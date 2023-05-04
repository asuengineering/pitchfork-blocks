<?php
/**
 * Plugin Name:     Pitchfork Blocks
 * Plugin URI:      http://github.com/ASU-Engineering/Pitchfork-Blocks
 * Description:     Contains blocks that correspond to the universal design system within ASU. Leverages Bootstrap 4 and Advanced Custom Fields (ACF).
 * Author:          Steve Ryan (ASU Engineering)
 * Author URI:      https://engineering.asu.edu
 * Text Domain:     pitchfork-blocks
 * Version:         1.4.1
 *
 * @package         Pitchfork_Blocks
 *
 * GitHub Plugin URI: http://github.com/ASU-Engineering/Pitchfork-Blocks
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Variable for root directory of this plugin. Includes trailing slash.
define( 'PITCHFORK_BLOCKS_BASE_PATH', plugin_dir_path( __FILE__ ) );

// Composer vendor autoload
if ( file_exists( PITCHFORK_BLOCKS_BASE_PATH . 'vendor/autoload.php' ) ) {
	require_once PITCHFORK_BLOCKS_BASE_PATH . 'vendor/autoload.php';
}

// Function: Activate.
// Function: Deactivate.
// Function: Execute plugin.

// TGM Plugin Activation Script. Checks for Advanced Custom Fields.
require_once PITCHFORK_BLOCKS_BASE_PATH . 'tgmpa/class-tgm-plugin-activation.php';
require_once PITCHFORK_BLOCKS_BASE_PATH . 'tgmpa/dependency-check.php';

// Enqueue scripts.
require_once PITCHFORK_BLOCKS_BASE_PATH . 'inc/enqueue-scripts.php';

// Add class to extend nav walker for the sidebar block.
require_once PITCHFORK_BLOCKS_BASE_PATH . 'inc/class_pfblocks_sidebar.php';

// ACF configurations.
require_once PITCHFORK_BLOCKS_BASE_PATH . 'inc/acf-config.php';
require_once PITCHFORK_BLOCKS_BASE_PATH . 'inc/acf-block-utilities.php';
require_once PITCHFORK_BLOCKS_BASE_PATH . 'inc/acf-menu-select/acf-menu-select.php';
require_once PITCHFORK_BLOCKS_BASE_PATH . 'vendor/philipnewcomer/acf-unique-id-field/src/ACF_Field_Unique_ID.php';
require_once PITCHFORK_BLOCKS_BASE_PATH . 'inc/acf-register-blocks.php';
