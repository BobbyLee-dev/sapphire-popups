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
 * Print/echo the dashboard about message.
 * 
 * @since 1.0.0
 */
function sapphire_popups_callback_section_dashboard_about() {
	
	echo '<p>' . esc_html__( 'All about this plugin maybe some meta data...', 'sapphire-popups' ) . '</p>';

}



/**
 * Print/echo the Popup section message.
 *
 * @return void
 * @since 1.0.0
 */
function sapphire_popups_callback_section_popups() {
	
	echo '<p>' . esc_html__( 'These settings enable you to select a popup and customize it\'s behavior.', 'sapphire-popups' ) .'</p>';

}



/**
 * Select field options.
 * 
 * @param string $id ID of the field that options will be added.
 * @return array
 * @since 1.0.0
 */
function sapphire_popups_options_select($id) {

	
	if(isset($id)) {
		
		// WP_Query arguments
		$args = array (
			'post_type'           => array( 'sapphire_popups' ),
			'post_status'         => array( 'publish' ),
			'order'           	  => 'ASC',
			'orderby'             => 'menu_order',
			
		);

		// The Query
		$popupsQuery = new WP_Query( $args );
		$popupsNamesAndValues = array('none_selected' => esc_html__( 'None Selected', 'sapphire-popups' ) );

		while ( $popupsQuery->have_posts() ) : $popupsQuery->the_post(); 
			$popupsNamesAndValues[ strtolower( esc_html__(get_the_title() ) ) ] = esc_html__( get_the_title(), 'sapphire-popups' );
		endwhile;

		return $popupsNamesAndValues;

		wp_reset_postdata(); 
	}
	
}



/**
 * Select field.
 *
 * @param array $args
 * @return string
 * @since 1.0.0
 */
function sapphire_popups_callback_field_select( $args ) {

	$dbOptions = get_option( 'sapphire_popups_options', [ $args['id'] => $args['default'] ] );
	
	$id      = isset( $args['id'] )    	 ? $args['id']      : '';
	$isCpt   = isset( $args['cpt'] )     ? $args['cpt']     : '';

	// Options from register setting
	$options = isset( $args['options'] ) ? $args['options'] : false;
	$label   = isset( $args['label'] )   ? $args['label'] 	: '';
	
	$selected_option = isset( $dbOptions[$id] ) ? sanitize_text_field( $dbOptions[$id] ) : '';
	
	if( true === $isCpt ) {
		$select_options = sapphire_popups_options_select($id);
	} elseif( false != $options ) {
		$select_options = $options;
	} else {
		$select_options = array('no_options' => 'No Options');
	}
	
	
	echo '<select id="sapphire_popups_options_'. $id .'" name="sapphire_popups_options['. $id .']">';
	
	foreach ( $select_options as $value => $option ) {
		
		$selected = selected( $selected_option === $value, true, false );
		
		echo '<option value="'. $value .'"'. $selected .'>'. esc_html__( $option, 'sapphire-popups' ) .'</option>';
		
	}
	
	echo '</select> <label for="sapphire_popups_options_'. $id .'">'. wp_kses_post( __( $label, 'sapphire-popups' ) ) .'</label>';
	
}



/**
 * Checbox field.
 * 
 * Echos checkbox field to settings page.
 *
 * @param array $args
 * @since 1.0.0
 */
function sapphire_popups_field_checkbox( $args ) {
	
	$options = get_option( 'sapphire_popups_options', [$args['id'] => $args['default']] );
	
	$id    = isset( $args['id'] )    ? $args['id']    : '';
	$label = isset( $args['label'] ) ? $args['label'] : '';
	
	$checked = isset( $options[$id] ) ? checked( $options[$id], 1, false ) : '';
	
	echo '<input id="sapphire_popups_options_'. $id .'" name="sapphire_popups_options['. $id .']" type="checkbox" value="1"'. $checked .'> ';
	echo '<label for="sapphire_popups_options_'. $id .'">'. $label .'</label>';
	
}