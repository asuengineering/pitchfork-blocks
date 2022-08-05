<?php
/**
 * Block Registration
 *
 * Block name: Hero - Video
 * Author: Steve Ryan
 * Version: 0.2
 *
 * @package Pitchfork_Blocks
 *
 * Notes: All of the goodness of the static image hero + enhancements for playing videos in the hero.
 * Still takes advantage of Inner Blocks to use default header higlighting, buttons, etc.
 * 
 * */

acf_register_block_type(
	array(
		'name'            => 'hero-video',
		'title'           => __( 'UDS Hero - Video', 'pitchfork-blocks' ),
		'description'     => __( 'Used for full motion video (MP4) in your hero. Inner Blocks for content.', 'pitchfork-blocks' ),
		'icon'            => 'star-filled',
		'render_template' => PITCHFORK_BLOCKS_BASE_PATH . 'acf-block-templates/hero-video/hero-video.php',
		'category'        => 'uds',
		'keywords'        => array( 'hero', 'cover', 'video' ),
		'align'			  => 'full',
		'supports'        => array(
			'jsx'   => true,
			'classname' => false,
			'align' => array( 'full' ),
			'multiple' => false,
		),
		'mode'            => 'edit'
	)
);
