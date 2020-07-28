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



// disable direct file access
if ( ! defined( 'ABSPATH' ) ) {

	exit;

}



// load text domain
function sapphire_popups_load_textdomain() {
	
	load_plugin_textdomain( 'sapphire-popups', false, plugin_dir_path( __FILE__ ) . 'languages/' );
	
}
add_action( 'plugins_loaded', 'sapphire_popups_load_textdomain' );



// include plugin dependencies: admin only
if ( is_admin() ) {

	require_once plugin_dir_path( __FILE__ ) . 'admin/admin-page.php';
	require_once plugin_dir_path( __FILE__ ) . 'admin/settings-register.php';
	require_once plugin_dir_path( __FILE__ ) . 'admin/settings-callbacks.php';
	
}

	require_once plugin_dir_path( __FILE__ ) . 'admin/post-types/register-custom-post-types.php';


// include plugin dependencies: admin and public
require_once plugin_dir_path( __FILE__ ) . 'includes/core-functions.php';



// default plugin options
// function sapphire_popups_options_default() {

// 	return array(
// 		'custom_url'     => 'https://wordpress.org/.',
// 		// 'custom_title'   => 'Powered by WordPress.',
// 		'custom_style'   => 'disable',
// 		'custom_message' => '<p class="custom-message">My. custom message</p>',
// 		// 'custom_footer'  => 'Special message for users.',
// 		'custom_toolbar' => false,
// 		'custom_scheme'  => 'default',
// 	);

// }


// remove options on uninstall
function myplugin_on_uninstall() {

	if ( ! current_user_can( 'activate_plugins' ) ) return;

	delete_option( 'sapphire_popups' );

}
register_uninstall_hook( __FILE__, 'myplugin_on_uninstall' );