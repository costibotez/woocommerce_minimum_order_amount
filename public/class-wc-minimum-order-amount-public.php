<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://costinbotez.co.uk
 * @since      1.0.0
 *
 * @package    Wc_Minimum_Order_Amount
 * @subpackage Wc_Minimum_Order_Amount/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wc_Minimum_Order_Amount
 * @subpackage Wc_Minimum_Order_Amount/public
 * @author     Costin Botez <costibotez94@gmail.com>
 */
class Wc_Minimum_Order_Amount_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wc-minimum-order-amount-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wc-minimum-order-amount-public.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function wc_minimum_order_amount() {

		global $current_user;

	    // Get minimum order amount from database
	    $minimum = ( get_option( 'wc_minimum_order_amount_number' ) !==0 ? get_option( 'wc_minimum_order_amount_number' ) : 0 );
	    // Get the user roles to be applied on
	    $user_roles = ( is_array(get_option( 'wc_minimum_order_amount_user_roles' )) ? get_option( 'wc_minimum_order_amount_user_roles' ) : array() );

	    // Check if one of the user roles intersect with the plugin user roles

	    $apply_on_user = false;
	    // var_dump($user_roles);
	    // var_dump($current_user->roles);
	    // var_dump(!empty(array_intersect($current_user->roles, $user_roles)));
	    if(!empty(array_intersect($current_user->roles, $user_roles)))
	    	$apply_on_user = true;

	    if ( WC()->cart->total < $minimum  && $apply_on_user ) {

	        if( is_cart() ) {

	            wc_print_notice(
	                sprintf( 'You must have an order with a minimum of %s to place your order, your current order total is %s.' ,
	                    wc_price( $minimum ),
	                    wc_price( WC()->cart->total )
	                ), 'error'
	            );

	        } else {

	            wc_add_notice(
	                sprintf( 'You must have an order with a minimum of %s to place your order, your current order total is %s.' ,
	                    wc_price( $minimum ),
	                    wc_price( WC()->cart->total )
	                ), 'error'
	            );

	        }
	    }

	}

}
