<?php
/**
 * PFBlocks_Sidebar class, extends native Nav Walker.
 *
 * @package Pitchfork_Blocks
 * 
 */

if ( !class_exists('PFBlocks_Sidebar') ) {

    class PFBlocks_Sidebar extends Walker_Nav_Menu {

        function start_el(&$output, $item, $depth=0, $args=[], $id=0) {

            // Check to see if item includes "current-menu-item" class.
            // Output the correct additional class from UDS-BS4 if so.
            if ( in_array('current-menu-item', $item->classes)) {
                $item->classes[] = 'is-active';
            }

            // Also check to see if item is a parent which includes the active item.
            if ( in_array('current-menu-parent', $item->classes)) {
                $item->classes[] = 'is-active';
            }
            
            $normal_link = '<a class="nav-link ' . implode(" ", $item->classes) . '" href="' . $item->url . '">' . $item->title . '</a>';

            // If we are at the top level...
            if ( $depth == 0 ) {

                if ( $args->walker->has_children ) {

                    $mid = $item->ID;

                    // If this top level item also has children, we need the card markup.
                    $output .= '<div class="card card-foldable">';
                    $output .= '<div class="card-header">';
                    $output .= '<a id="card' . $mid . '" class="collapsed nav-link' . implode(" ", $item->classes) . '" href="#cardBody' . $mid . '" data-toggle="collapse" data-target="#cardBody' . $mid . '" aria-expanded="false" aria-controls="cardBody' . $mid . '">';
                    $output .= $item->title . '<span class="fas fa-chevron-down ml-1"></span></a></div>';
                    $output .= '<div id="cardBody' . $mid . '" class="collapse card-body" aria-labelledby="card' . $mid . '" data-parent=".sidebar">';

                } else {

                    // Top level, no kids. We need to wrap the normal link with a <div>.
                    $output .= '<div class="nav-link-container">';
                    $output .= $normal_link;
                    
                }

            } else {

                // Second level output is just the $normal_link with no wrapper.
                $output .= $normal_link;

            }

        } 

        function end_el(&$output, $item, $depth=0, $args=[], $id=0) {

            // If we are at the top level...
            if ( $depth == 0 ) {

                // Different check for "does this have children." 
                // Previous logic unavailable in end_el for some reason...
                // See: https://wordpress.stackexchange.com/a/199847/69368
                
                if ( in_array('menu-item-has-children', $item->classes)) {

                    // Top level card output needs two closing divs.
                    $output .= '</div></div>';

                } else {

                    // Top level with no card only needs one closing div.
                    $output .= '</div>';

                }

            }

        }
    }
}