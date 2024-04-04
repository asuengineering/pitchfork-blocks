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

$allowed_blocks = array( 'core/card-badge', 'core/categories', 'core/tags' );
// $template       = array(
// 	array(
// 		'core/heading',
// 		array(
// 			'level'   => 3,
// 			'placeholder' => 'Card title'
// 		),
// 	)
// );

/**
 * Output the card.
 */
$cardpart  = '<div class="card-tags">';
$cardpart .= '<p class="badge text-bg-gray-2">test badge</p><p class="badge text-bg-gray-7">second badge</p>';
// $cardpart .= '<InnerBlocks allowedBlocks="' . esc_attr( wp_json_encode( $allowed_blocks ) ) . '" template="' . esc_attr( wp_json_encode( $template ) ) . '" />';
$cardpart .= '</div>';

echo $cardpart;
