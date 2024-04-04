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

$allowed_blocks = array( 'acf/card-link', 'core/read-more' );
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
$cardpart  = '<div class="card-link">';
$cardpart .= '<a href="#" class="" data-ga="Regular text link here" data-ga-name="onclick" data-ga-event="link" data-ga-action="click" data-ga-type="internal link" data-ga-region="main content" data-ga-section="card default title">Regular text link here</a>';
// $cardpart .= '<InnerBlocks allowedBlocks="' . esc_attr( wp_json_encode( $allowed_blocks ) ) . '" template="' . esc_attr( wp_json_encode( $template ) ) . '" />';
$cardpart .= '</div>';

echo $cardpart;
