<?php
/**
 * Block Registration
 *
 * Block name: UDS Grid Links
 * Author: Steve Ryan
 * Version: 0.1
 *
 * @package PitchforkBlocks
 */

$gridlinkicon =

acf_register_block_type(
	array(
		'name'              => 'grid links',
		'title'             => __( 'UDS Grid Links', 'uds-wordpress-theme' ),
		'description'       => __( 'A series of formatted links arranged in a grid.', 'uds-wordpress-theme' ),
		'icon'              => 'grid-view',
		'render_template'   => PITCHFORK_BLOCKS_BASE_PATH . 'acf-block-templates/grid-links/grid-links.php',
		'category'          => 'uds',
		'keywords'          => array( 'grid', 'links' ),
		'align'			  => '',
		'mode'              => 'edit',
		'supports'          => array(
			'spacing' => array(
				'units' => array('rem'),
				'margin' => array('top', 'bottom'),
				'padding' => true,
			),
			'align' => '',
			'jsx' => true,
			'color' => array(
				'backround' => false,
				'text' => true,
				'link' => false,
			),
		),
		'example'           => array(
			'attributes' => array(
				'mode' => 'preview', // show the actual card view for the preview when adding this block.
				'data' => array(
					'uds_grid_links_source'  => 'arbitrary',
					'uds_grid_links_columns' => 'three-columns',
					'uds_grid_links_color'   => 'none',
					'uds_grid_links_created' => '',
				),
			),
		),
	)
);
