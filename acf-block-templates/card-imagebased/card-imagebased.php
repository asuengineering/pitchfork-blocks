<?php
/**
 * Pitchfork Blocks - Image based card
 *
 * - Image based cards can create added visual interest and break up a page with a lot of content.
 *
 * @package Pitchfork_Blocks
 */

/**
 * Set initial get_field declarations.
 */

$imgcard_image = get_field('card_imagebase_image');
$imgcard_orient = get_field('card_imagebase_orientation');
$imgcard_size = get_field('card_imagebase_size');

/**
 * Set block classes
 * - Get additional classes from the 'advanced' field in the editor.
 * - Include any default classs for the block in the intial array.
 * - Build additional class needed for block size/orientation
 */

$block_attr = array( 'uds-image-based-card');
if ( ! empty( $block['className'] ) ) {
	$block_attr[] = $block['className'];
}

// ACF fields have default values assigned, but just in case?
if (empty($imgcard_orient)) {
	$imgcard_orient = 'portrait';
}
if (empty($imgcard_size)) {
	$imgcard_orient = 'md';
}

$blocksize = $imgcard_orient . '-' . $imgcard_size;

// Edge case: There are no styles defined for portrait-lg
if ('portrait-lg' === $blocksize) {
	$blocksize = 'portrait-md';
}

$block_attr[] = $blocksize;

/**
 * Additional margin/padding settings
 * Returns a string for inclusion with style=""
 */
$spacing = pitchfork_blocks_acf_calculate_spacing( $block );

/**
 * Include block.json support for HTML anchor.
 */
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
	$anchor = 'id="' . $block['anchor'] . '"';
}

/**
 * Block logic here.
 */



/**
 * Create the outer wrapper for the block output.
 * Add image as element immediately following wrapper.
 */
$attr  = implode( ' ', $block_attr );
$block = '<div ' . $anchor . ' class="' . $attr . '" style="' . $spacing . '">';

/**
 * Check for empty image and render a placeholder if not set by user.
 */

$emptyimg = '<div class="card-img-top components-placeholder block-editor-media-placeholder is-medium has-illustration">';
$emptyimg .= '<svg fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 60 60" preserveAspectRatio="none" class="components-placeholder__illustration" aria-hidden="true" focusable="false"><path vector-effect="non-scaling-stroke" d="M60 60 0 0"></path></svg>';
$emptyimg .= '</div>';

if ( ! empty( $imgcard_image ) ) {
	// $cardpart = '<img class="card-img-top" src="' . esc_url($image['url']) . '" alt="' . esc_attr($image['alt']) . '" />';
	$block .= wp_get_attachment_image( $imgcard_image, 'medium_large', array( 'class' => 'img-resp' ) );
} else {
	if ( $is_preview ) {
		$block .= '<image src="" alt="No image selected"/>';
	}
}

/**
 * Inner Block attributes, example templates and output string.
 */
$allowed_blocks = array( 'core/html', 'core/heading', 'core/paragraph', 'core/buttons' );
$template       = array(
	array(
		'core/heading',
		array(
			'level'   => 2,
			'content' => 'Heading example, level 2',
			'textColor' => 'white',
		),
	),
	array(
		'core/buttons',
		array(),
		array(
			array(
				'core/button',
				array(
					'backgroundColor' => 'asu-maroon',
					'metadata' => array(
						'name' => 'CTA: Image card'
					),
					'className' => 'is-style-uds-md',
				),
				array()
			),
		),
	),
);

$block .= '<InnerBlocks class="card-img-overlay" allowedBlocks="' . esc_attr( wp_json_encode( $allowed_blocks ) ) . '" template="' . esc_attr( wp_json_encode( $template ) ) . '" />';


/**
 * Close the block, echo the output.
 */
$block .= '</div>';
echo $block;
