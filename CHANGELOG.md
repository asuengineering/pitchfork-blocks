# Change Log

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/)
and this project adheres to [Semantic Versioning](http://semver.org/).

## Version 2.3.0

**New block**

- ADD: Implemented new `image-based-card` blocks from Unity Design System.

**Card tags, card buttons**

- FIX: Add missing class for manual card tag block.
- FIX: Enable use of `post-terms` block within a card. Format this block as a button tag when placed inside of a card block. Remove HREF element to prevent tag from being a link to an archive page.
- FIX: Align buttons within cards to the left on mobile.

**Accessibility improvements**

- FIX: Change markup witihn `card-foldable` that triggers the expand/collapse functionality from a link to a button. ([WCMMA-402](https://asudev.jira.com/browse/WCMAA-402))
- FIX: Deter users from altering the order of the inner blocks within all `hero` blocks by including block locking within the default template. ([WCMMA-405](https://asudev.jira.com/browse/WCMAA-405))

**Other**

- Created a generic ACF block template as an easy to replicate starting point for new blocks.

## Version 2.2.0

This release contains a critical fix to address a PHP error that can occur when updating to WordPress core v6.7.0.

This plugin update should be applied concurrently with the [Pitchfork theme](https://github.com/asuengineering/pitchfork) v2.3.0 release before attempting to update to WP core files to the latest version.

- FIX: Rewrite HTML Tag processor function that applied missing CSS classes to acf/card-v2 blocks. Reorganized code to avoid the problematic `set_bookmark` method included in the class.
- FIX: Adjust default block settings for `acf/background-section` so that placing a new block on the page no longer appears like a malfunction. The former default settings were "no pattern, white background" which was a confusing user experience. The block will now default to one of the UDS patterns in the library.
- FIX: Adjust `acf/breadcrumb` block so that the preview of the block always appears within the editor.
- ADD: Add additional block style to `acf/breadcrumb` to allow for "dark mode." The new block style will automatically switch the display to white text with gold links for use against a dark background color or texture.

## Version 2.1.2

FIX: Add CSS rule for block editor to fix layout of ACF fields for blocks in preview mode.

## Version 2.1.1

This release is being made with a concurrent release to the accompanying [Pitchfork theme](https://github.com/asuengineering/pitchfork). Please ensure that the 2.1.1 version of this plugin is being used with the 2.2.1 version of the theme.

This minor release contains the following bug fixes and code cleanup activities.

- FIX: Remove the requirement for the `subtitle_text` field in the `subtitle` block to contain a value. This should prevent hero blocks that contain blank subtitles from triggering an ACF block validatation error.
- CHANGE: Adjust `subtitle` block max length to 70 characters.
- FIX: Remove required fields for `sidebar` block. Prevents field validation errors when block first deployed within editor.
- CHANGE: Two custom field definitions for ACF were moved from this plugin to the Pitchfork theme. This allows the fields to be reused in multiple plugins without needing to be redefined in each application. The fields that moved are the menu selection control used within the `sidebar` block and the unique ID field used within the `foldable-card` block.

## Version 2.1

This release is being made with a concurrent release to the accompanying [Pitchfork theme](https://github.com/asuengineering/pitchfork). Please ensure that the 2.1 version of this plugin is being used with the 2.2 version of the theme.

**UDS Card Block**

ADD: A new version of the UDS Card block is available within the block editor.

The new `acf/card-v2` version of the card component from our design kit relies on existing core blocks to improve the editing experience for content creators. The newer card also relies heavily on the presence of `<InnerBlocks>` to add or configure card options.

The following blocks were developed as a part of the new `card-v2` package.
| New block | Purpose |
|---|---|
| `card-v2` | Wrapper block for cards. Options for orientation and supported card variations are found here. |
| `card-v2-event` | Adds event date and time fields plus a location field for event cards. |
| `card-v2-header` | A wrapper block for the card heading text. Uses the `core/heading` block within. |
| `card-v2-icon` | Include an icon from the included Font Awesome 6 library at the top of your card. |
| `card-v2-image` | Include an image at the top of your card. |
| `card-v2-links` | A wrapper block for card links. Users can create a plain text link or use the dedicated `card-v2-link` block. |
| `card-v2-link` | Add a link to a page within your website or an arbitrary URL using this inner block. |
| `card-v2-tags` | A wrapper block that contains the series of individual `card-v2-tag` blocks. |
| `card-v2-tag` | Configure a series of individual tags at the bottom of your card to help users classify and scan the content. |

In addition, the new `acf/card-v2` can be used inside of a `core/query-loop` block to allow for card layouts consisting of information from elsewhere in the site. Support for the following core blocks is also available by using the new `card-v2` block.

| Core block       | Support provided                                                                                                                                                           |
| ---------------- | -------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| `post-title`     | Use within `card-v2-header` as a replacement for the card title.                                                                                                           |
| `featured-image` | Use within `card-v2` directly. Replaces the need for a card image.                                                                                                         |
| `excerpt`        | Used within `card-v2-content` as a replacement for manually entered content. Provides a configurable read more link.                                                       |
| `content`        | Also replaces manually entered content within the `card-v2-content` block. The excerpt length is an available field within this core block.                                |
| `post-terms`     | Use within `card-v2` directly. Produces a list of card tags which are linked to the archive page for the term. Choose from categories, tags or any other related taxonomy. |

**UDS Hero Post Block**

ADD: A new block called the `acf/hero-post` block was created to allow users to create a standard page hero based on content from a selected post.

Options are available within the block to:

- Use the latest post by taxonomy term (category, tag or unfiltered).
- Offset the requested post by an arbitrary number.
- Select a specific post from a list.

**Additional Changes**

DEPRECATED: The older `acf/card` blocks are now officially deprecated and may become unsupported by a future release of the plugin.

- Within the block editor, older card blocks can be easily identified by an added pink overlay.
- Older versions of the card block will still display correctly, but they are not available for insertion via the block picker.

CHANGE: The following blocks within this plugin now support the HTML anchor attribute.

- `acf/alert`, `acf/background-section`, `acf/banner`, `acf/blockquote`, `acf/content-media-overlap`, `acf/grid-links`

## Version 2.0.2

- FIX: Addressed missing `acf/hero` and `acf/hero-video` inner block content.

The issue was caused by a conflict with Pitchfork Blocks and a duplication of the `acf/blocks/wrap_frontend_innerblocks` filter. When both plugins were active the filter can be called twice and possibly fail to remove the set of inner block wrapper divs. Solution is to add a CSS rule for the hero blocks to ignore the wrapper rather than surpress it.

## Version 2.0.1

- FIX: Add better support for a default layout choice for `acf/background-section` which only renders the background color of the block.

## Version 2.0

This release is being made with a concurrent release to the accompanying [Pitchfork theme](https://github.com/asuengineering/pitchfork). Please ensure that the 2.0 version of this plugin is being used with the 2.0 version of the theme.

**Bootstrap 5 and the data layer**

- FIX: All included blocks are now formatted to use Bootstrap 5 and the latest markup recommended by the ASU Unity project.
- ADD: The following elements within Pitchfork Blocks will automatically have their user interface interactions added to ASU's GA4 data layer object.

| Element             | Data tracked                                                      |
| ------------------- | ----------------------------------------------------------------- |
| `acf/alert`         | Tracks any close/dismissal event.                                 |
| `acf/banner`        | Tracks any close/dismissal event.                                 |
| `acf/card-foldable` | Within an accordion, tracks all individual open and close events. |
| `acf/sidebar`       | Tracks all open and close events for nested menu items.           |

**Background Section block `(acf/background-section)`**

- CHANGE: All block types are now supported as direct children of the `acf/background-section` block. By default, the block will now include a `core/group` block as the first inner block, but this block can be freely removed as needed.
- ADD: Add six new Unity patterns to the `acf/background-section` block.
- CHANGE: The `acf/background-section` block now allows for all ASU gray colors as preset solid color backgrounds. (Previous options were limited to ASU Gray 1, 2 and 7.) Background color options are now available via the native WordPress color controls in the block options panel.
- ADD: The block now allows for a background color option as an overlay for repeatable/tileable patterns. This makes it easier to use patterns from collections like [Subtle Patterns](https://www.toptal.com/designers/subtlepatterns/) and [Transparent Textures](https://www.transparenttextures.com/) without writing further CSS rules.

**Additional fixes**

- FIX: The `acf/card-foldable` block now allows for an end user to alter the unique ID associated with the card. Addresses a problem when duplicating an existing foldable card block to allow for more accordions in the set.
- CHANGE: Change the `acf/alert` and `acf/banner` blocks to use the same underlying JS mehanism for dismissing the messages. Both now use the appropriate Bootstrap 5 dismissal JS function.
- ADD: The `acf/grid-links` block now uses the ACF Font Awesome icon picker in the interface.
- ADD: The `acf/hero` and `acf/hero-video` blocks allow for a bottom margin to be set in the block styles editor. The default state of that margin is 4rem ($uds-size-8) for all new hero blocks.
- CHANGE: Blocks immediately following a hero block will no longer have a top margin. The [adjacent sibling](https://developer.mozilla.org/en-US/docs/Web/CSS/Adjacent_sibling_combinator) style rule that produced this effect has been removed.
- FIX: The supporting CSS classes for `acf/hero` and `acf/hero-video` which controlled the positioning of the button row and the content group are no longer required to be present in the advanced/additional CSS classes section of the block settings. Those classes are now added automatically anytime there is a `core/buttons` or `core/group` block within the `acf/hero` block.

**Additional technical release notes**

- CHANGE: Update references to ASU Unity Project to current packages located at [https://github.com/orgs/ASU/packages](https://github.com/orgs/ASU/packages).
- CHANGE: Adopt new build process for continued development of the plugin. See [Gulp WP](https://github.com/BlackbirdDigital/gulp-wp) for additional details. Build and compilation process still begins with `npm start`.
- FIX: Change method used to provide additional CSS rules within the block editor. Aligns with current best practice.
- ADD: Registered new ACF save point for any ACF-JSON settings applied by this plugin.

## Version 1.6

This release addresses a few issues with the `acf/hero` block due to a change in the required markup from the Unity Project.

Please also note that a concurrent update to the Pitchfork People plugin will also resolve a related but separate compatability issue also effecting the `acf/hero` block. See the [CHANGELOG for Pitchfork People](https://github.com/asuengineering/pitchfork-people/blob/main/CHANGELOG.md#version-11) for additional details.

- FIX: Layout issues with buttons and subtitles within the `acf/hero` block were fixed.
- REMOVED: The option to retain the content within the hero block as visible text on mobile has been removed from the component at the Unity level. The corresponding control within the block editor was also removed.

## Version 1.5 (Pitchfork People)

This minor release corresponds with the launch of [Pitchfork People](https://github.com/asuengineering/pitchfork-people) and represents the relocation of blocks and processes related to building directory pages within the Pitchfork system.

- REMOVED: The following blocks were moved to the Pitchfork People plugin.
  - `acf/profiles`
  - `acf/profile-manual`

Neither of the above blocks were changed other than the relocation to a different plugin. If you have page content that features these blocks, simply activate the Pitchfork People plugin in your environment to restore the page to its original form.

## Version 1.4.1 (Bug Fixes)

A regression of the ACF hero blocks prevented the image overlay from appearing within `acf/hero` or `acf/hero-video`. The cause was a downstream effect of the update to Pitchfork v1.9 which updated the Bootstrap 4 library from the Unity project.

- FIX: Add a missing div for hero blocks in `acf/hero` or `acf/hero-video`.

Single links within the sidebar element `(.sidebar>.nav-link-container)` contain no native background color which causes display issues when the background of the page was anything except white.

- FIX: Added temporary CSS rule to force sidebar single links to be `background-color: white;`

## Version 1.4

- ADD: Created two new blocks called `acf/profiles` and `acf/profile-manual` to aid with the creation of directory pages in Pitchfork.
- CHANGE: Recategorized all blocks in this plugin into their own category in the block inserter.
- FIX: Removed debugging code in several places. Applied code linting standards.

**Documentation:**

- ADD: https://wordpress.asu.edu/pitchfork/docs/profiles-block/
- ADD: https://wordpress.asu.edu/pitchfork/docs/profile-block-manual/
- ADD: https://wordpress.asu.edu/pitchfork/docs/block-patterns/

## Version 1.3

This release contains several bigger refactoring efforts for performance and best practices.

- CHANGE: Refactored all blocks to use `block.json`, which is now [the recommended method](https://www.advancedcustomfields.com/resources/acf-blocks-with-block-json/) for doing so as of ACF 6.0.
- ADD: Several blocks now also take advantage of a dedicated ACF field for picking an icon from the Font Awesome library. This field is provided by the [ACF Font Awesome Field plugin](https://wordpress.org/plugins/advanced-custom-fields-font-awesome/) which is now bundled with the theme as a recommended plugin for the system.
- FIX: Blocks now use WP styling engine to generate inline style declatations for margin/padding/colors.

Additional small adjustments to individual blocks include:

`acf/accordion`

- FIX: Address block crash related to FA icon insertion/removal from block.
- CHANGE: Implemented Font Awesome icon field for a better UX.
- ADD: Unique block ID generated by dedicated field for the purpose. Removes dependency on block id generated by ACF.

`acf/alert`

- FIX: Removal of icon caused block rendering error in block editor. The icon is now not optional for this block. Consistent with Unity design component.

`acf/banner`

- ADD: Added option for user to select an optional icon for the banner.

`acf/content-media-overlap`

- CHANGE: Non-functional control for media size/zoom was removed. No matching option in Unity.

`acf/uds-sidebar`

- FIX: Nav walker class for items in a sub-menu produced an incorrect wrapper `<ul>` element. Removed unneeded wrapper.
- CHANGE: Relocated nav walker class to main plugin file.

`acf/subtitle block`

- FIX: No longer produces markup of any kind if the block is unused.

## Version 1.2

- NEW: Initial deployment of the `acf/hero-video` block.
- IMPROVE: Options within the `acf/accordion` block failed when the block was nested within other blocks. Fixed so that the block can exist anyplace on the page.
- FIX: Adjusted SASS for `acf/background-section` to add padding/margin on a mobile device. Content no longer stretches from edge to edge.
- FIX: `.gitignore` excluded a required file fror the acf/breadcrumb block without a prior `composer install`. The plugin will now safely work "out of the box" again without further install steps.

## Version 1.1

- Added `content-media-overlap` block to the party.
- Added additional contributors to this README from ASU Knowledge Enterprise.

## Version 1.0

- Initial deployment of the plugin. v1.0.
- Includes working versions of the following blocks:
  - `accordion` / `card-foldable`
  - `alert` and `banner` for eassy inclusion on a page. Works as repeatable blocks within the block editor.
  - `background-section` for easy inclusion of the background patterns from the unity design kit.
  - `blockquote` which also includes vertical styles corresponding to the "testimonial" element from the design kit.
  - `breadcrumb` via Hybrid Brreadcrumbs
  - `card` which can produce UDS cards of arbitrary content in any of the approved formats.
  - `grid-links`
  - `hero` version 2.0 from the design kit.
  - `sidebar`
  - `subtitle` for use within the hero.
