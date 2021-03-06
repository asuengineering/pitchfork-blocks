<?php
/**
 * Block Registration
 *
 * Block name: Background Section
 * Author: Steve Ryan
 * Version: 0.1
 *
 * @package Pitchfork_Blocks
 *
 * Notes: A block indicated by the UDS design document as a necessary "wrapper" for the application
 * of a background texture or color to a standard Bootstrap container. This does not have a direct correlation to
 * a specific element within the design system. But the specs for padding/margins are at the following page:
 * Home --> Spacing and layout --> Section spacing
 */

acf_register_block_type(
	array(
		'name'            => 'background-section',
		'title'           => __( 'UDS Background Section', 'pitchfork-blocks' ),
		'description'     => __( 'Creates a container that can have a background image, pattern, or color, and uses Inner Blocks for content.', 'pitchfork-blocks' ),
		'icon'            => 'star-filled',
		'render_template' => PITCHFORK_BLOCKS_BASE_PATH . 'acf-block-templates/background-section/background-section.php',
		'category'        => 'uds',
		'keywords'        => array( 'background', 'section', 'image' ),
		'align'			  => 'full',
		'mode'            => 'preview',
		'supports'        => array(
			'spacing' => array(
				'units' => array('rem'),
				'margin' => array('top', 'bottom'),
				'padding' => false,
			),
			'jsx'   => true,
			'classname' => false,
			'align' => 'full',
		),
		'example'         => array(
			'attributes' => array(
				'mode' => 'preview',
				'data' => array(
					'uds_background_section_choice'  => 'pattern',
					'uds_background_section_pattern' => 'network-white',
				),
			),
		),
	)
);
