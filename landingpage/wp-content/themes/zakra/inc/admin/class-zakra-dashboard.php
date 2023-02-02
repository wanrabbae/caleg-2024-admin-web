<?php
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

class Zakra_Dashboard {
	private static $instance;

	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	private function __construct() {
		$this->setup_hooks();
	}

	private function setup_hooks() {
		add_action( 'admin_menu', array( $this, 'create_menu' ) );
	}

	public function create_menu() {
		if ( ! is_child_theme() ) {
			$theme = wp_get_theme();
		} else {
			$theme = wp_get_theme()->parent();
		}

		/* translators: %s: Theme Name. */
		$theme_page_name = sprintf( esc_html__( '%s Options', 'zakra' ), $theme->Name );

		add_theme_page(
			$theme_page_name,
			$theme_page_name,
			'edit_theme_options',
			'zakra-options',
			array(
				$this,
				'option_page',
			)
		);
	}

	public function import_button_html() {

		// Check if TDI is installed but not activated or not installed at all or installed and activated.
		if ( file_exists( WP_PLUGIN_DIR . '/themegrill-demo-importer/themegrill-demo-importer.php' ) && is_plugin_inactive( 'themegrill-demo-importer/themegrill-demo-importer.php' ) ) {
			$zakra_btn_texts = __( 'Activate ThemeGrill Demo Importer Plugin', 'zakra' );
		} elseif ( ! file_exists( WP_PLUGIN_DIR . '/themegrill-demo-importer/themegrill-demo-importer.php' ) && is_plugin_inactive( 'themegrill-demo-importer/themegrill-demo-importer.php' ) ) {
			$zakra_btn_texts = __( 'Install ThemeGrill Demo Importer Plugin', 'zakra' );
		} else {
			$zakra_btn_texts = __( 'Demo Library', 'zakra' );
		}

		$html = '<a class="btn-get-started" href="#" data-name="' . esc_attr( 'themegrill-demo-importer' ) . '" data-slug="' . esc_attr( 'themegrill-demo-importer' ) . '" aria-label="' . esc_attr( $zakra_btn_texts ) . '">' . esc_html( $zakra_btn_texts . ' &#129066;' ) . '</a>';

		return $html;
	}

	public function option_page() {

		if ( ! is_child_theme() ) {
			$theme = wp_get_theme();
		} else {
			$theme = wp_get_theme()->parent();
		}

		$support_link = ( zakra_is_zakra_pro_active() ) ? 'https://zakratheme.com/support-ticket/' : 'https://wordpress.org/support/theme/zakra/';

		$pro_feature_links = array(
			__( 'Header Top Bar', 'zakra' )    => 'https://docs.zakratheme.com/en/article/header-top-bar-overview-pro-40xyxb/',
			__( 'Header Main Area', 'zakra' )  => 'https://docs.zakratheme.com/en/article/header-main-area-overview-pro-1niwud8/',
			__( 'Primary Menu', 'zakra' )      => 'https://docs.zakratheme.com/en/article/primary-menu-overview-pro-8ezs4n/',
			__( 'Mobile Menu', 'zakra' )       => 'https://docs.zakratheme.com/en/article/mobile-menu-overview-pro-18z4iw/',
			__( 'Layout', 'zakra' )            => 'https://docs.zakratheme.com/en/article/how-to-change-the-sidebar-layout-pro-zju16w/',
			__( 'Blog/Archive', 'zakra' )      => 'https://docs.zakratheme.com/en/article/blogarchive-overview-pro-2w9ptx/',
			__( 'Single Post', 'zakra' )       => 'https://docs.zakratheme.com/en/article/single-post-overview-pro-1yc7ew/',
			__( 'Meta', 'zakra' )              => 'https://docs.zakratheme.com/en/article/meta-overview-pro-1mgawoj/',
			__( 'Typography', 'zakra' )        => 'https://docs.zakratheme.com/en/article/how-to-change-the-typography-of-the-site-pro-zqpave/',
			__( 'WooCommerce', 'zakra' )       => 'https://docs.zakratheme.com/en/article/how-to-change-the-layout-of-woocommerce-page-pro-1uci0eh/',
			__( 'Footer Widgets', 'zakra' )    => 'https://docs.zakratheme.com/en/article/footer-widgets-overview-pro-hhwkyc/',
			__( 'Footer Bottom Bar', 'zakra' ) => 'https://docs.zakratheme.com/en/article/footer-bottom-bar-overview-pro-783eio/',
		);
		?>
			<div class="wrap">
				<div class="metabox-holder">
					<div class="zakra-header" >
						<div class="zakra-container">
							<a class="zakra-title" href="<?php echo esc_url( 'https://zakratheme.com/?utm_source=zakra-options-page&utm_medium=logo&utm_campaign=theme-info' ); ?>" target="_blank">
								<img class="zakra-icon" src="<?php echo esc_url( ZAKRA_PARENT_URI . '/inc/admin/images/zakra-logo.svg' ); ?>" alt="<?php esc_attr_e( 'Zakra', 'zakra' ); ?>">
								<span class="zakra-version">
									<?php
									echo $theme->Version;
									?>
								</span>
							</a>
							<div>
								<a href="<?php echo esc_url( 'https://zakratheme.com/?utm_source=zakra-options-page&utm_medium=menu-link&utm_campaign=theme-info' ); ?>" target="_blank"><?php esc_html_e( 'Theme Info', 'zakra' ); ?></a>
								<a href="<?php echo esc_url( 'https://zakratheme.com/demos/?utm_source=zakra-options-page&utm_medium=menu-link&utm_campaign=demos' ); ?>" target="_blank"><?php esc_html_e( 'Demos', 'zakra' ); ?></a>
								<a href="<?php echo esc_url( 'https://zakratheme.com/pro/?utm_source=zakra-options-page&utm_medium=menu-link&utm_campaign=premium' ); ?>" target="_blank"><?php esc_html_e( 'Premium', 'zakra' ); ?></a>
								<a href="<?php echo esc_url( $support_link ); ?>" target="_blank"><?php esc_html_e( 'Support', 'zakra' ); ?></a>
								<a href="<?php echo esc_url( 'https://docs.zakratheme.com/en/' ); ?>" target="_blank"><?php esc_html_e( 'Documentation', 'zakra' ); ?></a>
							</div>
						</div><!--/.zakra-container-->
					</div> <!--/.zakra-header-->
					<div class="zakra-container">
						<div class="postbox-container" style="float: none;">
							<div class="col-70">
								<h2 style="height:0;margin:0;"><!-- admin notices below this element --></h2>
								<div class="postbox">
									<h3 class="hndle"><?php esc_html_e( 'Premium Features', 'zakra' ); ?></h3>
									<div class="inside" style="padding: 0;margin: 0;">
										<ul>
											<?php foreach ( $pro_feature_links as $pro_feature_text => $pro_feature_link ) : ?>
												<li class="pro-feature">
													<a href="<?php echo esc_url( $pro_feature_link ); ?>" target="_blank"><?php echo esc_html( $pro_feature_text ); ?></a>
													<span>
														<a href=" <?php echo esc_url( $pro_feature_link ); ?>" target="_blank"><?php echo esc_html__( 'Learn More', 'zakra' ); ?></a>
													</span>
												</li>
											<?php endforeach; ?>
										</ul>
									</div>
								</div>
							</div> <!--/.col-70-->
							<div class="col-30">
								<div class="postbox">
									<h3>
										<span class="dashicons dashicons-category"></span>
										<span><?php esc_html_e( 'Get Started', 'zakra' ); ?></span>
									</h3>
									<a href="<?php echo esc_url( 'https://docs.zakratheme.com/en/category/getting-started-1470csx/' ); ?>" target="_blank"><?php esc_html_e( 'Learn Basics &#129066;', 'zakra' ); ?></a>
								</div>
								<div class="postbox">
									<h3 class="hndle" ><span class="dashicons dashicons-download"></span><span><?php esc_html_e( 'Starter Demos', 'zakra' ); ?></span></h3>
									<div class="inside">
										<p>
											<?php
											echo sprintf(
												/* translators: 1: Theme Name, 2: Demo Link. */
												esc_html__( 'You do not need to build your site from scratch, %1$s provides a variety of %2$s', 'zakra' ),
												$theme->Name,
												'<a href="' . esc_url( 'https://zakratheme.com/demos/?utm_source=zakra-options-page&utm_medium=sidebar-link&utm_campaign=demos' ) . '" target="_blank">' . esc_html__( 'Demos.', 'zakra' ) . '</a>'
											);
											?>
										</p>
										<p><?php esc_html_e( 'Import demo site and start editing as your liking.', 'zakra' ); ?></p>
										<?php echo $this->import_button_html(); ?>
									</div>
								</div>
								<div class="postbox">
									<h3 class="hndle">
										<span class="dashicons dashicons-facebook"></span>
										<span>
											<?php
											echo sprintf(
												/* translators: %s: Theme Name. */
												esc_html__( '%s Community', 'zakra' ),
												$theme->Name
											);
											?>
										</span>
									</h3>
									<div class="inside">
										<p>
											<?php
											echo sprintf(
												/* translators: %s: Theme Name. */
												esc_html__( 'Connect with us and other helpful %s users like you.', 'zakra' ),
												$theme->Name
											);
											?>
										</p>
										<a href="<?php echo esc_url( 'https://www.facebook.com/groups/zakratheme/' ); ?>" target="_blank"><?php esc_html_e( 'Join Now &#129066;', 'zakra' ); ?></a>
									</div>
								</div>
								<div class="postbox">
									<h3 class="hndle"><span class="dashicons dashicons-thumbs-up"></span><span><?php esc_html_e( 'Review', 'zakra' ); ?></span></h3>
									<div class="inside">
										<p>
											<?php
											echo sprintf(
												/* translators: 1: Theme Name, 2: Review Link. */
												esc_html__( 'Love using %1$s? Help us by leaving a review %2$s', 'zakra' ),
												$theme->Name,
												'<a href="' . esc_url( 'https://wordpress.org/support/theme/zakra/reviews/' ) . '" target="_blank">' . esc_html__( 'here &#129066;', 'zakra' ) . '</a>'
											);
											?>
										</p>
									</div>
								</div>
							</div><!--/.col-30-->
						</div><!--/.postbox-container-->
					</div><!--/.zakra-container-->
				</div><!--/.metabox-holder-->
			</div><!--/.wrap-->
		<?php
	}
}

Zakra_Dashboard::instance();
