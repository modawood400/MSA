<?php
/**
 * Template helpers.
 *
 * @package msa
 */

defined( 'ABSPATH' ) || exit;

/** Link to a home-page section: a bare anchor on the front page, a full URL elsewhere. */
function msa_section_url( $id ) {
	return is_front_page() ? '#' . $id : home_url( '/#' . $id );
}

/** First term of the post's first public taxonomy, used as the card label. */
function msa_term_label( $post = null ) {
	$post = get_post( $post );
	foreach ( get_object_taxonomies( $post->post_type, 'objects' ) as $tax ) {
		if ( ! $tax->public || 'post_format' === $tax->name || 'post_tag' === $tax->name ) {
			continue;
		}
		$terms = get_the_terms( $post, $tax->name );
		if ( $terms && ! is_wp_error( $terms ) && 'uncategorized' !== $terms[0]->slug ) {
			return $terms[0]->name;
		}
	}
	return '';
}

/** "Q3 2026" from "Mining Saudi Arabia Magazine Q3 2026", otherwise the full title. */
function msa_issue_label( $post = null ) {
	$title = get_the_title( $post );
	return preg_match( '/\bQ[1-4]\s*\d{4}\b/i', $title, $m ) ? strtoupper( $m[0] ) : $title;
}

function msa_icon( $name ) {
	$icons = array(
		'chev'  => '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6"><path d="M9 6l6 6-6 6"/></svg>',
		'arrow' => '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M13 6l6 6-6 6"/></svg>',
		'arr14' => '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M13 6l6 6-6 6"/></svg>',
	);
	return isset( $icons[ $name ] ) ? $icons[ $name ] : '';
}

/**
 * Article card. $big renders the horizontal lead card; $heading is the tag for its title.
 */
function msa_card( $post = null, $big = false, $heading = 'h3', $lazy = true ) {
	$post  = get_post( $post );
	$label = $big && is_front_page() ? '' : msa_term_label( $post );
	?>
	<a class="acard<?php echo $big ? ' big' : ''; ?>" href="<?php echo esc_url( get_permalink( $post ) ); ?>">
		<div class="pic">
			<?php
			if ( has_post_thumbnail( $post ) ) {
				echo get_the_post_thumbnail( $post, $big ? 'full' : 'large', array(
					'alt'           => '',
					'loading'       => $lazy ? 'lazy' : 'eager',
					'fetchpriority' => $lazy ? 'auto' : 'high',
				) );
			} else {
				echo '<span class="noimg" aria-hidden="true"></span>';
			}
			if ( $big && is_front_page() ) {
				echo '<span class="cat" data-i18n="tag.top">Top story</span>';
			} elseif ( $label ) {
				echo '<span class="cat">' . esc_html( $label ) . '</span>';
			}
			?>
		</div>
		<div class="body">
			<time class="date" datetime="<?php echo esc_attr( get_the_date( 'Y-m-d', $post ) ); ?>"><?php echo esc_html( get_the_date( 'M j, Y', $post ) ); ?></time>
			<<?php echo tag_escape( $heading ); ?><?php echo 'h1' === $heading ? ' id="leadH"' : ''; ?>><?php echo esc_html( get_the_title( $post ) ); ?></<?php echo tag_escape( $heading ); ?>>
			<p class="ex"><?php echo esc_html( wp_strip_all_tags( get_the_excerpt( $post ) ) ); ?></p>
			<span class="go"><span class="go-ic" aria-hidden="true"><?php echo msa_icon( 'chev' ); // phpcs:ignore ?></span><span data-i18n="art.read">Read more</span></span>
		</div>
	</a>
	<?php
}

/** Latest posts of a section's type. */
function msa_latest( $type, $count ) {
	return get_posts( array(
		'post_type'           => msa_pt( $type ),
		'posts_per_page'      => $count,
		'post_status'         => 'publish',
		'ignore_sticky_posts' => true,
	) );
}
