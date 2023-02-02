<?php
/**
 * WPForms class.
 *
 * @since 2.9.0
 *
 * @package OMAPI
 * @author  Eduardo Nakatsuka
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * The WPForms class.
 *
 * @since 2.9.0
 */
class OMAPI_WPForms {

	/**
	 * Holds the class object.
	 *
	 * @since 2.9.0
	 *
	 * @var object
	 */
	public static $instance;

	/**
	 * Holds the forms object.
	 *
	 * @since 2.9.0
	 *
	 * @var object
	 */
	public $forms;

	public function __construct() {
		$this->save = new OMAPI_WPForms_Save();

		// When WPForms is activated, connect it.
		add_action( 'activate_wpforms-lite/wpforms.php', array( $this->save, 'connect' ) );
		add_action( 'activate_wpforms/wpforms.php', array( $this->save, 'connect' ) );

		// When WPForms is deactivated, disconnect.
		add_action( 'deactivate_wpforms-lite/wpforms.php', array( $this->save, 'disconnect' ) );
		add_action( 'deactivate_wpforms/wpforms.php', array( $this->save, 'disconnect' ) );
	}

	/**
	 * Returns the singleton instance of the class.
	 *
	 * @since 2.9.0
	 *
	 * @return OMAPI_WPForms
	 */
	public static function get_instance() {
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof OMAPI_WPForms ) ) {
			self::$instance = new OMAPI_WPForms();
		}

		return self::$instance;
	}

	/**
	 * Check if the WPForms plugin is active.
	 *
	 * @since 2.9.0
	 *
	 * @return bool
	 */
	public static function is_active() {
		return class_exists( 'WPForms', true );
	}

	/**
	 * Get WPForms forms array containing label and value.
	 *
	 * @since 2.9.0
	 *
	 * @return array
	 */
	public function get_forms_array() {
		$forms  = $this->get_forms();
		$result = array();

		if ( empty( $forms ) || ! is_array( $forms ) ) {
			return $result;
		}

		foreach ( $forms as $form ) {
			$result[] = array(
				'value' => $form->ID,
				'label' => $form->post_title,
			);
		}

		return $result;
	}

	/**
	 * Get forms from WPForms plugin.
	 *
	 * @since 2.9.0
	 *
	 * @return array All the forms in WPForms plugin.
	 */
	public function get_forms() {
		if ( ! function_exists( 'wpforms' ) ) {
			return array();
		}

		return wpforms()->form->get( '', array( 'order' => 'DESC' ) );
	}

	/**
	 * Get the currently installed WPForms version.
	 *
	 * @since 2.9.0
	 *
	 * @return int The WPForms version.
	 */
	public function get_version() {
		if ( ! function_exists( 'wpforms' ) ) {
			return 0;
		}

		$version = wpforms()->version;

		return $version ? $version : 0;
	}

}
