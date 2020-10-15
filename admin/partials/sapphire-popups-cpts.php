<?php 

$popupLabels = array( 
		'name'          		 => esc_html__( 'Popups', 'sapphire_popups' ),
		'singular_name' 		 => esc_html__( 'Popup', 'sapphire_popups' ),
		'archives'      		 => esc_html__( 'Popups', 'sapphire_popups' ),
		'add_new'       		 => esc_html__( 'Add Popup', 'sapphire_popups' ),
		'add_new_item'  		 => esc_html__( 'Add Popup', 'sapphire_popups' ),
		'edit_item'   			 => esc_html__( 'Edit Popup', 'sapphire_popups' ),
		'new_item' 					 => esc_html__( 'New Popup', 'sapphire_popups' ),
		'view_item' 				 => esc_html__( 'View Popup', 'sapphire_popups' ),
		'search_items' 			 => esc_html__( 'Search Popups', 'sapphire_popups' ),
		'not_found' 				 => esc_html__( 'No Popups found', 'sapphire_popups' ),
		'not_found_in_trash' => esc_html__( 'No Popups found in Trash', 'sapphire_popups' )
	);

	$popupArgs = array(
		'labels'              => $popupLabels,
		'description'		      => esc_html__( 'Sapphire Popups - popups', 'sapphire_popups' ),
		'public'              => true,
		'exclude_from_search' => true,
		'publicly_queryable'  => false,
		'show_in_menu'        => 'sapphire-popups-settings',
		'show_in_nav_menus'	  => false,
		'supports'            => array( 'title', 'editor', 'thumbnail' => false ),
		'show_in_rest'        => true,
		'pages' 					    => false,
		'has_archive'			    => false
	);

  register_post_type( 'sapphire_popups', $popupArgs );
  
  ?>