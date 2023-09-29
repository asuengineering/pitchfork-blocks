<?php
/**
 * UDS Background Section
 *
 * @package Pitchfork_Blocks
 */

$choice     = get_field( 'uds_background_section_choice' );
$pattern    = get_field( 'uds_background_section_pattern' );
$preset     = get_field( 'uds_background_section_preset' );
$color      = get_field( 'uds_background_section_color' );
$upload     = get_field( 'uds_background_section_upload_url' );
$innercolor = get_field( 'uds_background_inner_color' );
$repeat     = get_field( 'uds_background_image_repeat' );
$position   = get_field( 'uds_background_image_position' );
$size       = get_field( 'uds_background_image_size' );

// Retrieve additional classes from the 'advanced' field in the editor.
$additional_classes = '';
if ( ! empty( $block['className'] ) ) {
	$additional_classes = $block['className'];
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
	// The $choice variable will be one of the following three values. It has a default value set by the ACF control.
	if ( 'color' === $choice ) {

		if ( 'custom' === $preset ) {
			// We're doing a custom background color.
			echo '<section class="uds-section alignfull bg-color ' . $additional_classes . '" style="background-color: ' . $color . ';" style="' . $spacing . '">';
		} else {
			// Background colors via utility BS4 classes.
			echo '<section class="uds-section alignfull bg-color ' . $preset . ' ' . $additional_classes . '" style="' . $spacing . '">';
		}
	} elseif ( 'pattern' === $choice ) {

		// UDS Background patterns.
		echo '<section class="uds-section alignfull bg ' . $pattern . ' ' . $additional_classes . '" style="' . $spacing . '">';

	} elseif ( 'upload' === $choice ) {

		// Build the inline style rule.
		$inline_style = 'background: url(' . $upload . ') ' . $position . ' / ' . $size . ' ' . $repeat . ';';

		// Set the basic utility class + inner bg color as classes.

		echo '<section class="uds-section alignfull media-file ' . $additional_classes . '" style="' . $inline_style . $spacing . '" >';

	}

	// Sets InnerBlocks with a core/column block as default content.
	$allowed_blocks = array( 'core/columns', 'core/html' );
	$template       = array(
		array( 'core/columns', array() ),
	);

	echo '<InnerBlocks template="' . esc_attr( wp_json_encode( $template ) ) . '" />';
	// echo '<InnerBlocks allowedBlocks="' . esc_attr( wp_json_encode( $allowed_blocks ) ) . '" template="' . esc_attr( wp_json_encode( $template ) ) . '" />';
	echo '</section>';
}


