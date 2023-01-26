<?php
/**
 * UDS Breadcrumb
 * Invokes class from Hybrid Breadcrumbs.
 *
 * @package Pitchfork_Blocks
 */


$crumbs = array(
	'list_tag'    => 'ul',
	'item_tag'    => 'li',
	'list_class'  => 'breadcrumb',
	'item_class'  => 'breadcrumb-item',
	'title_class' => 'd-none',
);

// Display a fake breadcrumb on preview since class is not loaded in admin.
// Display the real crumb when not in preview mode.
// See: https://support.advancedcustomfields.com/forums/topic/register-block-preview-image-with-acf_register_block_type/

if ( ! empty( $_POST['query']['preview'] ) ) {

	?>
	<ol class="breadcrumb bg-white">
		<li class="breadcrumb-item"><a href="#">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page">Current Page</li>
	</ol>
	<?php

} else {

	// Invoke class for breadcrumb.
	Hybrid\Breadcrumbs\Trail::display( $crumbs );

};


