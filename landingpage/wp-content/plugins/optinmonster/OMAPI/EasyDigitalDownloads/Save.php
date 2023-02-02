<?php
/**
 * EasyDigitalDownloads Save class.
 *
 * @since 2.8.0
 *
 * @package OMAPI
 * @author  Gabriel Oliveira
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * EasyDigitalDownloads Save class.
 *
 * @since 2.8.0
 */
class OMAPI_EasyDigitalDownloads_Save {

	/**
	 * Holds the class object.
	 *
	 * @since 2.8.0
	 *
	 * @var OMAPI_EasyDigitalDownloads_Save
	 */
	public static $instance;

	/**
	 * Holds the base class object.
	 *
	 * @since 2.8.0
	 *
	 * @var OMAPI
	 */
	public $base;

	/**
	 * Primary class constructor.
	 *
	 * @since 2.8.0
	 */
	public function __construct() {

		// Set our object.
		$this->set();
	}

	/**
	 * Sets our object instance and base class instance.
	 *
	 * @since 2.8.0
	 */
	public function set() {
		self::$instance = $this;
		$this->base     = OMAPI::get_instance();
	}

	/**
	 * Handles auto-connecting the EDD plugin with our app. First, get public key. If not present, then generate it, and then connect.
	 *
	 * @since 2.8.0
	 *
	 * @return WP_Error|array Array with public_key, private_key and token, or WP_Error if something happened.
	 */
	public function autogenerate() {
		if ( ! $this->base->edd->can_manage_shop() ) {
			return new WP_Error(
				'omapi-error-user-permission',
				esc_html__( 'You don\'t have the required permissions to retrieve or generate API Keys for EDD.', 'optin-monster-api' )
			);
		}

		$user_id = get_current_user_id();

		// We first try retrieving the public keys for the current user
		$public_key = EDD()->api->get_user_public_key( $user_id );

		// If it doesn't have, then let's generate it
		if ( empty( $public_key ) ) {
			EDD()->api->generate_api_key( $user_id );

			// If we can't retrieve for the second time, then that's an error
			$public_key = EDD()->api->get_user_public_key( $user_id );

			if ( empty( $public_key ) ) {
				return new WP_Error(
					'omapi-error-generate-edd-keys',
					esc_html__( 'An error happened while generating the keys for EDD user. Try again.', 'optin-monster-api' )
				);
			}
		}

		$token = EDD()->api->get_token( $user_id );

		return $this->connect( $public_key, $token );
	}

	/**
	 * Handles connecting the EDD plugin with our app.
	 *
	 * @since 2.8.0
	 *
	 * @param string $public_key The user public key
	 * @param string $token      The user token
	 *
	 * @return WP_Error|array Array with public_key, private_key and token, or WP_Error if something happened.
	 */
	public function connect( $public_key, $token ) {
		$url = esc_url_raw( site_url() );

		$payload = array(
			'public_key' => $public_key,
			'token'      => $token,
			'url'        => $url,
		);

		$response = $this->base->edd->connect( $payload );

		if ( is_wp_error( $response ) ) {
			return $response;
		}

		// Set up the connected EDD options.
		// We only need to save the truncated public_key, so we can output to the user.
		$option = $this->base->get_option();

		$option['edd'] = array(
			'key'   => $public_key,
			'token' => $token,
			'shop'  => $response->id,
		);

		// Save the option.
		$this->base->save->update_option( $option );

		return true;
	}

	/**
	 * Handles disconnecting EDD when the disconnect button is clicked.
	 *
	 * @since 2.8.0
	 *
	 * @return WP_Error|bool True if successful, or WP_Error if something happened.
	 */
	public function disconnect() {
		$response = $this->base->edd->disconnect();

		// Output an error or register a successful disconnection.
		if ( is_wp_error( $response ) ) {
			return $response;
		}

		$option = $this->base->get_option();

		unset( $option['edd'] );

		// Save the option.
		$this->base->save->update_option( $option );

		return true;
	}
}
