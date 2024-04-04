<?php
/**
 * PF Blocks - Card v2
 *
 * @package Pitchfork Blocks
 * @author Steve Ryan
 *
 * A block for creating static versions of a UDS card. Supports the following features:
 *
 * - basic, story, and event card formats with
 * - vertical or horizontal cards
 * - blank, image, or icon header styles
 *
 */

$header_style   = get_field( 'uds_card2_header_style' );
$header_image = get_field( 'uds_card2_image' );
$header_icon  = get_field( 'uds_card2_icon' );
$orientation   = get_field( 'uds_card2_orientation' );

// do_action('qm/debug', $block);

/**
 * Additional margin/padding settings
 * Returns a string for inclusion with style=""
 * --------------------
 */
$spacing = pitchfork_blocks_acf_calculate_spacing( $block );

/**
 * Add block style support for story, degree and event cards.
 * Get additional class names from block advanced panel.
 */

$card_classes = array( 'wp-card-v2', 'card' );

if ( ! empty( $block['className'] ) ) {

	// Assume that there is more than one class in the "roll your own CSS" field separated by a space.
	$class_setting = explode(' ', $block['className']);

	// Remove the is-style prefix from the block style before adding to array.
	foreach ($class_setting as $setting) {
		$prefix = "is-style-";
		if (strpos($setting, $prefix) === 0) {
			$card_classes[] = substr($setting, strlen($prefix));
		} else {
			$card_classes[] = $setting;
		}
	}
}


/**
 * Sets Inner Blocks template and allowed blocks attributes.
 */
// Children I have yet to create: acf/card-event-details, acf/card-link, acf/card-tag
$allowed_blocks = array( 'acf/card-v2-header', 'acf/card-v2-tags', 'acf/card-v2-links', 'core/group', 'core/buttons' );
$template       = array(
	array(
		'acf/card-v2-header',
	),
	array(
		'core/group',
		array(),
		array(
			array(
				'core/paragraph',
				array(
					'placeholder' => 'Card body copy goes here.'
				),
				array()
			),

		)
	),
	array(
		'core/buttons',
		array(),
		array(
			array(
				'core/button',
				array(
					'backgroundColor' => 'asu-maroon',
					'className' => 'is-style-uds-md'
				),
				array()
			),

		)
	),
);

/**
 * Output the card.
 */
$card  = '<div class="' . implode( ' ', $card_classes ) . '" style="' . $spacing . '">';

echo wp_kses_post( $card );
echo '<InnerBlocks allowedBlocks="' . esc_attr( wp_json_encode( $allowed_blocks ) ) . '" template="' . esc_attr( wp_json_encode( $template ) ) . '" />';
echo '</div>';

/** Output */
// echo '<div class="' . implode( ' ', $card_classes ) . '" style="' . $spacing . '">';
// echo '<div class="card-header"></div>
// <div class="card-body">
// 	<p class="card-text">
// 		Body copy goes here. Limit to 5 lines max. Lorem ipsum dolor sit
// 		amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
// 		ut labore et dolore magna aliqua eiusmod tempo.
// 	</p>
// </div>
// </div>';
