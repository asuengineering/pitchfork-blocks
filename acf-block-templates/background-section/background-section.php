<?php
/**
 * UDS Background Section
 *
 * @package Pitchfork_Blocks
 */

$choice     = get_field( 'uds_background_section_choice' );
// $preset     = get_field( 'uds_background_section_preset' );
$pattern    = get_field( 'uds_background_section_pattern' );

$upload     = get_field( 'uds_background_section_upload_url' );
$repeat     = get_field( 'uds_background_image_repeat' );
$position   = get_field( 'uds_background_image_position' );
$size       = get_field( 'uds_background_image_size' );
$color      = get_field( 'uds_background_section_color' );

// Retrieve additional classes from the 'advanced' field in the editor.
$additional_classes = '';
if ( ! empty( $block['className'] ) ) {
	$additional_classes = $block['className'];
}

/**
 * Create block.json support for HTML anchor.
 */
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
	$anchor = 'id="' . $block['anchor'] . '"';
}

/**
 * Additional margin/padding settings
 * Returns a string for inclusion with style=""
 * --------------------
 */
$spacing = pitchfork_blocks_acf_calculate_spacing( $block );

// Produce the correct section block
if ( $choice ) {

	// Produce the correct classes for the <section> element and echo it.
	// The $choice variable will be one of the following three values: 'none', 'pattern', or 'upload'
	// Treating 'none' as the default choice to accomodate blocks with an older version of the block markup.

	if ( 'pattern' === $choice ) {

		// UDS Background patterns.
		echo '<section ' . $anchor . ' class="uds-section alignfull bg ' . $pattern . ' ' . $additional_classes . '" style="' . $spacing . '">';

	} elseif ( 'upload' === $choice ) {

		// Check to see if background image is selected then build inline style.
		// Forcing image to be present prevents workaround for picking an arbitrary color from the picker.
		if (! empty( $upload )) {
			$inline_style = 'background: ' . $color . ' url(' . $upload . ') ' . $position . ' / ' . $size . ' ' . $repeat . ';';
		} else {
			$inline_style = '';
		}

		// Set the background CSS rule + additional classes.
		echo '<section ' . $anchor . ' class="uds-section alignfull media-file ' . $additional_classes . '" style="' . $inline_style . $spacing . '" >';

	} else {

		// Use case for 'default' or ( 'none' === $choice )

		// Add the required text-color modifier to the base class array.
		if ( ! empty( $block['backgroundColor'] ) ) {
			$additional_classes = 'has-background has-' . $block['backgroundColor'] . '-background-color ';
		}

		// Background color defined by block settings and the bg color palette.
		echo '<section ' . $anchor . ' class="uds-section alignfull ' . $additional_classes . '" style="' . $spacing . '">';
	}

	// Sets InnerBlocks with a core/column block as default content.
	$template = array(
		array( 'core/group', array() ),
	);

	echo '<InnerBlocks template="' . esc_attr( wp_json_encode( $template ) ) . '" />';
	echo '</section>';
}


