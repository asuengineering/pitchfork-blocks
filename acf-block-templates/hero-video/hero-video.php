<?php
/**
 * UDS Hero - Video
 *
 * - encoded to deliver the UDS Hero v2 (CSS Grid-based)
 * - Based off of initial implementation from KE web dev team.
 *
 * @package Pitchfork_Blocks
 */

$size           = get_field( 'uds_herovideo_size' );
$video          = get_field( 'uds_herovideo_source' );
$image          = get_field( 'uds_herovideo_image' );

do_action( 'qm/debug', $video );

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
		),
	),
	array(
		'core/heading',
		array(
			'level'   => 1,
			'content' => 'Your Hero Headline',
			'textColor' => 'white'
		),
	),
	array(
		'core/group',
		array(
			'className' => 'content',
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
			),
		),
	),
);

// Block output.
echo '<div class="uds-hero-video ' . esc_html( $size ) . esc_html( $alignment ) . ' has-btn-row ' . esc_html( $additional_classes ) . '">';
echo '<div class="hero-overlay"></div>';
if ( $video ) {
	?>

	<video id="media-video" autoplay loop muted>
		<source src="<?php echo esc_url( $video['url'] ); ?>" type="video/mp4">
	</video>

	<div class="hero-video-controls">
		<button id="playHeroVid" type="button" class="btn btn-circle btn-circle-alt-white btn-circle-large">
			<span class="fa-solid fa-play"></span>
			<span class="sr-only">Play hero video</span>
		</button>
		<button id="pauseHeroVid" type="button" class="btn btn-circle btn-circle-alt-white btn-circle-large">
			<span class="fa-solid fa-pause"></span>
			<span class="sr-only">Pause hero video</span>
		</button>
	</div>

	<?php
}
if ( $image ) {
	echo wp_get_attachment_image( $image, $size, '', array( 'class' => 'hero' ) );
}
echo '<InnerBlocks allowedBlocks="' . esc_attr( wp_json_encode( $allowed_blocks ) ) . '" template="' . esc_attr( wp_json_encode( $template ) ) . '" />';
echo '</div>';
