<?php
/**
 * Additional functions for Advanced Custom Fields.
 *
 * Contents:
 *   - Load path for ACF groups from the parent.
 *   - Register custom blocks for the theme.
 *
 * @package pitchfork-blocks
 */

/**
 * Register a new loading point for the Local JSON feature for this plugin.
 *
 * @param  mixed $paths // path to ACF load point.
 * @return $paths
 */
function pitchfork_blocks_acf_json_load_point( $paths ) {
	$paths[] = PITCHFORK_BLOCKS_BASE_PATH . 'acf-json';
	return $paths;
}
add_filter( 'acf/settings/load_json', 'pitchfork_blocks_acf_json_load_point' );


/**
 * Create a save point for specifc JSON files for the the plugin's ACF groups.
 *
 * Key list
 * - UDS Block: Accordion - group_627bf21169d29
 * - UDS Block: Alert - group_603436127871b
 * - UDS Block: Banner - group_611ec0462e2e5
 * - UDS Block: Background Section - group_603819e0955bf
 * - UDS Block: Blockquote - group_6272d7b38757e
 * - UDS Block: Breadcrumb - group_6267257b9dd8f
 * - UDS Block: Card - group_602edd7eb0e61
 * - UDS Block: Card v2 - group_6605e470e665f
 * - UDS Block: Content-Image Overlap - group_602314dddcc3f
 * - UDS Block: Foldable Card - group_613fc14daf233
 * - UDS Block: Grid Links - group_60bf99d0b5ceb
 * - UDS Block: Hero - group_6114252e73759
 * - UDS Block: Hero (Video) - group_62ead7abbe15f
 * - UDS Block: Sidebar - group_62689708eb27e
 * - UDS Block: Subtitle - group_6250abdba7d2c
 * - UDS Fieldset: Button - group_601db250e6c94
 *
 * @return $paths
 */
function pitchfork_blocks_field_groups( $path ) {
    $path = PITCHFORK_BLOCKS_BASE_PATH . 'acf-json';
    return $path;
}
add_filter( 'acf/settings/save_json/key=group_627bf21169d29', 'pitchfork_blocks_field_groups' );
add_filter( 'acf/settings/save_json/key=group_603436127871b', 'pitchfork_blocks_field_groups' );
add_filter( 'acf/settings/save_json/key=group_611ec0462e2e5', 'pitchfork_blocks_field_groups' );
add_filter( 'acf/settings/save_json/key=group_603819e0955bf', 'pitchfork_blocks_field_groups' );
add_filter( 'acf/settings/save_json/key=group_6272d7b38757e', 'pitchfork_blocks_field_groups' );
add_filter( 'acf/settings/save_json/key=group_6267257b9dd8f', 'pitchfork_blocks_field_groups' );
add_filter( 'acf/settings/save_json/key=group_602edd7eb0e61', 'pitchfork_blocks_field_groups' );
add_filter( 'acf/settings/save_json/key=group_6605e470e665f', 'pitchfork_blocks_field_groups' );
add_filter( 'acf/settings/save_json/key=group_602314dddcc3f', 'pitchfork_blocks_field_groups' );
add_filter( 'acf/settings/save_json/key=group_613fc14daf233', 'pitchfork_blocks_field_groups' );
add_filter( 'acf/settings/save_json/key=group_60bf99d0b5ceb', 'pitchfork_blocks_field_groups' );
add_filter( 'acf/settings/save_json/key=group_6114252e73759', 'pitchfork_blocks_field_groups' );
add_filter( 'acf/settings/save_json/key=group_62ead7abbe15f', 'pitchfork_blocks_field_groups' );
add_filter( 'acf/settings/save_json/key=group_62689708eb27e', 'pitchfork_blocks_field_groups' );
add_filter( 'acf/settings/save_json/key=group_6250abdba7d2c', 'pitchfork_blocks_field_groups' );
add_filter( 'acf/settings/save_json/key=group_601db250e6c94', 'pitchfork_blocks_field_groups' );

