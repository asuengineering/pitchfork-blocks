<?php
/**
 * PF Blocks - Card v2 - Card Image
 *
 * @package Pitchfork Blocks
 * @author Steve Ryan
 *
 * An inner block for creating the card-image wrapper.
 * Uses a single ACF field to defin the image.
 *
 */

$image = get_field('uds_card2_image');

/**
 * Render card-image with correct classes.
 * Uses WP default medium sized image thumbnail.
 */

$cardpart = '';

if ( !empty( $image ) ) {
	$cardpart = '<img class="card-img-top" src="' . $image['url'] . '" alt="' . $image['alt'] . '"/>';
} else {
	// Output a placeholder image if we are still in the editor. Otherwise, echo nothing.
	if ( $is_preview ) {
		$cardpart = '<img class="card-img-top" src="https://placehold.co/800x600?text=card+image" alt="placeholder image"/>';
	}
}

/**
 * Output the card image.
 */

echo $cardpart;
