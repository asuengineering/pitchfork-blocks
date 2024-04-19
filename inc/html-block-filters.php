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

	// Process all possible class insertions needed.
	// Reset to block start after each check to deal with missing elements.

    $processor = new WP_HTML_Tag_Processor( $block_content );
	$processor->set_bookmark( 'block-start' );

	if ( $processor->next_tag( array( 'class_name' => 'wp-block-image' ) ) ) {
		$processor->add_class( 'card-img-top' );
	}

	$processor->seek('block-start');

	if ( $processor->next_tag( array( 'class_name' => 'wp-block-heading' ) ) ) {
		$processor->add_class( 'card-title' );
	}

	$processor->seek('block-start');

	if ( $processor->next_tag( array( 'class_name' => 'wp-block-group' ) ) ) {
		$processor->add_class( 'card-body' );
	}

	$processor->seek('block-start');

	if ( $processor->next_tag( array( 'class_name' => 'wp-block-buttons' ) ) ) {
		$processor->add_class( 'card-buttons' );

		// Check for up to 5 single buttons immediately following the buttons parent block.
		for ($i = 1; $i <= 5; $i++) {
			if ( $processor->next_tag( array( 'class_name' => 'wp-block-button' ) ) ) {
				$processor->add_class( 'card-button' );
			}
		}

	}

	$processor->seek('block-start');

	if ( $processor->next_tag( array( 'class_name' => 'taxonomy-category' ) ) ) {
		$processor->add_class( 'card-tags' );

		// Check for any following links and give them button classes.
		while ( $processor->next_tag( array( 'tag_name' => 'a' ) ) ) {
			$rel_check = $processor->get_attribute('rel');
			if ( $rel_check === 'tag' ) {
				$processor->add_class( 'btn btn-tag btn-tag-alt-white' );
			}
		}
	}

	$processor->seek('block-start');

	if ( $processor->next_tag( array( 'class_name' => 'taxonomy-post_tag' ) ) ) {
		$processor->add_class( 'card-tags' );

		// Check for any following links and give them button classes.
		while ( $processor->next_tag( array( 'tag_name' => 'a' ) ) ) {
			$rel_check = $processor->get_attribute('rel');
			if ( $rel_check === 'tag' ) {
				$processor->add_class( 'btn btn-tag btn-tag-alt-white' );
			}
		}
	}

	return $processor->get_updated_html();

}
add_filter( 'render_block', 'pitchfork_add_missing_classes_to_cardv2', 10, 2 );

/**
 * Remove ACF block wrapper from front end display of blocks associated with acf/card-v2.
 */
function acf_remove_cardv2_innerblock_wrapper( $wrap, $name ) {
	$acf_wrap_removal = array(
		'acf/card-v2',
		'acf/card-v2-header',
		'acf/card-v2-links'
	);

    if ( in_array( $name, $acf_wrap_removal )) {
        return false;
    };

    return true;
}
add_filter( 'acf/blocks/wrap_frontend_innerblocks', 'acf_remove_cardv2_innerblock_wrapper', 10, 2 );

