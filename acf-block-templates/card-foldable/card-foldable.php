<?php
/**
 * UDS Foldable card block
 *
 * @package Pitchfork_Blocks
 */

$fc_title  = get_field( 'uds_foldcard_title' );
$fc_icon   = get_field( 'uds_foldcard_icon' );
$collapsed = get_field( 'uds_foldcard_collapsed' );
$disabled  = get_field( 'uds_foldcard_disabled' );
$blockID   = get_field( 'uds_foldcard_id' );

// do_action('qm/debug', $fc_icon);

// Gather field data from parent block. Passed via block context and the $context variable.
$parentData        = $context['acf/parentFields'];
$accordionID       = $parentData['uds_accordion_id'];
$accordionBehavior = $parentData['uds_accordion_behavior'];

/**
 * Additional margin/padding settings
 * Returns a string for inclusion with style=""
 * --------------------
 */
$spacing = pitchfork_blocks_acf_calculate_spacing( $block );


/**
 * Start assembling base classes for <div class="card-foldable"> wrapper.
 * --------------------
 */
$base_class = array( 'card', 'card-foldable' );

// Add the required text-color modifier to the base class array.
// Get block text color from theme.json settings.
// Block requires "card-{color}" classes to correctly modify the accent color.
if ( ! empty( $block['backgroundColor'] ) ) {
	$base_class[] = 'card-' . $block['backgroundColor'];
}

// Retrieve additional classes from the 'advanced' field in the editor.
if ( ! empty( $block['className'] ) ) {
	$base_class[] = $block['className'];
}

// Add disable fold class and create wrapper.
$base_class[] = $disabled;
$card_wrap    = '<div class="' . implode( ' ', $base_class ) . '" style="' . $spacing . '">';


/**
 * Card header, title and icon state.
 * Note: Markup for icon needs to be either a placeholder or the actual icon.
 * Removing the icon markup from the mix completely causes a block render error.
 * --------------------
 */


if ( ! empty( $fc_icon ) ) {
	$fc_icon_markup = $fc_icon->element;
	$card_head      = '<div class="card-header card-header-icon">';
} else {
	$fc_icon_markup = '<i class="fa-placeholder"></i>';
	$card_head      = '<div class="card-header">';
}

// $card_head = '<div class="card-header card-header-icon">';
$card_title  = '<span class="card-icon">' . $fc_icon_markup . $fc_title . '</span>';
$card_title .= '<span class="fas fa-chevron-up"></span>';

/**
 * Card header <a> tag.
 * --------------------
 */
$card_head_link_attr   = array();
$card_head_link_attr[] = 'id="fCard-' . $blockID . '"';
$card_head_link_attr[] = 'href="#fCardBody-' . $blockID . '"';
$card_head_link_attr[] = 'role="button"';
$card_head_link_attr[] = 'data-toggle="collapse"';
$card_head_link_attr[] = 'data-target="#fCardBody-' . $blockID . '"';
$card_head_link_attr[] = 'aria-controls="fCardBody-' . $blockID . '"';

if ( ! $collapsed ) {
	$card_head_link_attr[] = 'aria-expanded="false"';
	$card_head_link_attr[] = 'class="collapsed"';
} else {
	$card_head_link_attr[] = 'aria-expanded="true"';
	$card_head_link_attr[] = 'class=""';
}

$card_head_link = '<a ' . implode( ' ', $card_head_link_attr ) . '>';

/**
 * Card body w/classes
 * --------------------
 */
$card_body_attr   = array();
$card_body_attr[] = 'id="fCardBody-' . $blockID . '"';
$card_body_attr[] = 'aria-labelledby="fCard-' . $blockID . '"';

// If the parent accordion allows for synchronized behavior...
// do_action('qm/debug', $accordionBehavior );
if ( $accordionBehavior ) {
	$card_body_attr[] = 'data-parent="#Accordion-' . $accordionID . '"';
}

if ( ! $collapsed ) {
	$card_body_attr[] = 'class="card-body collapse"';
} else {
	$card_body_attr[] = $card_body_attr[] = 'class="card-body collapse show"';
}

$card_body = '<div ' . implode( ' ', $card_body_attr ) . '>';


// Sets InnerBlocks with an H4 and a paragraph as default content.
$allowed_blocks = array( 'core/html', 'core/heading', 'core/paragraph', 'core/image', 'core/list' );
$template       = array(
	array(
		'core/heading',
		array(
			'level'   => 4,
			'content' => 'Accordion content headline',
		),
	),
	array(
		'core/paragraph',
		array(
			'content' => 'Example foldable card inner contents. Add paragraphs as needed.',
		),
	),
);

// Build the card.
$card  = '';
$card .= $card_wrap . $card_head . '<h4>' . $card_head_link . $card_title . '</a></h4></div>' . $card_body;

echo wp_kses_post( $card );
echo '<InnerBlocks allowedBlocks="' . esc_attr( wp_json_encode( $allowed_blocks ) ) . '" template="' . esc_attr( wp_json_encode( $template ) ) . '" />';
echo '</div></div>';


