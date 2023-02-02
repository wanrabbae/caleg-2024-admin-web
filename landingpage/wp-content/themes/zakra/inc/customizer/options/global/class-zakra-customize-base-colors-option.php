<?php
/**
 * Base Colors.
 *
 * @package     zakra
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/*========================================== COLORS > BASE COLORS ==========================================*/
if ( ! class_exists( 'Zakra_Customize_Base_Colors_Option' ) ) :

	/**
	 * Base option.
	 */
	class Zakra_Customize_Base_Colors_Option extends Zakra_Customize_Base_Option {

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
					'name'     => 'zakra_base_color_primary',
					'default'  => '#269bd1',
					'type'     => 'control',
					'control'  => 'zakra-color',
					'label'    => esc_html__( 'Primary Color', 'zakra' ),
					'section'  => 'zakra_base_colors',
					'priority' => 5,
				),

				array(
					'name'     => 'zakra_base_color_text',
					'default'  => '#51585f',
					'type'     => 'control',
					'control'  => 'zakra-color',
					'label'    => esc_html__( 'Text Color', 'zakra' ),
					'section'  => 'zakra_base_colors',
					'priority' => 20,
				),

				array(
					'name'     => 'zakra_base_color_border',
					'default'  => '#e9ecef',
					'type'     => 'control',
					'control'  => 'zakra-color',
					'label'    => esc_html__( 'Border Color', 'zakra' ),
					'section'  => 'zakra_base_colors',
					'priority' => 30,
				),

			);

			$options = array_merge( $options, $configs );

			if ( ! zakra_is_zakra_pro_active() ) {

				$configs[] = array(
					'name'        => 'zakra_base_colors_upgrade',
					'type'        => 'control',
					'control'     => 'zakra-upgrade',
					'label'       => esc_html__( 'Learn more', 'zakra' ),
					'description' => esc_html__( 'Unlock more features available for this section.', 'zakra' ),
					'url'         => esc_url( 'https://zakratheme.com/pricing/?utm_source=zakra-customizer&utm_medium=view-pro-link&utm_campaign=zakra-pricing' ),
					'section'     => 'zakra_base_colors',
					'priority'    => 100,
				);

				$options = array_merge( $options, $configs );
			}

			return $options;
		}

	}

	new Zakra_Customize_Base_Colors_Option();

endif;
