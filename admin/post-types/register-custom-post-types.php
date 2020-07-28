<?php

function sapphire_popups_register_popups() {

  $labels = array( 
    'name' => esc_html__( 'Popups', 'sapphire_popups' ),
    'singular_name' => esc_html__( 'Popup', 'sapphire_popups' ),
    'archives' => esc_html__( 'Popups', 'sapphire_popups' ),
    'add_new' => esc_html__( 'Add Popup', 'sapphire_popups' ),
    'add_new_item' => esc_html__( 'Add Popup', 'sapphire_popups' ),
  );

  $args = array(
    'labels' => $labels,
    'public' => true,
    'show_in_menu' => 'sapphire_popups_settings',
    // 'rewrite' => array( 'has_front' => false ),
    // 'menu_icon' => 'dashicons-building',
    'supports' => array( 'title', 'editor' ),
    'show_in_rest' => true,
    'has_archive'         => false,
		'exclude_from_search' => true,
		'publicly_queryable'  => false
    // 'rest_base' => plugin_dir_path( __FILE__ ),
  );


  register_post_type( 'sapphire_popups', $args );

}

add_action( 'init', 'sapphire_popups_register_popups' );