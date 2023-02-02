<?php
/**
 * Class to register panels and sections for customize options.
 *
 * Class Zakra_Customize_Register_Section_Panels
 *
 * @package    ThemeGrill
 * @subpackage Zakra
 * @since      Zakra 1.5.4
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Zakra_Customize_Register_Section_Panels' ) ) :

	class Zakra_Customize_Register_Section_Panels extends Zakra_Customize_Base_Option {

		/**
		 * Include customize options.
		 *
		 * @param array                 $options      Customize options provided via the theme.
		 * @param \WP_Customize_Manager $wp_customize Theme Customizer object.
		 *
		 * @return mixed|void Customizer options for registering panels, sections as well as controls.
		 */
		public function register_options( $options, $wp_customize ) {

			$configs = array(

				array(
					'name'     => 'zakra_global',
					'type'     => 'panel',
					'title'    => esc_html__( 'Global', 'zakra' ),
					'priority' => 10,
				),

				array(
					'name'     => 'zakra_colors',
					'type'     => 'section',
					'title'    => esc_html__( 'Colors', 'zakra' ),
					'panel'    => 'zakra_global',
					'priority' => 20,
				),

				array(
					'name'     => 'zakra_base_colors',
					'type'     => 'section',
					'title'    => esc_html__( 'Base Colors', 'zakra' ),
					'panel'    => 'zakra_global',
					'section'  => 'zakra_colors',
					'priority' => 10,
				),

				array(
					'name'     => 'zakra_link_colors',
					'type'     => 'section',
					'title'    => esc_html__( 'Link Colors', 'zakra' ),
					'panel'    => 'zakra_global',
					'section'  => 'zakra_colors',
					'priority' => 20,
				),

				array(
					'name'     => 'zakra_background',
					'type'     => 'section',
					'title'    => esc_html__( 'Background', 'zakra' ),
					'panel'    => 'zakra_global',
					'priority' => 30,
				),

				array(
					'name'     => 'zakra_layout',
					'type'     => 'section',
					'title'    => esc_html__( 'Layout', 'zakra' ),
					'panel'    => 'zakra_global',
					'priority' => 40,
				),

				array(
					'name'     => 'zakra_container',
					'type'     => 'section',
					'title'    => esc_html__( 'Container', 'zakra' ),
					'panel'    => 'zakra_global',
					'section'  => 'zakra_layout',
					'priority' => 10,
				),

				array(
					'name'     => 'zakra_sidebar_layout',
					'type'     => 'section',
					'title'    => esc_html__( 'Sidebar Layout', 'zakra' ),
					'panel'    => 'zakra_global',
					'section'  => 'zakra_layout',
					'priority' => 20,
				),

				array(
					'name'     => 'zakra_typography',
					'type'     => 'section',
					'title'    => esc_html__( 'Typography', 'zakra' ),
					'panel'    => 'zakra_global',
					'priority' => 50,
				),

				array(
					'name'     => 'zakra_base_typography',
					'type'     => 'section',
					'title'    => esc_html__( 'Base Typography', 'zakra' ),
					'panel'    => 'zakra_global',
					'section'  => 'zakra_typography',
					'priority' => 10,
				),

				array(
					'name'     => 'zakra_headings_typography',
					'type'     => 'section',
					'title'    => esc_html__( 'Headings ( H1 - H6 )', 'zakra' ),
					'panel'    => 'zakra_global',
					'section'  => 'zakra_typography',
					'priority' => 20,
				),

				array(
					'name'     => 'zakra_link_typography',
					'type'     => 'section',
					'title'    => esc_html__( 'Links', 'zakra' ),
					'panel'    => 'zakra_global',
					'section'  => 'zakra_typography',
					'priority' => 30,
				),

				array(
					'name'     => 'zakra_button',
					'type'     => 'section',
					'title'    => esc_html__( 'Button', 'zakra' ),
					'panel'    => 'zakra_global',
					'priority' => 60,
				),

				array(
					'name'     => 'zakra_header',
					'type'     => 'panel',
					'title'    => esc_html__( 'Header', 'zakra' ),
					'priority' => 20,
				),

				array(
					'name'     => 'title_tagline',
					'type'     => 'section',
					'title'    => esc_html__( 'Site Identity', 'zakra' ),
					'panel'    => 'zakra_header',
					'priority' => 10,
				),

				array(
					'name'     => 'header_image',
					'type'     => 'section',
					'title'    => esc_html__( 'Header Media', 'zakra' ),
					'panel'    => 'zakra_header',
					'priority' => 20,
				),

				array(
					'name'     => 'zakra_header_top',
					'type'     => 'section',
					'title'    => esc_html__( 'Header Top Bar', 'zakra' ),
					'panel'    => 'zakra_header',
					'priority' => 30,
				),

				array(
					'name'     => 'zakra_header_main',
					'type'     => 'section',
					'title'    => esc_html__( 'Header Main Area', 'zakra' ),
					'panel'    => 'zakra_header',
					'priority' => 40,
				),

				array(
					'name'     => 'zakra_header_button',
					'type'     => 'section',
					'title'    => esc_html__( 'Header Button', 'zakra' ),
					'panel'    => 'zakra_header',
					'priority' => 50,
				),

				array(
					'name'     => 'zakra_menu',
					'type'     => 'section',
					'title'    => esc_html__( 'Menu', 'zakra' ),
					'panel'    => 'zakra_header',
					'priority' => 100,
				),

				array(
					'name'     => 'zakra_primary_menu',
					'type'     => 'section',
					'title'    => esc_html__( 'Primary Menu', 'zakra' ),
					'panel'    => 'zakra_header',
					'section'  => 'zakra_menu',
					'priority' => 10,
				),

				array(
					'name'     => 'zakra_primary_menu_item',
					'type'     => 'section',
					'title'    => esc_html__( 'Primary Menu : Menu Item', 'zakra' ),
					'panel'    => 'zakra_header',
					'section'  => 'zakra_menu',
					'priority' => 20,
				),

				array(
					'name'     => 'zakra_primary_menu_dropdown_item',
					'type'     => 'section',
					'title'    => esc_html__( 'Primary Menu : Dropdown Item', 'zakra' ),
					'panel'    => 'zakra_header',
					'section'  => 'zakra_menu',
					'priority' => 30,
				),

				array(
					'name'     => 'zakra_mobile_menu',
					'type'     => 'section',
					'title'    => esc_html__( 'Mobile Menu', 'zakra' ),
					'panel'    => 'zakra_header',
					'section'  => 'zakra_menu',
					'priority' => 30,
				),

				array(
					'name'     => 'zakra_content',
					'type'     => 'panel',
					'title'    => esc_html__( 'Content', 'zakra' ),
					'priority' => 30,
				),

				array(
					'name'     => 'zakra_page_header',
					'type'     => 'section',
					'title'    => esc_html__( 'Page Header', 'zakra' ),
					'panel'    => 'zakra_content',
					'priority' => 10,
				),

				array(
					'name'     => 'zakra_archive_blog',
					'type'     => 'section',
					'title'    => esc_html__( 'Blog/Archive', 'zakra' ),
					'panel'    => 'zakra_content',
					'priority' => 20,
				),

				array(
					'name'     => 'zakra_single_blog_post',
					'type'     => 'section',
					'title'    => esc_html__( 'Single Post', 'zakra' ),
					'panel'    => 'zakra_content',
					'priority' => 30,
				),

				array(
					'name'     => 'zakra_meta',
					'type'     => 'section',
					'title'    => esc_html__( 'Meta', 'zakra' ),
					'panel'    => 'zakra_content',
					'priority' => 40,
				),

				array(
					'name'     => 'zakra_sidebar',
					'type'     => 'section',
					'title'    => esc_html__( 'Sidebar', 'zakra' ),
					'panel'    => 'zakra_content',
					'priority' => 60,
				),

				array(
					'name'     => 'zakra_footer',
					'type'     => 'panel',
					'title'    => esc_html__( 'Footer', 'zakra' ),
					'priority' => 35,
				),

				array(
					'name'     => 'zakra_footer_widgets',
					'type'     => 'section',
					'title'    => esc_html__( 'Footer Widgets', 'zakra' ),
					'panel'    => 'zakra_footer',
					'priority' => 10,
				),

				array(
					'name'     => 'zakra_footer_bottom_bar',
					'type'     => 'section',
					'title'    => esc_html__( 'Footer Bottom Bar', 'zakra' ),
					'panel'    => 'zakra_footer',
					'priority' => 20,
				),

				array(
					'name'     => 'zakra_footer_scroll_to_top',
					'type'     => 'section',
					'title'    => esc_html__( 'Scroll to Top', 'zakra' ),
					'panel'    => 'zakra_footer',
					'priority' => 30,
				),

				array(
					'name'     => 'zakra_woocommerce_sidebar_layout',
					'type'     => 'section',
					'title'    => esc_html__( 'Sidebar Layout', 'zakra' ),
					'panel'    => 'woocommerce',
					'priority' => 4,
				),

				array(
					'name'             => 'zakra-section-separator',
					'type'             => 'section',
					'priority'         => 37,
					'section_callback' => 'Zakra_WP_Customize_Separator',
				),

                array(
                    'name'             => 'zakra_customize_review_link_section',
                    'type'             => 'section',
                    'title'            => esc_html__( 'Leave a Review on .org', 'zakra' ),
                    'url'              => 'https://wordpress.org/support/theme/zakra/reviews/?filter=5/#new-post',
                    'priority'         => 200,
                    'section_callback' => 'Zakra_Upsell_Section',
                ),
			);

			$options = array_merge( $options, $configs );

			if ( ! zakra_is_zakra_pro_active() ) {

				$configs[] = array(
					'name'             => 'zakra_customize_upsell_section',
					'type'             => 'section',
					'title'            => esc_html__( 'View Pro Version', 'zakra' ),
					'url'              => 'https://zakratheme.com/pricing/?utm_source=zakra-customizer&utm_medium=view-pro-link&utm_campaign=zakra-pricing',
					'priority'         => 1,
					'section_callback' => 'Zakra_Upsell_Section',
				);

				$options = array_merge( $options, $configs );
			}

			return $options;
		}
	}

	new Zakra_Customize_Register_Section_Panels();

endif;
