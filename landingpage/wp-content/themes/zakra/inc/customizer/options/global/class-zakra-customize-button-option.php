<?php
/**
 * Button.
 *
 * @package     zakra
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/*========================================== STYLING >  BUTTON ==========================================*/
if ( ! class_exists( 'Zakra_Customize_Button_Option' ) ) :

	/**
	 * Button option.
	 */
	class Zakra_Customize_Button_Option extends Zakra_Customize_Base_Option {

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
					'name'     => 'zakra_button_dimensions_heading',
					'type'     => 'control',
					'control'  => 'zakra-title',
					'label'    => esc_html__( 'Dimensions', 'zakra' ),
					'section'  => 'zakra_button',
					'priority' => 5,
				),

				array(
					'name'     => 'zakra_button_padding',
					'default'  => array(
						'top'    => '10px',
						'right'  => '15px',
						'bottom' => '10px',
						'left'   => '15px',
					),
					'type'     => 'control',
					'control'  => 'zakra-dimensions',
					'label'    => esc_html__( 'Padding', 'zakra' ),
					'section'  => 'zakra_button',
					'priority' => 10,
				),

				array(
					'name'     => 'zakra_button_color_heading',
					'type'     => 'control',
					'control'  => 'zakra-title',
					'label'    => esc_html__( 'Colors', 'zakra' ),
					'section'  => 'zakra_button',
					'priority' => 20,
				),

				array(
					'name'     => 'zakra_button_text_color_group',
					'default'  => '',
					'type'     => 'control',
					'control'  => 'zakra-group',
					'label'    => esc_html__( 'Text Color', 'zakra' ),
					'section'  => 'zakra_button',
					'priority' => 25,
				),

				array(
					'name'     => 'zakra_button_text_color',
					'default'  => '#ffffff',
					'type'     => 'sub-control',
					'control'  => 'zakra-color',
					'parent'   => 'zakra_button_text_color_group',
					'tab'      => esc_html__( 'Normal', 'zakra' ),
					'section'  => 'zakra_button',
					'priority' => 25,
				),

				array(
					'name'     => 'zakra_button_text_hover_color',
					'default'  => '#ffffff',
					'type'     => 'sub-control',
					'control'  => 'zakra-color',
					'parent'   => 'zakra_button_text_color_group',
					'tab'      => esc_html__( 'Hover', 'zakra' ),
					'section'  => 'zakra_button',
					'priority' => 25,
				),

				array(
					'name'     => 'zakra_button_bg_color_group',
					'default'  => '',
					'type'     => 'control',
					'control'  => 'zakra-group',
					'label'    => esc_html__( 'Background', 'zakra' ),
					'section'  => 'zakra_button',
					'priority' => 30,
				),

				array(
					'name'     => 'zakra_button_bg_color',
					'default'  => '#269bd1',
					'type'     => 'sub-control',
					'control'  => 'zakra-color',
					'parent'   => 'zakra_button_bg_color_group',
					'tab'      => esc_html__( 'Normal', 'zakra' ),
					'section'  => 'zakra_button',
					'priority' => 30,
				),

				array(
					'name'     => 'zakra_button_bg_hover_color',
					'default'  => '#1e7ba6',
					'type'     => 'sub-control',
					'control'  => 'zakra-color',
					'parent'   => 'zakra_button_bg_color_group',
					'tab'      => esc_html__( 'Hover', 'zakra' ),
					'section'  => 'zakra_button',
					'priority' => 30,
				),

				array(
					'name'     => 'zakra_button_border_heading',
					'type'     => 'control',
					'control'  => 'zakra-title',
					'label'    => esc_html__( 'Border', 'zakra' ),
					'section'  => 'zakra_button',
					'priority' => 35,
				),

				array(
					'name'        => 'zakra_button_roundness',
					'default'     => 0,
					'suffix'      => 'px',
					'type'        => 'control',
					'control'     => 'zakra-slider',
					'label'       => esc_html__( 'Roundness', 'zakra' ),
					'section'     => 'zakra_button',
					'priority'    => 40,
					'input_attrs' => array(
						'min'  => 0,
						'max'  => 20,
						'step' => 1,
					),
				),

			);

			$options = array_merge( $options, $configs );

			if ( ! zakra_is_zakra_pro_active() ) {

				$configs[] = array(
					'name'        => 'zakra_styling_button_upgrade',
					'type'        => 'control',
					'control'     => 'zakra-upgrade',
					'label'       => esc_html__( 'Learn more', 'zakra' ),
					'description' => esc_html__( 'Unlock more features available for this section.', 'zakra' ),
					'url'         => esc_url( 'https://zakratheme.com/pricing/?utm_source=zakra-customizer&utm_medium=view-pro-link&utm_campaign=zakra-pricing' ),
					'section'     => 'zakra_button',
					'priority'    => 100,
				);

				$options = array_merge( $options, $configs );
			}

			return $options;
		}

	}

	new Zakra_Customize_Button_Option();

endif;
