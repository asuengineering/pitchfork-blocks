<?php
/**
 * UDS Foldable card block
 *
 * @package Pitchfork_Blocks
 */

$fc_title 		= get_field( 'uds_foldcard_title' );
$fc_icon 		= get_field( 'uds_foldcard_icon' );
$collapsed 		= get_field( 'uds_foldcard_collapsed' );
$disabled 		= get_field( 'uds_foldcard_disabled' );
$blockID 		= $block['id'];
global $post;

/** 
 * Loop through all of the blocks on the page to identify the parent acf/accordion block's unique ID. 
 * Used in the data-target attribute within the card body.
 */

$outerbreak = false;
$postblocks = parse_blocks( $post->post_content );
foreach( $postblocks as $postblock ) {
	if( 'acf/accordion' === $postblock['blockName'] ) {

		$accordionInners = $postblock['innerBlocks'];

		foreach( $accordionInners as $accordionInner ) {
			$accordionInnerID = $accordionInner['attrs']['id'];
			if ($blockID == $accordionInnerID ) {
				// Chicken dinner.
				$outerbreak = true;
				break;
			}
		}
	}

	// Stops the outer foreach loop once we have a match.
	if ($outerbreak) {
		$accordionID = $postblock['attrs']['id'];
		$accordionBehavior = $postblock['attrs']['data']['uds_accordion_behavior'];
		break;
	}

}


/** 
 * Start assembling base classes for <div class="card-foldable"> wrapper.
 * --------------------
 */
$base_class = array('card', 'card-foldable');

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
$card_wrap = '<div class="' . implode( ' ', $base_class) . '">';


/** 
 * Card header, title and icon state.
 * --------------------
 */
if ( ! empty( $fc_icon)) {
	$card_head = '<div class="card-header card-header-icon">';
	$card_title = '<span class="card-icon"><i class="' . $fc_icon . '"></i>' . $fc_title . '</span>';
	
} else {
	$card_head = '<div class="card-header">';
	$card_title = $fc_title;
}

$card_title .= '<span class="fas fa-chevron-up"></span>';

/** 
 * Card header <a> tag. 
 * --------------------
 */
$card_head_link_attr = array();
$card_head_link_attr[] = 'id="fCard-' . $blockID. '"';
$card_head_link_attr[] = 'href="#fCardBody-' . $blockID . '"';
$card_head_link_attr[] = 'role="button"';
$card_head_link_attr[] = 'data-toggle="collapse"';
$card_head_link_attr[] = 'data-target="#fCardBody-' . $blockID . '"';
$card_head_link_attr[] = 'aria-controls="fCardBody-' . $blockID . '"';

if ( ! $collapsed) {
	$card_head_link_attr[] = 'aria-expanded="false"';
	$card_head_link_attr[] = 'class="collapsed"';
} else {
	$card_head_link_attr[] = 'aria-expanded="true"';
	$card_head_link_attr[] = 'class=""';
}

$card_head_link = '<a ' . implode( ' ', $card_head_link_attr) . '>';

/**
 * Card body w/classes 
 * --------------------
 */
$card_body_attr = array();
$card_body_attr[] = 'id="fCardBody-' . $blockID . '"';
$card_body_attr[] = 'aria-labelledby="fCard-'  . $blockID . '"';

// If the parent accordion allows for synchronized behavior...
if ( $accordionBehavior ) {
	$card_body_attr[] = 'data-parent="#Accordion-' . $accordionID . '"';
}

if (! $collapsed) {
	$card_body_attr[] = 'class="card-body collapse"';
} else {
	$card_body_attr[] = $card_body_attr[] = 'class="card-body collapse show"';
}

$card_body = '<div ' . implode( ' ', $card_body_attr) . '>';


// Sets InnerBlocks with an H4 and a paragraph as default content.
$allowed_blocks = array( 'core/html', 'core/heading', 'core/paragraph', 'core/image', 'core/list' );
$template       = array(
	array(
		'core/heading', array(
			'level' => 4,
			'content' => 'Accordion content headline'
		)
	),
	array(
		'core/paragraph', array(
			'content' => 'Example foldable card inner contents. Add paragraphs as needed.'
		)
	)
);

// Build the card.
$card = '';
$card .= $card_wrap . $card_head . '<h4>' . $card_head_link . $card_title . '</a></h4></div>' . $card_body;

echo wp_kses_post( $card );
echo '<InnerBlocks allowedBlocks="' . esc_attr( wp_json_encode( $allowed_blocks ) ) . '" template="' . esc_attr( wp_json_encode( $template ) ) . '" />';
echo '</div></div>';

?>
