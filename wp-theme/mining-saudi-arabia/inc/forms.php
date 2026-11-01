<?php
/**
 * Lead form and newsletter sign-up.
 *
 * Both forms post JSON to the REST API. Each submission is saved in wp-admin (Leads / Subscribers)
 * and, for leads, emailed to the address set in Customizer → Mining Saudi Arabia → Forms.
 * Hooks for CRM / email-platform integrations: msa_lead_received, msa_subscriber_added.
 *
 * @package msa
 */

defined( 'ABSPATH' ) || exit;

add_action( 'rest_api_init', function () {
	register_rest_route( 'msa/v1', '/lead', array(
		'methods'             => 'POST',
		'callback'            => 'msa_handle_lead',
		'permission_callback' => '__return_true',
	) );
	register_rest_route( 'msa/v1', '/subscribe', array(
		'methods'             => 'POST',
		'callback'            => 'msa_handle_subscribe',
		'permission_callback' => '__return_true',
	) );
} );

/** Basic abuse guard: honeypot field plus a per-IP limit. Returns a WP_Error when blocked. */
function msa_form_guard( WP_REST_Request $req, $bucket ) {
	if ( '' !== (string) $req->get_param( 'website' ) ) {
		return new WP_Error( 'msa_spam', 'Rejected.', array( 'status' => 400 ) );
	}
	$ip  = isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : '';
	$key = 'msa_rl_' . $bucket . '_' . md5( $ip );
	$n   = (int) get_transient( $key );
	if ( $n >= 5 ) {
		return new WP_Error( 'msa_rate', 'Too many requests.', array( 'status' => 429 ) );
	}
	set_transient( $key, $n + 1, 10 * MINUTE_IN_SECONDS );
	return true;
}

const MSA_SERVICES = array(
	'articles'     => 'Featured articles',
	'magazine'     => 'Magazine coverage',
	'interviews'   => 'Interviews & video',
	'events'       => 'Event coverage',
	'newsletter'   => 'Newsletter & email',
	'linkedin'     => 'LinkedIn & social',
	'directory'    => 'Company directory',
	'market-entry' => 'Market entry campaigns',
	'unsure'       => 'Not sure yet',
);

const MSA_GOALS = array(
	'market-entry'         => 'Market entry',
	'brand-awareness'      => 'Brand awareness',
	'decision-makers'      => 'Reach decision-makers',
	'lead-generation'      => 'Lead generation',
	'event-promotion'      => 'Event promotion',
	'executive-visibility' => 'Executive visibility',
);

function msa_handle_lead( WP_REST_Request $req ) {
	$guard = msa_form_guard( $req, 'lead' );
	if ( is_wp_error( $guard ) ) {
		return $guard;
	}

	$name    = sanitize_text_field( (string) $req->get_param( 'name' ) );
	$email   = sanitize_email( (string) $req->get_param( 'email' ) );
	$company = sanitize_text_field( (string) $req->get_param( 'company' ) );
	if ( ! $name || ! $company || ! is_email( $email ) ) {
		return new WP_Error( 'msa_invalid', 'Name, a valid email and company are required.', array( 'status' => 400 ) );
	}
	$type    = 'meeting' === $req->get_param( 'requestType' ) ? 'Book a marketing meeting' : 'Request the media kit';
	$service = (string) $req->get_param( 'service' );
	$service = isset( MSA_SERVICES[ $service ] ) ? MSA_SERVICES[ $service ] : '—';
	$goals   = array_values( array_intersect_key( MSA_GOALS, array_flip( array_map( 'strval', (array) $req->get_param( 'goals' ) ) ) ) );
	$details = sanitize_textarea_field( (string) $req->get_param( 'details' ) );
	$lang    = 'ar' === $req->get_param( 'lang' ) ? 'Arabic' : 'English';

	$lines = array(
		'Request'  => $type,
		'Name'     => $name,
		'Email'    => $email,
		'Company'  => $company,
		'Service'  => $service,
		'Goals'    => $goals ? implode( ', ', $goals ) : '—',
		'Details'  => $details ? $details : '—',
		'Language' => $lang,
	);
	$body = '';
	foreach ( $lines as $k => $v ) {
		$body .= $k . ': ' . $v . "\n";
	}

	$id = wp_insert_post( array(
		'post_type'    => 'msa_lead',
		'post_status'  => 'private',
		'post_title'   => $name . ' — ' . $company,
		'post_content' => $body,
	) );
	if ( is_wp_error( $id ) || ! $id ) {
		return new WP_Error( 'msa_save', 'Could not save.', array( 'status' => 500 ) );
	}
	foreach ( $lines as $k => $v ) {
		update_post_meta( $id, 'msa_' . strtolower( $k ), $v );
	}

	$to = get_theme_mod( 'msa_leads_email', get_option( 'admin_email' ) );
	wp_mail( $to, sprintf( '[Mining Saudi Arabia] %s — %s', $type, $company ), $body, array( 'Reply-To: ' . $name . ' <' . $email . '>' ) );

	do_action( 'msa_lead_received', $lines, $id );
	return array( 'ok' => true );
}

function msa_handle_subscribe( WP_REST_Request $req ) {
	$guard = msa_form_guard( $req, 'nl' );
	if ( is_wp_error( $guard ) ) {
		return $guard;
	}
	$email = sanitize_email( (string) $req->get_param( 'email' ) );
	if ( ! is_email( $email ) ) {
		return new WP_Error( 'msa_invalid', 'A valid email is required.', array( 'status' => 400 ) );
	}
	$exists = get_posts( array(
		'post_type'      => 'msa_subscriber',
		'post_status'    => 'private',
		'title'          => $email,
		'posts_per_page' => 1,
		'fields'         => 'ids',
	) );
	if ( ! $exists ) {
		$id = wp_insert_post( array(
			'post_type'    => 'msa_subscriber',
			'post_status'  => 'private',
			'post_title'   => $email,
			'post_content' => 'Language: ' . ( 'ar' === $req->get_param( 'lang' ) ? 'Arabic' : 'English' ),
		) );
		do_action( 'msa_subscriber_added', $email, $id );
	}
	return array( 'ok' => true );
}

/** Export subscribers as CSV from Subscribers → Export CSV. */
add_action( 'admin_menu', function () {
	add_submenu_page( 'edit.php?post_type=msa_subscriber', 'Export CSV', 'Export CSV', 'manage_options', 'msa-export', '__return_null' );
} );
add_action( 'admin_init', function () {
	if ( ! isset( $_GET['page'] ) || 'msa-export' !== $_GET['page'] || ! current_user_can( 'manage_options' ) ) {
		return;
	}
	$ids = get_posts( array( 'post_type' => 'msa_subscriber', 'post_status' => 'private', 'posts_per_page' => -1, 'fields' => 'ids' ) );
	header( 'Content-Type: text/csv; charset=utf-8' );
	header( 'Content-Disposition: attachment; filename=subscribers-' . gmdate( 'Y-m-d' ) . '.csv' );
	$out = fopen( 'php://output', 'w' );
	fputcsv( $out, array( 'email', 'date' ) );
	foreach ( $ids as $id ) {
		fputcsv( $out, array( get_the_title( $id ), get_the_date( 'Y-m-d H:i', $id ) ) );
	}
	exit;
} );
