<?php
/**
 * Side drawer: "Just in" feed plus the full site menu. Opened from the header menu button.
 * Assign a menu to "Side drawer" (Appearance → Menus) to replace the default links.
 *
 * @package msa
 */

$feed = get_posts( array(
	'post_type'           => array_unique( array( msa_pt( 'article' ), msa_pt( 'newsletter' ), msa_pt( 'magazine' ) ) ),
	'posts_per_page'      => 3,
	'post_status'         => 'publish',
	'ignore_sticky_posts' => true,
) );
$type_keys = array( 'article' => 'side.t.article', 'newsletter' => 'side.t.newsletter', 'magazine' => 'side.t.magazine' );

$here = trailingslashit( strtok( home_url( add_query_arg( array() ) ), '?' ) );
/** One drawer link; marked current when it points at the page being viewed. */
$link = function ( $url, $label, $key, $sub = false ) use ( $here ) {
	$on = trailingslashit( strtok( $url, '#?' ) ) === $here && false === strpos( $url, '#' );
	printf(
		'<li><a class="%s" href="%s"%s data-i18n="%s">%s</a></li>',
		esc_attr( trim( ( $sub ? 'sub' : '' ) . ( $on ? ' on' : '' ) ) ),
		esc_url( $url ),
		$on ? ' aria-current="page"' : '',
		esc_attr( $key ),
		esc_html( $label )
	);
};
?>
<div class="side-scrim" id="sideScrim" hidden></div>
<aside class="side-drawer" id="sideDrawer" aria-label="Site menu" aria-hidden="true" inert>
  <div class="side-top">
    <img src="<?php echo esc_url( msa_logo_url() ); ?>" alt="Mining Saudi Arabia" width="128" height="34">
    <button type="button" class="side-close" id="sideClose" aria-label="Close menu"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"><path d="M6 6l12 12M18 6 6 18"/></svg></button>
  </div>

  <?php if ( $feed ) : ?>
  <section class="side-feed" aria-labelledby="sideFeedH">
    <h2 id="sideFeedH" data-i18n="side.justin">Just in</h2>
    <ul>
      <?php
      foreach ( $feed as $p ) :
          $is_new = ( time() - get_post_time( 'U', true, $p ) ) < WEEK_IN_SECONDS;
          $tk     = isset( $type_keys[ $p->post_type ] ) ? $type_keys[ $p->post_type ] : 'side.t.article';
          $tname  = get_post_type_object( $p->post_type )->labels->singular_name;
          ?>
        <li class="<?php echo $is_new ? 'is-new' : ''; ?>">
          <a href="<?php echo esc_url( get_permalink( $p ) ); ?>">
            <span class="sf-meta"><?php if ( $is_new ) : ?><b data-i18n="side.new">New</b> · <?php endif; ?><span data-i18n="<?php echo esc_attr( $tk ); ?>"><?php echo esc_html( 'post' === $p->post_type ? 'Article' : $tname ); ?></span> · <time datetime="<?php echo esc_attr( get_the_date( 'Y-m-d', $p ) ); ?>"><?php echo esc_html( get_the_date( 'j M', $p ) ); ?></time></span>
            <span class="sf-title" dir="auto"><?php echo esc_html( get_the_title( $p ) ); ?></span>
          </a>
        </li>
      <?php endforeach; ?>
    </ul>
  </section>
  <?php endif; ?>

  <nav class="side-nav" aria-label="Site">
    <?php
    if ( has_nav_menu( 'sidebar' ) ) {
        wp_nav_menu( array( 'theme_location' => 'sidebar', 'container' => false, 'depth' => 2 ) );
    } else {
        ?>
    <ul>
      <?php $link( home_url( '/' ), 'Home', 'side.home' ); ?>
      <li class="grp"><span data-i18n="side.news">Latest News</span>
        <ul>
          <?php
          $link( msa_archive_url( 'magazine' ), 'Magazine', 'nav.magazine', true );
          $link( msa_archive_url( 'article' ), 'Article', 'side.article', true );
          $link( msa_archive_url( 'newsletter' ), 'Newsletter', 'nav.newsletter', true );
          ?>
        </ul>
      </li>
      <?php $link( home_url( '/event-webinar/' ), 'Event/Webinar', 'side.events' ); ?>
      <li class="grp"><span data-i18n="side.dir">Directory</span>
        <ul>
          <?php
          $link( home_url( '/browse-company-directory/' ), 'Browse Company Directory', 'side.browse', true );
          $link( home_url( '/list-your-company/' ), 'List Your Company', 'side.list', true );
          ?>
        </ul>
      </li>
      <li class="grp"><span data-i18n="ft.company">Company</span>
        <ul>
          <?php
          $link( home_url( '/about-us/' ), 'About MSA', 'side.about', true );
          $link( home_url( '/contact-us/' ), 'Contact Us', 'side.contact', true );
          ?>
        </ul>
      </li>
      <?php $link( msa_section_url( 'advertise' ), 'Advertise', 'nav.advertise' ); ?>
    </ul>
        <?php
    }
    ?>
  </nav>

  <a class="btn btn-gold side-cta" href="<?php echo esc_url( msa_section_url( 'newsletter' ) ); ?>" data-i18n="cta.subscribe">Subscribe</a>
</aside>
