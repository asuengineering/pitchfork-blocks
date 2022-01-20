<?php
/**
 * ACF Configurations. 
 * - Add save/load points for JSON feature.
 */

// Register a new save point for the Local JSON feature for this plugin.
add_filter( 'acf/settings/save_json', 'pitchfork_blocks_acf_json_save_point' );
function pitchfork_blocks_acf_json_save_point( $path ) {
	$path = PITCHFORK_BLOCKS_BASE_PATH . '/acf-json';
	return $path;
}

// It needs to load as well.
add_filter( 'acf/settings/load_json', 'pitchfork_blocks_acf_json_load_point' );
function pitchfork_blocks_acf_json_load_point( $paths ) {
	$paths[] = PITCHFORK_BLOCKS_BASE_PATH . '/acf-json';
	return $paths;
}

// // Register new options page within ACF
// if( function_exists('acf_add_options_page') ) {
// 	acf_add_options_sub_page(
// 		array(
// 			'page_title' 	=> 'Pitchfork Blocks Options',
// 			'menu_title'	=> 'Pitchfork Blocks',
// 			'parent_slug'	=> 'tools.php',
// 		)
// 	);
// }
