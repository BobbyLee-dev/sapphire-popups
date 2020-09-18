<?php // sapphire_popups - Core Functionality



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



// Add popup script
/**
 * Enqueue css and js if a popup has been selected.
 *
 * @return void
 * @since 1.0.0
 */
function sapphire_popups_add_popup_script() {

	// Get the plugin options from the DB.
	$options = get_option( 'sapphire_popups_options', '' );

	// If a popup is selected and not set to default.
	if ( isset( $options['select_popup'] ) && ! empty( $options['select_popup'] ) && 'none_selected' != $options['select_popup'] ) {
		
		// Get the popup from the custom post type - popups.
		$popup = get_page_by_title( $options['select_popup'], OBJECT, 'sapphire_popups' );
		$popupContent = __( apply_filters( 'the_content',  $popup->post_content ), 'sapphire-popups' );

		// Get the popup behavior from the DB.
		$popupBehavior = isset( $options['select_popup_behavior'] ) ? esc_html__( wp_kses_post($options['select_popup_behavior']), 'sapphire-popups' ) : '';

		// See if the title will be excluded or included - default is included.
		$popupTitle = isset( $options['exclude_popup_title'] ) ? '' : '<h2 class="popup-title">' . get_the_title( $popup->ID ) . '</h2>';
		// $popupID = title no spaces lowercase will use for cookie


    // data-sapphirePopupID... must remain one space away from the opening div - being taken out with js via this postion.
		$popupMarkup = '<div data-sapphirePopupID="sapphirePopup-' . $popup->ID . '" data-sapphirePopupBehavior="' . $popupBehavior . '" class="sapphire-popup-content">' . $popupTitle . $popupContent . '<button class="close-sapphire-popup" aria-label="Close Button"></button></div>';

		echo '<script>const sapphirePopupContent = ' . json_encode($popupMarkup) . '</script>';
	
		wp_enqueue_style( 'sapphire_popups', plugin_dir_url( dirname( __FILE__ ) ) . 'public/css/sapphire-popup.css', array(), null, 'screen' );
		wp_enqueue_script( 'sapphire_popups', plugin_dir_url( dirname( __FILE__ ) ) . 'public/js/sapphire-popup.js', array(), null, true );


	}
	
}
add_action( 'wp_enqueue_scripts', 'sapphire_popups_add_popup_script' );
// add_action( 'the_content', 'sapphire_popups_add_popup_script' );