<?php
/**
 * UDS Alert
 * - Includes options for dismissing the alert message temporarily.
 * - Includes an option for including/excluding the corresponding icon for the alert type.
 * - Alert types (colors/icons) controled by block style panel. 
 *
 * @package Pitchfork_Blocks
 */
$use_icon		= get_field( 'uds_alert_icon' );
$dismissable	= get_field( 'uds_alert_dismissable' );
do_action('qm/debug', $block);

/** 
 * Additional margin/padding settings
 * Returns a string for inclusion with style=""
 * --------------------
 */
$spacing = pitchfork_blocks_acf_calculate_spacing($block);

// Retrieve additional classes from the 'advanced' field in the editor.
// Add optional classes for dismissal.
$alert_classes = array('wp-block-alert', 'alert');


if ( ! empty( $block['className'] ) ) {
	$alert_classes[] = $block['className'];
}

if ( $dismissable ) {
	$alert_classes[] = 'alert-dismissable';
	$close = 	'<div class="alert-close">
				<button type="button" class="btn btn-circle btn-circle-alt-black close" data-dismiss="alert" aria-label="Close">
				<span class="fas fa-times"></span>
				</button></div>';
} else {
	$close = '';
}

$wrapper = '<div class="' . implode( ' ', $alert_classes) . '" style="' . $spacing . '">';

// Set the icon depending on if the option is enabled and the alert type.
if ( $use_icon ) {
	$icon = '<div class="alert-icon">';

	// $block['className]' may be blank if the user hasn't made a choice yet.
	// default: should catch that use case and still add warning icon.
	switch ($block['className']) {
		case 'is-style-alert-success':
			$icon .= '<span class="fas fa-bell"></span></div>';
			break;
		case 'is-style-alert-info':
			$icon .= '<span class="fas fa-check-circle"></span></div>';
			break;
		case 'is-style-alert-error':
			$icon .= '<span class="fas fa-info-circle"></span></div>';
			break;
		case 'is-style-alert-warning':
		default:
			$icon .= '<span class="fas fa-exclamation-triangle"></span></div>';
			break;
	}
	
} else {
	$icon = '';
}


// Sets InnerBlocks with a pair of foldable cards both containing an H4 and a paragraph.
$allowed_blocks = array( 'core/paragraph', 'core/list' );
$template       = array(
	array(
		'core/paragraph', array(
			'content' => 'Example alert box inner contents. Lists are allowed too. Dismissable options are available in the sidebar.'
		)
	)
);

// Build the alert.
echo wp_kses_post($wrapper) . $icon . '<div class="alert-content">';
echo '<InnerBlocks allowedBlocks="' . esc_attr( wp_json_encode( $allowed_blocks ) ) . '" template="' . esc_attr( wp_json_encode( $template ) ) . '" />';
echo '</div>' . $close . '</div>';

?>