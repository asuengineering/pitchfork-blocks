<?php
/**
 * - Enqueue plugin scripts.
 * - Register additional scripts to be loaded with individual blocks.
 *
 * @package pitchfork-blocks
 */

// add_action('admin_enqueue_scripts', 'pitchfork_blocks_enqueue_admin_scripts');
// function pitchfork_blocks_enqueue_admin_scripts() {

// 	// Get the theme data.
// 	$the_plugin     = get_plugin_data( PITCHFORK_BLOCKS_BASE_PATH );
// 	$plugin_version = $the_plugin['Version'];

// }

add_action( 'enqueue_block_editor_assets', 'pitchfork_blocks_enqueue_block_scripts' );
function pitchfork_blocks_enqueue_block_scripts() {

		$the_plugin     = get_plugin_data( plugin_dir_path( __DIR__ ) . 'pitchfork-blocks.php' );
		$the_version    = $the_plugin['Version'];
		$plugin_version = $the_version . '.' . filemtime( plugin_dir_path( __DIR__ ) . 'js/block-variations.js' );
	
	wp_enqueue_script( 'uds-block-variations', plugin_dir_url( __DIR__ ) . 'js/block-variations.js',  array( 'wp-blocks', 'wp-dom' ), $plugin_version , true );

}
