<?php

/**
 * Fired during plugin activation
 *
 * @link       https://notikumi.com
 * @since      1.0.0
 *
 * @package    Notikumi
 * @subpackage Notikumi/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Notikumi
 * @subpackage Notikumi/includes
 * @author     notikumi <hola@notikumi.com>
 */
class Notikumi_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		flush_rewrite_rules();
	}

}
