<?php
/**
 * UDS Hero
 * 
 * - encoded to deliver the UDS Hero v2 (CSS Grid-based)
 *
 * @package UDS WordPress Theme
 */

$size     = get_field( 'uds_hero_size' );
$image    = get_field( 'uds_hero_image' );

// Retrieve additional classes from the 'advanced' field in the editor.
$additional_classes = '';
if ( ! empty( $block['className'] ) ) {
	$additional_classes = $block['className'];
}

// Sets InnerBlocks with a Bootstrap blocks container as default content.
$allowed_blocks = array( 'core/html', 'core/heading', 'core/paragraph', 'core/group', 'core/row');
$template       = array(
	array(
		'core/heading', array(
			'level' => 2,
			'content' => 'Your Hero Headline'
		)
	),
	array(
		'core/paragraph', array(
			'content' => 'Example hero paragraph text would go here. This might need an Inner Block wrapper?'
		)
	),
);

echo '<div class="' . $size . '">';
if( $image ) {
	echo wp_get_attachment_image( $image, $size, '', array('class'=>'hero'));
}

echo '<InnerBlocks allowedBlocks="' . esc_attr( wp_json_encode( $allowed_blocks ) ) . '" template="' . esc_attr( wp_json_encode( $template ) ) . '" />';
echo '</div>';

// Sample Inner Block Content? 
// <!-- wp:heading {"level":1} -->
// <h1>Heading Level One</h1>
// <!-- /wp:heading -->

// <!-- wp:paragraph -->
// <p>Some text here that provides relevance to the </p>
// <!-- /wp:paragraph -->

// <!-- wp:buttons -->
// <div class="wp-block-buttons"><!-- wp:button {"className":"is-style-uds-md"} -->
// <div class="wp-block-button is-style-uds-md"><a class="wp-block-button__link">A single CTA button</a></div>
// <!-- /wp:button --></div>
// <!-- /wp:buttons -->

