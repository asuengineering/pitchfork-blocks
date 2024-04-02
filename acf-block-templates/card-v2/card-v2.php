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
 * "icon": "<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 640 512'><!-- fa-regular fa-cards--><!--!Font Awesome Pro 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2024 Fonticons, Inc.--><path d='M244.7 49c3.7-2.1 8.4-.9 10.5 2.8l167 289.3c2.1 3.7 .9 8.4-2.8 10.5L226.5 463c-3.7 2.1-8.4 .9-10.5-2.8L49 170.9c-2.1-3.7-.9-8.4 2.8-10.5L244.7 49zM27.8 118.8C1.2 134.2-7.9 168.2 7.5 194.9l167 289.3c15.4 26.6 49.4 35.8 76.1 20.4L443.4 393.2c26.6-15.4 35.8-49.4 20.4-76.1L296.8 27.8C281.4 1.2 247.3-7.9 220.7 7.5L27.8 118.8zM324.1 499c9.7 8.1 22.2 13 35.9 13H584c30.9 0 56-25.1 56-56V120c0-30.9-25.1-56-56-56H360c-1.8 0-3.5 .1-5.3 .2L491.5 301.1c24.2 41.9 9.8 95.6-32.1 119.8L324.1 499zM582 187.6l-48.2 49.9c-3.2 3.2-8.5 3.2-11.5 0l-48.4-49.9c-14-14.5-13.2-38.5 2.5-51.9c13.5-11.7 34.2-9.5 46.7 3.2l5 5.2 4.7-5.2c12.5-12.7 33-15 46.9-3.2c15.5 13.5 16.2 37.5 2.2 51.9zM171.4 174.3l-7.2 26.9-20.4 76.1c-7 26 8.5 52.7 34.4 59.7s52.7-8.5 59.7-34.4l2.4-8.8c.1-.4 .2-.8 .3-1.1l17.7 30.7-12.1 7c-6.7 3.8-8.9 12.4-5.1 19s12.4 8.9 19 5.1l48.2-27.8c6.7-3.8 8.9-12.4 5.1-19s-12.4-8.9-19-5.1l-12.1 7-17.7-30.7c.4 .1 .8 .2 1.1 .3l8.8 2.4c26 7 52.7-8.5 59.7-34.4s-8.5-52.7-34.4-59.7l-76.1-20.4L197 159.6c-11.1-3-22.6 3.6-25.6 14.8z'/></svg>",
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
$allowed_blocks = array( 'core/heading/card-header', 'core/paragraph' );
$template       = array(
	array(
		'core/heading/card-header',
		array(
			'level'   => 3,
			'content' => 'Card title',
		),
	),
	array(
		'core/paragraph',
		array(
			'content' => 'Getting closer to an actual card?',
		),
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
