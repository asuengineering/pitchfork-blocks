<?php
/**
 * Block Registration
 *
 * Block name: Hero
 * Author: Steve Ryan
 * Version: 0.2
 *
 * @package Pitchfork_Blocks
 *
 * Notes: A block designed to deliver the v2 CSS Grid based version of the header. 
 * Uses an ACF wrapper to quickly enable/disable a couple of options that are otherwise hard to deliver.
 * But, will take advantage of Inner Blocks to use default header higlighting, buttons, etc.
 *  
 * */

acf_register_block_type(
	array(
		'name'            => 'hero',
		'title'           => __( 'UDS Hero', 'pitchfork-blocks' ),
		'description'     => __( 'Creates a hero for the top of the page. Uses Inner Blocks for content.', 'pitchfork-blocks' ),
		'icon'            => 'star-filled',
		'render_template' => PITCHFORK_BLOCKS_BASE_PATH . 'acf-block-templates/hero/hero.php',
		'category'        => 'uds',
		'keywords'        => array( 'hero', 'cover', 'image' ),
		'align'			  => 'full',
		'supports'        => array(
			'jsx'   => true,
			'classname' => false,
			'align' => array( 'full' ),
			'multiple' => false,
		),
		'mode'            => 'edit',
		// 'example'         => array(
		// 	'attributes' => array(
		// 		'mode' => 'preview',
		// 		'data' => array(
		// 			'uds_background_section_choice'  => 'pattern',
		// 			'uds_background_section_pattern' => 'network-white',
		// 		),
		// 	),
		// ),
	)
);
