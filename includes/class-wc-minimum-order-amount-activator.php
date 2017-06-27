<?php

/**
 * Fired during plugin activation
 *
 * @link       https://costinbotez.co.uk
 * @since      1.0.0
 *
 * @package    Wc_Minimum_Order_Amount
 * @subpackage Wc_Minimum_Order_Amount/includes
 */

define ( 'WCMOA_REQUIRED_PHP_VERSION', '5.4' );  	// because of get_called_class()
define ( 'WCMOA_REQUIRED_WP_VERSION', '4.6' );		// because of esc_textarea()
define ( 'WCMOA_REQUIRED_WC_VERSION', '2.6' );     	// because of Shipping Class system

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Wc_Minimum_Order_Amount
 * @subpackage Wc_Minimum_Order_Amount/includes
 * @author     Costin Botez <costibotez94@gmail.com>
 */
class Wc_Minimum_Order_Amount_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		if ( self::wcmoa_requirements_met() ) {
		    return true;
		} else {
		    add_action( 'admin_notices', array( __CLASS__, 'admin_notice__error' ) );
		}
	}

	public static function wcmoa_requirements_met() {

		global $wp_version;

	    require_once( ABSPATH . '/wp-admin/includes/plugin.php' );  // to get is_plugin_active() early

	    if ( version_compare ( PHP_VERSION, WCMOA_REQUIRED_PHP_VERSION, '<' ) ) {
	        return false ;
	    }

	    if ( version_compare ( $wp_version, WCMOA_REQUIRED_WP_VERSION, '<' ) ) {
	        return false ;
	    }

	    if ( ! is_plugin_active ( 'woocommerce/woocommerce.php' ) ) {
	        return false ;
	    }

	    $woocommerce_data = get_plugin_data(WP_PLUGIN_DIR .'/woocommerce/woocommerce.php', false, false);

	    if (version_compare ($woocommerce_data['Version'] , WCCF_REQUIRED_WC_VERSION, '<')){
	        return false;
	    }

	    return true;
	}

	public static function admin_notice__error() {
		?>
	    <div class="error notice">
	        <p><?php _e( 'Please install WooCommerce Plugin first!!!', 'wc-minimum-order-amount' ); ?></p>
	    </div>
   	 	<?php
	}
}
