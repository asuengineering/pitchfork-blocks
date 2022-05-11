<?php
/**
 * UDS Accordion
 * - Creates a wrapper for acf/card-foldable to selectively enable or disable the
 * - accordion mechanism across a group of foldable cards.
 *
 * @package Pitchfork_Blocks
 */

$enable_sync		= get_field( 'uds_accordion_behavior' );
$blockID 			= $block['id'];

$wrap = '<div class="accordion" id="Accordion-' . $blockID . '">';

// Sets InnerBlocks with a pair of foldable cards both containing an H4 and a paragraph.
$allowed_blocks = array( 'acf/card-foldable' );
$template       = array(
	array(
		'acf/card-foldable', array(), array(
			array(
				'core/heading', array(
					'level' => 4,
					'content' => 'Accordion content headline'
				)
			),
			array(
				'core/paragraph', array(
					'content' => 'Example foldable card inner contents. Add paragraphs as needed.'
				)
			)
		)
	),
	array(
		'acf/card-foldable', array(), array(
			array(
				'core/heading', array(
					'level' => 4,
					'content' => 'Second foldable card example'
				)
			),
			array(
				'core/paragraph', array(
					'content' => 'Add more content. Color options are also available.'
				)
			)
		)
	),
);

// Build the accordion.
echo wp_kses_post($wrap);
echo '<InnerBlocks allowedBlocks="' . esc_attr( wp_json_encode( $allowed_blocks ) ) . '" template="' . esc_attr( wp_json_encode( $template ) ) . '" />';
echo '</div>';

?>
