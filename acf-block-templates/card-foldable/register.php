<?php
/**
 * Block Registration
 *
 * Block name: Foldable Card
 * Author: Steve Ryan
 * Version: 0.2
 *
 * @package Pitchfork_Blocks
 *
 * Notes: A block to deliver a foldable card. Used as the "base block" for an accordion.
 * Leverages inner blocks for the content of each card.
 *  
 * */

acf_register_block_type(
	array(
		'name'            => 'card-foldable',
		'title'           => __( 'UDS Foldable Card', 'pitchfork-blocks' ),
		'description'     => __( 'A singlular foldable card. Uses Inner Blocks for content.', 'pitchfork-blocks' ),
		'icon'            => 'star-filled',
		'render_template' => PITCHFORK_BLOCKS_BASE_PATH . 'acf-block-templates/card-foldable/card-foldable.php',
		'category'        => 'uds',
		'keywords'        => array( 'foldable', 'card', 'accordion' ),
		'align'			  => '',
		'supports'        => array(
			'jsx'   => true,
			'classname' => false,
			'align' => '',
			'color' => array(
				'backround' => true,
				'text' => false,
				'link' => false,
			),
		),
		'mode'            => 'edit'
	)
);
