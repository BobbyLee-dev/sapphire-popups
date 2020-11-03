<?php



/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Sapphire_Popups
 * @subpackage Sapphire_Popups/admin
 * @author     Bobby Lee
 * since      1.2.0
 */
class Sapphire_Popups_Admin {



	/**
	 * The ID of this plugin.
	 *
	 * since  1.2.0
	 * @access private
	 * @var    string
	 */
	private $plugin_name;



	/**
	 * The version of this plugin.
	 *
	 * since  1.2.0
	 * @access private
	 * @var    string
	 */
	private $version;



	/**
	 * Initialize the class and set its properties.
	 *
	 * since 1.2.0
	 * @param string $plugin_name  The name of this plugin.
	 * @param string $version      The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	} // __construct()



	/**
	 * Adds a settings page.
	 *
	 * @link 	 https://codex.wordpress.org/Administration_Menus
	 * since  1.0.0
	 * @return void
	 */
	public function add_menu() {

		// Top-level page
		// add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );

		add_menu_page(
			esc_html__('Sapphire Popups Dashboard', 'sapphire-popups'),
			esc_html__('Sapphire Popups', 'sapphire-popups'),
			'manage_options',
			$this->plugin_name . '-settings',
			array( $this, 'page_options' ),
			'dashicons-thumbs-up',
			null
		);

		// Submenu Page
		// add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function)

		add_submenu_page(
			$this->plugin_name . '-settings',
			esc_html__('Sapphire Popups', 'sapphire-popups'),
			esc_html__('Settings', 'sapphire-popups'),
			'manage_options',
			$this->plugin_name . '-settings',
			array( $this, 'page_options' ),
			0
		);


	} // add_menu()



	/**
	 * Creates the options page
	 *
	 * since 		1.2.0
	 * @return 		void
	 */
	public function page_options() {

		include( plugin_dir_path( __FILE__ ) . 'partials/sapphire-popups-admin-page.php' );

	} // page_options()



	/**
	 * Register settings for the settings page.
	 *
	 * since 1.0.0
	 */
	public function register_settings() {

		// register_setting( $option_group, $option_name, $sanitize_callback );

		register_setting(
			$this->plugin_name . '-options',
			$this->plugin_name . '-options'
			// array( $this, 'validate_options' ) 
		);

	} // register_settings() 



	/**
	 * Sanitize/validate plugin settings.
	 *
	 * since 1.0.0
	 */
	// private function validate_options( $type, $data ) {

	// } //validate_options()



	/**
	 * Register sections for the settings page.
	 *
	 * since 1.0.0
	 */
	public function register_sections() {

		// add_settings_section( $id, $title, $callback, $menu_slug );

		add_settings_section(
			$this->plugin_name . '-section-popups',
			esc_html__('Popup Settings', 'sapphire-popups'),
			array( $this, 'popup_settings' ),
			$this->plugin_name . '-settings'
		);

	} // register_sections()



	/**
	 * Creates a settings section
	 *
	 * since  1.0.0
	 * @param  array 
	 * @return mixed The settings section
	 */
	public function popup_settings( $params ) {

		include( plugin_dir_path( __FILE__ ) . 'partials/sapphire-popups-admin-section-popups.php' );

	} // popup_settings()



	/**
	 * Registers settings fields with WordPress
	 * 
	 * since 1.2.0
	 */
	public function register_fields() {

		// add_settings_field( $id, $title, $callback, $menu_slug, $section, $args );

		// Select Popup - Popups CPT
		add_settings_field(
			'select_popup',
			esc_html__( 'Select Popup', 'sapphire-popups' ),
			array( $this, 'field_select' ),
			$this->plugin_name . '-settings',
			$this->plugin_name . '-section-popups',
			array(
				'cpt' 		=> true, // custom post type.
				'id' 			=> 'select_popup', 
				'label' 	=> '<a href="edit.php?post_type=sapphire_popups">' . esc_html__('Manage Popups', 'sapphire-popups') . '</a>', 
				'default' => esc_html__('Select Popup', 'sapphire-popups') 
			)
		);

	

		// Select popup behavior field.
		add_settings_field(
			'select_popup_behavior',
			esc_html__( 'Select Behavior', 'sapphire-popups' ),
			array( $this, 'field_select' ),
			$this->plugin_name . '-settings',
			$this->plugin_name . '-section-popups',
			array( 
				'cpt'     => false, // not custom post type.
				'id'      => 'select_popup_behavior', 
				'label'   => esc_html__('How often to show.', 'sapphire-popups'), 
				'options' => array(
					'default'    => esc_html__('Default', 'sapphire-popups'),
					'show_daily' => esc_html__('Show Daily', 'sapphire-popups'),
					'show_once'  => esc_html__('Show Once', 'sapphire-popups')
				),
				'default' => esc_html__('Default', 'sapphire-popups')
			)
		);

		// Exclude Title checkbox field.
		add_settings_field(
			'exclude_popup_title',
			esc_html__('Exclude Title', 'sapphire-popups'),
			array( $this, 'field_checkbox' ),
			$this->plugin_name . '-settings',
			$this->plugin_name . '-section-popups',
			array( 
				'id' => 'exclude_popup_title', 
				'label' => esc_html__('Exclude Popup Title from popup.', 'sapphire-popups'),
				'default' => false
			)
		);
	} // register_fields()



	/**
	 * Select field options.
	 * 
	 * @param  string $id ID of the field that options will be added.
	 * @return array
	 * since  1.0.0
	 */
	public function sapphire_popups_options_select( $id ) {
		
		if( isset( $id ) ) {
			
			// WP_Query arguments
			$args = array (
				'post_type'   => array( 'sapphire_popups' ),
				'post_status' => array( 'publish' ),
				'order'       => 'ASC',
				'orderby'     => 'menu_order'
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
		
	} // sapphire_popups_options_select()



	/**
	 * Select field.
	 *
	 * @param array $args
	 * @return      string
	 * since       1.0.0
	 */
	public function field_select( $args ) {

		$dbOptions = get_option( 'sapphire-popups-options', [ $args['id'] => $args['default'] ] );
	
		$id      = isset( $args['id'] )    	 ? $args['id']      : '';
		$isCpt   = isset( $args['cpt'] )     ? $args['cpt']     : '';

		// Options from register setting
		$options = isset( $args['options'] ) ? $args['options'] : false;
		$label   = isset( $args['label'] )   ? $args['label'] 	: '';
		
		$selected_option = isset( $dbOptions[$id] ) ? sanitize_text_field( $dbOptions[$id] ) : '';
		
		if( true === $isCpt ) {
			$select_options = $this->sapphire_popups_options_select( $id );
		} elseif( false != $options ) {
		
			$select_options = $options;
		} else {
			$select_options = array('no_options' => 'No Options');
		}
		
		echo '<select id="sapphire-popups-options-'. $id .'" name="sapphire-popups-options['. $id .']">';
		
		foreach ( $select_options as $value => $option ) {
			
			$selected = selected( $selected_option === $value, true, false );
			
			echo '<option value="'. $value .'"'. $selected .'>'. esc_html__( $option, 'sapphire-popups' ) .'</option>';
			
		}
		
		echo '</select> <label for="sapphire-popups-options-'. $id .'">'. wp_kses_post( __( $label, 'sapphire-popups' ) ) .'</label>';

	} // field_select()



	/**
	 * Checbox field.
	 * 
	 * Echos checkbox field to settings page.
	 *
	 * @param array $args
	 * since 1.0.0
	 */
	public function field_checkbox( $args ) {

		$options = get_option( 'sapphire-popups-options', [$args['id'] => $args['default']] );
		
		$id    = isset( $args['id'] )    ? $args['id']    : '';
		$label = isset( $args['label'] ) ? $args['label'] : '';
		
		$checked = isset( $options[$id] ) ? checked( $options[$id], 1, false ) : '';
		
		echo '<input id="sapphire-popups-options-'. $id .'" name="sapphire-popups-options['. $id .']" type="checkbox" value="1"'. $checked .'> ';
		echo '<label for="sapphire-popups-options-'. $id .'">'. $label .'</label>';
		
	} // field_checkbox()



	/**
	 * Register custom post types for Popups.
	 * 
	 * Does not create front end pages.
	 *
	 * since 	1.0.0
	 * @access 	public
	 * @uses 	register_post_type()
	 */
	public static function sapphire_cpts() {

				include( plugin_dir_path( __FILE__ ) . 'partials/sapphire-popups-cpts.php' );


	} // new_cpt_job()



	/**
	 * Register the stylesheets for the admin area.
	 *
	 * since    1.2.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Sapphire_Popups_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Sapphire_Popups_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/sapphire-popups-admin.css', array(), $this->version, 'all' );

	}




	/**
	 * Register the JavaScript for the admin area.
	 *
	 * since    1.2.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Sapphire_Popups_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Sapphire_Popups_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/sapphire-popups-admin.js', array(), $this->version, false );

	}



	/**
	 * Register Admin Endpoints for the WP Rest API
	 * 
	 * /wp-json/sapphire-popups/v1/admin
	 * 
	 * since 1.3.1
	 */
	public function setup_admin_rest_endpoints() {

		$version = '1';
		$namespace = $this->plugin_name . '/v' . $version;
		$endpoint = '/admin/';

		register_rest_route( 
			$namespace, 
			$endpoint, 
			array(
				array(
						'methods'               => \WP_REST_Server::READABLE,
						'callback'              => array( $this, 'get_popup' ),
						// 'permission_callback'   => array( $this, 'admin_permissions_check' ),
						'args'                  => array(),
				),
		) );

	}



	/**
	 * Get Example
	 *
	 * @param WP_REST_Request $request Full data about the request.
	 * @return WP_Error|WP_REST_Request
	 */
	public function get_popup( $request ) {
			$example_option = get_option( 'sapphire-popups-options' );
		
			// Don't return false if there is no option
			if ( ! $example_option ) {
					return new \WP_REST_Response( array(
							'success' => true,
							'value' => ''
					), 200 );
			}

			return new \WP_REST_Response( array(
					'success' => true,
					'value' => $example_option
			), 200 );
	}
		


	/**
	 * Check if a given request has access to update a setting
	 *
	 * @param WP_REST_Request $request Full data about the request.
	 * @return WP_Error|bool
	 */
	public function admin_permissions_check(  ) {
		
			return current_user_can( 'manage_options' );
			
	}



	/**
	 * Add a link to the settings page from the plugins page.
	 *
	 * Will be displayed after plugin in activated in the plugins page.
	 *
	 * @param array $links
	 * @return array
	 * since 1.3.2
	 */
	function add_settings_link( $links ) {
			$settings_link = '<a href="admin.php?page=sapphire-popups-settings">' . esc_html__( 'Settings', 'sapphire-popups' ) . '</a>';
			array_push( $links, $settings_link );
			return $links;
	}



}
