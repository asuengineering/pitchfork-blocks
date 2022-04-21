<?php
/**
 * UDS Hero
 * 
 * - encoded to deliver the UDS Hero v2 (CSS Grid-based)
 *
 * @package Pitchfork_Blocks
 */

$size     			= get_field( 'uds_hero_size' );
$image    			= get_field( 'uds_hero_image' );
$mobile_content   	= get_field( 'uds_hero_content_on_mobile' );

do_action('qm/debug', $block);

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

// Retrieve hide-content setting from ACF
$hidecontent = '';
if ( ! $mobile_content ) {
	$hidecontent = ' hide-content';
}

// Sets InnerBlocks with default content and default block arrangement.
$allowed_blocks = array( 'core/html', 'core/heading', 'core/group', 'core/buttons', 'acf/subtitle');
$template       = array(
	array(
		'acf/subtitle', array(
			'uds_subtitle_text' => 'Example subtitle',
			'uds_subtitle_highlight_color' => 'highlight-black'
		)
	),
	array(
		'core/heading', array(
			'level' => 1,
			'content' => 'Your Hero Headline'
		)
	),
	array(
		'core/group', array(
			'className' => 'content'
		), array(
			array(
				'core/paragraph', array(
					'content' => 'Example hero paragraph text.'
				)
			)
		)
	),
	array(
		'core/buttons', array(), array(
			array(
				'core/button', array(
					'className' => 'is-style-'
				)
			)
		)
	)
);

// Block output.
echo '<div class="' . esc_html($size) . esc_html($alignment) . esc_html($hidecontent) . ' has-btn-row ' . esc_html($additional_classes) . '">';
if( $image ) {
	echo wp_get_attachment_image( $image, $size, '', array('class'=>'hero'));
}
echo '<InnerBlocks allowedBlocks="' . esc_attr( wp_json_encode( $allowed_blocks ) ) . '" template="' . esc_attr( wp_json_encode( $template ) ) . '" />';
echo '</div>';
