<?php
/**
 * UDS Sidebar
 * - Uses an ACF custom field for selecting the menu object from the DB.
 * - Uses a custom walker for outputting the structure of the <nav> element. 
 * 
 * @package Pitchfork_Blocks
 * 
 */

$menu_object = wp_get_nav_menu_object( get_field( 'uds_sidebar_menu_name' ) );
$menu_name = $menu_object->name;
$menu = $menu_object->slug;

$sidebar_title = get_field( 'uds_sidebar_no_title' );
$mobile_display = get_field( 'uds_sidebar_mobile_collapse' );
$mobile_prompt = get_field( 'uds_sidebar_mobile_prompt' );


// Output the menu title and select box before the actual <nav>.
if ($mobile_display) {

    if (! $sidebar_title) {
        echo '<h3>' . esc_html($menu_name) . '</h3>';
    }

    ?>
    <div class="sidebar-toggler" data-toggle="collapse" data-target="#sidebar-<?php echo esc_html($menu); ?>" aria-expanded="false" aria-controls="sidebar-<?php echo esc_html($menu); ?>">
        <p><?php echo esc_html($mobile_prompt); ?></p>
        <span class="fas fa-chevron-up"></span>
    </div>
    <?php

}

// Run the nav walker and display the real version.

wp_nav_menu( array (
    'menu' => $menu_object,
    'depth' => 2,
    'container' => 'nav',
    'container_id' => 'sidebar-' . $menu,
    'container_class' => 'sidebar collapse',
    'container_aria_label' => 'Secondary',
    'items_wrap' => '%3$s',     // No wrapper around nav elements.
    'walker' => new PFBlocks_Sidebar(),
));