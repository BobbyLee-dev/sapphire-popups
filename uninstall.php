<?php



/**
 * Exit if uninstall constant is not defined.
 * 
 * @since 1.0.0
 */
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	
	exit;
	
}



/**
 * Remove plugin options from database when plugin in uninstalled via the Plugins screen.
 * 
 * @since 1.0.0
 */
delete_option( 'sapphire_popups_options' );
