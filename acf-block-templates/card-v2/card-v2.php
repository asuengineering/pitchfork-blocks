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

$orientation  = get_field( 'uds_card2_orientation' );

/**
 * Additional margin/padding settings
 * Returns a string for inclusion with style=""
 */
$spacing = pitchfork_blocks_acf_calculate_spacing( $block );

/**
 * Add block style support for story, degree and event cards.
 * Add horizontal/vertical class modifier.
 * Get additional class names from block advanced panel.
 */

$card_classes = array( 'wp-card-v2', 'card' );
$card_classes[] = "card-" . $orientation;

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
$allowed_blocks = array(
	'acf/card-v2-image',
	'acf/card-v2-icon',
	'acf/card-v2-header',
	'acf/card-v2-tags',
	'acf/card-v2-links',
	'core/post-featured-image',
	'core/group',
	'core/buttons',
	'core/post-terms'
);

$template = array(
	array(
		'acf/card-v2-image',
		array(
			'name' => 'acf/card-v2-image',
			'mode' => 'preview',
			'lock' => array(
				'move' => true,
				'remove' => false
			)
		),
		array()
	),
	array(
		'acf/card-v2-header',
		array(
			'name' => 'acf/card-v2-header',
			'mode' => 'preview',
			'lock' => array(
				'move' => true,
				'remove' => true
			)
		),
		array(
			array(
				'core/heading',
				array(
					'level' => 3,
					'placeholder' => 'Card title'
				),
				array()
			),

		)
	),
	array(
		'core/group',
		array(
			'lock' => array(
				'move' => true,
				'remove' => true
			),
			'metadata' => array(
				'name' => 'Card Content'
			)
		),
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
		array(
			'lock' => array(
				'move' => true,
				'remove' => false
			)
		),
		array(
			array(
				'core/button',
				array(
					'backgroundColor' => 'asu-maroon',
					'className' => 'is-style-'
				),
				array()
			),

		)
	),
);

/**
 * Output the card.
 */
echo '<div class="' . implode( ' ', $card_classes ) . '" style="' . $spacing . '">';

echo '<InnerBlocks allowedBlocks="' . esc_attr( wp_json_encode( $allowed_blocks ) ) .
     '" template="' . esc_attr( wp_json_encode( $template ) ) . '" />';

echo '</div>';


