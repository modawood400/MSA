<?php
/**
 * Archives, blog index and search results: a card grid.
 *
 * @package msa
 */

get_header();

if ( is_search() ) {
	/* translators: %s: search query */
	$title = sprintf( __( 'Search: %s', 'msa' ), get_search_query() );
} elseif ( is_home() ) {
	$title = get_option( 'page_for_posts' ) ? get_the_title( get_option( 'page_for_posts' ) ) : __( 'Articles', 'msa' );
} elseif ( is_post_type_archive() ) {
	$title = post_type_archive_title( '', false );
} elseif ( is_category() || is_tag() || is_tax() ) {
	$title = single_term_title( '', false );
} else {
	$title = wp_strip_all_tags( get_the_archive_title() );
}
$desc = is_archive() ? get_the_archive_description() : '';
?>
<section class="lead-wrap archive-wrap">
  <div class="wrap">
    <header class="arch-head">
      <h1 class="big-title"><?php echo esc_html( $title ); ?></h1>
      <?php if ( $desc ) : ?><div class="arch-desc"><?php echo wp_kses_post( $desc ); ?></div><?php endif; ?>
      <form class="arch-search" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
        <label class="sr-only" for="s" data-i18n="art.search">Search</label>
        <input id="s" type="search" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="Search…">
        <?php if ( is_post_type_archive() ) : ?><input type="hidden" name="post_type" value="<?php echo esc_attr( get_query_var( 'post_type' ) ); ?>"><?php endif; ?>
        <button class="btn btn-dark btn-sm" type="submit" data-i18n="art.search">Search</button>
      </form>
    </header>

    <?php if ( have_posts() ) : ?>
      <div class="mosaic">
        <?php
        $first = ! is_paged() && ! is_search();
        while ( have_posts() ) {
            the_post();
            msa_card( null, $first, $first ? 'h2' : 'h3', ! $first );
            $first = false;
        }
        ?>
      </div>
      <nav class="pager" aria-label="Pagination">
        <?php
        echo paginate_links( array( // phpcs:ignore
            'prev_text' => '‹',
            'next_text' => '›',
            'mid_size'  => 1,
        ) );
        ?>
      </nav>
    <?php else : ?>
      <p class="arch-empty" data-i18n="art.none">Nothing here yet.</p>
    <?php endif; ?>
  </div>
</section>
<?php
get_footer();
