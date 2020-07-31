<?php // sapphire_popups - Register Settings



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
 * Register Sapphire Popup settings.
 *
 * @since 1.0.0
 */
function sapphire_popups_register_settings() {


	register_setting(
		'sapphire_popups_options',
		'sapphire_popups_options'
	);

	
	// Dashboard section
	// add_settings_section(
	// 	'sapphire_popups_dashboard_section_about',
	// 	'About',
	// 	'sapphire_popups_callback_section_dashbaord_about',
	// 	'sapphire_popups_dashboard'
	// );


  // Popups section.
	add_settings_section(
		'sapphire_popups_section_popups',
		esc_html__('Popup Settings', 'sapphire-popups'),
		'sapphire_popups_callback_section_popups',
		'sapphire_popups_settings'
	);



  // Select popup field.
	add_settings_field(
		'select_popup',
		esc_html__('Select Popup', 'sapphire-popups'),
		'sapphire_popups_callback_field_select',
		'sapphire_popups_settings',
		'sapphire_popups_section_popups',
		[ 'id' => 'select_popup', 'label' => esc_html__('Popup to be used.', 'sapphire-popus'), 'default' => esc_html__('Select Popup', 'sapphire-popups') ]
	);

	

}
add_action( 'admin_init', 'sapphire_popups_register_settings' );


