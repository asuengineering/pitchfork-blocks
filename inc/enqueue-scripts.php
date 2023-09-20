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

		$the_plugin         = get_plugin_data( plugin_dir_path( __DIR__ ) . 'pitchfork-blocks.php' );
		$the_version        = $the_plugin['Version'];
		$plugin_version     = $the_version . '.' . filemtime( plugin_dir_path( __DIR__ ) . 'dist/css/blocks.css' );
		$hero_video_version = $the_version . '.' . filemtime( plugin_dir_path( __DIR__ ) . 'dist/js/hero-video.js' );
		$block_variations_version = $the_version . '.' . filemtime( plugin_dir_path( __DIR__ ) . 'dist/js/block-variations.js' );
		$data_layer 		= $the_version . '.' . filemtime( plugin_dir_path( __DIR__ ) . 'dist/js/data-layer-bs5.js' );

		wp_enqueue_style( 'pitchfork-block-styles', plugin_dir_url( __DIR__ ) . 'dist/css/blocks.css', array( 'pitchfork-styles' ), $plugin_version );
		wp_enqueue_script( 'hero-video-controls', plugin_dir_url( __DIR__ ) . 'dist/js/hero-video.js', array(), $hero_video_version, true );
		wp_enqueue_script( 'uds-block-variations', plugin_dir_url( __DIR__ ) . 'dist/js/block-variations.js', array( 'wp-blocks', 'wp-dom' ), $block_variations_version, true );
		wp_enqueue_script( 'pitchfork-block-data-layer', plugin_dir_url( __DIR__ ) . 'dist/js/data-layer-bs5.js', array(), $data_layer, true );

}

// Allow styles added here to also be present within the block editor.
function pitchfork_blocks_gutenberg_css() {
	add_editor_style( plugin_dir_url( __DIR__ ) . 'dist/css/blocks.css' );
}
add_action( 'after_setup_theme', 'pitchfork_blocks_gutenberg_css' );

// Enqueue to the admin. Gutenberg editor fixes.
add_action( 'enqueue_block_editor_assets', 'pitchfork_blocks_enqueue_block_editor_scripts' );
function pitchfork_blocks_enqueue_block_editor_scripts() {

	$the_plugin     = get_plugin_data( plugin_dir_path( __DIR__ ) . 'pitchfork-blocks.php' );
	$the_version    = $the_plugin['Version'];
	$plugin_version = $the_version . '.' . filemtime( plugin_dir_path( __DIR__ ) . 'dist/css/block-editor.css' );

	wp_enqueue_style( 'pitchfork-block-admin-styles', plugin_dir_url( __DIR__ ) . 'dist/css/block-editor.css', array(), $plugin_version );
	wp_enqueue_script( 'hero-missing-classes', plugin_dir_url( __DIR__ ) . 'dist/js/hero-missing-classes.js', array( 'wp-blocks', 'wp-dom' ), null, true);
}
