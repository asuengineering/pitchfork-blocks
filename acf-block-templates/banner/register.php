<?php
/**
 * Block Registration
 *
 * Block name: Banner
 * Author: Steve Ryan
 * Version: 0.1
 *
 * @package Pitchfork_Blocks
 *
 * Notes: Allows the user to create an banner message.
 * Includes options for creating a dismissable / immutable message.
 *  
 * */

acf_register_block_type(
	array(
		'name'            => 'banner',
		'title'           => __( 'UDS Banner', 'pitchfork-blocks' ),
		'description'     => __( 'Banner style message. Full-width. Use with repeatable blocks. Uses Inner Blocks for content.', 'pitchfork-blocks' ),
		'icon'            => 'star-filled',
		'render_template' => PITCHFORK_BLOCKS_BASE_PATH . 'acf-block-templates/banner/banner.php',
		'category'        => 'uds',
		'keywords'        => array( 'banner', 'dismiss', 'message' ),
		'align'			  => '',
		'mode'            => 'preview',
		'supports'        => array(
			'multiple' => false,
			'jsx'   => true,
			'classname' => false,
			'align' => '',
			'color' => array(
				'background' => true,
				'text' => false,
				'link' => false,
			),
		),
	)
);
