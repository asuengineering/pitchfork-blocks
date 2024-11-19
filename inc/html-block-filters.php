<?php
/**
 * HTML filtering of the_content using HTML API.
 * Available since WP 6.2
 *
 * @package pitchfork
 *
 * Helpful docs:
 *  - https://wpdevelopment.courses/articles/wp-html-tag-processor/
 *  - https://developer.wordpress.org/reference/classes/wp_html_tag_processor/
 *
 * Filters within this module:
 * 1. acf/hero and acf/hero-video
 * 2. acf/card-v2
 */

/**
 * 1. Add missing classes to core/group or core/buttons blocks that are
 * found within an acf/hero, acf/hero-video or related parent block.
 */
function pitchfork_add_missing_classes_to_hero( $block_content, $block ) {

	$tested_blocks = array('acf/hero', 'acf/hero-video');

    if ( ! $block_content || ! in_array($block['blockName'], $tested_blocks) ) {
        return $block_content;
    }

	// Process group block first, then button block.
	// Two calls to the processor just in case the inner blocks happen to be out of the normal order.

    $group_processor = new WP_HTML_Tag_Processor( $block_content );

	if ( $group_processor->next_tag( array( 'class_name' => 'wp-block-group' ) ) ) {
		$group_processor->add_class( 'content' );
	}

	$button_processor = new WP_HTML_Tag_Processor( $group_processor->get_updated_html() );

	if ( $button_processor->next_tag( array( 'class_name' => 'wp-block-buttons' ) ) ) {
		$button_processor->add_class( 'btn-row' );
	}

    return $button_processor->get_updated_html();
}
add_filter( 'render_block', 'pitchfork_add_missing_classes_to_hero', 10, 2 );

/**
 * 2. Add missing classes to child blocks of acf/card-v2
 * Covers core/heading, core/buttons, core/button and core/group block possibilities.
 */

 function pitchfork_add_missing_classes_to_cardv2( $block_content, $block ) {

	$tested_blocks = array('acf/card-v2');

    if ( ! $block_content || ! in_array($block['blockName'], $tested_blocks) ) {
        return $block_content;
    }

	$processor = new WP_HTML_Tag_Processor( $block_content );

	// Iterate through all tags in the block content
    while ( $processor->next_tag() ) {
        // Check for wp-block-image and add 'card-img-top'
        if ( $processor->get_attribute( 'class' ) && str_contains( $processor->get_attribute( 'class' ), 'wp-block-image' ) ) {
            $processor->add_class( 'card-img-top' );
        }

        // Check for wp-block-post-featured-image and add 'card-img-top'
        if ( $processor->get_attribute( 'class' ) && str_contains( $processor->get_attribute( 'class' ), 'wp-block-post-featured-image' ) ) {
            $processor->add_class( 'card-img-top' );
        }

        // Check for wp-block-heading and add 'card-title'
        if ( $processor->get_attribute( 'class' ) && str_contains( $processor->get_attribute( 'class' ), 'wp-block-heading' ) ) {
            $processor->add_class( 'card-title' );
        }

		// Check for wp-block-post-title and add 'card-title'
		if ( $processor->get_attribute( 'class' ) && str_contains( $processor->get_attribute( 'class' ), 'wp-block-post-title' ) ) {
			$processor->add_class( 'card-title' );
		}

		// Check for wp-block-group and add 'card-body'
		if ( $processor->get_attribute( 'class' ) && str_contains( $processor->get_attribute( 'class' ), 'wp-block-group' ) ) {
			$processor->add_class( 'card-body' );
		}

		// Check for wp-block-buttons and add 'card-buttons'
		if ( $processor->get_attribute( 'class' ) && preg_match( '/\bwp-block-buttons\b/', $processor->get_attribute( 'class' ) ) ) {
			$processor->add_class( 'card-buttons' );
		}

		// Check for wp-block-button and add 'card-button'
		if ( $processor->get_attribute( 'class' ) && preg_match( '/\bwp-block-button\b/', $processor->get_attribute( 'class' ) ) ) {
			$processor->add_class( 'card-button' );
		}

		// Check for taxonomy-category and add 'card-tags'
		if ( $processor->get_attribute( 'class' ) && str_contains( $processor->get_attribute( 'class' ), 'taxonomy-category' ) ) {
			$processor->add_class( 'card-tags' );
		}

		// Check for taxonomy-post_tag and add 'card-tags'
		if ( $processor->get_attribute( 'class' ) && str_contains( $processor->get_attribute( 'class' ), 'taxonomy-post_tag' ) ) {
			$processor->add_class( 'card-tags' );
		}

		// Check for an anchor element with rel="tag" and add 'btn btn-tag btn-tag-alt-white'
		if ( $processor->get_tag('A') && $processor->get_attribute('rel') && str_contains( $processor->get_attribute('rel'), 'tag' ) ) {
			$processor->add_class( 'btn btn-tag btn-tag-alt-white' );
		}

    }

    return $processor->get_updated_html();

}
add_filter( 'render_block', 'pitchfork_add_missing_classes_to_cardv2', 10, 2 );
