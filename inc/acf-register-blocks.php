<?php
/**
 * File: acf-register-blocks.php
 *
 * @package         Pitchfork_Blocks
 *
 * This file is responsible for loading all of our block 'register.php' files
 * (found in the individual block folders) so that we can register our custom
 * blocks. We do this by hooking into ACF Pro's 'acf/init' action.
 */

 /**
  * Initialize ACF field for Unique ID. Requisite file included from plugin root.
  */
// PhilipNewcomer\ACF_Unique_ID_Field\ACF_Field_Unique_ID::init();
ASUEngineering\ACF_Unique_ID_Field\ACF_Field_Unique_ID::init();

/**
 * Register a custom block category for our blocks to live in. We hook into
 * the block_categories_all() filter to do this.
 */
if ( ! function_exists( 'pitchfork_blocks_custom_category' ) ) {
	/**
	 * Merges our custom category in with the others.
	 *
	 * @param array                   $categories The existing block categories.
	 * @param WP_Block_Editor_Context $editor_context Editor context.
	 */
	function pitchfork_blocks_custom_category( $categories, $editor_context ) {
		return array_merge(
			$categories,
			array(
				array(
					'slug'  => 'pitchfork-blocks',
					'title' => __( 'Pitchfork Blocks', 'pitchfork-blocks' ),
				),
			)
		);
	}
}
add_filter( 'block_categories_all', 'pitchfork_blocks_custom_category', 10, 2 );

/**
 * Loops through an array of block folder names and includes the 'register.php'
 * from within each one.
 *
 * When creating a new block, add the folder name to the $block_includes array
 * below. The folder should contain a 'register.php' file that does the actual
 * block registration, along with your block template(s).
 *
 * Note: Blocks appear in the block picker IN THE ORDER THEY ARE LISTED HERE.
 * When adding a new block, please make sure to insert it an alphabetical order.
 */
function pitchfork_blocks_register_acf_blocks() {

	require_once PITCHFORK_BLOCKS_BASE_PATH . 'acf-block-templates/icons.php';

	// Array of block folders to use. Each contains a block.json file.
	$block_includes = array(
		'/accordion',               // UDS Accordion, uses foldable cards.
		'/alert',                   // UDS Alert Block, includes options for dismissal.
		'/background-section',      // UDS Background section.
		'/banner',                  // UDS Banner block.
		'/blockquote',              // UDS Blockquote, inner blocks
		'/breadcrumb',              // UDS Breadcrumbs, via Hybrid Breadcrumbs (composer)
		// '/card',               		// UDS Cards.
		'/card-v2',					// Card v2
		'/card-v2-event',			// Card v2 - Card Event
		'/card-v2-icon',			// Card v2 - Card Icon
		'/card-v2-image',			// Card v2 - Card Image
		'/card-v2-header',			// Card v2 - Card Header
		'/card-v2-tag',				// Card v2 - Card Tag
		'/card-v2-tags',			// Card v2 - Card Tags
		'/card-v2-link',			// Card v2 - Card Link
		'/card-v2-links',			// Card v2 - Card Links
		'/card-foldable',           // UDS Foldable card block.
		'/content-media-overlap',   // Miscellaneous content sections.
		'/grid-links',              // UDS Grid Links.
		'/hero',                    // UDS Hero block, v2
		'/hero-post',				// UDS Hero, powered by info from a WP Query
		'/hero-video',              // UDS Video hero
		'/sidebar',                 // UDS Sidebar, powered by a custom ACF field to choose the menu object.
		'/subtitle',                // Subtitle block, for use within the hero.
	);

	// Loop through array items and register each block.
	foreach ( $block_includes as $folder ) {
		register_block_type( PITCHFORK_BLOCKS_BASE_PATH . 'acf-block-templates' . $folder );
	}
}
add_action( 'init', 'pitchfork_blocks_register_acf_blocks' );

/**
 * Old school method of registering a block.
 * Check to see if we have ACF Pro for block support.
 */
function pitchfork_blocks_register_v1_acf_blocks() {
	if ( function_exists( 'acf_register_block_type' ) ) {
		require_once PITCHFORK_BLOCKS_BASE_PATH . 'acf-block-templates/card/register.php';
	}
}
add_action( 'acf/init', 'pitchfork_blocks_register_v1_acf_blocks' );
