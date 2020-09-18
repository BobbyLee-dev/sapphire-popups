<?php
/*
Plugin Name: Sapphire Popups
Description: A simple yet powerful solution for popups.
Plugin URI:  https://github.com/runningCoder81/sapphire-popups
Author:      Bobby Lee
Author URI:  https://therunningcoder.com/
Version:     1.0.1
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
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * @since      1.1.0
 */
final class SapphirePopup {



	/**
	 * Add core dependencies and hooks.
	 * 
	 * Load the dependencies, define the locale, and set the hooks for the admin area
	 * and the public-facing side.
	 * Create plugin page settings link.
	 *
	 * @since 1.1.0
	 */
	public function __construct() {

		if ( is_admin() ) {
			$this->load_admin_dependencies();
		}

		$this->load_dependencies();

	}



	/**
	 * Load text domain for languages translation.
	 * 
	 * Set as public because it's getting called from outside the class.
	 *
	 * @since 1.1.0
	 */
	public function set_locale() {

		load_plugin_textdomain( 'sapphire-popups', false, plugin_dir_path( __FILE__ ) . 'languages/' );

	}



	/**
	 * Include admin dependencies.
	 * 
	 * Called from $this->__construct inside is_admin().
	 *
	 * @since 1.1.0
	 */
	private function load_admin_dependencies() {

		require_once plugin_dir_path( __FILE__ ) . 'admin/admin-page.php';
		require_once plugin_dir_path( __FILE__ ) . 'admin/settings-register.php';
		require_once plugin_dir_path( __FILE__ ) . 'admin/settings-callbacks.php';

	}



	/**
	 * Include admin and public dependencies.
	 * 
	 * Called from $this->__construct.
	 *
	 * @since 1.1.0
	 */
	private function load_dependencies() {

		require_once plugin_dir_path( __FILE__ ) . 'includes/core-functions.php';
		// Make sure this is outside of is_admin - will not allow posts to be saved!!
		require_once plugin_dir_path( __FILE__ ) . 'admin/post-types/register-custom-post-types.php';

	}



	/**
	 * Add a link to the settings page from the plugins page.
	 *
	 * Will be displayed after plugin in activated in the plugins page.
	 * 
	 * Set as public because it's getting called from outside the class.
	 *
	 * @param array $links
	 * @return array
	 * @since 1.1.0
	 */
	public function add_settings_link( $links ) {

			$settings_link = '<a href="admin.php?page=sapphire_popups_settings">' . esc_html__( 'Settings', 'sapphire_popups' ) . '</a>';
			array_push( $links, $settings_link );
			return $links;

	}




} // End class SapphirePopup

$sapphirePopups = new SapphirePopup;
add_action( 'plugins_loaded', [ $sapphirePopups, 'set_locale' ] );
add_filter( "plugin_action_links_" . plugin_basename( __FILE__ ), [ $sapphirePopups, 'add_settings_link' ] );