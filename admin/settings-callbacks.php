<?php // sapphire_popups - Settings Callbacks



// disable direct file access
if ( ! defined( 'ABSPATH' ) ) {
	
	exit;
	
}



// callback: dashboard about
function sapphire_popups_callback_section_dashbaord_about() {
	
	echo '<p>' . esc_html__('All about this plugin maybe some meta data...', 'sapphire_popus') . '</p>';

}





// callback: login section
function sapphire_popups_callback_section_popups() {
	
	echo '<p>' . esc_html__('These settings enable you to select a popup and customize it\'s behavior.', 'sapphire_popus') .'</p>';

}




// select field options
function sapphire_popups_options_select($id) {

	// echo $id;
	if(isset($id)) {
			// WP_Query arguments
		$args = array (
			'post_type'           => array( 'sapphire_popups' ),
			'post_status'         => array( 'publish' ),
			// 'nopaging'         => true,
			'order'           	  => 'ASC',
			'orderby'             => 'menu_order',
			
		);

		// The Query
		$popupsQuery = new WP_Query( $args );
		$popupsNamesAndValues = array('none_selected' => esc_html__('None Selected', 'sapphire-popups'));

		while ( $popupsQuery->have_posts() ) : $popupsQuery->the_post(); 
			// echo '<div>'. the_title() .'<a href='. get_edit_post_link() .'>Link</a></div>';
		$popupsNamesAndValues[strtolower(get_the_title())] = esc_html__(get_the_title(), 'sapphire-popus');
		endwhile;

		return $popupsNamesAndValues;

		wp_reset_postdata(); 
	}
	
}


// callback: select field
function sapphire_popups_callback_field_select( $args ) {
	
	$options = get_option( 'sapphire_popups_options', [$args['id'] => $args['default']] );
	
	$id    = isset( $args['id'] )    ? $args['id']    : '';
	$label = isset( $args['label'] ) ? $args['label'] : '';
	
	$selected_option = isset( $options[$id] ) ? sanitize_text_field( $options[$id] ) : '';
	
	$select_options = sapphire_popups_options_select($id);
	
	echo '<select id="sapphire_popups_options_'. $id .'" name="sapphire_popups_options['. $id .']">';
	
	foreach ( $select_options as $value => $option ) {
		
		$selected = selected( $selected_option === $value, true, false );
		
		echo '<option value="'. $value .'"'. $selected .'>'. $option .'</option>';
		
	}
	
	echo '</select> <label for="sapphire_popups_options_'. $id .'">'. $label .'</label>';
	
}



// // callback: admin section
// function sapphire_popups_callback_section_admin() {
	
// 	echo '<p>These settings enable you to customize the WP Admin Area.</p>';
	
// }



// // callback: text field
// function sapphire_popups_callback_field_text( $args ) {

// 	$options = get_option( 'sapphire_popups_options', [$args['id'] => $args['default']] );
	
// 	$id    = isset( $args['id'] )    ? $args['id']    : '';
// 	$label = isset( $args['label'] ) ? $args['label'] : '';
	
// 	$value = isset( $options[$id] ) ? sanitize_text_field( $options[$id] ) : 'ha';
	
// 	echo '<input id="sapphire_popups_options_'. $id .'" name="sapphire_popups_options['. $id .']" type="text" size="40" value="'. $value .'"><br />';
// 	echo '<label for="sapphire_popups_options_'. $id .'">'. $label .'</label>';
	
// }



// // radio field options
// function sapphire_popups_options_radio() {
	
// 	return array(
		
// 		'enable'  => 'Enable custom styles',
// 		'disable' => 'Disable custom styles'
		
// 	);
	
// }



// // callback: radio field
// function sapphire_popups_callback_field_radio( $args ) {
	
// 	$options = get_option( 'sapphire_popups_options', sapphire_popups_options_default() );
	
// 	$id    = isset( $args['id'] )    ? $args['id']    : '';
// 	$label = isset( $args['label'] ) ? $args['label'] : '';
	
// 	$selected_option = isset( $options[$id] ) ? sanitize_text_field( $options[$id] ) : '';
	
// 	$radio_options = sapphire_popups_options_radio();
	
// 	foreach ( $radio_options as $value => $label ) {
		
// 		$checked = checked( $selected_option === $value, true, false );
		
// 		echo '<label><input name="sapphire_popups_options['. $id .']" type="radio" value="'. $value .'"'. $checked .'> ';
// 		echo '<span>'. $label .'</span></label><br />';
		
// 	}
	
// }



// // callback: textarea field
// function sapphire_popups_callback_field_textarea( $args ) {
	
// 	$options = get_option( 'sapphire_popups_options', sapphire_popups_options_default() );
	
// 	$id    = isset( $args['id'] )    ? $args['id']    : '';
// 	$label = isset( $args['label'] ) ? $args['label'] : '';
	
// 	$allowed_tags = wp_kses_allowed_html( 'post' );
	
// 	$value = isset( $options[$id] ) ? wp_kses( stripslashes_deep( $options[$id] ), $allowed_tags ) : '';
	
// 	echo '<textarea id="sapphire_popups_options_'. $id .'" name="sapphire_popups_options['. $id .']" rows="5" cols="50">'. $value .'</textarea><br />';
// 	echo '<label for="sapphire_popups_options_'. $id .'">'. $label .'</label>';
	
// }



// // callback: checkbox field
// function sapphire_popups_callback_field_checkbox( $args ) {
	
// 	$options = get_option( 'sapphire_popups_options', sapphire_popups_options_default() );
	
// 	$id    = isset( $args['id'] )    ? $args['id']    : '';
// 	$label = isset( $args['label'] ) ? $args['label'] : '';
	
// 	$checked = isset( $options[$id] ) ? checked( $options[$id], 1, false ) : '';
	
// 	echo '<input id="sapphire_popups_options_'. $id .'" name="sapphire_popups_options['. $id .']" type="checkbox" value="1"'. $checked .'> ';
// 	echo '<label for="sapphire_popups_options_'. $id .'">'. $label .'</label>';
	
// }






