<?php
/**
 * UDS Hero
 *
 * - encoded to deliver the UDS Hero v2 (CSS Grid-based)
 *
 * @package Pitchfork_Blocks
 */

$size           = get_field( 'uds_hero_size' );
$image          = get_field( 'uds_hero_image' );

/**
 * Additional margin/padding settings
 * Returns a string for inclusion with style=""
 * --------------------
 */
$spacing = pitchfork_blocks_acf_calculate_spacing( $block );

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

// Sets InnerBlocks with default content and default block arrangement.
$allowed_blocks = array( 'core/html', 'core/heading', 'core/group', 'core/buttons', 'acf/subtitle' );
$template       = array(
	array(
		'acf/subtitle',
		array(
			'uds_subtitle_text'            => 'Example subtitle',
			'uds_subtitle_highlight_color' => 'highlight-black',
			'lock' => array(
					'move' => true,
					'remove' => false
				)
		),
	),
	array(
		'core/heading',
		array(
			'level'   => 1,
			'content' => 'Your Hero Headline',
			'textColor' => 'white',
			'lock' => array(
				'move' => true,
				'remove' => false
			)
		),
	),
	array(
		'core/group',
		array(
			'className' => 'content',
			'lock' => array(
				'move' => true,
				'remove' => false
			)
		),
		array(
			array(
				'core/paragraph',
				array(
					'content' => 'Example hero paragraph text.',
					'textColor' => 'white'
				),
			),
		),
	),
	array(
		'core/buttons',
		array(
			'className' => 'btn-row',
			'lock' => array(
				'move' => true,
				'remove' => false
			)
		),
		array(
			array(
				'core/button',
				array(
					'backgroundColor' => 'asu-maroon',
					'metadata' => array(
						'name' => 'CTA: Hero'
					),
				),
				array()
			),
		),
	),
);


// Block output.
echo '<div class="' . esc_html( $size ) . esc_html( $alignment ) . ' has-btn-row ' . esc_html( $additional_classes ) . '" style="' . $spacing . '">';
echo '<div class="hero-overlay"></div>';
if ( $image ) {
	echo wp_get_attachment_image( $image, $size, '', array( 'class' => 'hero' ) );
}
echo '<InnerBlocks allowedBlocks="' . esc_attr( wp_json_encode( $allowed_blocks ) ) . '" template="' . esc_attr( wp_json_encode( $template ) ) . '" />';
echo '</div>';
