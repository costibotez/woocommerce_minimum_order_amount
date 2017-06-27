<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://costinbotez.co.uk
 * @since      1.0.0
 *
 * @package    Wc_Minimum_Order_Amount
 * @subpackage Wc_Minimum_Order_Amount/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wc_Minimum_Order_Amount
 * @subpackage Wc_Minimum_Order_Amount/admin
 * @author     Costin Botez <costibotez94@gmail.com>
 */
class Wc_Minimum_Order_Amount_Admin {

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
	 * The options name to be used in this plugin
	 *
	 * @since  	1.0.0
	 * @access 	private
	 * @var  	string 		$option_name 	Option name of this plugin
	 */
	private $option_name = 'wc_minimum_order_amount';

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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wc-minimum-order-amount-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wc-minimum-order-amount-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Add an options page under the Settings submenu
	 *
	 * @since  1.0.0
	 */
	public function add_options_page() {

		$this->plugin_screen_hook_suffix = add_options_page(
			__( 'WC Minimum Order Amount Settings', 'wc-minimum-order-amount' ),
			__( 'WC Minimum Order Amount', 'wc-minimum-order-amount' ),
			'manage_options',
			$this->plugin_name,
			array( $this, 'display_options_page' )
		);
	}

	/**
	 * Render the options page for plugin
	 *
	 * @since  1.0.0
	 */
	public function display_options_page() {

		include_once 'partials/wc-minimum-order-amount-admin-display.php';

	}

	/**
	 * Register setting section
	 *
	 * @since  1.0.0
	 */
	public function register_setting() {

		// Add a General section
		add_settings_section(
			$this->option_name . '_general',
			__( 'General', 'wc-minimum-order-amount' ),
			array( $this, $this->option_name . '_general_cb' ),
			$this->plugin_name
		);

		// Add Minimum Order Amount Field number
		add_settings_field(
			$this->option_name . '_number',
			__( 'Minimum order amount', 'wc-minimum-order-amount' ),
			array( $this, $this->option_name . '_number_cb' ),
			$this->plugin_name,
			$this->option_name . '_general',
			array( 'label_for' => $this->option_name . '_number' )
		);

		// Register Setting
		register_setting( $this->plugin_name, $this->option_name . '_number', 'intval' );
		// var_dump(get_option( $this->option_name . '_number' ));

	}

	/**
	 * Render the text for the general section
	 *
	 * @since  1.0.0
	 */
	public function wc_minimum_order_amount_general_cb() {

		echo '<p>' . __( 'Please change the settings accordingly.', 'wc-minimum-order-amount' ) . '</p>';

	}

	/**
	 * Render the radio input field for position option
	 *
	 * @since  1.0.0
	 */
	public function wc_minimum_order_amount_number_cb() {

		$number = get_option( $this->option_name . '_number' );
		?>

		<label>
			<input type="text" name="<?php echo $this->option_name . '_number' ?>" id="<?php echo $this->option_name . '_number' ?>" value="<?php echo $number; ?>" />
			<?php _e( 'Leave it empty if you don\'t want to apply it', 'wc-minimum-order-amount' ); ?>
		</label>
		<?php

	}

}
