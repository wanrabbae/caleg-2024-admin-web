<?php
/**
 * Link Colors.
 *
 * @package     zakra
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/*========================================== COLORS > LINK COLORS ==========================================*/
if ( ! class_exists( 'Zakra_Customize_Link_Colors_Option' ) ) :

	/**
	 * Link option.
	 */
	class Zakra_Customize_Link_Colors_Option extends Zakra_Customize_Base_Option {

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
					'name'     => 'zakra_link_color_heading',
					'type'     => 'control',
					'control'  => 'zakra-title',
					'label'    => esc_html__( 'Link Colors', 'zakra' ),
					'section'  => 'zakra_link_colors',
					'priority' => 5,
				),

				array(
					'name'     => 'zakra_link_color',
					'default'  => '#269bd1',
					'type'     => 'control',
					'control'  => 'zakra-color',
					'label'    => esc_html__( 'Normal', 'zakra' ),
					'section'  => 'zakra_link_colors',
					'priority' => 10,
				),

				array(
					'name'     => 'zakra_link_hover_color',
					'default'  => '#1e7ba6',
					'type'     => 'control',
					'control'  => 'zakra-color',
					'label'    => esc_html__( 'Hover', 'zakra' ),
					'section'  => 'zakra_link_colors',
					'priority' => 15,
				),

			);

			$options = array_merge( $options, $configs );

			if ( ! zakra_is_zakra_pro_active() ) {

				$configs[] = array(
					'name'        => 'zakra_link_colors_upgrade',
					'type'        => 'control',
					'control'     => 'zakra-upgrade',
					'label'       => esc_html__( 'Learn more', 'zakra' ),
					'description' => esc_html__( 'Unlock more features available for this section.', 'zakra' ),
					'url'         => esc_url( 'https://zakratheme.com/pricing/?utm_source=zakra-customizer&utm_medium=view-pro-link&utm_campaign=zakra-pricing' ),
					'section'     => 'zakra_link_colors',
					'priority'    => 100,
				);

				$options = array_merge( $options, $configs );
			}

			return $options;
		}

	}

	new Zakra_Customize_Link_Colors_Option();

endif;
