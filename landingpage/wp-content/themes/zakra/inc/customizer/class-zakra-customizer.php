<?php
/**
 * Zakra Customizer Class
 *
 * @package zakra
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Include the customizer framework.
require_once dirname( __FILE__ ) . '/core/class-zakra-customizer-framework.php';
// Include the customizer base class.
require_once dirname( __FILE__ ) . '/core/class-zakra-customize-base-option.php';

if ( ! class_exists( 'Zakra_Customizer' ) ) :

	/**
	 * Zakra Customizer class
	 */
	class Zakra_Customizer {
		/**
		 * Constructor - Setup customizer
		 */
		public function __construct() {
			add_action( 'customize_register', array( $this, 'zakra_customize_register' ) );
			add_action( 'customize_register', array( $this, 'zakra_customize_options_file_include' ), 1 );
			add_filter( 'zakra_default_variants', array( $this, 'add_font_variants' ) );
			add_filter( 'zakra_fontawesome_src', array( $this, 'fontawesome_src' ) );
		}

		/**
		 * Include the required files for extending the custom Customize controls.
		 *
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 */
		public function zakra_customize_register( $wp_customize ) {

			// Override default.
			require ZAKRA_PARENT_CUSTOMIZER_DIR . '/override-defaults.php';
			require ZAKRA_PARENT_CUSTOMIZER_DIR . '/class-zakra-customizer-partials.php';
		}

		public function zakra_customize_options_file_include() {

			// Include the required customize section and panels register file.
			require ZAKRA_PARENT_CUSTOMIZER_DIR . '/class-zakra-customizer-register-panels-sections.php';

			/**
			 * Include the required customize options file.
			 */
			// Global.
			require ZAKRA_PARENT_CUSTOMIZER_DIR . '/options/global/class-zakra-customize-container-option.php';
			require ZAKRA_PARENT_CUSTOMIZER_DIR . '/options/global/class-zakra-customize-base-colors-option.php';
			require ZAKRA_PARENT_CUSTOMIZER_DIR . '/options/global/class-zakra-customize-link-colors-option.php';
			require ZAKRA_PARENT_CUSTOMIZER_DIR . '/options/global/class-zakra-customize-background-option.php';
			require ZAKRA_PARENT_CUSTOMIZER_DIR . '/options/global/class-zakra-customize-sidebar-layout-option.php';
			require ZAKRA_PARENT_CUSTOMIZER_DIR . '/options/global/class-zakra-customize-typography-option.php';
			require ZAKRA_PARENT_CUSTOMIZER_DIR . '/options/global/class-zakra-customize-headings-typography-option.php';
			require ZAKRA_PARENT_CUSTOMIZER_DIR . '/options/global/class-zakra-customize-button-option.php';

			// Header.
			require ZAKRA_PARENT_CUSTOMIZER_DIR . '/options/header/class-zakra-customize-site-identity-option.php';
			require ZAKRA_PARENT_CUSTOMIZER_DIR . '/options/header/class-zakra-customize-header-media-option.php';
			require ZAKRA_PARENT_CUSTOMIZER_DIR . '/options/header/class-zakra-customize-header-top-option.php';
			require ZAKRA_PARENT_CUSTOMIZER_DIR . '/options/header/class-zakra-customize-header-main-option.php';
			require ZAKRA_PARENT_CUSTOMIZER_DIR . '/options/header/class-zakra-customize-header-button-option.php';
			require ZAKRA_PARENT_CUSTOMIZER_DIR . '/options/header/class-zakra-customize-primary-menu-option.php';
			require ZAKRA_PARENT_CUSTOMIZER_DIR . '/options/header/class-zakra-customize-primary-menu-item-option.php';
			require ZAKRA_PARENT_CUSTOMIZER_DIR . '/options/header/class-zakra-customize-primary-menu-dropdown-item-option.php';
			require ZAKRA_PARENT_CUSTOMIZER_DIR . '/options/header/class-zakra-customize-mobile-menu-option.php';

			// Content.
			require ZAKRA_PARENT_CUSTOMIZER_DIR . '/options/content/class-zakra-customize-page-header-option.php';
			require ZAKRA_PARENT_CUSTOMIZER_DIR . '/options/content/class-zakra-customize-blog-archive-option.php';
			require ZAKRA_PARENT_CUSTOMIZER_DIR . '/options/content/class-zakra-customize-single-blog-post-option.php';
			require ZAKRA_PARENT_CUSTOMIZER_DIR . '/options/content/class-zakra-customize-blog-meta-option.php';
			require ZAKRA_PARENT_CUSTOMIZER_DIR . '/options/content/class-zakra-customize-blog-sidebar-option.php';

			// Footer.
			require ZAKRA_PARENT_CUSTOMIZER_DIR . '/options/footer/class-zakra-customize-footer-bottom-bar-option.php';
			require ZAKRA_PARENT_CUSTOMIZER_DIR . '/options/footer/class-zakra-customize-footer-widget-option.php';
			require ZAKRA_PARENT_CUSTOMIZER_DIR . '/options/footer/class-zakra-customize-scroll-to-top-option.php';

			// Blog.
			require ZAKRA_PARENT_CUSTOMIZER_DIR . '/options/woocommerce/class-zakra-customize-layout-woocommerce-option.php';
		}

		/**
		 * @param $array
		 *
		 * @return mixed
		 */
		public function add_font_variants( $array ) {
			$array[] = '500';
			$array[] = '500italic';
			$array[] = '700italic';

			return $array;
		}

		/**
		 * @param $path
		 *
		 * @return string
		 */
		public function fontawesome_src( $path ) {
			$path = '/assets/lib/font-awesome/css/font-awesome';

			return $path;
		}
	}
endif;

new Zakra_Customizer();
