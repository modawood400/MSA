<?php
/**
 * 1. Latest articles over the animated contour map.
 *
 * @package msa
 */

$articles = msa_latest( 'article', 9 );
?>
<!-- 1. ARTICLES -->
<section class="lead-wrap" id="articles" aria-labelledby="leadH">
  <div class="topo-fx" aria-hidden="true">
    <div class="topo-stage"><canvas id="topoFx"></canvas></div>
  </div>
  <div class="wrap">
    <?php if ( $articles ) : ?>
    <div class="mosaic">
      <?php
      foreach ( $articles as $i => $p ) {
          msa_card( $p, 0 === $i, 0 === $i ? 'h1' : 'h3', 0 !== $i );
      }
      ?>
    </div>
    <?php endif; ?>
    <div class="lead-head">
      <div>
        <span class="kicker" data-i18n="news.eyebrow">Newsroom</span>
        <h2<?php echo $articles ? '' : ' id="leadH"'; ?> data-i18n="art.latest">Latest articles</h2>
        <p data-i18n="art.sub">News and analysis from Saudi Arabia’s mining sector.</p>
      </div>
      <a class="btn btn-dark btn-sm" href="<?php echo esc_url( msa_archive_url( 'article' ) ); ?>"><span data-i18n="art.all">All articles</span> <?php echo msa_icon( 'arrow' ); // phpcs:ignore ?></a>
    </div>
  </div>
</section>
