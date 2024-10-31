<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://notikumi.com
 * @since      1.0.0
 *
 * @package    Notikumi
 * @subpackage Notikumi/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Notikumi
 * @subpackage Notikumi/admin
 * @author     notikumi <hola@notikumi.com>
 */
class Notikumi_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Notikumi_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Notikumi_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_style('wp-codemirror');

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/notikumi-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Notikumi_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Notikumi_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		// CodeMirror 
		if (function_exists('wp_enqueue_code_editor')) {
			$cm_settings['codeEditor'] = wp_enqueue_code_editor(array('type' => 'text/css'));
			wp_localize_script('jquery', 'cm_settings', $cm_settings);
			wp_enqueue_script('wp-theme-plugin-editor');
		}

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/notikumi-admin.js', array( 'jquery' ), $this->version, false );

	}

	

	/* Página principal y subpáginas del plugin */
	public function add_options_page() {

		add_menu_page('Notikumi', 
			'Notikumi', 
			'manage_options', 
			'notikumi-ticketing', 
			array(
				$this, 'main_credentials_page'
			), 
			plugins_url( '/admin/images/notikumi_logo.ico', dirname(__FILE__ )) );

		add_submenu_page('notikumi-ticketing', 
			'Contenido', 
			'Contenido', 
			'manage_options', 
			'events-config',
			array(
				$this, 'main_events_config_page'
			) );

		add_submenu_page('notikumi-ticketing', 
			'Custom diseño', 
			'Custom diseño', 
			'manage_options', 
			'template-config',
			array(
				$this, 'main_templates_config_page'
			) );
	}

	/*
	public function add_settings_options() {
		add_settings_section("header_section", 
			"Header Options", 
			function() {
				echo "The header of the theme";
			}, 
			"notikumi-ticketing");
		
		add_settings_field('field_canta', 
			'Field title', 
			function() {
				echo "Function";
			}, 
			'notikumi-ticketing', 'header_section');

		add_settings_field('field_canta2', 
			'Field title', 
			function() {
				echo "Function";
			}, 
			'notikumi-ticketing', 'header_section');

		register_setting("header_section", "field_canta");
		register_setting("header_section", "field_canta2");
	}*/



	/**
	 * HTML
	 */
	public function main_credentials_page() { 
		include(plugin_dir_path( __FILE__ ) . 'partials/credentials.php');
	} 
	public function main_events_config_page() { 
		include(plugin_dir_path( __FILE__ ) . 'partials/events.php');
	} 
	public function main_templates_config_page() { 
		include(plugin_dir_path( __FILE__ ) . 'partials/templates.php');
	} 
}
