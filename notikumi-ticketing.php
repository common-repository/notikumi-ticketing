<?php

/**
 *
 * @link              https://pro.notikumi.com
 * @since             1.0.0
 * @package           Notikumi Ticketing
 *
 * @wordpress-plugin
 * Plugin Name:       Notikumi Ticketing
 * Description:       Show your events and tickets ready to be sold in your wordpress page. 
 * Version:           1.3.3
 * Author:            notikumi
 * Author URI:        https://pro.notikumi.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       notikumi-ticketing
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'NOTIKUMI_VERSION', '1.3.3' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-notikumi-activator.php
 */
function activate_notikumi() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-notikumi-activator.php';
	Notikumi_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-notikumi-deactivator.php
 */
function deactivate_notikumi() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-notikumi-deactivator.php';
	Notikumi_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_notikumi' );
register_deactivation_hook( __FILE__, 'deactivate_notikumi' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-notikumi.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_notikumi() {

	$plugin = new Notikumi();
	$plugin->run();

}
run_notikumi();

