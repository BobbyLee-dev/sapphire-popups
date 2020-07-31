<?php


/**
 * Register custom post types for Popups and Flyouts.
 * 
 * Does not create front end pages.
 *
 * @since 1.0.0
 */
function sapphire_popups_register_popups() {

	$popupLabels = array( 
		'name'          => esc_html__( 'Popups', 'sapphire_popups' ),
		'singular_name' => esc_html__( 'Popup', 'sapphire_popups' ),
		'archives'      => esc_html__( 'Popups', 'sapphire_popups' ),
		'add_new'       => esc_html__( 'Add Popup', 'sapphire_popups' ),
		'add_new_item'  => esc_html__( 'Add Popup', 'sapphire_popups' ),
	);

	$popupArgs = array(
		'labels'              => $popupLabels,
		'public'              => true,
		'show_in_menu'        => 'sapphire_popups_settings',
		'supports'            => array( 'title', 'editor' ),
		'show_in_rest'        => true,
		'pages' 					    => false,
		'has_archive'			    => false,
		'show_in_nav_menus'	  => false,
		'exclude_from_search' => true,
		'publicly_queryable'  => false
	);


	$flyoutLabels = array( 
		'name'          => esc_html__( 'Flyouts', 'sapphire_popups' ),
		'singular_name' => esc_html__( 'Flyout', 'sapphire_popups' ),
		'archives'      => esc_html__( 'Flyouts', 'sapphire_popups' ),
		'add_new'       => esc_html__( 'Add Flyout', 'sapphire_popups' ),
		'add_new_item'  => esc_html__( 'Add Flyout', 'sapphire_popups' ),
	);

	$flyoutArgs = array(
		'labels'              => $flyoutLabels,
		'description'		      => 'Sapphire Popups - popups',
		'public'              => true,
		'show_in_menu'        => 'sapphire_popups_settings',
		'supports'            => array( 'title', 'editor' ),
		'show_in_rest'        => true,
		'pages' 					    => false,
		'has_archive'			    => false,
		'show_in_nav_menus'	  => false,
		'exclude_from_search' => true,
		'publicly_queryable'  => false
	);


	register_post_type( 'sapphire_popups', $popupArgs );
	register_post_type( 'sapphire_flyouts', $flyoutArgs );

}

add_action( 'init', 'sapphire_popups_register_popups' );