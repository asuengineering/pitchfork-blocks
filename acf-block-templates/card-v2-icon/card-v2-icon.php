<?php
/**
 * PF Blocks - Card v2 - Card Icon
 *
 * @package Pitchfork Blocks
 * @author Steve Ryan
 *
 * An inner block for adding a card icon at the top of the card.
 * Uses a single ACF field (FA icon picker) to define the icon.
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
