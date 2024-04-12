<?php
/**
 * PF Blocks - Card v2 - Card Links
 *
 * @package Pitchfork Blocks
 * @author Steve Ryan
 *
 * An inner block for creating the card-link wrapper.
 * Supports its own <innerBlocks> = acf/card-link, core/read-more
 *
 */


/**
 * Sets Inner Blocks template and allowed blocks attributes.
 */

$allowed_blocks = array( 'acf/card-link', 'core/paragraph', 'core/read-more' );
$template       = array(
	array(
		'acf/card-v2-link',
		array(
			'name' => 'acf/card-v2-link',
			'mode' => 'preview',
		),
		array()
	),
);

/**
 * Output the card.
 */
$cardpart  = '<div class="card-link">';
$cardpart .= '<InnerBlocks allowedBlocks="' . esc_attr( wp_json_encode( $allowed_blocks ) ) . '" template="' . esc_attr( wp_json_encode( $template ) ) . '" />';
$cardpart .= '</div>';

echo $cardpart;
