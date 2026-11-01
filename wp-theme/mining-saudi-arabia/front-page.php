<?php
/**
 * Home page: articles, magazine, Mining Leaders, events, newsletter, reach, work with us.
 *
 * @package msa
 */

get_header();

foreach ( array( 'articles', 'magazine', 'mining-leaders', 'events', 'newsletter', 'reach', 'advertise' ) as $section ) {
	get_template_part( 'template-parts/' . $section );
}

get_footer();
