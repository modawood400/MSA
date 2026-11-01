<?php
/**
 * Mining Saudi Arabia theme.
 *
 * @package msa
 */

defined( 'ABSPATH' ) || exit;

define( 'MSA_VERSION', '1.0.0' );

require get_theme_file_path( 'inc/content-types.php' );
require get_theme_file_path( 'inc/forms.php' );
require get_theme_file_path( 'inc/customizer.php' );
require get_theme_file_path( 'inc/template-tags.php' );

add_action( 'after_setup_theme', function () {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'custom-logo', array( 'height' => 185, 'width' => 701, 'flex-width' => true, 'flex-height' => true ) );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	register_nav_menus( array(
		'footer'  => __( 'Footer — Company links', 'msa' ),
		'sidebar' => __( 'Side drawer', 'msa' ),
	) );
} );

/** URL of a file shipped in the theme's assets folder. */
function msa_asset( $path ) {
	return get_theme_file_uri( 'assets/' . ltrim( $path, '/' ) );
}

/** Site logo: the Customizer logo when set, otherwise the bundled one. */
function msa_logo_url() {
	$id = get_theme_mod( 'custom_logo' );
	if ( $id ) {
		$src = wp_get_attachment_image_url( $id, 'full' );
		if ( $src ) {
			return $src;
		}
	}
	return msa_asset( 'img/logo.png' );
}

add_action( 'wp_enqueue_scripts', function () {
	wp_enqueue_style( 'msa-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=IBM+Plex+Sans+Arabic:wght@400;500;600;700&display=swap', array(), null );
	wp_enqueue_style( 'msa-main', msa_asset( 'css/main.css' ), array( 'msa-fonts' ), MSA_VERSION );
	wp_enqueue_style( 'msa-inner', msa_asset( 'css/inner.css' ), array( 'msa-main' ), MSA_VERSION );

	wp_enqueue_script( 'msa-main', msa_asset( 'js/main.js' ), array(), MSA_VERSION, true );
	wp_localize_script( 'msa-main', 'MSA', array(
		'lead'      => esc_url_raw( rest_url( 'msa/v1/lead' ) ),
		'subscribe' => esc_url_raw( rest_url( 'msa/v1/subscribe' ) ),
	) );
} );

add_action( 'wp_head', function () {
	echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
	echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
	echo '<meta name="theme-color" content="#0d1117">' . "\n";
}, 1 );

/** Front-page SEO tags and structured data, unless an SEO plugin already handles them. */
add_action( 'wp_head', function () {
	if ( ! is_front_page() ) {
		return;
	}
	$home = home_url( '/' );
	echo '<link rel="alternate" hreflang="en" href="' . esc_url( $home ) . '">' . "\n";
	echo '<link rel="alternate" hreflang="ar" href="' . esc_url( add_query_arg( 'lang', 'ar', $home ) ) . '">' . "\n";

	$seo_plugin = defined( 'WPSEO_VERSION' ) || defined( 'RANK_MATH_VERSION' ) || defined( 'AIOSEO_VERSION' ) || defined( 'SEOPRESS_VERSION' );
	if ( ! $seo_plugin ) {
		$desc = get_bloginfo( 'description' );
		if ( ! $desc ) {
			$desc = 'Saudi mining news and analysis, the quarterly Mining Saudi Arabia Magazine, Mining Leaders interviews, on-the-ground event coverage and a weekly newsletter.';
		}
		echo '<meta name="description" content="' . esc_attr( $desc ) . '">' . "\n";
		echo '<meta property="og:type" content="website">' . "\n";
		echo '<meta property="og:site_name" content="Mining Saudi Arabia">' . "\n";
		echo '<meta property="og:title" content="' . esc_attr( wp_get_document_title() ) . '">' . "\n";
		echo '<meta property="og:description" content="' . esc_attr( $desc ) . '">' . "\n";
		echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
	}

	$org   = $home . '#org';
	$ep    = msa_episode();
	$graph = array(
		array(
			'@type'              => 'NewsMediaOrganization',
			'@id'                => $org,
			'name'               => 'Mining Saudi Arabia',
			'url'                => $home,
			'logo'               => msa_logo_url(),
			'parentOrganization' => array( '@type' => 'Organization', 'name' => 'Mining News Company Limited' ),
			'sameAs'             => array( 'https://www.linkedin.com/company/mining-saudi-arabia', 'https://www.youtube.com/@miningSaudiArabia' ),
		),
		array(
			'@type'      => 'WebSite',
			'@id'        => $home . '#site',
			'url'        => $home,
			'name'       => 'Mining Saudi Arabia',
			'publisher'  => array( '@id' => $org ),
			'inLanguage' => array( 'en', 'ar' ),
		),
	);
	if ( $ep['id'] ) {
		$graph[] = array(
			'@type'        => 'VideoObject',
			'name'         => 'Mining Leaders | ' . $ep['guest'] . ', ' . $ep['role'],
			'embedUrl'     => 'https://www.youtube-nocookie.com/embed/' . $ep['id'],
			'thumbnailUrl' => 'https://i.ytimg.com/vi/' . $ep['id'] . '/hqdefault.jpg',
			'uploadDate'   => $ep['date'],
			'publisher'    => array( '@id' => $org ),
		);
	}
	echo '<script type="application/ld+json">' . wp_json_encode( array( '@context' => 'https://schema.org', '@graph' => $graph ), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . "</script>\n";
} );

/** Shorter excerpts with a plain ellipsis for the cards. */
add_filter( 'excerpt_length', function () {
	return 28;
} );
add_filter( 'excerpt_more', function () {
	return '…';
} );
