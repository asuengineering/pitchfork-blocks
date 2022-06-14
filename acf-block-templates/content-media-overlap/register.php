<?php
/**
 * Block Registration
 *
 * Block name: Content Image Overlap
 * Author: Steve Ryan
 * Version: 0.1
 *
 * @package UDS WordPress Theme
 *
 * Notes: A block created from the XD design document directly, as opposed to "downstream"
 * from the UDS Boostrap project. Notes found with the Misc. Content section under the heading of Content Image Overlap
 */

acf_register_block_type(
	array(
		'name'              => 'content-image-overlap',
		'title'             => __( 'UDS Content Image Overlap', 'uds-wordpress-theme' ),
		'description'       => __( 'A stylized layout element with a prominent image, and a configurable content area.', 'uds-wordpress-theme' ),
		'icon'              => 'welcome-widgets-menus',
		'render_template' 	=> PITCHFORK_BLOCKS_BASE_PATH . 'acf-block-templates/content-media-overlap/content-media.php',
		'category'          => 'uds',
		'keywords'          => array( 'overlap', 'content', 'section' ),
		'mode'              => 'preview',
		'example'           => array(
			'attributes' => array(
				'mode' => 'preview', // show the actual card view for the preview when adding this block.
				'data' => array(),
			),
		),
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
				'background' => false,
				'text' => false,
				'link' => false,
			),
		),
	)
);
