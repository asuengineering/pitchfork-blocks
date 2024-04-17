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

$icon = get_field('uds_card2_icon');

/**
 * Render card-image with correct classes.
 * Uses WP default medium sized image thumbnail.
 */

$cardpart = '';

if ( ! empty( $icon ) ) {
	$cardpart = '<span class="' . $icon->class . ' card-icon-top"></span>';
} else {
	$cardpart = '<span class="fa-light fa-circle-question card-icon-top"></span>';
}

/**
 * Output the card icon.
 */

echo $cardpart;
