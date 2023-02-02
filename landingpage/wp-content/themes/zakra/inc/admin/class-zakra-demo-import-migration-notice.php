<?php
/**
 * Zakra Demo Import Migration Notice Class.
 *
 * @author  ThemeGrill
 * @package Zakra
 * @since   2.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Zakra_Demo_Import_Migration_Notice' ) ) {
	/**
	 * Class to display the demo import migration notice after demo is imported.
	 *
	 * Class Zakra_Demo_Import_Migration_Notice
	 */
	class Zakra_Demo_Import_Migration_Notice extends Zakra_Notice {

		/**
		 * Zakra_Demo_Import_Migration_Notice constructor.
		 */
		public function __construct() {

			$dismiss_url = wp_nonce_url(
				add_query_arg( 'zakra_notice_dismiss', 'demo_import_migration', admin_url() ),
				'zakra_demo_import_migration_notice_dismiss_nonce',
				'_zakra_demo_import_migration_notice_dismiss_nonce'
			);

			parent::__construct( 'demo_import_migration', 'info', $dismiss_url, '' );

			$this->set_dismiss_notice();
		}

		private function set_dismiss_notice() {

			if ( get_option( 'zakra_demo_import_migration_notice_dismiss' ) ) {
				add_filter( 'zakra_demo_import_migration_notice_dismiss', '__return_true' );
			} else {
				add_filter( 'zakra_demo_import_migration_notice_dismiss', '__return_false' );
			}
		}

		public function notice_markup() {
			$demo_imported  = get_option( 'themegrill_demo_importer_activated_id' );
			$notice_dismiss = get_option( 'zakra_demo_import_migration_notice_dismiss' );

			if ( ! $notice_dismiss ) :

				if ( $demo_imported && ( false !== strpos( $demo_imported, 'zakra' ) ) ) :
					?>
					<div class="notice notice-info zakra-notice demo-import-migrate-notice" style="position:relative;">
						<p>
							<?php
							esc_html_e(
								'It looks like you have imported one of the demos recently. Please check your site, if fonts and background are not the same as in the demo. Please click the \'Fix Imported Demo\' button below.',
								'zakra'
							);
							?>
						</p>
						<p>
							<a href="<?php echo esc_url( $this->dismiss_url ); ?>" class="btn button-primary">
								<span><?php esc_html_e( 'Fix Imported Demo', 'zakra' ); ?></span>
							</a>
							<a href="<?php echo esc_url( 'https://zakratheme.com/contact/' ); ?>" class="btn button-secondary" target="_blank">
								<span><?php esc_html_e( 'Any confusion?', 'zakra' ); ?></span>
							</a>
						</p>
						<a class="notice-dismiss" href="<?php echo esc_url( $this->dismiss_url ); ?>"></a>
					</div>
					<?php
				endif;
			endif;
		}

		public function dismiss_notice() {

			if ( isset( $_GET['zakra_notice_dismiss'] ) && isset( $_GET['_zakra_demo_import_migration_notice_dismiss_nonce'] ) ) {

				if ( ! wp_verify_nonce( $_GET['_zakra_demo_import_migration_notice_dismiss_nonce'], 'zakra_demo_import_migration_notice_dismiss_nonce' ) ) {
					wp_die( esc_html__( 'Action failed. Please refresh the page and retry.', 'zakra' ) );
				}

				update_option( 'zakra_demo_import_migration_notice_dismiss', true );
			}
		}
	}

	new Zakra_Demo_Import_Migration_Notice();
}
