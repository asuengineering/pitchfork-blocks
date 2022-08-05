# Pitchfork Blocks

A plugin for use with the [Pitchfork theme](https://github.com/asuengineering/pitchfork) for WordPress. 

This plugin adds blocks and block patterns for the block editor consistent with the ASU Unity Design system for web standards. 

Requires at least: WP 6.0  
Tested up to: 6.0  
Requires PHP: 7.3  
Stable tag: 1.0  
License: GPLv2 or later  
License URI: https://www.gnu.org/licenses/gpl-2.0.html  

**Contributors**

- Steve Ryan (ASU Engineering)
- Zainab Alsidiki, Justin Holloway, Walt McConnell, Nathan Rollins, Cindy Zisner (ASU Knowledge Enterprise)

## Usage Requirements

- Download the lastest release from Github.
- Install in the normal WP location for plugins which is typically `/wp-content/plugins`.

**Recommended / Required Additional Plugins**

This plugin contains blocks that are constructed with the use of Advanced Custom Fields Pro. 
- The ACF Pro plugin is also required by the Pitchfork theme.
- The theme contains a script which will prompt the user to install this plugin upon theme activation.
- ASU Engineering provides a licensed copy of this plugin within its standard distribution of WordPress on the Pantheon hosting platform.

Plugin updates can optionally be managed from the admin dashboard through the use of [Git Updater](https://git-updater.com/). 


## Includes

This plugin leverages the following libraries for functionality delivered within certain blocks.

- This plugin loads a copy of the SASS files from the [Bootstrap 4 library](https://github.com/ASU/asu-unity-stack/tree/dev/packages/bootstrap4-theme) within the ASU Unity design kit. It includes only the design tokens for easier SASS references and expects that the theme will load the remainder of the required BS4 files.  

- The breadcrumb block is an ACF wrapper for the [Hybrid Breadcrumbs](https://github.com/themehybrid/hybrid-breadcrumbs) composer-based assset for including breadcrumbs.

- The sidebar block makes use of a custom ACF field group for menu selection which can be found within the [ASU Engineering's GitHub organization](https://github.com/asuengineering/ACF-Menu-Select). 

## Development

- Run `npm install` and `composer install` prior to local development.
- SASS and JS compile & watch tasks are triggered via WP-Gulp and `npm start` from the project root.

<hr>

## Release Notes

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
