<?php
/**
 * PF Blocks - Card v2 - Card Tags
 *
 * @package Pitchfork Blocks
 * @author Steve Ryan
 *
 * An inner block for creating the card-tag wrapper.
 * Supports its own <innerBlocks> = acf/card-badge, core/categories, core/tags
 *
 */


/**
 * Sets Inner Blocks template and allowed blocks attributes.
 */

$allowed_blocks = array( 'acf/card-v2-tag' );
$template       = array(
	array(
		'acf/card-v2-tag',
		array(
			'name' => 'acf/card-v2-tag',
			'data' => array(
				'uds_card2_tag_text' => 'card tag',
			),
			'mode' => 'preview'
		),
		array()
	),
	array(
		'acf/card-v2-tag',
		array(
			'name' => 'acf/card-v2-tag',
			'data' => array(
				'uds_card2_tag_text' => 'second tag',
			),
			'mode' => 'preview'
		),
		array()
	),
);

/**
 * Output the card.
 */
$cardpart  = '<div class="card-tags">';
$cardpart .= '<InnerBlocks allowedBlocks="' . esc_attr( wp_json_encode( $allowed_blocks ) ) . '" template="' . esc_attr( wp_json_encode( $template ) ) . '" orientation="horizontal" />';
$cardpart .= '</div>';

echo $cardpart;
