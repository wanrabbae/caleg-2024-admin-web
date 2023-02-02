<?php
/**
 * Easy Digital Downloads class.
 *
 * @since 2.6.13
 *
 * @package OMAPI
 * @author  Thomas Griffin
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * The Easy Digital Downloads class.
 *
 * @since 2.6.13
 */
class OMAPI_EasyDigitalDownloads {
	/**
	 * Holds the class object.
	 *
	 * @since 2.6.13
	 *
	 * @var object
	 */
	public static $instance;

	/**
	 * Path to the file.
	 *
	 * @since 2.6.13
	 *
	 * @var string
	 */
	public $file = __FILE__;

	/**
	 * Holds the base class object.
	 *
	 * @since 2.6.13
	 *
	 * @var OMAPI
	 */
	public $base;

	/**
	 * The minimum EDD version required.
	 *
	 * @since 2.8.0
	 *
	 * @var string
	 */
	const MINIMUM_VERSION = '2.1.0';

	/**
	 * OMAPI_EasyDigitalDownloads_Save object
	 *
	 * @since 2.8.0
	 *
	 * @var OMAPI_EasyDigitalDownloads_Save
	 */
	public $save;

	/**
	 * Primary class constructor.
	 *
	 * @since 2.6.13
	 */
	public function __construct() {
		// Set our object.
		$this->set();

		// Revenue attribution support. We load on shutdown because we need access
		// to the $_COOKIE data, which will not be available for any action triggered
		// by cron. This attempts at the last possible moment to avoid interfering
		// with anything else happening with the payment.
		add_action( 'shutdown', array( $this, 'maybe_store_revenue_attribution' ) );
		add_action( 'edd_update_payment_status', array( $this, 'maybe_store_revenue_attribution_on_payment_status_update' ), 10, 2 );
	}

	/**
	 * Sets our object instance and base class instance.
	 *
	 * @since 2.6.13
	 */
	public function set() {
		self::$instance = $this;
		$this->base     = OMAPI::get_instance();
		$this->save     = new OMAPI_EasyDigitalDownloads_Save();
	}

	/**
	 * Maybe stores revenue attribution data when a purchase is successful.
	 *
	 * @since 2.6.13
	 *
	 * @param int  $payment_id The EDD payment ID.
	 * @param bool $force      Flag to force sending the revenue attribution data.
	 *
	 * @return void
	 */
	public function maybe_store_revenue_attribution( $payment_id = 0, $force = false ) {
		if ( ! class_exists( 'EDD_Payment' ) ) {
			return;
		}

		// If we don't have a payment ID passed, try to grab one.
		if ( ! $payment_id ) {
			// If we don't have the right EDD function to grab session data, return early.
			if ( ! function_exists( 'edd_get_purchase_session' ) ) {
				return;
			}

			// If we are not on the success page, return early.
			if ( function_exists( 'edd_is_success_page' ) && ! edd_is_success_page() ) {
				return;
			}

			// Grab the purchase session. If we can't find it, return early.
			$session = edd_get_purchase_session();
			if ( empty( $session['purchase_key'] ) ) {
				return;
			}

			// Grab the payment ID from the purchase session. If we can't find
			// it, return early.
			$payment_id = edd_get_purchase_id_by_key( $session['purchase_key'] );
			if ( ! $payment_id ) {
				return;
			}
		}

		// If we have already stored revenue attribution data before, return early.
		$stored = get_post_meta( $payment_id, '_om_revenue_attribution_complete', true );
		if ( $stored ) {
			return;
		}

		// Grab the payment. If we can't, return early.
		$payment = new EDD_Payment( $payment_id );
		if ( ! $payment ) {
			return;
		}

		// Grab some necessary data to send.
		$data_on_payment = get_post_meta( $payment_id, '_om_revenue_attribution_data', true );
		$data            = wp_parse_args(
			array(
				'transaction_id' => absint( $payment_id ),
				'value'          => esc_html( $payment->total ),
				'test'           => 'live' !== $payment->mode,
			),
			! empty( $data_on_payment ) ? $data_on_payment : $this->base->revenue->get_revenue_data()
		);

		// If the status is not complete, return early.
		// This will happen for payments where further
		// work is required (such as checks, etc.). In those
		// instances, we need to store the data to be processed
		// at a later time.
		if (
			! in_array( $payment->status, array( 'complete', 'completed', 'publish' ), true )
			&& ! $force
		) {
			update_post_meta( $payment_id, '_om_revenue_attribution_data', $data );
			return;
		}

		// Attempt to make the revenue attribution request.
		// It checks to determine if campaigns are set, etc.
		$ret = $this->base->revenue->store( $data );
		if ( ! $ret || is_wp_error( $ret ) ) {
			return;
		}

		// Update the payment meta for storing revenue attribution data.
		update_post_meta( $payment_id, '_om_revenue_attribution_complete', time() );
	}

	/**
	 * Maybe stores revenue attribution data when a purchase is successful.
	 *
	 * @since 2.6.13
	 *
	 * @param int    $payment_id The EDD payment ID.
	 * @param string $new_status The new payment status.
	 *
	 * @return void
	 */
	public function maybe_store_revenue_attribution_on_payment_status_update( $payment_id, $new_status ) {
		// If we don't have the proper new status, return early.
		if ( 'publish' !== $new_status && 'complete' !== $new_status && 'completed' !== $new_status ) {
			return;
		}

		// Maybe store the revenue attribution data.
		return $this->maybe_store_revenue_attribution( $payment_id, true );
	}

	/**
	 * Connects EDD to OptinMonster.
	 *
	 * @param array $data The array of key / token.
	 *
	 * @since 2.8.0
	 *
	 * @return WP_Error|bool True if success, or WP_Error if any error was encountered.
	 */
	public function connect( $data ) {
		if ( empty( $data['public_key'] ) || empty( $data['token'] ) ) {
			return new WP_Error(
				'omapi-invalid-edd-keys',
				esc_html__( 'The EDD key or token appears to be invalid. Try again.', 'optin-monster-api' )
			);
		}

		// Setup the request payload.
		$payload = array(
			'key'      => $data['public_key'],
			'token'    => $data['token'],
			'shop'     => $data['url'],
			'name'     => esc_html( get_bloginfo( 'name' ) ),
			'restUrl'  => esc_url_raw( get_rest_url() ),
			'homeUrl'  => esc_url_raw( home_url() ),
			'adminUrl' => esc_url_raw( get_admin_url() ),
		);

		// Get the OptinMonster API credentials.
		$creds = $this->base->get_api_credentials();

		// Initialize the API class.
		$api = new OMAPI_Api( 'edd/shop', $creds, 'POST', 'v2' );

		$body = $api->request( $payload );

		if ( is_wp_error( $body ) ) {
			$message = isset( $body->message )
				? $body->message
				: esc_html__( 'EDD could not be connected to OptinMonster. The OptinMonster API returned with the following response: ', 'optin-monster-api' ) . $body->get_error_message();

			return new WP_Error( 'omapi-error-edd-api-connect', $message );
		}

		return $body;
	}

	/**
	 * Disconnects EDD from OptinMonster.
	 *
	 * @since 2.8.0
	 *
	 * @return WP_Error|string Empty string if success, or WP_Error if any error was encountered.
	 */
	public function disconnect() {

		// Get the OptinMonster API credentials.
		$creds = $this->base->get_api_credentials();

		// Get the shop.
		$shop = esc_attr( $this->base->get_option( 'edd', 'shop' ) );

		if ( empty( $shop ) ) {
			return true;
		}

		// Initialize the API class.
		$api = new OMAPI_Api( 'edd/shop/' . rawurlencode( $shop ), $creds, 'DELETE', 'v2' );

		$body = $api->request();

		if ( is_wp_error( $body ) ) {
			$message = isset( $body->message )
				? $body->message
				: esc_html__( 'EDD could not be disconnected to OptinMonster. The OptinMonster API returned with the following response: ', 'optin-monster-api' ) . $body->get_error_message();

			return new WP_Error( 'omapi-error-api-disconnect', $message );
		}

		return empty( $body ) ? true : $body;
	}

	/**
	 * Checks if current user can manage the shop
	 *
	 * @since 2.8.0
	 *
	 * @return bool True if it can, false if not.
	 */
	public static function can_manage_shop() {
		return current_user_can( 'manage_shop_settings' );
	}

	/**
	 * Return the EDD Plugin version string.
	 *
	 * @since 2.8.0
	 *
	 * @return string
	 */
	public static function version() {
		return defined( 'EDD_VERSION' ) ? EDD_VERSION : '0.0.0';
	}

	/**
	 * Check if the EDD plugin is active.
	 *
	 * @since 2.8.0
	 *
	 * @return bool
	 */
	public static function is_active() {
		return class_exists( 'Easy_Digital_Downloads', true ) && function_exists( 'EDD' );
	}

	/**
	 * Check if the EDD plugin is connected.
	 *
	 * @since 2.8.0
	 *
	 * @return bool If it is currently connected.
	 */
	public static function is_connected() {
		// If not active, then it is not connected as well.
		if ( ! self::is_active() ) {
			return false;
		}

		// Get any options we have stored.
		$option = OMAPI::get_instance()->get_option( 'edd' );

		// If the option is empty, then it was never connected or it was disconnected.
		if ( empty( $option ) ) {
			return false;
		}

		$shop = isset( $option['shop'] ) ? $option['shop'] : '';

		if ( empty( $shop ) ) {
			return false;
		}

		// Check if the saved key and token are not empty.
		$key = isset( $option['key'] ) ? $option['key'] : '';

		if ( empty( $key ) ) {
			return false;
		}

		// Finally, check if the public_key is still active in user
		$user_id = EDD()->api->get_user( $key );

		return ! empty( $user_id );
	}

	/**
	 * Determines if the passed version string passes the operator compare
	 * against the currently installed version of EDD.
	 *
	 * Defaults to checking if the current EDD version is greater than
	 * the passed version.
	 *
	 * @since 2.8.0
	 *
	 * @param string $version  The version to check.
	 * @param string $operator The operator to use for comparison.
	 *
	 * @return string
	 */
	public static function version_compare( $version = '', $operator = '>=' ) {
		return version_compare( self::version(), $version, $operator );
	}

	/**
	 * Determines if the current EDD version meets the minimum version
	 * requirement.
	 *
	 * @since 2.8.0
	 *
	 * @return boolean
	 */
	public static function is_minimum_version() {
		return self::version_compare( self::MINIMUM_VERSION );
	}
}
