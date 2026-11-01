<?php
/**
 * Not found.
 *
 * @package msa
 */

get_header();
?>
<section class="lead-wrap archive-wrap nf">
  <div class="wrap">
    <p class="nf-code">404</p>
    <h1 class="big-title" data-i18n="art.notfound">Page not found</h1>
    <a class="btn btn-dark" href="<?php echo esc_url( home_url( '/' ) ); ?>" data-i18n="art.back">Back to the home page</a>
  </div>
</section>
<?php
get_footer();
