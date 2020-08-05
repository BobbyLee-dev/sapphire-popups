<?php
/*
Plugin Name: Sapphire Popups
Description: A light weight yet powerful solution for popups and flyouts.
Plugin URI:  https://github.com/runningCoder81/sapphire-popups
Author:      Bobby Lee
Author URI:  https://therunningcoder.com/
Version:     1.0.0
Text Domain: sapphire-popups
Domain Path: /languages
License:     GPL v2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.txt

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version
2 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
with this program. If not, visit: https://www.gnu.org/licenses/
*/



/**
 * Disable direct file access.
 *
 * Exit if file is called directly
 *
 * @since 1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {

	exit;

}



/**
 * Load text domain for languages translation.
 *
 * @since 1.0.0
 */
function sapphire_popups_load_textdomain() {

	load_plugin_textdomain( 'sapphire-popups', false, plugin_dir_path( __FILE__ ) . 'languages/' );

}
add_action( 'plugins_loaded', 'sapphire_popups_load_textdomain' );



/**
 * Include admin dependencies.
 *
 * @since 1.0.0
 */
if ( is_admin() ) {


	require_once plugin_dir_path( __FILE__ ) . 'admin/admin-page.php';
	require_once plugin_dir_path( __FILE__ ) . 'admin/settings-register.php';
	require_once plugin_dir_path( __FILE__ ) . 'admin/settings-callbacks.php';

}




/**
 * Include admin and public dependencies.
 *
 * @since 1.0.0
 */
require_once plugin_dir_path( __FILE__ ) . 'includes/core-functions.php';
// Make sure this is outside of is_admin - will not allow posts to be saved!!
require_once plugin_dir_path( __FILE__ ) . 'admin/post-types/register-custom-post-types.php';



/**
 * Add a link to the settings page from the plugins page.
 *
 * Will be displayed after plugin in activated in the plugins page.
 *
 * @param array $links
 * @return array
 * @since 1.0.0
 */
function sapphire_popups_add_settings_link( $links ) {
		$settings_link = '<a href="admin.php?page=sapphire_popups_settings">' . esc_html__( 'Settings', 'sapphire_popups' ) . '</a>';
		array_push( $links, $settings_link );
		return $links;
}

$filter_name = "plugin_action_links_" . plugin_basename( __FILE__ );
add_filter( $filter_name, 'sapphire_popups_add_settings_link' );