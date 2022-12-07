<?php
/**
 * Block Registration
 *
 * Block name: Sidebar
 * Author: Steve Ryan
 * Version: 0.1
 *
 * @package Pitchfork_Blocks
 *
 * Notes: Produces a sidebar navigation element as a block.
 * - ACF field definitions will include a new custom control for ACF that was graciously
 *   left for us to consume via GitHub. (Forked for safety and maintained within ASU Engineering.)
 *
 */

acf_register_block_type(
	array(
		'name'            => 'uds-sidebar',
		'title'           => __( 'UDS Sidebar', 'pitchfork-blocks' ),
		'description'     => __( 'Secondary navigation powered by menus made the old skool way.', 'pitchfork-blocks' ),
		'icon'            => 'star-filled',
		'render_template' => PITCHFORK_BLOCKS_BASE_PATH . 'acf-block-templates/sidebar/sidebar.php',
		'category'        => 'uds',
		'keywords'        => array( 'sidebar', 'navigation', 'secondary' ),
		'align'			  => array(),
		'mode'            => 'edit',
		'supports'        => array(
			'jsx'   => true,
			'classname' => false,
			'align' => array(),
		)
	)
);
