<?php
/**
 * Zakra Pro Minimum Version Notice Class.
 *
 * @author  ThemeGrill
 * @package Zakra
 * @since   2.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Zakra_Pro_Minimum_Version_Notice' ) ) {

	/**
	 * Class to display the Zakra Pro plugin minimum version notice.
	 *
	 * Class Zakra_Pro_Minimum_Version_Notice
	 */
	class Zakra_Pro_Minimum_Version_Notice extends Zakra_Notice {

		/**
		 * Zakra_Pro_Minimum_Version_Notice constructor.
		 */
		public function __construct() {

			$dismiss_url = wp_nonce_url(
				add_query_arg( 'zakra_notice_dismiss', 'zakra_pro_min_version', admin_url() ),
				'zakra_pro_min_version_notice_dismiss_nonce',
				'_zakra_pro_min_version_notice_dismiss_nonce'
			);

			parent::__construct( 'pro_min_version', 'error', $dismiss_url, '' );

			$this->set_dismiss_notice();
		}

		private function set_dismiss_notice() {

			if ( get_option( 'zakra_pro_min_version_notice_dismiss' ) ) {
				add_filter( 'zakra_pro_min_version_notice_dismiss', '__return_true' );
			} else {
				add_filter( 'zakra_pro_min_version_notice_dismiss', '__return_false' );
			}
		}

		public function notice_markup() {

			$notice_dismiss = get_option( 'zakra_pro_min_version_notice_dismiss' );

			// Only show notice if Zakra Pro plugin is active and the version is less that 1.3.0.
			if ( ! $notice_dismiss && zakra_is_zakra_pro_active() && zakra_plugin_version_compare( 'zakra-pro/zakra-pro.php', '1.3.0', '<' ) ) :
				?>
				<div class="notice notice-error zakra-notice zakra-pro-min-version-notice" style="position:relative;">
					<p>
						<?php
						printf(
							/* Translators: %1$s Zakra Pro link, %2$s Zakra Pro update link, %3$s Zakra Pro update link opening, %4$s Zakra Pro update link closing, %5$s Opening strong tag, %5$s Closing strong tag */
							esc_html__( 'Please update the %1$s plugin to latest version i.e %5$s1.3.0%6$s for %2$s to work properly. %5$s%3$sClick here to update Zakra Pro Plugin%4$s%6$s', 'zakra' ),
							'<a href="' . esc_url( admin_url( 'plugins.php' ) ) . '">Zakra Pro</a>',
							'<a href="https://zakratheme.com/" target="_blank">Zakra</a>',
							'<a href="' . esc_url( admin_url( 'plugins.php' ) ) . '">',
							'</a>',
							'<strong>',
							'</strong>'
						);
						?>
					</p>
					<a class="notice-dismiss" href="<?php echo esc_url( $this->dismiss_url ); ?>"></a>
				</div>
				<?php
			endif;
		}

		public function dismiss_notice() {

			if ( isset( $_GET['zakra_notice_dismiss'] ) && isset( $_GET['_zakra_pro_min_version_notice_dismiss_nonce'] ) ) {

				if ( ! wp_verify_nonce( $_GET['_zakra_pro_min_version_notice_dismiss_nonce'], 'zakra_pro_min_version_notice_dismiss_nonce' ) ) {
					wp_die( esc_html__( 'Action failed. Please refresh the page and retry.', 'zakra' ) );
				}

				update_option( 'zakra_pro_min_version_notice_dismiss', true );
			}
		}
	}

	new Zakra_Pro_Minimum_Version_Notice();
}
