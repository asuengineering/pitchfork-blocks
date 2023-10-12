<?php
/**
 * File: acf-block-utilities.php
 *
 * @package         Pitchfork_Blocks
 *
 * Additional functions that are useful for block manipulation and markup.
 *  - Return string value from calculate spacing
 *  - Remove inner blocks wrapper from a acf/hero blocks.
 */

/**
 * Given an $block object from an ACF block for gutenberg:
 * This will return a string of CSS inline values suitable for
 * inclusion in the block output in PHP.
 *
 * @param  mixed $block
 * @return $style as string
 */
function pitchfork_blocks_acf_calculate_spacing( $block ) {

	if ( ! empty( $block['style'] ) ) {
		$style_engine = wp_style_engine_get_styles( $block['style'] );
		$style        = $style_engine['css'];
	} else {
		$style = '';
	}

	return $style;
	// echo '<div style="' . $style . '">Block content</div>';
}
