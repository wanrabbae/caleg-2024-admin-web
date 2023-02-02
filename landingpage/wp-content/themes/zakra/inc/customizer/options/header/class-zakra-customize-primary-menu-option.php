<?php
/**
 * Primary menu.
 *
 * @package zakra
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/*== MENU > PRIMARY MENU ==*/
if ( ! class_exists( 'Zakra_Customize_Primary_Menu_Option' ) ) :

	/**
	 * Primary Menu option.
	 */
	class Zakra_Customize_Primary_Menu_Option extends Zakra_Customize_Base_Option {

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
					'name'     => 'zakra_primary_menu_disabled',
					'default'  => false,
					'type'     => 'control',
					'control'  => 'zakra-toggle',
					'label'    => esc_html__( 'Disable Primary Menu', 'zakra' ),
					'section'  => 'zakra_primary_menu',
					'priority' => 10,
				),

				array(
					'name'       => 'zakra_primary_menu_extra',
					'default'    => false,
					'type'       => 'control',
					'control'    => 'zakra-toggle',
					'label'      => esc_html__( 'Keep Menu Items on One Line', 'zakra' ),
					'section'    => 'zakra_primary_menu',
					'priority'   => 20,
					'dependency' => array(
						'zakra_primary_menu_disabled',
						'==',
						false,
					),
				),

				array(
					'name'       => 'zakra_primary_menu_border_heading',
					'type'       => 'control',
					'control'    => 'zakra-title',
					'label'      => esc_html__( 'Border Bottom', 'zakra' ),
					'section'    => 'zakra_primary_menu',
					'priority'   => 80,
					'dependency' => array(
						'zakra_primary_menu_disabled',
						'==',
						false,
					),
				),

				array(
					'name'        => 'zakra_primary_menu_border_bottom_width',
					'default'     => 0,
					'suffix'      => 'px',
					'type'        => 'control',
					'control'     => 'zakra-slider',
					'label'       => esc_html__( 'Size', 'zakra' ),
					'section'     => 'zakra_primary_menu',
					'transport'   => 'postMessage',
					'priority'    => 90,
					'input_attrs' => array(
						'min'  => 0,
						'max'  => 20,
						'step' => 1,
					),
					'dependency'  => array(
						'zakra_primary_menu_disabled',
						'==',
						false,
					),
				),

				array(
					'name'       => 'zakra_primary_menu_border_bottom_color',
					'default'    => '#e9ecef',
					'type'       => 'control',
					'control'    => 'zakra-color',
					'label'      => esc_html__( 'Color', 'zakra' ),
					'section'    => 'zakra_primary_menu',
					'transport'  => 'postMessage',
					'priority'   => 100,
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
					'name'        => 'zakra_primary_menu_upgrade',
					'type'        => 'control',
					'control'     => 'zakra-upgrade',
					'label'       => esc_html__( 'Learn more', 'zakra' ),
					'description' => esc_html__( 'Unlock more features available for this section.', 'zakra' ),
					'url'         => esc_url( 'https://zakratheme.com/pricing/?utm_source=zakra-customizer&utm_medium=view-pro-link&utm_campaign=zakra-pricing' ),
					'section'     => 'zakra_primary_menu',
					'priority'    => 110,
				);

				$options = array_merge( $options, $configs );
			}

			return $options;
		}

	}

	new Zakra_Customize_Primary_Menu_Option();

endif;
