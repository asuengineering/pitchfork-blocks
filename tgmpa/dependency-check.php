<?php
/**
 * TGMPA Registration script.
 * 
 * @package pitchfork-blocks
 */

add_action( 'tgmpa_register', 'pitchfork_blocks_register_required_plugins' );

/**
 * Register the required plugins for this plugin.
 */
function pitchfork_blocks_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		// The 'is_callable' setting checks for the ability to register a block, specific for ACF Pro.
		array(
			'name'        => 'Advanced Custom Fields Pro',
			'slug'        => 'advanced-custom-fields-pro',
			'is_callable' => 'acf_register_block_type',
			'required'    => 'true',
		),
	);

	/*
	 * Array of configuration settings.
	 */
	$config = array(
		'id'           => 'pitchfork_blocks',      // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => false,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => true,                    // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}
