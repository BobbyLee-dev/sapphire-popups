<?php // Sapphire Popups - Settings Page



// exit if file is called directly
if ( ! defined( 'ABSPATH' ) ) {

	exit;

}



// Add top-level administrative menu
function sapphire_popups_add_menu() {
	
	add_menu_page(
		esc_html__('Sapphire Popups Dashboard', 'sapphire-popups'),
		esc_html__('Sapphire Popups', 'sapphire-popups'),
		'manage_options',
		'sapphire_popups_settings',
		'sapphire_popups_display_settings_page',
		'dashicons-thumbs-up',
		null
	);
	

	add_submenu_page(
		'sapphire_popups_settings',
		esc_html__('Sapphire Popups And Flyouts', 'sapphire-popups'),
		esc_html__('Settings', 'sapphire-popups'),
		'manage_options',
		'sapphire_popups_settings',
		'sapphire_popups_display_settings_page',
		null
	);

}
add_action( 'admin_menu', 'sapphire_popups_add_menu' );


// Display the plugin dashboard
function sapphire_popups_display_dashboard() {
	
	// check if user is allowed access
	if ( ! current_user_can( 'manage_options' ) ) return;
	
	?>
	
	<div class="wrap">
		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
		<form action="options.php" method="post">
			
			<?php
			
			// output security fields
			settings_fields( 'sapphire_popups_dashboard' );
			
			// output setting sections
			do_settings_sections( 'sapphire_popups_dashboard' );
			
			// submit button
			// submit_button();
			
			?>
			
		</form>
	</div>
	
	<?php
	
}

// Display the plugin settings page
function sapphire_popups_display_settings_page() {
	
	// check if user is allowed access
	if ( ! current_user_can( 'manage_options' ) ) return;
	
	?>
	
	<div class="wrap">
		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
		<form action="options.php" method="post">
			
			<?php
			
			// output security fields
			settings_fields( 'sapphire_popups_options' );
			
			// output setting sections
			do_settings_sections( 'sapphire_popups_settings' );
			
			// submit button
			submit_button();
			
			?>
			
		</form>
	</div>
	
	<?php
	
}


