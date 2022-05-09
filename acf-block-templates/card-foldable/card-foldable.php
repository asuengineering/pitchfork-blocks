<?php
/**
 * UDS Foldable card block
 *
 * @package Pitchfork_Blocks
 */

$fc_title 		= get_field( 'uds_foldcard_title' );
$fc_icon 		= get_field( 'uds_foldcard_icon' );
$collapsed 		= get_field( 'uds_foldcard_collapsed' );

$base_class = array('card', 'card-foldable');
// Add color declaration from block properties.
// Add disable fold.

// do_action('qm/debug', $collapsed );
$blockID = $block['id'];

// Card header, title and icon state.
if ( ! empty( $fc_icon)) {
	$card_head = '<div class="card-header card-header-icon">';
	$card_title = '<span class="card-icon"><i class="' . $fc_icon . '"></i>' . $fc_title . '</span>';
	
} else {
	$card_head = '<div class="card-header">';
	$card_title = $fc_title;
}

$card_title .= '<span class="fas fa-chevron-up"></span>';

// Card header <a> tag.
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

// Card body w/classes 
$card_body_attr = array();
$card_body_attr[] = 'id="fCardBody-' . $blockID . '"';
$card_body_attr[] = 'aria-labelledby="fCard-'  . $blockID . '"';

if (! $collapsed) {
	$card_body_attr[] = 'class="card-body collapse"';
} else {
	$card_body_attr[] = $card_body_attr[] = 'class="card-body collapse show"';
}

$card_body = '<div ' . implode( ' ', $card_body_attr) . '>';


// Sets InnerBlocks with an H4 and a paragraph as default content.
$allowed_blocks = array( 'core/html', 'core/heading', 'core/paragraph', 'core/image' );
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
$card .= '<div class="card card-foldable">' . $card_head . '<h4>' . $card_head_link . $card_title . '</a></h4></div>' . $card_body;

echo wp_kses_post( $card );
echo '<InnerBlocks allowedBlocks="' . esc_attr( wp_json_encode( $allowed_blocks ) ) . '" template="' . esc_attr( wp_json_encode( $template ) ) . '" />';
echo '</div></div>';

?>
