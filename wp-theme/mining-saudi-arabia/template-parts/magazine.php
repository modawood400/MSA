<?php
/**
 * 2. Magazine: the three latest issues, listed and fanned out as covers.
 *
 * @package msa
 */

$issues = msa_latest( 'magazine', 3 );
if ( ! $issues ) {
	return;
}
$slots = array( 'c1', 'c2', 'c3' );
?>
<!-- 2. MAGAZINE -->
<section class="dark" id="magazine" aria-labelledby="magH">
  <div class="wrap mag-grid">
    <div class="mag-text">
      <h2 class="h mag-title" id="magH" data-i18n="mag.h">Our <span>Magazine</span></h2>
      <ul class="mag-issues">
        <?php foreach ( $issues as $i => $p ) : ?>
          <li><a href="<?php echo esc_url( get_permalink( $p ) ); ?>" data-cover="<?php echo esc_attr( $slots[ $i ] ); ?>"><?php echo get_the_post_thumbnail( $p, 'thumbnail', array( 'class' => 'th', 'alt' => '', 'loading' => 'lazy' ) ); ?><span><span class="q"><?php echo esc_html( msa_issue_label( $p ) ); ?></span><?php echo 0 === $i ? '<span class="lbl" data-i18n="mag.latest">Latest issue</span>' : '<span class="lbl" data-i18n="mag.prev">Previous issue</span>'; ?></span><span class="arr"><?php echo msa_icon( 'arr14' ); // phpcs:ignore ?></span></a></li>
        <?php endforeach; ?>
      </ul>
      <div class="mag-ctas">
        <a class="btn btn-gold" href="<?php echo esc_url( get_permalink( $issues[0] ) ); ?>" data-i18n="mag.cta">Read the <?php echo esc_html( msa_issue_label( $issues[0] ) ); ?> issue</a>
        <a class="btn btn-ghost" href="<?php echo esc_url( msa_archive_url( 'magazine' ) ); ?>" data-i18n="mag.all">All issues</a>
      </div>
    </div>
    <div class="mag-stage" id="magStage">
      <?php
      // Back covers first so the latest issue (c1) sits on top.
      foreach ( array( 1, 2, 0 ) as $i ) :
          if ( ! isset( $issues[ $i ] ) ) {
              continue;
          }
          $p     = $issues[ $i ];
          $label = msa_issue_label( $p );
          ?>
        <a class="cover <?php echo esc_attr( $slots[ $i ] ); ?>" href="<?php echo esc_url( get_permalink( $p ) ); ?>" aria-label="<?php echo esc_attr( 'Mining Saudi Arabia Magazine ' . $label ); ?>" tabindex="-1">
          <div class="inner"><?php echo get_the_post_thumbnail( $p, 'large', array( 'alt' => $label . ' cover', 'loading' => 'lazy' ) ); ?></div>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>
