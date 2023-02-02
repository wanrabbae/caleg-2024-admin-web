<?php
/**
 * WPForms API routes for usage in WP's RestApi.
 *
 * @since 2.9.0
 *
 * @author  Eduardo Nakatsuka
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Rest Api class.
 *
 * @since 2.9.0
 */
class OMAPI_WPForms_RestApi extends OMAPI_BaseRestApi {
	/**
	 * Registers the Rest API routes for WPForms
	 *
	 * @since 2.9.0
	 *
	 * @return void
	 */
	public function register_rest_routes() {
		register_rest_route(
			$this->namespace,
			'wpforms/forms',
			array(
				'methods'             => 'GET',
				'permission_callback' => array( $this, 'logged_in_or_has_api_key' ),
				'callback'            => array( $this, 'forms' ),
			)
		);
	}

	/**
	 * Handles getting WPForms forms.
	 *
	 * Route: GET omapp/v1/woocommerce/forms
	 *
	 * @since 2.9.0
	 *
	 * @param WP_REST_Request $request The REST Request.
	 *
	 * @return WP_REST_Response The API Response
	 * @throws Exception If plugin action fails.
	 */
	public function forms() {
		try {
			return new WP_REST_Response(
				OMAPI_WPForms::get_instance()->get_forms_array(),
				200
			);
		} catch ( Exception $e ) {
			return $this->exception_to_response( $e );
		}
	}
}
