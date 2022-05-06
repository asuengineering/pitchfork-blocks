<?php
/**
 * UDS Hero
 * 
 * - encoded to deliver the UDS Hero v2 (CSS Grid-based)
 *
 * @package Pitchfork_Blocks
 */

$text				= get_field( 'uds_blockquote_quote' );
$cite				= get_field( 'uds_blockquote_cite' );
$desc				= get_field( 'uds_blockquote_description' );

$style     			= get_field( 'uds_blockquote_style' );
$accent     		= get_field( 'uds_blockquote_accent' );
$altcite    		= get_field( 'uds_blockquote_alt' );
$withimage     		= get_field( 'uds_blockquote_image_include' );
$img_id				= get_field( 'uds_blockquote_image_src' );
$reversed			= get_field( 'uds_blockquote_reversed' );

// Retrieve additional classes from the 'advanced' field in the editor.
$additional_classes = '';
if ( ! empty( $block['className'] ) ) {
	$additional_classes = $block['className'];
}

// Retreive alignment setting from toolbar.
$alignment = '';
if ( ! empty( $block['align'] ) ) {
	$alignment = ' alignfull';
}

// Assemble associated attributes.
$block_attr = array();
$use_glyph = false;
$use_image = false;

if ('default' == $style ){
	// Default style. Is there an image included?
	if ( $withimage ) {
		$block_attr[] = 'with-image';

		$use_image = true;

		// Is the layout reversed?
		if ( $reversed ) {
			$block_attr[] = 'reversed';
		}

	} else {

		// No image. Comes with an accent color and a citation style.
		$block_attr[] = 'accent-' . $accent;

		if ( $altcite ) {
			$block_attr[] = 'alt-citation';
		}

		// The glyph is needed here.
		$use_glyph = true;

	}

} else {

	// Testimonial style. Comes with accent color and optional image.
	$block_attr[] = 'uds-testimonial'; 
	$block_attr[] = 'accent-' . $accent;

	if ($withimage) {
		$block_attr[] = 'with-image';
		$use_image = true;
	}

	// The glyph is always needed here.
	$use_glyph = true;

}

// Get block text color from theme.json settings.
if ( ! empty( $block['textColor'] ) ) {
	$block_attr[] = 'has-' . $block['textColor'] . '-color';
}

// Assemble .uds-blockquote wrapper and associated attributes.
$attr = implode( ' ', $block_attr);
$glyph = '
	<svg title="Open quote" role="presentation" viewBox="0 0 302.87 245.82">
	<path d="M113.61,245.82H0V164.56q0-49.34,8.69-77.83T40.84,35.58Q64.29,12.95,100.67,0l22.24,46.9q-34,11.33-48.72,31.54T58.63,132.21h55Zm180,0H180V164.56q0-49.74,8.7-78T221,35.58Q244.65,12.95,280.63,0l22.24,46.9q-34,11.33-48.72,31.54t-15.57,53.77h55Z"/>
	</svg>';

$quote = '<div class="uds-blockquote ' . $attr . '">';
if (( $use_image ) && ( $img_id )) {
	$quote .= wp_get_attachment_image( $img_id, 'medium' );
}
if ( $use_glyph ) {
	$quote .= $glyph;
}
$quote .= '<blockquote>' . wp_kses_post($text) . '<div class="citation"><div class="citation-content">';
$quote .= '<cite class="name">' . esc_html($cite) . '</cite>';
$quote .= '<cite class="description">' . esc_html($desc) . '</cite>';
$quote .= '</div></div></blockquote></div>';

echo $quote;

