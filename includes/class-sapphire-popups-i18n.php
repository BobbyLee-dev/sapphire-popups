<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://therunningcoder.com/
 * since      1.2.0
 * 
 * @package    Sapphire_Popups
 * @subpackage Sapphire_Popups/includes
 */

 
/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * since      1.2.0
 * @package    Sapphire_Popups
 * @subpackage Sapphire_Popups/includes
 * @author     Bobby Lee <rdlee8181@gmail.com>
 */
class Sapphire_Popups_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * since    1.2.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'sapphire-popups',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}

}
