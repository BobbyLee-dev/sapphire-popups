<?php



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
 * Add menu pages for Sapphire Popups.
 * 
 * Adds top level and sub menu pages.
 *
 * @since 1.0.0
 */
function sapphire_popups_add_menu() {
	
	// Top level menu page.
	add_menu_page(
		esc_html__('Sapphire Popups Dashboard', 'sapphire-popups'),
		esc_html__('Sapphire Popups', 'sapphire-popups'),
		'manage_options',
		'sapphire_popups_settings',
		'sapphire_popups_display_settings_page',
		'dashicons-thumbs-up',
		null
	);
	
  // Submenu page
	add_submenu_page(
		'sapphire_popups_settings',
		esc_html__('Sapphire Popups And Flyouts', 'sapphire-popups'),
		esc_html__('Settings', 'sapphire-popups'),
		'manage_options',
		'sapphire_popups_settings',
		'sapphire_popups_display_settings_page',
		0
	);

}
add_action( 'admin_menu', 'sapphire_popups_add_menu' );



/**
 * Display the plugin settings page.
 *
 * @since 1.0.0
 */
function sapphire_popups_display_settings_page() {
	
	// Check if user is allowed access.
	if ( ! current_user_can( 'manage_options' ) ) return;
	
	?>
	
	<div class="wrap">
		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
		<form action="options.php" method="post">
			
			<?php
			
			// output security fields
			settings_fields( 'sapphire_popups_options' );
			
			// Display all settings sections added to this page.
			do_settings_sections( 'sapphire_popups_settings' );
			
			// submit button
			submit_button();
			
			?>
			
		</form>
	</div>
	
	<?php
	
}