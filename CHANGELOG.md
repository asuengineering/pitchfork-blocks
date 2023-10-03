# Change Log

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/)
and this project adheres to [Semantic Versioning](http://semver.org/).

### Version 2.0

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

### Version 1.6

This release addresses a few issues with the `acf/hero` block due to a change in the required markup from the Unity Project.

Please also note that a concurrent update to the Pitchfork People plugin will also resolve a related but separate compatability issue also effecting the `acf/hero` block. See the [CHANGELOG for Pitchfork People](https://github.com/asuengineering/pitchfork-people/blob/main/CHANGELOG.md#version-11) for additional details.

- FIX: Layout issues with buttons and subtitles within the `acf/hero` block were fixed.
- REMOVED: The option to retain the content within the hero block as visible text on mobile has been removed from the component at the Unity level. The corresponding control within the block editor was also removed.

### Version 1.5 (Pitchfork People)

This minor release corresponds with the launch of [Pitchfork People](https://github.com/asuengineering/pitchfork-people) and represents the relocation of blocks and processes related to building directory pages within the Pitchfork system.

- REMOVED: The following blocks were moved to the Pitchfork People plugin.
  - `acf/profiles`
  - `acf/profile-manual`

Neither of the above blocks were changed other than the relocation to a different plugin. If you have page content that features these blocks, simply activate the Pitchfork People plugin in your environment to restore the page to its original form.

### Version 1.4.1 (Bug Fixes)

A regression of the ACF hero blocks prevented the image overlay from appearing within `acf/hero` or `acf/hero-video`. The cause was a downstream effect of the update to Pitchfork v1.9 which updated the Bootstrap 4 library from the Unity project.

- FIX: Add a missing div for hero blocks in `acf/hero` or `acf/hero-video`.

Single links within the sidebar element `(.sidebar>.nav-link-container)` contain no native background color which causes display issues when the background of the page was anything except white.

- FIX: Added temporary CSS rule to force sidebar single links to be `background-color: white;`

### Version 1.4

- ADD: Created two new blocks called `acf/profiles` and `acf/profile-manual` to aid with the creation of directory pages in Pitchfork.
- CHANGE: Recategorized all blocks in this plugin into their own category in the block inserter.
- FIX: Removed debugging code in several places. Applied code linting standards.

**Documentation:**

- ADD: https://wordpress.asu.edu/pitchfork/docs/profiles-block/
- ADD: https://wordpress.asu.edu/pitchfork/docs/profile-block-manual/
- ADD: https://wordpress.asu.edu/pitchfork/docs/block-patterns/

### Version 1.3

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

### Version 1.2

- NEW: Initial deployment of the `acf/hero-video` block.
- IMPROVE: Options within the `acf/accordion` block failed when the block was nested within other blocks. Fixed so that the block can exist anyplace on the page.
- FIX: Adjusted SASS for `acf/background-section` to add padding/margin on a mobile device. Content no longer stretches from edge to edge.
- FIX: `.gitignore` excluded a required file fror the acf/breadcrumb block without a prior `composer install`. The plugin will now safely work "out of the box" again without further install steps.

### Version 1.1

- Added `content-media-overlap` block to the party.
- Added additional contributors to this README from ASU Knowledge Enterprise.

### Version 1.0

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
