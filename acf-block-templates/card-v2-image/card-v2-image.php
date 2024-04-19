<?php
/**
 * PF Blocks - Card v2 - Card Image
 *
 * @package Pitchfork Blocks
 * @author Steve Ryan
 *
 * An inner block for adding a card image at the top of the card.
 * Uses an ACF field to define the image.
 *
 * Native image block not supported as an inner block for cards due to issues created with
 * image customization tools. (Resize, aspect ratio changes, etc.)
 *
 */

$image = get_field('uds_card2_image');

$emptyimg = '<div class="card-img-top components-placeholder block-editor-media-placeholder is-medium has-illustration">';
$emptyimg .= '<svg fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 60 60" preserveAspectRatio="none" class="components-placeholder__illustration" aria-hidden="true" focusable="false"><path vector-effect="non-scaling-stroke" d="M60 60 0 0"></path></svg>';
$emptyimg .= '</div>';

/**
 * Render card-image with correct classes.
 * Uses WP default medium sized image thumbnail.
 */

$cardpart = '';

if ( !empty( $image ) ) {
	$cardpart = '<img class="card-img-top" src="' . esc_url($image['url']) . '" alt="' . esc_attr($image['alt']) . '" />';
} else {
	if ( $is_preview ) {
		$cardpart = $emptyimg;
	}
}

/**
 * Output the card image.
 */

echo $cardpart;
