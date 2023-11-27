<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.smart-is.pk/
 * @since             1.0.0
 * @package           Sb
 *
 * @wordpress-plugin
 * Plugin Name:		 Smart WP Plugin
 * Plugin URI:       https://www.smart-is.pk/
 * Description:      Smart WP Plugin
 * Version:          1.0.0
 * Author:           Smart Is
 * Author URI:       https://www.smart-is.pk/
 * License:          GPL-2.0+
 * License URI:      http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:      pc
 * Domain Path:      /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}





defined( 'ABSPATH' ) or die( 'Hey, what are you doing here? You silly human!' );

// Require once the Composer Autoload
if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
	require_once dirname( __FILE__ ) . '/config.php';
}

/**
 * The code that runs during plugin activation
 */
function activate_smart_booking_plugin() {
	
	SmartWpPlugin\Core\Activate::activate();
}
register_activation_hook( __FILE__, 'activate_smart_booking_plugin' );

/**
 * The code that runs during plugin deactivation
 */
function deactive_smart_booking_plugin() {
	SmartWpPlugin\Core\Deactivate::deactivate();
}
register_deactivation_hook( __FILE__, 'deactive_smart_booking_plugin' );

/**
 * Initialize all the core classes of the plugin
 */
if ( class_exists( 'SmartWpPlugin\\Init' ) ) {
	SmartWpPlugin\Init::register_services();
}