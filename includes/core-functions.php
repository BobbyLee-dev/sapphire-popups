<?php // sapphire_popups - Core Functionality



// disable direct file access
if ( ! defined( 'ABSPATH' ) ) {
	
	exit;
	
}


// Add popup script
function sapphire_popups_add_popup_script() {
	
	$options = get_option( 'sapphire_popups_options', ['select_popup' => 'Default'] );

	
	if ( isset( $options['select_popup'] ) && ! empty( $options['select_popup'] ) && 'none_selected' != $options['select_popup'] ) {
		
		$popup = get_page_by_title( $options['select_popup'], OBJECT, 'sapphire_popups' );
		$popupContent = __(wp_kses_post( $popup->post_content ), 'sapphire-popups');

		// Add to page for seo, but hide by default.
		echo '<div class="sapphire-popup" style="display: none;">' . $popupContent . '</div>';
		
		wp_enqueue_style( 'sapphire_popups', plugin_dir_url( dirname( __FILE__ ) ) . 'public/css/sapphire-popup.css', array(), null, 'screen' );
		wp_enqueue_script( 'sapphire_popups', plugin_dir_url( dirname( __FILE__ ) ) . 'public/js/sapphire-popup.js', array(), null, true );


	}
	
}
// add_action( 'wp_enqueue_scripts', 'sapphire_popups_add_popup_script' );
add_action( 'the_content', 'sapphire_popups_add_popup_script' );