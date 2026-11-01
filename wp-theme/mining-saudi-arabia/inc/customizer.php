<?php
/**
 * Customizer: the featured Mining Leaders episode and form settings.
 *
 * @package msa
 */

defined( 'ABSPATH' ) || exit;

function msa_episode_defaults() {
	return array(
		'id'      => '_3ID3TQO5pQ',
		'ep'      => 'EP 01',
		'guest'   => 'Adam Oehlman',
		'role'    => 'CEO, Sierra Nevada Gold',
		'company' => 'Sierra Nevada Gold',
		'date'    => '2026-10-20',
	);
}

/** The episode shown in the Mining Leaders section. */
function msa_episode() {
	$ep = array();
	foreach ( msa_episode_defaults() as $k => $default ) {
		$ep[ $k ] = trim( (string) get_theme_mod( 'msa_ml_' . $k, $default ) );
	}
	// Accept a full YouTube URL as well as a bare video ID.
	if ( preg_match( '~(?:v=|youtu\.be/|embed/|shorts/)([\w-]{11})~', $ep['id'], $m ) ) {
		$ep['id'] = $m[1];
	}
	return $ep;
}

add_action( 'customize_register', function ( WP_Customize_Manager $c ) {
	$c->add_panel( 'msa', array( 'title' => 'Mining Saudi Arabia', 'priority' => 30 ) );

	$c->add_section( 'msa_ml', array(
		'title'       => 'Mining Leaders episode',
		'panel'       => 'msa',
		'description' => 'The episode featured on the home page.',
	) );
	$fields = array(
		'id'      => array( 'YouTube video URL or ID', 'text' ),
		'ep'      => array( 'Episode label', 'text' ),
		'guest'   => array( 'Guest name', 'text' ),
		'role'    => array( 'Guest title', 'text' ),
		'company' => array( 'Company', 'text' ),
		'date'    => array( 'Release date', 'date' ),
	);
	$defaults = msa_episode_defaults();
	foreach ( $fields as $k => $f ) {
		$c->add_setting( 'msa_ml_' . $k, array( 'default' => $defaults[ $k ], 'sanitize_callback' => 'sanitize_text_field' ) );
		$c->add_control( 'msa_ml_' . $k, array( 'label' => $f[0], 'type' => $f[1], 'section' => 'msa_ml' ) );
	}

	$c->add_section( 'msa_forms', array( 'title' => 'Forms', 'panel' => 'msa' ) );
	$c->add_setting( 'msa_leads_email', array( 'default' => get_option( 'admin_email' ), 'sanitize_callback' => 'sanitize_email' ) );
	$c->add_control( 'msa_leads_email', array(
		'label'       => 'Send media-kit / meeting requests to',
		'type'        => 'email',
		'section'     => 'msa_forms',
		'description' => 'Every request is also saved under Leads in the admin menu.',
	) );
} );
