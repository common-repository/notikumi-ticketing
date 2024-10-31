<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://notikumi.com
 * @since      1.0.0
 *
 * @package    Notikumi
 * @subpackage Notikumi/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Notikumi
 * @subpackage Notikumi/includes
 * @author     notikumi <hola@notikumi.com>
 */
class Notikumi_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'notikumi-ticketing',
			false,
			dirname(dirname( plugin_basename( __FILE__ ) ) ) . '/languages'
		);
	}



}
