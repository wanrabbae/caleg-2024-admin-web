<?php
/**
 * EasyDigitalDownloads Output class.
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
 * EasyDigitalDownloads Output class.
 *
 * @since 2.8.0
 */
class OMAPI_EasyDigitalDownloads_Output {

	/**
	 * Holds the class object.
	 *
	 * @since 2.8.0
	 *
	 * @var OMAPI_EasyDigitalDownloads_Output
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
	 * Returns the payload EDD needs to use in its Display Rules.
	 *
	 * @since 2.8.0
	 *
	 * @return array The
	 */
	public function display_rules_data() {
		$output = array(
			'cart' => $this->get_cart(),
		);

		$user_id = get_current_user_id();

		$purchased_products = edd_get_users_purchased_products( $user_id );

		if ( ! empty( $purchased_products ) ) {
			$customer_products = array_map(
				function ( $product ) {
					return $product->ID;
				},
				$purchased_products
			);

			$output['customer'] = array(
				'products' => $customer_products,
				'stats'    => edd_get_purchase_stats_by_user( $user_id ),
			);
		}

		return $output;
	}

	/**
	 * Retrieve the cart from EDD
	 *
	 * @since 2.8.0.
	 *
	 * @return array An array of EDD cart data.
	 */
	public function get_cart() {
		// Bail if EDD isn't currently active.
		if ( ! OMAPI_EasyDigitalDownloads::is_active() ) {
			return array();
		}

		// Check if EDD is the minimum version.
		if ( ! OMAPI_EasyDigitalDownloads::is_minimum_version() ) {
			return array();
		}

		$edd_cart = EDD()->cart;

		$cart              = array();
		$cart['discounts'] = $edd_cart->get_discounts();
		$cart['quantity']  = $edd_cart->get_quantity();
		$cart['subtotal']  = $edd_cart->get_subtotal();
		$cart['total']     = $edd_cart->get_total();

		// Filter out items by leaving only necessary fields
		$cart['items'] = array_map(
			function ( $edd_item ) {
				return array(
					'id'         => $edd_item['id'],
					'quantity'   => $edd_item['quantity'],
					'discount'   => $edd_item['discount'],
					'subtotal'   => $edd_item['subtotal'],
					'price'      => $edd_item['price'],
					'item_price' => $edd_item['item_price'],
				);
			},
			$edd_cart->get_contents_details()
		);

		return $cart;
	}
}
