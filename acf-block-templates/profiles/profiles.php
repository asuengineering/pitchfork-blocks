<?php
/**
 * UDS Profiles
 * - Creates a wrapper for acf/profile-manual and (data block) to organize the profiles
 * - into a grid. Suitable for building an ad-hoc direectory page.
 *
 * @package Pitchfork_Blocks
 */

$columns = get_field( 'uds_profiles_columns' );

$spacing = pitchfork_blocks_acf_calculate_spacing( $block );

/**
 * Retrieve additional classes from the 'advanced' field in the editor for inline styles.
 * Explode given string into an array so we can search it later.
 */
$block_classes = array( 'uds-profile-grid', $columns );
if ( ! empty( $block['className'] ) ) {
	$block_classes[] = $block['className'];
}

// Sets InnerBlocks with a pair of foldable cards both containing an H4 and a paragraph.
$allowed_blocks = array( 'acf/profile-manual' );
$template       = array(
	array(
		'acf/profile-manual',
		array(
			'backgroundColor' => 'fill-white',
		),
	),
	array(
		'acf/profile-manual',
		array(
			'backgroundColor' => 'fill-white',
		),
	),
);

// Build the profile container.
$profile  = '<div class="' . implode( ' ', $block_classes ) . '" style="' . $spacing . '">';
$profile .= '<InnerBlocks allowedBlocks="' . esc_attr( wp_json_encode( $allowed_blocks ) ) . '" template="' . esc_attr( wp_json_encode( $template ) ) . '" />';
$profile .= '</div>';

echo $profile;


