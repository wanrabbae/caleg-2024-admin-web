<?php

/**
 * Plugin Name: Hostinger
 * Plugin URI: https://www.hostinger.com
 * Description: Hostinger WordPress plugin.
 * Version: 1.0.1
 * Author: Hostinger
 * Author URI: https://www.hostinger.com
 * Text Domain:       hostinger
 * Domain Path:       /languages
 *
 */

defined( 'ABSPATH' ) || exit;

if ( ! defined( 'HOSTINGER_VERSION' ) ) {
    define( 'HOSTINGER_VERSION', '1.0.1' );
}

/**
 * @return void
 */
function activate_hostinger() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-hostinger-activator.php';
	Hostinger_Activator::activate();
}

/**
 * @return void
 */
function deactivate_hostinger() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-hostinger-deactivator.php';
	Hostinger_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_hostinger' );
register_deactivation_hook( __FILE__, 'deactivate_hostinger' );

/**
 * Begins execution of the plugin.
 *
 * @return void
 *
 */
require_once plugin_dir_path( __FILE__ ) . 'includes/class-hostinger.php';

$plugin = new Hostinger();
$plugin->run();
