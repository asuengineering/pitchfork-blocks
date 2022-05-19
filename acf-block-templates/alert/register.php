<?php
/**
 * Block Registration
 *
 * Block name: Alert
 * Author: Steve Ryan
 * Version: 0.2
 *
 * @package Pitchfork_Blocks
 *
 * Notes: Allows the user to create an alert message.
 * Includes options for creating a dismissable / immutable message.
 *  
 * */

acf_register_block_type(
	array(
		'name'            => 'alert',
		'title'           => __( 'UDS Alert', 'pitchfork-blocks' ),
		'description'     => __( 'Creates an alert message. Styles dictate the color/purpose. Uses Inner Blocks for content.', 'pitchfork-blocks' ),
		'icon'            => 'star-filled',
		'render_template' => PITCHFORK_BLOCKS_BASE_PATH . 'acf-block-templates/alert/alert.php',
		'category'        => 'uds',
		'keywords'        => array( 'alert', 'dismiss', 'message' ),
		'align'			  => '',
		'mode'            => 'preview',
		'supports'        => array(
			'jsx'   => true,
			'classname' => false,
			'align' => '',
			'color' => array(
				'background' => false,
				'text' => false,
				'link' => false,
			),
		),
	)
);
