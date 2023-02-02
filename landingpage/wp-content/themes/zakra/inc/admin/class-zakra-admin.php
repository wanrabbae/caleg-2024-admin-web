<?php
/**
 * Zakra main admin class.
 *
 * @package Zakra
 */

defined( 'ABSPATH' ) || exit;

/**
 * Class Zakra_Admin
 */
class Zakra_Admin {

	/**
	 * Zakra_Admin constructor.
	 */
	public function __construct() {
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
	}

	/**
	 * Localize array for import button AJAX request.
	 */
	public function enqueue_scripts() {
		wp_enqueue_style( 'zakra-admin-style', get_template_directory_uri() . '/inc/admin/css/admin.css', array(), ZAKRA_THEME_VERSION );

		wp_enqueue_script( 'zakra-plugin-install-helper', ZAKRA_PARENT_INC_URI . '/admin/js/plugin-handle.js', array( 'jquery' ), ZAKRA_THEME_VERSION, true );

		$welcome_data = array(
			'uri'      => esc_url( admin_url( '/themes.php?page=demo-importer&browse=all&zakra-hide-notice=welcome' ) ),
			// Check if TDI is installed but not activated or not installed at all or installed and activated.
			'btn_text' => ! file_exists( WP_PLUGIN_DIR . '/themegrill-demo-importer/themegrill-demo-importer.php' ) ? esc_html__( 'Processing...', 'zakra' ) : ( file_exists( WP_PLUGIN_DIR . '/themegrill-demo-importer/themegrill-demo-importer.php' ) && is_plugin_inactive( 'themegrill-demo-importer/themegrill-demo-importer.php' ) ? esc_html__( 'Activating...', 'zakra' ) : esc_html__( 'Redirecting...', 'zakra' ) ),
			'nonce'    => wp_create_nonce( 'zakra_demo_import_nonce' ),
		);

		wp_localize_script( 'zakra-plugin-install-helper', 'zakraRedirectDemoPage', $welcome_data );
	}
}

new Zakra_Admin();
