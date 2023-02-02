<?php
/**
 * Header button options.
 *
 * @package zakra
 */

defined( 'ABSPATH' ) || exit;

/*========================================== HEADER > HEADER BUTTON ==========================================*/
if ( ! class_exists( 'Zakra_Customize_Header_Button_Option' ) ) :

	/**
	 * Header main customizer options.
	 */
	class Zakra_Customize_Header_Button_Option extends Zakra_Customize_Base_Option {

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
					'name'     => 'zakra_header_button_text',
					'default'  => '',
					'type'     => 'control',
					'control'  => 'text',
					'label'    => esc_html__( 'Button Text', 'zakra' ),
					'section'  => 'zakra_header_button',
					'priority' => 5,
				),

				array(
					'name'        => 'zakra_header_button_link',
					'default'     => '',
					'type'        => 'control',
					'control'     => 'text',
					'label'       => esc_html__( 'Button Link', 'zakra' ),
					'section'     => 'zakra_header_button',
					'priority'    => 10,
					'input_attrs' => array(
						'placeholder' => esc_attr__( 'https://example.com', 'zakra' ),
					),
				),

				array(
					'name'     => 'zakra_header_button_target',
					'default'  => false,
					'type'     => 'control',
					'control'  => 'zakra-toggle',
					'label'    => esc_html__( 'Open link in a new tab', 'zakra' ),
					'section'  => 'zakra_header_button',
					'priority' => 15,
				),

				array(
					'name'     => 'zakra_header_button_dimensions_heading',
					'type'     => 'control',
					'control'  => 'zakra-title',
					'label'    => esc_html__( 'Dimensions', 'zakra' ),
					'section'  => 'zakra_header_button',
					'priority' => 20,
				),

				array(
					'name'      => 'zakra_header_button_padding',
					'default'   => array(
						'top'    => '5px',
						'right'  => '10px',
						'bottom' => '5px',
						'left'   => '10px',
					),
					'type'      => 'control',
					'control'   => 'zakra-dimensions',
					'label'     => esc_html__( 'Padding', 'zakra' ),
					'section'   => 'zakra_header_button',
					'transport' => 'postMessage',
					'priority'  => 25,
				),

				array(
					'name'     => 'zakra_header_button_color_heading',
					'type'     => 'control',
					'control'  => 'zakra-title',
					'label'    => esc_html__( 'Colors', 'zakra' ),
					'section'  => 'zakra_header_button',
					'priority' => 30,
				),

				array(
					'name'     => 'zakra_header_button_text_color_group',
					'default'  => '',
					'type'     => 'control',
					'control'  => 'zakra-group',
					'label'    => esc_html__( 'Text Color', 'zakra' ),
					'section'  => 'zakra_header_button',
					'priority' => 35,
				),

				array(
					'name'      => 'zakra_header_button_text_color',
					'default'   => '#ffffff',
					'type'      => 'sub-control',
					'control'   => 'zakra-color',
					'parent'    => 'zakra_header_button_text_color_group',
					'tab'       => esc_html__( 'Normal', 'zakra' ),
					'section'   => 'zakra_header_button',
					'transport' => 'postMessage',
					'priority'  => 40,
				),

				array(
					'name'      => 'zakra_header_button_text_hover_color',
					'default'   => '#ffffff',
					'type'      => 'sub-control',
					'control'   => 'zakra-color',
					'parent'    => 'zakra_header_button_text_color_group',
					'tab'       => esc_html__( 'Hover', 'zakra' ),
					'section'   => 'zakra_header_button',
					'transport' => 'postMessage',
					'priority'  => 45,
				),

				array(
					'name'     => 'zakra_header_button_bg_color_group',
					'default'  => '',
					'type'     => 'control',
					'control'  => 'zakra-group',
					'label'    => esc_html__( 'Background Color', 'zakra' ),
					'section'  => 'zakra_header_button',
					'priority' => 50,
				),

				array(
					'name'      => 'zakra_header_button_bg_color',
					'default'   => '#269bd1',
					'type'      => 'sub-control',
					'control'   => 'zakra-color',
					'parent'    => 'zakra_header_button_bg_color_group',
					'tab'       => esc_html__( 'Normal', 'zakra' ),
					'section'   => 'zakra_header_button',
					'transport' => 'postMessage',
					'priority'  => 55,
				),

				array(
					'name'      => 'zakra_header_button_bg_hover_color',
					'default'   => '#1e7ba6',
					'type'      => 'sub-control',
					'control'   => 'zakra-color',
					'parent'    => 'zakra_header_button_bg_color_group',
					'tab'       => esc_html__( 'Hover', 'zakra' ),
					'section'   => 'zakra_header_button',
					'transport' => 'postMessage',
					'priority'  => 60,
				),

				array(
					'name'     => 'zakra_header_button_border_heading',
					'type'     => 'control',
					'control'  => 'zakra-title',
					'label'    => esc_html__( 'Border', 'zakra' ),
					'section'  => 'zakra_header_button',
					'priority' => 80,
				),

				array(
					'name'        => 'zakra_header_button_roundness',
					'default'     => 0,
					'suffix'      => 'px',
					'type'        => 'control',
					'control'     => 'zakra-slider',
					'label'       => esc_html__( 'Roundness', 'zakra' ),
					'section'     => 'zakra_header_button',
					'transport'   => 'postMessage',
					'priority'    => 85,
					'input_attrs' => array(
						'min'  => 0,
						'max'  => 30,
						'step' => 1,
					),
				),

			);

			$options = array_merge( $options, $configs );

			if ( ! zakra_is_zakra_pro_active() ) {

				$configs[] = array(
					'name'        => 'zakra_header_button_upgrade',
					'type'        => 'control',
					'control'     => 'zakra-upgrade',
					'label'       => esc_html__( 'Learn more', 'zakra' ),
					'description' => esc_html__( 'Unlock more features available for this section.', 'zakra' ),
					'url'         => esc_url( 'https://zakratheme.com/pricing/?utm_source=zakra-customizer&utm_medium=view-pro-link&utm_campaign=zakra-pricing' ),
					'section'     => 'zakra_header_button',
					'priority'    => 100,
				);

				$options = array_merge( $options, $configs );
			}

			return $options;
		}

	}

	new Zakra_Customize_Header_Button_Option();

endif;
