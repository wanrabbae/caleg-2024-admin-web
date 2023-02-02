<?php
/**
 * Primary menu dropdown item options.
 *
 * @package    ThemeGrill
 * @subpackage Zakra
 * @since      Zakra 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/*== MENU > PRIMARY MENU: DROPDOWN ITEM ==*/
if ( ! class_exists( 'Zakra_Customize_Primary_Menu_Dropdown_Item_Option' ) ) :

	/**
	 * Header button customizer options.
	 */
	class Zakra_Customize_Primary_Menu_Dropdown_Item_Option extends Zakra_Customize_Base_Option {

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
					'name'       => 'zakra_typography_primary_menu_dropdown_item_heading',
					'type'       => 'control',
					'control'    => 'zakra-title',
					'label'      => esc_html__( 'Typography', 'zakra' ),
					'section'    => 'zakra_primary_menu_dropdown_item',
					'priority'   => 60,
					'dependency' => array(
						'zakra_primary_menu_disabled',
						'==',
						false,
					),
				),

				array(
					'name'       => 'zakra_typography_primary_menu_dropdown_item_group',
					'type'       => 'control',
					'control'    => 'zakra-group',
					'label'      => esc_html__( 'Dropdown', 'zakra' ),
					'section'    => 'zakra_primary_menu_dropdown_item',
					'priority'   => 70,
					'dependency' => array(
						'zakra_primary_menu_disabled',
						'==',
						false,
					),
				),

				array(
					'name'        => 'zakra_typography_primary_menu_dropdown_item',
					'default'     => array(
						'font-family'    => 'default',
						'font-weight'    => '400',
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
					'parent'      => 'zakra_typography_primary_menu_dropdown_item_group',
					'section'     => 'zakra_primary_menu_dropdown_item',
					'transport'   => 'postMessage',
					'priority'    => 75,
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
					'name'        => 'zakra_primary_menu_drop_down_item_upgrade',
					'type'        => 'control',
					'control'     => 'zakra-upgrade',
					'label'       => esc_html__( 'Learn more', 'zakra' ),
					'description' => esc_html__( 'Unlock more features available for this section.', 'zakra' ),
					'url'         => esc_url( 'https://zakratheme.com/pricing/?utm_source=zakra-customizer&utm_medium=view-pro-link&utm_campaign=zakra-pricing' ),
					'section'     => 'zakra_primary_menu_dropdown_item',
					'priority'    => 100,
				);

				$options = array_merge( $options, $configs );
			}

			return $options;
		}

	}

	new Zakra_Customize_Primary_Menu_Dropdown_Item_Option();

endif;
