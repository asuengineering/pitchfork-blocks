<?php
/**
 * Block Registration
 *
 * Block name: Breadcrumb
 * Author: Steve Ryan
 * Version: 0.1
 *
 * @package Pitchfork_Blocks
 *
 * Notes: A block which produces a breadcrumb from the Hybrid Breadcrumbs library
 * which is included in this plugin via Composer.
 */

acf_register_block_type(
	array(
		'name'            => 'breadcrumb',
		'title'           => __( 'UDS Breadcrumb', 'pitchfork-blocks' ),
		'description'     => __( 'Produces a breadcrumb to promote better internal site navigation.', 'pitchfork-blocks' ),
		'icon'            => 'star-filled',
		'render_template' => PITCHFORK_BLOCKS_BASE_PATH . 'acf-block-templates/breadcrumb/breadcrumb.php',
		'category'        => 'uds',
		'keywords'        => array( 'breadcrumb', 'navigation' ),
		'align'			  => array( 'full' ),
		'mode'            => 'preview',
		'supports'        => array(
			'jsx'   => true,
			'classname' => false,
			'align' => array( 'full' ),
		)
	)
);
