<?php

/**
 * Create admin page for Sapphire Popups
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @since      1.0.0
 *
 */

// Check if user is allowed access.
	if ( ! current_user_can( 'manage_options' ) ) return;
	
	?>
	
	<div class="wrap">
		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
		<form action="options.php" method="post">
			
			<?php
			
			// output security fields
			settings_fields( 'sapphire-popups-options' );
			
			// Display all settings sections added to this page.
			do_settings_sections( 'sapphire-popups-settings' );
			
			// submit button
			submit_button();
			
			?>
			
		</form>
	</div>

<?php 