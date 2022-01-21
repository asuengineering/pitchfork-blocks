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
function pitchfork_blocks_acf_blocks_init() {
	// Check to see if we have ACF Pro for block support.
	if ( function_exists( 'acf_register_block_type' ) ) {

		// Array of block folders to use. Each must have a 'register.php' file.
		$block_includes = array(
			// '/alert',
			'/background-section', // UDS Background section.
			// '/banner',             // UDS banner block.
			// '/blockquote',         // Combination of UDS block quote and testimonial.
			// '/button',             // Button block for UDS theme.
			// '/cards',              // UDS Cards.
			// '/content-sections',   // Miscellaneous content sections.
			// '/foldable-card',      // UDS Foldable card block.
			// '/grid-links',         // UDS Grid Links.
			// '/headings',           // A UDS Headings block.
			// '/image',              // UDS Image block with caption and shadow options.
			// '/modals',             // UDS windows modal block.
			// '/overlay-card',       // UDS Program Cards.
			// '/profile',            // Individual person profile (non-iSearch).
			// '/show-more',          // Show more button.
			// '/tabbed-panels',      // UDS Tabbed panels block.
		);

		// Loop through array items and include each register file.
		foreach ( $block_includes as $folder ) {
			require_once PITCHFORK_BLOCKS_BASE_PATH . '/acf-block-templates' . $folder . '/register.php';
		}
	}
}
add_action( 'acf/init', 'pitchfork_blocks_acf_blocks_init' );
