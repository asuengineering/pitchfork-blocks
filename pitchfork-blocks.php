<?php
/**
 * Plugin Name:     Pitchfork Blocks
 * Plugin URI:      http://github.com/ASU-Engineering/Pitchfork-Blocks
 * Description:     Contains blocks that correspond to the universal design system within ASU. Leverages Bootstrap 4 and Advanced Custom Fields (ACF).
 * Author:          Steve Ryan (ASU Engineering)
 * Author URI:      https://engineering.asu.edu
 * Text Domain:     pitchfork-blocks
 * Version:         1.1.1
 *
 * @package         Pitchfork_Blocks
 *
 * GitHub Plugin URI: http://github.com/ASU-Engineering/Pitchfork-Blocks
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

function find_accordion_block_in_haystack( $blocks, $needle ) {
	static $parent = array();
	foreach( $blocks as $block ) {

		// do_action('qm/debug', $block['blockName'] );
		// Is the current block an accordion? Evaluate the inner blocks one level down to check if it's the correct parent.
		// Or, does this block have inner blocks? If so, recurse and keep checking.

		if( 'acf/accordion' === $block['blockName'] ) {
			
			// Evaluate the inners
			$inners = $block['innerBlocks'];
			$foundit = false;
			foreach ($inners as $inner) {
				// do_action('qm/debug', 'Inners: ' . $inner['attrs']['id'] );
				if ( $needle == $inner['attrs']['id'] ) {
					$parent = $block;
					break(2); 
				}
			}
		} elseif ( ! empty( $block['innerBlocks'] )) {
			// If $block contains inner blocks, recurse the function and keep checking. 
			$blocks = find_accordion_block_in_haystack( $block['innerBlocks'], $needle );
		}

	}

	if( $parent != null ){
        return $parent;
    }

}

// Variable for root directory of this plugin.
define( 'PITCHFORK_BLOCKS_BASE_PATH', plugin_dir_path( __FILE__ ) );

// Composer vendor autoload
if ( file_exists( PITCHFORK_BLOCKS_BASE_PATH . 'vendor/autoload.php' ) ) {
	require_once PITCHFORK_BLOCKS_BASE_PATH . 'vendor/autoload.php';
}

// Function: Activate.
// Function: Deactivate.
// Function: Execute plugin.

// TGM Plugin Activation Script. Checks for Advanced Custom Fields.
require_once PITCHFORK_BLOCKS_BASE_PATH . '/tgmpa/class-tgm-plugin-activation.php';
require_once PITCHFORK_BLOCKS_BASE_PATH . '/tgmpa/dependency-check.php';

// Enqueue scripts.
require_once PITCHFORK_BLOCKS_BASE_PATH . '/inc/enqueue-scripts.php';

// ACF configurations.
require_once PITCHFORK_BLOCKS_BASE_PATH . '/inc/acf-config.php';
require_once PITCHFORK_BLOCKS_BASE_PATH . '/inc/acf-menu-select/acf-menu-select.php';
require_once PITCHFORK_BLOCKS_BASE_PATH . '/inc/acf-register-blocks.php';
