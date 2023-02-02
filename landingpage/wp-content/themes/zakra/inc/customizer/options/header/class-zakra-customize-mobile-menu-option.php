<?php
/**
 * Mobile Menu Options.
 *
 * @package zakra
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/*== MENU > MOBILE MENU ==*/
if ( ! class_exists( 'Zakra_Customize_Mobile_Menu_Option' ) ) :

	/**
	 * Header button customizer options.
	 */
	class Zakra_Customize_Mobile_Menu_Option extends Zakra_Customize_Base_Option {

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
					'name'       => 'zakra_typography_mobile_menu_heading',
					'type'       => 'control',
					'control'    => 'zakra-title',
					'label'      => esc_html__( 'Typography', 'zakra' ),
					'section'    => 'zakra_mobile_menu',
					'priority'   => 200,
					'dependency' => array(
						'zakra_primary_menu_disabled',
						'==',
						false,
					),
				),

				array(
					'name'       => 'zakra_typography_mobile_menu_group',
					'type'       => 'control',
					'control'    => 'zakra-group',
					'label'      => esc_html__( 'Mobile Menu', 'zakra' ),
					'section'    => 'zakra_mobile_menu',
					'priority'   => 205,
					'dependency' => array(
						'zakra_primary_menu_disabled',
						'==',
						false,
					),
				),

				array(
					'name'       => 'zakra_typography_mobile_menu',
					'default'    => array(
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
					'type'       => 'sub-control',
					'control'    => 'zakra-typography',
					'parent'     => 'zakra_typography_mobile_menu_group',
					'section'    => 'zakra_mobile_menu',
					'transport'  => 'postMessage',
					'priority'   => 205,
					'dependency' => array(
						'zakra_primary_menu_disabled',
						'==',
						false,
					),
				),

			);

			$options = array_merge( $options, $configs );

			if ( ! zakra_is_zakra_pro_active() ) {

				$configs[] = array(
					'name'        => 'zakra_mobile_menu_upgrade',
					'type'        => 'control',
					'control'     => 'zakra-upgrade',
					'label'       => esc_html__( 'Learn more', 'zakra' ),
					'description' => esc_html__( 'Unlock more features available for this section.', 'zakra' ),
					'url'         => esc_url( 'https://zakratheme.com/pricing/?utm_source=zakra-customizer&utm_medium=view-pro-link&utm_campaign=zakra-pricing' ),
					'section'     => 'zakra_mobile_menu',
					'priority'    => 210,
				);

				$options = array_merge( $options, $configs );
			}

			return $options;
		}
	}

	new Zakra_Customize_Mobile_Menu_Option();

endif;
