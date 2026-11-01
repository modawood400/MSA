<?php
/**
 * Static pages (About, Privacy policy, Terms…).
 *
 * @package msa
 */

get_header();

while ( have_posts() ) :
	the_post();
	?>
<article <?php post_class( 'post-single' ); ?>>
  <header class="post-head">
    <div class="wrap narrow">
      <h1><?php the_title(); ?></h1>
    </div>
  </header>
  <div class="wrap narrow post-body">
    <?php if ( has_post_thumbnail() ) : ?>
      <figure class="post-hero"><?php the_post_thumbnail( 'full' ); ?></figure>
    <?php endif; ?>
    <div class="entry">
      <?php
      the_content();
      wp_link_pages();
      ?>
    </div>
  </div>
</article>
	<?php
endwhile;

get_footer();
