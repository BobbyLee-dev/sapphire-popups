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
		[ 
			'cpt' 		=> true, // custom post type.
			'id' 			=> 'select_popup', 
			'label' 	=> '<a href="edit.php?post_type=sapphire_popups">' . esc_html__('Manage Popups', 'sapphire-popus') . '</a>', 
			'default' => esc_html__('Select Popup', 'sapphire-popups') 
		]
	);



	// Select popup behavior field.
	add_settings_field(
		'select_popup_behavior',
		esc_html__('Select Behavior', 'sapphire-popups'),
		'sapphire_popups_callback_field_select',
		'sapphire_popups_settings',
		'sapphire_popups_section_popups',
		[ 
			'cpt' => false, // not custom post type.
			'id' => 'select_popup_behavior', 
			'label' => esc_html__('How often to show.', 
			'sapphire-popus'), 
			'options' => array(
				'default' => esc_html__('Default', 'sapphire-popups'),
				'show_daily' => esc_html__('Show Daily', 'sapphire-popups'),
				'show_once' => esc_html__('Show Once', 'sapphire-popups'),
			),
			'default' => esc_html__('Default', 'sapphire-popups'),
		]
	);



	// Exclude Title checkbox field.
	add_settings_field(
		'exclude_popup_title',
		esc_html__('Exclude Title', 'sapphire-popups'),
		'sapphire_popups_field_checkbox',
		'sapphire_popups_settings',
		'sapphire_popups_section_popups',
		[ 
			'id' => 'exclude_popup_title', 
			'label' => esc_html__('Exclude Popup Title from popup.', 'sapphire-popus'),
			'default' => false,
		]
	);

	

}
add_action( 'admin_init', 'sapphire_popups_register_settings' );


