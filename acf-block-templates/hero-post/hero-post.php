<?php
/**
 * UDS Hero - Post
 *
 * Delivers ACF options to define a query for a single post.
 * Creates a hero from the result based on the featured image + excerpt + permalink
 *
 * @package Pitchfork_Blocks
 */

$size           = get_field( 'uds_hero_size' );

/**
 * Additional margin/padding settings
 * Returns a string for inclusion with style=""
 * --------------------
 */
$spacing = pitchfork_blocks_acf_calculate_spacing( $block );

// Retrieve additional classes from the 'advanced' field in the editor.
$additional_classes = '';
if ( ! empty( $block['className'] ) ) {
	$additional_classes = $block['className'];
}

// Retreive alignment setting from toolbar.
$alignment = '';
if ( ! empty( $block['align'] ) ) {
	$alignment = ' alignfull';
}

// Sets InnerBlocks with default content and default block arrangement.
$allowed_blocks = array( 'core/buttons' );
$template       = array(
	array(
		'core/buttons',
		array(
			'className' => 'btn-row',
		),
		array(
			array(
				'core/button',
				array(
					'className' => 'is-style-',
				),
			),
		),
	),
);


// Block output.
echo '<h1>I need a post hero!</h1>';
echo '<div class="' . esc_html( $size ) . esc_html( $alignment ) . ' has-btn-row ' . esc_html( $additional_classes ) . '" style="' . $spacing . '">';
echo '<div class="hero-overlay"></div>';
if ( $image ) {
	echo wp_get_attachment_image( $image, $size, '', array( 'class' => 'hero' ) );
}
echo '<InnerBlocks allowedBlocks="' . esc_attr( wp_json_encode( $allowed_blocks ) ) . '" template="' . esc_attr( wp_json_encode( $template ) ) . '" />';
echo '</div>';
