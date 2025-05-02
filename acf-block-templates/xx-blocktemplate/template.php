<?php
/**
 * Pitchfork Blocks - Block template
 *
 * - Add a description here
 *
 * @package Pitchfork_Blocks
 */

/**
 * Set initial get_field declarations.
 */

/**
 * Set block classes
 * - Get additional classes from the 'advanced' field in the editor.
 * - Get alignment setting from toolbar if enabled in theme.json, or set default value
 * - Include any default classs for the block in the intial array.
 */

$block_attr = array( 'uds-template');
if ( ! empty( $block['className'] ) ) {
	$block_attr[] = $block['className'];
}
// if ( ! empty( $block['align'] ) ) {
// 	$block_attr[] = $block['align'];
// }

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
 */
$attr  = implode( ' ', $block_attr );
$block = '<div ' . $anchor . ' class="' . $attr . '" style="' . $spacing . '">';

/**
 * Inner Block attributes, example templates and output string.
 */
$allowed_blocks = array( 'core/html', 'core/heading', 'core/paragraph', 'core/list' );
$template       = array(
	array(
		'core/heading',
		array(
			'level'   => 4,
			'content' => 'Template sample content',
		),
	),
	array(
		'core/paragraph',
		array(
			'content' => 'Example block template content',
		),
	),
);

// $block .= '<InnerBlocks allowedBlocks="' . esc_attr( wp_json_encode( $allowed_blocks ) ) . '" template="' . esc_attr( wp_json_encode( $template ) ) . '" />';


/**
 * Close the block, echo the output.
 */
$block .= '</div>';
echo $block;
