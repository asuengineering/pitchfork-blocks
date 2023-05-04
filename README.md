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

- Several blocks now also take advantage of a dedicated ACF field for picking an icon from the Font Awesome library. This field is provided by the [ACF Font Awesome Field plugin](https://wordpress.org/plugins/advanced-custom-fields-font-awesome/) which is now a recommended plugin for the Pitchfork theme.

## Development

- Run `npm install` and `composer install` prior to local development.
- SASS and JS compile & watch tasks are triggered via WP-Gulp and `npm start` from the project root.

## Release Notes

See [CHANGELOG.md](CHANGELOG.md) for the a list of all improvements made to the theme.

We also keep similar notes in the [releases section](https://github.com/asuengineering/pitchfork-blocks/releases) of our project for an overview of what changed with each release.
