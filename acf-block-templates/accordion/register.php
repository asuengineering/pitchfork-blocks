<?php
/**
 * Block Registration
 *
 * Block name: Accordion
 * Author: Steve Ryan
 * Version: 0.2
 *
 * @package Pitchfork_Blocks
 *
 * Notes: A wrapper block for acf/foldable cards. 
 * Provides an option to allow cards to function together or independently.
 *  
 * */

acf_register_block_type(
	array(
		'name'            => 'accordion',
		'title'           => __( 'UDS Accordion', 'pitchfork-blocks' ),
		'description'     => __( 'An accordion with optional independent expansion/contraction of inner cards', 'pitchfork-blocks' ),
		'icon'            => 'star-filled',
		'render_template' => PITCHFORK_BLOCKS_BASE_PATH . 'acf-block-templates/accordion/accordion.php',
		'category'        => 'uds',
		'keywords'        => array( 'foldable', 'accordion' ),
		'align'			  => '',
		'mode'            => 'edit',
		'supports'        => array(
			'spacing' => array(
				'units' => array('em'),
				'margin' => array('top', 'bottom'),
				'padding' => true,
			),
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
