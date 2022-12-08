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
PhilipNewcomer\ACF_Unique_ID_Field\ACF_Field_Unique_ID::init();

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
			// '/accordion',				// UDS Accordion, uses foldable cards.
			// '/alert',					// UDS Alert Block, includes options for dismissal.
			// '/background-section', 		// UDS Background section.
			// '/banner',             		// UDS banner block.
			// '/blockquote',				// UDS Blockquote, inner blocks
			// '/breadcrumb',				// UDS Breadcrumbs, via Hybrid Breadcrumbs (composer)
			'/card',               		// UDS Cards.
			// '/card-foldable',      		// UDS Foldable card block.
			// '/content-media-overlap', 	// Miscellaneous content sections.
			// '/grid-links',         		// UDS Grid Links.
			// '/hero',				  	// UDS Hero block, v2
			// '/hero-video',				  	// UDS Hero block, v2
			// '/sidebar',					// UDS Sidebar, powered by a custom ACF field to choose the menu object.
			// '/subtitle',				// Subtitle block, for use within the hero.

			// '/profile',            // Individual person profile (non-iSearch).
			// '/show-more',          // Show more button.
			// '/tabbed-panels',      // UDS Tabbed panels block.
		);

		// Loop through array items and include each register file.
		foreach ( $block_includes as $folder ) {
			require_once PITCHFORK_BLOCKS_BASE_PATH . 'acf-block-templates' . $folder . '/register.php';
		}
	}
}
add_action( 'acf/init', 'pitchfork_blocks_acf_blocks_init' );

add_action( 'init', 'pitchfork_blocks_register_v2_acf_blocks', 5 );
function pitchfork_blocks_register_v2_acf_blocks() {
    register_block_type( PITCHFORK_BLOCKS_BASE_PATH . 'acf-block-templates/accordion');
	register_block_type( PITCHFORK_BLOCKS_BASE_PATH . 'acf-block-templates/alert');
	register_block_type( PITCHFORK_BLOCKS_BASE_PATH . 'acf-block-templates/background-section');
	register_block_type( PITCHFORK_BLOCKS_BASE_PATH . 'acf-block-templates/banner');
	register_block_type( PITCHFORK_BLOCKS_BASE_PATH . 'acf-block-templates/blockquote');
	register_block_type( PITCHFORK_BLOCKS_BASE_PATH . 'acf-block-templates/breadcrumb');
	register_block_type( PITCHFORK_BLOCKS_BASE_PATH . 'acf-block-templates/card-foldable');
	register_block_type( PITCHFORK_BLOCKS_BASE_PATH . 'acf-block-templates/content-media-overlap');
	register_block_type( PITCHFORK_BLOCKS_BASE_PATH . 'acf-block-templates/grid-links');
	register_block_type( PITCHFORK_BLOCKS_BASE_PATH . 'acf-block-templates/hero');
	register_block_type( PITCHFORK_BLOCKS_BASE_PATH . 'acf-block-templates/hero-video');
	register_block_type( PITCHFORK_BLOCKS_BASE_PATH . 'acf-block-templates/sidebar');
	register_block_type( PITCHFORK_BLOCKS_BASE_PATH . 'acf-block-templates/subtitle');
}


/**
 * Given an $block object from an ACF block for gutenberg:
 * This will return a string of CSS inline values suitable for
 * inclusion in the block output in PHP.
 *
 * @param  mixed $block
 * @return $style as string
 */
function pitchfork_blocks_acf_calculate_spacing($block) {

	$style = '';
	$padding = array();
	$margin = array();

	if (isset($block['style']['spacing']['padding'])) {

		$padding = $block['style']['spacing']['padding'];

		foreach ($padding as $rule => $value) {
			if ( str_starts_with( $value, 'var:') ) {
				$var_position = strrpos($value, '|');
				$variable = substr($value, $var_position + 1 );
				$style .= 'padding-' . $rule . ':var(--wp--preset--spacing--' . $variable . '); ';
			} else {
				$style .= 'padding-' . $rule . ':' . $value . '; ';
			}
		}
	}

	if (isset($block['style']['spacing']['margin'])) {

		$margin = $block['style']['spacing']['margin'];

		foreach ($margin as $rule => $value) {
			if ( str_starts_with( $value, 'var:') ) {
				$var_position = strrpos($value, '|');
				$variable = substr($value, $var_position + 1 );
				$style .= 'margin-' . $rule . ':var(--wp--preset--spacing--' . $variable . '); ';
			} else {
				$style .= 'margin-' . $rule . ':' . $value . '; ';
			}
		}
	}

	return $style;
	// echo '<div style="' . $style . '">Block content</div>';
}

/**
 * Create filter to remove ACF inner blocks wrapper from a couple of blocks.
 *
 * Note that some additional CSS to "ignore" the wrapper in a grid context is required
 * for any of these blocks to function correctly in the block editor. The wrapper is
 * non-removable in that context.
 *
 * Removed here for greater transparency and compliance with actual markup for Unity elements.
 *
 * See: https://www.advancedcustomfields.com/resources/whats-new-with-acf-blocks-in-acf-6/#block-versioning
 */
add_filter( 'acf/blocks/wrap_frontend_innerblocks', 'pitchfork_acf_remove_wrap_innerblocks', 10, 2 );
function pitchfork_acf_remove_wrap_innerblocks( $wrap, $name ) {

	$nowrap_block_names = array( 'acf/hero', 'acf/hero-video' );

	// Loop through the array above. If located, remove the wrapper.
    if ( in_array( $name, $nowrap_block_names ) ) {
        return false;
    }

    return true;
}
