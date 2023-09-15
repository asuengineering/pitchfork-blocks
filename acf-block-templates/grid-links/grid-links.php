<?php
/**
 * UDS Grid Links
 *
 * @package UDS WordPress Theme
 */

$source     = get_field( 'uds_grid_links_source' );
$columns    = get_field( 'uds_grid_links_columns' );
$breakpoint = get_field( 'uds_grid_links_breakpoint' );

// Retrieve additional classes from the 'advanced' field in the editor.
$additional_classes = '';
if ( ! empty( $block['className'] ) ) {
	$additional_classes = $block['className'];
}

// Add the required text-color modifier to the additional classes string.
// Get block text color from theme.json settings.
// Block requires "text-{color}" classes to correctly modify both the BG color and text color.
if ( ! empty( $block['textColor'] ) ) {
	$additional_classes = 'text-' . $block['textColor'] . ' ' . $additional_classes;
}

// Add the required column modifier to the additional classes string.
if ( 'mobile' !== $columns ) {
	$additional_classes = $columns . ' ' . $additional_classes;
}

/**
 * Additional margin/padding settings
 * Returns a string for inclusion with style=""
 * --------------------
 */
$spacing = pitchfork_blocks_acf_calculate_spacing( $block );

echo '<div class="uds-grid-links ' . $additional_classes . '" style="' . $spacing . '">';

// If then structure determines the actual <a> tags produced. Indicated with user choice for the source of the links.
// This field is a radio button with a default setting, so no need to see if it exists.
if ( 'arbitrary' === $source ) {

	// Check the rows of the repeater, build the links.
	if ( have_rows( 'uds_grid_links_created' ) ) :

		while ( have_rows( 'uds_grid_links_created' ) ) :
			the_row();

			// Reset all loop variables with each loop.
			$icon       = '';
			$bg_image   = '';
			$gridlink   = '';
			$linkstring = '';

			$icon     = get_sub_field( 'uds_grid_links_created_icon' );
			$gridlink = get_sub_field( 'uds_grid_links_created_link' );

			if ( ! empty( $icon ) ) {
				$linkstring .= $icon;
			} else {
				/**
				 * This else statement doesb't actually make it into the block markup.
				 * But performing an operation here (of any kind) prevents an error in the block editor.
				 * Error occurs when the icon picker is set back to null.
				 * (Error: Failed to execute 'removeChild' on 'Node': The node to be removed is not a child of this node.)
				 */
				$icon = '<i class="empty-icon"></i>';
			}

			if ( ! empty( $gridlink ) ) {
				$link_url    = $gridlink['url'];
				$link_title  = $gridlink['title'];
				$link_target = $gridlink['target'] ? $gridlink['target'] : '_self';
			} else {
				$link_url    = '#';
				$link_title  = 'No link defined.';
				$link_target = '_self';
			}

			$linkstring = '<a href="' . esc_url( $link_url ) . '" target="' . esc_attr( $link_target ) . '">' . $linkstring . esc_html( $link_title ) . '</a>';

			echo $linkstring;

		endwhile;

	else :
		echo '<a href="#">No links defined.</a>';
	endif;

} else {

	// $content is equal to either "tag" or "category"
	if ( 'tag' === $source ) {
		$terms = get_field( 'uds_grid_links_tag' );
	} else {
		$terms = get_field( 'uds_grid_links_category' );
	}

	if ( $terms ) {
		foreach ( $terms as $gridterm ) {
			echo '<a href="' . esc_url( get_term_link( $gridterm ) ) . '">' . esc_html( $gridterm->name ) . '</a>';
		}
	} else {
		echo '<a href="#">No ' . $source . ' selected.</a>';
	}
}

// Close out the block.
echo '</div><!-- end .uds-grid-links -->';
