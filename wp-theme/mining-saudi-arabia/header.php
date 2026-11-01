<?php
/**
 * Site header: headline ticker, logo, section navigation.
 *
 * @package msa
 */

$ticker = msa_latest( 'article', 6 );
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip" href="#main" data-i18n="skip">Skip to content</a>

<div class="topbar">
  <div class="wrap">
    <div class="ticker"><b data-i18n="ticker">Latest</b><div class="ticker-view"><div class="ticker-track" dir="ltr">
      <?php
      // The track is printed twice so the marquee loops seamlessly.
      foreach ( array( false, true ) as $dup ) {
          foreach ( $ticker as $p ) {
              printf(
                  '<a href="%s"%s>%s</a>',
                  esc_url( get_permalink( $p ) ),
                  $dup ? ' tabindex="-1" aria-hidden="true"' : '',
                  esc_html( get_the_title( $p ) )
              );
          }
      }
      ?>
    </div></div></div>
    <div class="tb-right">
      <div class="social">
        <a href="https://www.linkedin.com/company/mining-saudi-arabia" aria-label="LinkedIn" target="_blank" rel="noopener"><svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M4.98 3.5a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5zM3 9h4v12H3zM9 9h3.8v1.7h.05c.53-1 1.83-2.05 3.77-2.05C20.6 8.65 21 11.2 21 14.4V21h-4v-5.8c0-1.4-.03-3.2-1.95-3.2-1.95 0-2.25 1.52-2.25 3.1V21H9z"/></svg></a>
        <a href="https://www.youtube.com/@miningSaudiArabia" aria-label="YouTube" target="_blank" rel="noopener"><svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M23 7.2a3 3 0 0 0-2.1-2.1C19 4.6 12 4.6 12 4.6s-7 0-8.9.5A3 3 0 0 0 1 7.2 31 31 0 0 0 .5 12a31 31 0 0 0 .5 4.8 3 3 0 0 0 2.1 2.1c1.9.5 8.9.5 8.9.5s7 0 8.9-.5a3 3 0 0 0 2.1-2.1 31 31 0 0 0 .5-4.8 31 31 0 0 0-.5-4.8zM9.7 15.1V8.9L15.5 12z"/></svg></a>
      </div>
      <div class="lang" role="group" aria-label="Language">
        <button type="button" data-lang="en" aria-pressed="true">EN</button>
        <button type="button" data-lang="ar" aria-pressed="false" lang="ar">العربية</button>
      </div>
    </div>
  </div>
</div>

<header class="site" id="siteHeader">
  <div class="wrap">
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo" aria-label="Mining Saudi Arabia — home"><img src="<?php echo esc_url( msa_logo_url() ); ?>" alt="Mining Saudi Arabia" width="144" height="38"></a>
    <nav class="main" id="nav" aria-label="Main">
      <a href="<?php echo esc_url( msa_section_url( 'articles' ) ); ?>" data-i18n="nav.articles">Articles</a>
      <a href="<?php echo esc_url( msa_section_url( 'magazine' ) ); ?>" data-i18n="nav.magazine">Magazine</a>
      <a href="<?php echo esc_url( msa_section_url( 'mining-leaders' ) ); ?>" data-i18n="nav.leaders">Mining Leaders</a>
      <a href="<?php echo esc_url( msa_section_url( 'events' ) ); ?>" data-i18n="nav.events">Events</a>
      <a href="<?php echo esc_url( msa_section_url( 'newsletter' ) ); ?>" data-i18n="nav.newsletter">Newsletter</a>
      <a href="<?php echo esc_url( msa_section_url( 'advertise' ) ); ?>" data-i18n="nav.advertise">Advertise</a>
      <span class="nav-ind" id="navInd" aria-hidden="true"></span>
    </nav>
    <a href="<?php echo esc_url( msa_section_url( 'newsletter' ) ); ?>" class="btn btn-gold btn-sm head-cta" data-i18n="cta.subscribe">Subscribe</a>
    <button class="menu-btn" id="menuBtn" aria-label="Menu" aria-expanded="false" aria-controls="sideDrawer">
      <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path class="l l1" d="M4 7h16"/><path class="l l2" d="M4 12h16"/><path class="l l3" d="M4 17h16"/></svg>
    </button>
    <span class="scroll-prog" id="scrollProg" aria-hidden="true"></span>
  </div>
</header>

<?php get_template_part( 'template-parts/side-drawer' ); ?>

<main id="main">
