<?php
/**
 * UDS Hero - Post
 *
 * Delivers ACF options to define a query for a single post.
 * Creates a hero from the result based on the featured image + excerpt + permalink
 *
 * @package Pitchfork_Blocks
 */

$size		= get_field( 'uds_hero_post_size' );
$source		= get_field( 'uds_hero_post_source' );
$single		= get_field( 'uds_hero_post_single' );
$category	= get_field( 'uds_hero_post_category' );
$tag		= get_field( 'uds_hero_post_tag' );
$offset		= get_field( 'uds_hero_post_offset' );

$btn_color		= get_field( 'uds_hero_post_btn_color' );
$btn_label		= get_field( 'uds_hero_post_btn_label' );

/**
 * Configure block wrapper markup.
 *  - Returns a string for inclusion with style=""
 *  - Add alignment markup and additional user classes
 * --------------------
 */
$spacing = pitchfork_blocks_acf_calculate_spacing( $block );

$additional_classes = '';
if ( ! empty( $block['className'] ) ) {
	$additional_classes = $block['className'];
}

$alignment = '';
if ( ! empty( $block['align'] ) ) {
	$alignment = ' alignfull';
}

/**
 * Build the query according to the user settings.
 */

if ('direct' === $source ) {

	$title = get_the_title( $single );
	$permalink = get_permalink( $single );
	$excerpt = get_the_excerpt( $single );

	if ( has_post_thumbnail( $single ) ) {
		$image = get_post_thumbnail_id( $single );
	} else {
		// Set a default or "empty state" image here.
		$image = '';
	}

} else {

	$args = array(
        'post_type' => 'post',
        'posts_per_page' => 1,
        'offset' => $offset,
        'post_status' => array( 'publish' ),
    );

	if ( 'latest' === $source ) {

		$args = array(
			'post_type' => 'post',
			'posts_per_page' => 1,
			'offset' => $offset,
			'post_status' => array( 'publish' ),
		);

    } else {

		if ( 'post_tag' === $source ) {
			$terms = $tag;
		} else {
			// 'category' === $source
			$terms = $category;
		}

		$args = array(
			'post_type' => 'post',
			'posts_per_page' => 1,
			'offset' => $offset,
			'post_status' => array( 'publish' ),
			'tax_query' => array(
				array(
					'taxonomy' => $source,
					'terms'    => $terms,
				),
			),
		);

    }

	$posthero = new WP_Query( $args );

    if ( $posthero->have_posts() ) :
        while ( $posthero->have_posts() ) : $posthero->the_post();

		if ( has_post_thumbnail() ) {
			$image = get_post_thumbnail_id($posthero->ID);
		} else {
			// Set a default or "empty state" image here.
			$image = '';
		}

		$title = get_the_title( $posthero->ID );
		$permalink = get_permalink( $posthero->ID );
		$excerpt = get_the_excerpt( $posthero->ID );

		endwhile;

	else :

		$title = 'Make a new selection.';
		$content = 'No story available with this criteria.';
		$image = '';

	endif;
}

/**
 * Build the permalink button with user set options.
 * Renders a blank string if there's no permalink (none selected) or if omitted by user.
 */

$renderbtn = '';
if ( ! $permalink ) {
	$renderbtn = '';
} else {
	$btnclasses = array('btn', 'btn-default', 'btn-' . $btn_color );
	$btnclasses[] = 'data-ga="hero-post-cta"';
	$btnclasses[] = 'data-ga="more quotes"';
	$btnclasses[] = 'data-ga-name="onclick"';
	$btnclasses[] = 'data-ga-event="link"';
	$btnclasses[] = 'data-ga-action="click"';
	$btnclasses[] = 'data-ga-type="internal link"';
	$btnclasses[] = 'data-ga-region="main content"';
	$btnclasses[] = 'data-ga-section="hero"';

	$renderbtn = '<div class="btn-row"><a href="' . $permalink . '" class="' . implode(" " , $btnclasses) . '">' . $btn_label . '</a></div>';
}

/**
 * Trim the excerpt ## characters, rounded to a complete word.
 * @docs: https://developer.wordpress.org/reference/functions/get_the_excerpt/
 */
$trim_excerpt = substr($excerpt, 0, 225);
$content = substr($trim_excerpt, 0, strrpos($trim_excerpt, ' '));


// Block output.
echo '<div class="' . esc_html( $size ) . esc_html( $alignment ) . ' has-btn-row ' . esc_html( $additional_classes ) . '" style="' . $spacing . '">';
echo '<div class="hero-overlay"></div>';
if ( $image ) {
	echo wp_get_attachment_image( $image, $size, '', array( 'class' => 'hero' ) );
}
echo '<h1 class="article has-white-color">' . wp_kses_post( $title ) . '</h1>';
echo '<div class="content has-white-color">' . $content . '</div>';
echo $renderbtn;
echo '</div>';
