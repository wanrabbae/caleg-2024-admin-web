<?php
/**
 * Primary menu item.
 *
 * @package zakra
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/*============================ MENU > PRIMARY MENU ITEM ============================*/
if ( ! class_exists( 'Zakra_Customize_Primary_Menu_Item_Option' ) ) :

	/**
	 * Primary Menu option.
	 */
	class Zakra_Customize_Primary_Menu_Item_Option extends Zakra_Customize_Base_Option {

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
					'name'            => 'zakra_primary_menu_text_active_effect',
					'default'         => 'tg-primary-menu--style-underline',
					'type'            => 'control',
					'control'         => 'select',
					'label'           => esc_html__( 'Active Menu Item Style', 'zakra' ),
					'choices'         => array(
						'tg-primary-menu--style-none'      => esc_html__( 'None', 'zakra' ),
						'tg-primary-menu--style-underline' => esc_html__( 'Underline Border', 'zakra' ),
						'tg-primary-menu--style-left-border' => esc_html__( 'Left Border', 'zakra' ),
						'tg-primary-menu--style-right-border' => esc_html__( 'Right Border', 'zakra' ),
					),
					'section'         => 'zakra_primary_menu_item',
					'priority'        => 20,
					'active_callback' => function () {
						if ( 'default' === get_theme_mod( 'zakra_primary_menu_item_style', 'default' ) && ! get_theme_mod( 'zakra_primary_menu_disabled', false ) ) {
							return true;
						}

						return false;
					},
				),

				array(
					'name'       => 'zakra_primary_menu_item_colors_heading',
					'type'       => 'control',
					'control'    => 'zakra-title',
					'label'      => esc_html__( 'Colors', 'zakra' ),
					'section'    => 'zakra_primary_menu_item',
					'priority'   => 50,
					'dependency' => array(
						'zakra_primary_menu_disabled',
						'==',
						false,
					),
				),

				array(
					'name'            => 'zakra_primary_menu_text_color_group',
					'type'            => 'control',
					'control'         => 'zakra-group',
					'label'           => esc_html__( 'Menu Item', 'zakra' ),
					'section'         => 'zakra_primary_menu_item',
					'priority'        => 55,
					'active_callback' => function () {
						if ( 'default' === get_theme_mod( 'zakra_primary_menu_item_style', 'default' ) && ! get_theme_mod( 'zakra_primary_menu_disabled', false ) ) {
							return true;
						}

						return false;
					},
				),

				array(
					'name'            => 'zakra_primary_menu_text_color',
					'default'         => '',
					'type'            => 'sub-control',
					'control'         => 'zakra-color',
					'parent'          => 'zakra_primary_menu_text_color_group',
					'tab'             => esc_html__( 'Normal', 'zakra' ),
					'section'         => 'zakra_primary_menu_item',
					'transport'       => 'postMessage',
					'priority'        => 55,
					'active_callback' => function () {
						if ( 'default' === get_theme_mod( 'zakra_primary_menu_item_style', 'default' ) && ! get_theme_mod( 'zakra_primary_menu_disabled', false ) ) {
							return true;
						}

						return false;
					},
				),

				array(
					'name'            => 'zakra_primary_menu_text_hover_color',
					'default'         => '',
					'type'            => 'sub-control',
					'control'         => 'zakra-color',
					'parent'          => 'zakra_primary_menu_text_color_group',
					'tab'             => esc_html__( 'Hover', 'zakra' ),
					'section'         => 'zakra_primary_menu_item',
					'transport'       => 'postMessage',
					'priority'        => 55,
					'active_callback' => function () {
						if ( 'default' === get_theme_mod( 'zakra_primary_menu_item_style', 'default' ) && ! get_theme_mod( 'zakra_primary_menu_disabled', false ) ) {
							return true;
						}

						return false;
					},
				),

				array(
					'name'            => 'zakra_primary_menu_text_active_color',
					'default'         => '',
					'type'            => 'sub-control',
					'control'         => 'zakra-color',
					'parent'          => 'zakra_primary_menu_text_color_group',
					'tab'             => esc_html__( 'Active', 'zakra' ),
					'section'         => 'zakra_primary_menu_item',
					'transport'       => 'postMessage',
					'priority'        => 55,
					'active_callback' => function () {
						if ( 'default' === get_theme_mod( 'zakra_primary_menu_item_style', 'default' ) && ! get_theme_mod( 'zakra_primary_menu_disabled', false ) ) {
							return true;
						}

						return false;
					},
				),

				array(
					'name'       => 'zakra_typography_primary_menu_heading',
					'type'       => 'control',
					'control'    => 'zakra-title',
					'label'      => esc_html__( 'Typography', 'zakra' ),
					'section'    => 'zakra_primary_menu_item',
					'priority'   => 115,
					'dependency' => array(
						'zakra_primary_menu_disabled',
						'==',
						false,
					),
				),

				array(
					'name'       => 'zakra_typography_primary_menu_group',
					'type'       => 'control',
					'control'    => 'zakra-group',
					'label'      => esc_html__( 'Primary Menu', 'zakra' ),
					'section'    => 'zakra_primary_menu_item',
					'priority'   => 120,
					'dependency' => array(
						'zakra_primary_menu_disabled',
						'==',
						false,
					),
				),

				array(
					'name'        => 'zakra_typography_primary_menu',
					'default'     => array(
						'font-family'    => 'default',
						'font-weight'    => 'regular',
						'font-size'      => array(
							'desktop' => '1rem',
							'tablet'  => '',
							'mobile'  => '',
						),
						'line-height'    => array(
							'desktop' => '1.8',
							'tablet'  => '',
							'mobile'  => '',
						),
						'font-style'     => 'normal',
						'text-transform' => 'none',
					),
					'input_attrs' => array(
						'desktop' => array(
							'font-size'   => array(
								'step' => 0.1,
								'min'  => 0.5,
								'max'  => 3,
							),
							'line-height' => array(
								'step' => 0.1,
								'min'  => 0,
								'max'  => 3,
							),
						),
						'tablet'  => array(
							'font-size'   => array(
								'step' => 0.1,
								'min'  => 0.5,
								'max'  => 3,
							),
							'line-height' => array(
								'step' => 0.1,
								'min'  => 0,
								'max'  => 3,
							),
						),
						'mobile'  => array(
							'font-size'   => array(
								'step' => 0.1,
								'min'  => 0.5,
								'max'  => 3,
							),
							'line-height' => array(
								'step' => 0.1,
								'min'  => 0,
								'max'  => 3,
							),
						),
					),
					'type'        => 'sub-control',
					'control'     => 'zakra-typography',
					'parent'      => 'zakra_typography_primary_menu_group',
					'section'     => 'zakra_primary_menu_item',
					'transport'   => 'postMessage',
					'priority'    => 120,
					'dependency'  => array(
						'zakra_primary_menu_disabled',
						'==',
						false,
					),
				),

			);

			$options = array_merge( $options, $configs );

			if ( ! zakra_is_zakra_pro_active() ) {

				$configs[] = array(
					'name'        => 'zakra_primary_menu_item_upgrade',
					'type'        => 'control',
					'control'     => 'zakra-upgrade',
					'label'       => esc_html__( 'Learn more', 'zakra' ),
					'description' => esc_html__( 'Unlock more features available for this section.', 'zakra' ),
					'url'         => esc_url( 'https://zakratheme.com/pricing/?utm_source=zakra-customizer&utm_medium=view-pro-link&utm_campaign=zakra-pricing' ),
					'section'     => 'zakra_primary_menu_item',
					'priority'    => 125,
				);

				$options = array_merge( $options, $configs );
			}

			return $options;
		}


	}

	new Zakra_Customize_Primary_Menu_Item_Option();

endif;
