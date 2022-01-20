<?php
/**
 * Plugin Name:     Pitchfork Blocks
 * Plugin URI:      http://github.com/ASU-Engineering/Pitchfork-Blocks
 * Description:     Contains blocks that correspond to the universal design system within ASU. Leverages Bootstrap 4 and Advanced Custom Fields (ACF).
 * Author:          Steve Ryan
 * Author URI:      https://engineering.asu.edu
 * Text Domain:     pitchfork-blocks
 * Domain Path:     /languages
 * Version:         0.1.0
 * 
 * @package         Pitchfork_Blocks
 * 
 * GitHub Plugin URI: http://github.com/ASU-Engineering/Pitchfork-Blocks
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Function: Activate
// Function: Deactivate
// Function: Execute plugin

// TGM Plugin Activation Script. Checks for Advanced Custom Fields.
require_once dirname( __FILE__ ) . '/tgmpa/class-tgm-plugin-activation.php';
require_once dirname( __FILE__ ) . '/tgmpa/dependency-check.php';

// ACF configurations.
require_once dirname( __FILE__ ) . '/inc/acf-config.php';