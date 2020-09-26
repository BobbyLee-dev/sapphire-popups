<?php
/*
Plugin Name: Sapphire Popups
Description: A simple yet powerful solution for popups.
Plugin URI:  https://github.com/runningCoder81/sapphire-popups
Author:      Bobby Lee
Author URI:  https://therunningcoder.com/
Version:     1.3.0
Text Domain: sapphire-popups
Domain Path: /languages
License:     GPL v3
License URI: https://www.gnu.org/licenses/gpl-3.0.txt

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



// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version - https://semver.org
 */
define( 'SAPPHIRE_POPUPS_VERSION', '1.3.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-sapphire-popups-activator.php
 */
// function activate_sapphire_popups() {
// 	require_once plugin_dir_path( __FILE__ ) . 'includes/class-sapphire-popups-activator.php';
// 	Sapphire_Popups_Activator::activate();
// }

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-sapphire-popups-deactivator.php
 */
// function deactivate_sapphire_popups() {
// 	require_once plugin_dir_path( __FILE__ ) . 'includes/class-sapphire-popups-deactivator.php';
// 	Sapphire_Popups_Deactivator::deactivate();
// }

// register_activation_hook( __FILE__, 'activate_sapphire_popups' );
// register_deactivation_hook( __FILE__, 'deactivate_sapphire_popups' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-sapphire-popups.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.2.0
 */
function run_sapphire_popups() {

	$plugin = new Sapphire_Popups();
	$plugin->run();

}
run_sapphire_popups();