<?php
/**
 * UDS Hero
 *
 * - encoded to deliver the UDS Hero v2 (CSS Grid-based)
 *
 * @package Pitchfork_Blocks
 */

$subtitle     			= get_field( 'uds_subtitle_text' );
$highlight    			= get_field( 'uds_subtitle_highlight_color' );

$content = '';

// Echo block content based on context of $highlight
if ( 'none' !== $highlight ) {
	$content = '<span class="' . $highlight . '">' . $subtitle . '</span>';
} else {
	$content = $subtitle;
}

// Block output. Only echo the markup if there's something actually there.
if (! empty($subtitle)) {
	echo '<div role="doc-subtitle">' . $content . '</div>';
}

