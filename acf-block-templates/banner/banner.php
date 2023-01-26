<?php
/**
 * UDS Banner
 * - Includes options for dismissing the banner message temporarily.
 * - Alert types (colors/icons) controled by block style panel.
 * - TODO: Add arbitrary icon selection via ACF/FA field group.
 *
 * @package Pitchfork_Blocks
 */

$button_count = get_field( 'uds_banner_button_count' );
$dismissible  = get_field( 'uds_banner_dismissible' );
$icon         = get_field( 'uds_banner_icon' );

/**
 * Additional margin/padding settings
 * Returns a string for inclusion with style=""
 * --------------------
 */
$spacing = pitchfork_blocks_acf_calculate_spacing( $block );

// Retreive alignment setting from toolbar.
$block_classes = array( 'wp-block-banner', 'alignfull', 'allowed-after-hero' );

// Base class of the banner is set with the background color option from the block.
// theme.json sets the suffix of each color so that the produced string is correct.
if ( ! empty( $block['backgroundColor'] ) ) {
	$block_classes[] = 'banner-' . $block['backgroundColor'];
} else {
	// When there is no choice set in the background color, use gray 2.
	$block_classes[] = 'banner-gray';
}

// If additional classes were requested, clean up the input and add them.
if ( isset( $block['className'] ) && ! empty( $block['className'] ) ) {
	$block_classes = trim( sanitize_text_field( $block['className'] ) );
}

/**
 * Buttons are part of an ACF form group, so we get the group first, then use
 * standard PHP array notation to get the sub-fields of the group
 */

$button_one_text = '';
$button_one_url  = '';
$button_two_text = '';
$button_two_url  = '';

$button_one_data = get_field( 'uds_banner_button_1_settings' );
if ( ! empty( $button_one_data ) ) {
	$button_one_text = $button_one_data['button_one_text'];
	$button_one_url  = $button_one_data['button_one_url'];
}

$button_two_data = get_field( 'uds_banner_button_2_settings' );
if ( ! empty( $button_two_data ) ) {
	$button_two_text = $button_two_data['button_two_text'];
	$button_two_url  = $button_two_data['button_two_url'];
}

/**
 * There are conditions for rendering buttons: the number
 * of buttons, and which button color to use based on the background,
 * so there's a bit more work than just grabbing the values from ACF
 */

// we'll build a 'button block' based on those conditions.
$button_block       = '';
$button_block_open  = '<div class="banner-buttons">';
$button_block_close = '</div>';

// if our button count is more than zero, we have buttons to build.
if ( $button_count ) {

	// add the opening markup to our button block.
	$button_block .= $button_block_open;

	// set a button class to make sure we don't make black buttons on a black BG.
	// all banner colors, besides black, use the dark buttons.
	$button_class = 'dark';
	if ( 'black' === $block['backgroundColor'] ) {
		$button_class = 'gold';
	}

	// if we got here we have more than zero buttons, so we will render button #1.
	$button_block .= '<a href="' . $button_one_url . '" class="btn btn-sm btn-' . $button_class . '">' . $button_one_text . '</a>';

	// if we have two buttons (the maximum), we also render button #2.
	if ( 2 == $button_count ) {
		$button_block .= '<a href="' . $button_two_url . '" class="btn btn-sm btn-' . $button_class . '">' . $button_two_text . '</a>';
	}

	// add the closing markup to the button block.
	$button_block .= $button_block_close;
}

// Grab the selected icon from the ACF field. Render a placeholder if empty.
if ( ! empty( $icon ) ) {
	$banner_icon = '<div class="banner-icon">' . $icon->element . '</div>';
} else {
	$banner_icon = '<div class="icon-placeholder"><i class="not-a-real-icon"></i></div>';
}

// Sets InnerBlocks with a pair of foldable cards both containing an H4 and a paragraph.
$allowed_blocks = array( 'core/paragraph', 'core/list', 'core/heading' );
$template       = array(
	array(
		'core/heading',
		array(
			'level'   => 3,
			'content' => 'Example Notification Headline (H3)',
		),
	),
	array(
		'core/paragraph',
		array(
			'content' => 'Example notification box message. Allowed blocks also include lists and headings. Dismissible options are available in the sidebar.',
		),
	),
);
?>

<section class="<?php echo implode( ' ', $block_classes ); ?>" style="<?php echo $spacing; ?>">
	<div class="banner" role="banner">
		<?php echo $banner_icon; ?>
		<div class="banner-content">
			<?php echo '<InnerBlocks allowedBlocks="' . esc_attr( wp_json_encode( $allowed_blocks ) ) . '" template="' . esc_attr( wp_json_encode( $template ) ) . '" />'; ?>
		</div>
		<?php echo $button_block; ?>
		<?php if ( $dismissible ) : ?>
			<div class="banner-close">
				<button type="button" class="btn btn-circle btn-circle-alt-white close" aria-label="Close" onclick="event.target.parentNode.parentNode.style.display='none';">x</button>
			</div>
		<?php endif; ?>
	</div>
</section>
