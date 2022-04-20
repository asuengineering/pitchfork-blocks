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
		'name'            => 'subtitle',
		'title'           => __( 'UDS Subtitle', 'pitchfork-blocks' ),
		'description'     => __( 'A block specifically for the UDS Hero. Used to include a subtitle above the H1.', 'pitchfork-blocks' ),
		'icon'            => 'star-filled',
		'render_template' => PITCHFORK_BLOCKS_BASE_PATH . 'acf-block-templates/subtitle/subtitle.php',
		'category'        => 'uds',
		'keywords'        => array( 'hero', 'subtitle', 'title' ),
		'parent'		  => array( '[acf/hero]' ),
		'supports'        => array(
			'jsx'   => true,
			'classname' => false,
			'align' => false,
			'multiple' => false,
			'mode' => false,
		),
		'mode'            => 'preview',
		'example'         => array(
			'attributes' => array(
				'mode' => 'preview',
				'data' => array(
					'uds_subtitle_text'  => 'Your hero subtitle',
					'uds_subtitle_highlight_color' => 'highlight-gold',
				),
			),
		),
	)
);
