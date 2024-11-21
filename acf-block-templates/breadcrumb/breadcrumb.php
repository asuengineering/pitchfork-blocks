<?php
/**
 * UDS Breadcrumb
 * Invokes class from Hybrid Breadcrumbs.
 *
 * @package Pitchfork_Blocks
 */

$block_classes = '';
// Add additional block styles to invoked class or default crumb.
if ( isset( $block['className'] ) && ! empty( $block['className'] ) ) {
	$block_classes = trim( sanitize_text_field( $block['className'] ) );
}

$crumbs = array(
	'list_tag'    => 'ul',
	'item_tag'    => 'li',
	'list_class'  => 'breadcrumb',
	'item_class'  => 'breadcrumb-item',
	'title_class' => 'd-none',
	'container_class' => 'breadcrumbs ' . $block_classes
);

// Display a fake breadcrumb on preview since class is not loaded in admin.
// Display the real crumb when not in preview mode.
// See: https://support.advancedcustomfields.com/forums/topic/register-block-preview-image-with-acf_register_block_type/

if ( $is_preview ) {

	?>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page">Current Page</li>
	</ol>
	<?php

} else {

	// Invoke class for breadcrumb.
	Hybrid\Breadcrumbs\Trail::display( $crumbs );

};


