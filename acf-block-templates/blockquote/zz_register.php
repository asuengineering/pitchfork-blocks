<?php
/**
 * Block Registration
 *
 * Block name: Blockquote
 * Author: Steve Ryan
 * Version: 0.1
 *
 * @package Pitchfork_Blocks
 *
 * Notes: A block used to deliver the UDS Blockquote element from the Bootstrap 4 library.
 * Uses inner blocks due to the necessity to deliver a highlighted H3 tag within the markup.
 *  
 * */

acf_register_block_type(
	array(
		'name'            => 'blockquote',
		'title'           => __( 'UDS Blockquote', 'pitchfork-blocks' ),
		'description'     => __( 'Blockquote with a dozen formats. Uses inner blocks for content.', 'pitchfork-blocks' ),
		'icon'            => 'star-filled',
		'render_template' => PITCHFORK_BLOCKS_BASE_PATH . 'acf-block-templates/blockquote/blockquote.php',
		'category'        => 'uds',
		'keywords'        => array( 'blockquote', 'quote', 'testimonial' ),
		'align'			  => '',
		'mode'            => 'edit',
		'supports'        => array(
			'spacing' => array(
				'units' => array('rem'),
				'margin' => array('top', 'bottom'),
				'padding' => false,
			),
			'jsx'   => true,
			'classname' => false,
			'align' => '',
			'color' => array(
				'backround' => false,
				'text' => true,
				'link' => false,
			),
		),
	)
);
