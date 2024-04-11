<?php
/**
 * PF Blocks - Card v2 - Card Header
 *
 * @package Pitchfork Blocks
 * @author Steve Ryan
 *
 * An inner block for creating the card-header wrapper.
 * Supports its own <innerBlocks> = core/heading, core/post-title, core/archive-title
 *
 */


/**
 * Sets Inner Blocks template and allowed blocks attributes.
 */

$allowed_blocks = array( 'core/heading', 'core/post-title', 'core/archive-title' );
$template       = array(
	array(
		'core/heading',
		array(
			'level'   => 3,
			'placeholder' => 'Card title'
		),
	)
);

/**
 * Output the card.
 */
$cardpart  = '<div class="card-header">';
$cardpart .= '<InnerBlocks allowedBlocks="' . esc_attr( wp_json_encode( $allowed_blocks ) ) . '" template="' . esc_attr( wp_json_encode( $template ) ) . '" />';
$cardpart .= '</div>';

echo $cardpart;
