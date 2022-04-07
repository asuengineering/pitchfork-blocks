<?php
/**
 * - Enqueue plugin scripts.
 * - Register additional scripts to be loaded with individual blocks.
 *
 * @package pitchfork-blocks
 */

 // Main styles/scripts enqueue.
add_action( 'wp_enqueue_scripts', 'pitchfork_blocks_enqueue_block_styles' );
function pitchfork_blocks_enqueue_block_styles() {

		$the_plugin     = get_plugin_data( plugin_dir_path( __DIR__ ) . 'pitchfork-blocks.php' );
		$the_version    = $the_plugin['Version'];
		$plugin_version = $the_version . '.' . filemtime( plugin_dir_path( __DIR__ ) . 'css/theme.min.css' );
	
		wp_enqueue_style( 'pitchfork-block-styles', plugin_dir_url( __DIR__ ) . 'css/theme.min.css', array(), $plugin_version );
}

// Main styles/scripts enqueue.
add_action( 'enqueue_block_editor_assets', 'pitchfork_blocks_enqueue_block_scripts' );
function pitchfork_blocks_enqueue_block_scripts() {

	$the_plugin     = get_plugin_data( plugin_dir_path( __DIR__ ) . 'pitchfork-blocks.php' );
	$the_version    = $the_plugin['Version'];
	$block_variations_version = $the_version . '.' . filemtime( plugin_dir_path( __DIR__ ) . 'js/block-variations.js' );
	$block_styles_version = $the_version . '.' . filemtime( plugin_dir_path( __DIR__ ) . 'css/theme.min.css' );
	
	wp_enqueue_script( 'uds-block-variations', plugin_dir_url( __DIR__ ) . 'js/block-variations.js',  array( 'wp-blocks', 'wp-dom' ), $block_variations_version , true );
	wp_enqueue_style( 'pitchfork-block-styles', plugin_dir_url( __DIR__ ) . 'css/theme.min.css', array(), $block_styles_version );

}

// Enqueue to the admin. Gutenberg editor fixes.
add_action('admin_enqueue_scripts', 'pitchfork_blocks_enqueue_admin_scripts');
function pitchfork_blocks_enqueue_admin_scripts() {

	$the_plugin     = get_plugin_data( plugin_dir_path( __DIR__ ) . 'pitchfork-blocks.php' );
	$the_version    = $the_plugin['Version'];
	$plugin_version = $the_version . '.' . filemtime( plugin_dir_path( __DIR__ ) . 'css/admin.min.css' );

	wp_enqueue_style( 'pitchfork-block-admin-styles', plugin_dir_url( __DIR__ ) . 'css/admin.min.css', array(), $plugin_version );

}