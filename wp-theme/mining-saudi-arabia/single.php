<?php
/**
 * Single article / magazine issue / newsletter issue / post.
 *
 * @package msa
 */

get_header();

while ( have_posts() ) :
	the_post();
	$label   = msa_term_label();
	$words   = str_word_count( wp_strip_all_tags( get_the_content() ) );
	$minutes = max( 1, (int) round( $words / 220 ) );
	$enc     = rawurlencode( get_permalink() );
	$type    = get_post_type_object( get_post_type() );
	?>
<article <?php post_class( 'post-single' ); ?>>
  <header class="post-head">
    <div class="wrap narrow">
      <p class="post-kicker">
        <a href="<?php echo esc_url( msa_archive_url( get_post_type() ) ); ?>"><?php echo esc_html( 'post' === get_post_type() ? __( 'Articles', 'msa' ) : $type->labels->name ); ?></a>
        <?php if ( $label ) : ?><span><?php echo esc_html( $label ); ?></span><?php endif; ?>
      </p>
      <h1><?php the_title(); ?></h1>
      <?php if ( has_excerpt() ) : ?><p class="ex"><?php echo esc_html( get_the_excerpt() ); ?></p><?php endif; ?>
      <p class="post-meta">
        <time datetime="<?php echo esc_attr( get_the_date( 'Y-m-d' ) ); ?>"><?php echo esc_html( get_the_date( 'M j, Y' ) ); ?></time>
        <span><?php echo esc_html( $minutes ); ?> min read</span>
      </p>
    </div>
  </header>

  <div class="wrap narrow post-body">
    <?php if ( has_post_thumbnail() ) : ?>
      <figure class="post-hero"><?php the_post_thumbnail( 'full', array( 'fetchpriority' => 'high', 'loading' => 'eager' ) ); ?></figure>
    <?php endif; ?>

    <div class="entry">
      <?php
      the_content();
      wp_link_pages();
      ?>
    </div>

    <div class="post-share">
      <span data-i18n="ml.share">Share</span>
      <a href="<?php echo esc_url( 'https://www.linkedin.com/sharing/share-offsite/?url=' . $enc ); ?>" target="_blank" rel="noopener">LinkedIn</a>
      <a href="<?php echo esc_url( 'https://x.com/intent/post?url=' . $enc ); ?>" target="_blank" rel="noopener">X</a>
      <a href="<?php echo esc_url( 'https://wa.me/?text=' . $enc ); ?>" target="_blank" rel="noopener">WhatsApp</a>
    </div>

    <aside class="post-cta">
      <div>
        <b data-i18n="nl.title">Weekly <span>Newsletter</span></b>
        <p data-i18n="nl.p">The Saudi Mining Weekly rounds up the projects, funding, discoveries and deals that moved the sector — in one short read.</p>
      </div>
      <a class="btn btn-gold" href="<?php echo esc_url( msa_section_url( 'newsletter' ) ); ?>" data-i18n="cta.subscribe">Subscribe</a>
    </aside>
  </div>
</article>

	<?php
	$related = get_posts( array(
		'post_type'      => get_post_type(),
		'posts_per_page' => 3,
		'post__not_in'   => array( get_the_ID() ),
		'post_status'    => 'publish',
	) );
	if ( $related ) :
		?>
<section class="related lead-wrap">
  <div class="wrap">
    <h2 class="big-title" data-i18n="art.related">Read next</h2>
    <div class="mosaic cols-3">
      <?php
      foreach ( $related as $p ) {
          msa_card( $p );
      }
      ?>
    </div>
  </div>
</section>
		<?php
	endif;
endwhile;

get_footer();
