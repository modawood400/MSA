<?php
/**
 * Content types.
 *
 * The live site already has "article", "magazine" and "newsletter" post types (registered by a
 * plugin). They are only registered here when nothing else has, so the theme also works on a
 * fresh install. Leads and newsletter sign-ups are stored as private, admin-only post types.
 *
 * @package msa
 */

defined( 'ABSPATH' ) || exit;

add_action( 'init', function () {
	$types = array(
		'article'    => array( 'Articles', 'Article', 'dashicons-media-document', array( 'category', 'post_tag' ) ),
		'magazine'   => array( 'Magazine', 'Magazine issue', 'dashicons-book', array() ),
		'newsletter' => array( 'Newsletter', 'Newsletter issue', 'dashicons-email-alt', array() ),
	);
	foreach ( $types as $type => $t ) {
		if ( post_type_exists( $type ) ) {
			continue;
		}
		register_post_type( $type, array(
			'labels'       => array(
				'name'          => $t[0],
				'singular_name' => $t[1],
				'add_new_item'  => 'Add ' . strtolower( $t[1] ),
				'edit_item'     => 'Edit ' . strtolower( $t[1] ),
			),
			'public'       => true,
			'has_archive'  => true,
			'rewrite'      => array( 'slug' => $type ),
			'menu_icon'    => $t[2],
			'show_in_rest' => true,
			'taxonomies'   => $t[3],
			'supports'     => array( 'title', 'editor', 'excerpt', 'thumbnail', 'author', 'revisions' ),
		) );
	}

	$private = array(
		'show_ui'         => true,
		'public'          => false,
		'capability_type' => 'post',
		'capabilities'    => array( 'create_posts' => 'do_not_allow' ),
		'map_meta_cap'    => true,
		'supports'        => array( 'title', 'editor' ),
	);
	register_post_type( 'msa_lead', $private + array(
		'labels'    => array( 'name' => 'Leads', 'singular_name' => 'Lead', 'edit_item' => 'Lead' ),
		'menu_icon' => 'dashicons-businessperson',
	) );
	register_post_type( 'msa_subscriber', $private + array(
		'labels'    => array( 'name' => 'Subscribers', 'singular_name' => 'Subscriber', 'edit_item' => 'Subscriber' ),
		'menu_icon' => 'dashicons-email',
	) );
}, 20 );

/** The post type to query for a section: the custom type when it exists, plain posts otherwise. */
function msa_pt( $type ) {
	return post_type_exists( $type ) ? $type : 'post';
}

/** Archive link for a section, falling back to the blog page. */
function msa_archive_url( $type ) {
	$url = post_type_exists( $type ) ? get_post_type_archive_link( $type ) : false;
	if ( ! $url ) {
		$blog = get_option( 'page_for_posts' );
		$url  = $blog ? get_permalink( $blog ) : home_url( '/' );
	}
	return $url;
}

add_action( 'after_switch_theme', 'flush_rewrite_rules' );
