<?php
/**
 * PF Blocks - Card v2 - Card Link
 *
 * @package Pitchfork Blocks
 * @author Steve Ryan
 *
 * An inner block for creating a single link using the ACF link field.
 * Parent block = acf/card-v2-links
 *
 */

$link = get_field('uds_card2_link');

$link_url = '';
$link_title = '';
$link_target = '';

if ( $link ) {
    $link_url = $link['url'];
    $link_title = $link['title'];
    $link_target = $link['target'] ? $link['target'] : '_self';
}

/**
 * Output the card.
 * UDS Data attributes added during content render via HTML Tag Processer API.
 * See:
 */
if ( $link ) {
	$cardpart = '<a href="' . esc_url( $link_url ) . '" target="' . esc_attr( $link_target ) . '">' . esc_html( $link_title ) . '</a>';
} else {
	// Output some placeholder text if we are still in the editor.
	if ( $is_preview ) {
		$cardpart = '<p style="opacity:.62;">Add link settings</p>';
	}
}

echo $cardpart;

