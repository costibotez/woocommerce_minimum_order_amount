<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://costinbotez.co.uk
 * @since             1.0.0
 * @package           Wc_Minimum_Order_Amount
 *
 * @wordpress-plugin
 * Plugin Name:       WooCommerce Minimum Order Amount
 * Plugin URI:        https://github.com/costibotez/woocommerce_minimum_order_amount
 * Description:       A WC Add-on which doesn't allow a custom user role to complete the order if doesn't meet a minimum order amount
 * Version:           1.0.0
 * Author:            Costin Botez
 * Author URI:        https://costinbotez.co.uk
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wc-minimum-order-amount
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wc-minimum-order-amount-activator.php
 */
function activate_wc_minimum_order_amount() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wc-minimum-order-amount-activator.php';
	Wc_Minimum_Order_Amount_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wc-minimum-order-amount-deactivator.php
 */
function deactivate_wc_minimum_order_amount() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wc-minimum-order-amount-deactivator.php';
	Wc_Minimum_Order_Amount_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wc_minimum_order_amount' );
register_deactivation_hook( __FILE__, 'deactivate_wc_minimum_order_amount' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wc-minimum-order-amount.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wc_minimum_order_amount() {
	$plugin = new Wc_Minimum_Order_Amount();
	$plugin->run();

}
run_wc_minimum_order_amount();
