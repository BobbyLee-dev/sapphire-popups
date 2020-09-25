<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://therunningcoder.com/
 * @since      1.2.0
 *
 * @package    Sapphire_Popups
 * @subpackage Sapphire_Popups/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Sapphire_Popups
 * @subpackage Sapphire_Popups/public
 * @author     Bobby Lee <rdlee8181@gmail.com>
 */
class Sapphire_Popups_Public {


	/**
	 * The ID of this plugin.
	 *
	 * @since    1.2.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;



	/**
	 * The version of this plugin.
	 *
	 * @since    1.2.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;



	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.2.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}




	/**
	 * Enqueue css and js if a popup has been selected.
	 *
	 * @since    1.2.0
	 */
	public function create_frontend_popup() {

		// Get the plugin options from the DB.
		$options = get_option( 'sapphire-popups-options', '' );

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

			echo '<script>const sapphirePopupContent = ' . json_encode( $popupMarkup ) . '</script>';
		
			wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/sapphire-popup.css', array(), null, 'screen' );
			wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/sapphire-popup.js', array(), null, true );

		}

		

	}

}
