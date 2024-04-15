<?php
/**
 * PF Blocks - Card v2 - Card Tag
 *
 * @package Pitchfork Blocks
 * @author Steve Ryan
 *
 * An inner block for creating a single card tag.
 * In this context all card tags will be represented as "badges" as opposed to links.
 * Parent block = acf/card-v2-tags
 *
 */

$tagtext = get_field('uds_card2_tag_text');

/**
 * Output the card tag.
 */

if ( $tagtext) {
	$cardtag = '<span class="badge text-bg-gray-2">' . esc_html($tagtext) . '</span>';
} else {
	$cardtag = '<span class="badge text-bg-gray-2">&nbsp;</span>';
}

echo $cardtag;

