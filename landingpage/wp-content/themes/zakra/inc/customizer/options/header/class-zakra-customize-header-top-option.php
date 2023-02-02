<?php
/**
 * Header top options.
 *
 * @package     zakra
 */

defined( 'ABSPATH' ) || exit;

/*========================================== HEADER > HEADER TOP ==========================================*/
if ( ! class_exists( 'Zakra_Customize_Header_Top_Option' ) ) :

	/**
	 * Header top customizer options.
	 */
	class Zakra_Customize_Header_Top_Option extends Zakra_Customize_Base_Option {

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
					'name'     => 'zakra_header_top_enabled',
					'default'  => false,
					'type'     => 'control',
					'control'  => 'zakra-toggle',
					'label'    => esc_html__( 'Enable Header Top Bar', 'zakra' ),
					'section'  => 'zakra_header_top',
					'priority' => 5,
				),

				array(
					'name'       => 'zakra_header_top_left_content_heading',
					'type'       => 'control',
					'control'    => 'zakra-title',
					'label'      => esc_html__( 'Left Content', 'zakra' ),
					'section'    => 'zakra_header_top',
					'priority'   => 50,
					'dependency' => array(
						'zakra_header_top_enabled',
						'==',
						true,
					),
				),

				array(
					'name'       => 'zakra_header_top_left_content',
					'default'    => 'text_html',
					'type'       => 'control',
					'control'    => 'select',
					'section'    => 'zakra_header_top',
					'choices'    => array(
						'none'      => esc_html__( 'None', 'zakra' ),
						'text_html' => esc_html__( 'Text/HTML', 'zakra' ),
						'menu'      => esc_html__( 'Menu', 'zakra' ),
						'widget'    => esc_html__( 'Widget', 'zakra' ),
					),
					'priority'   => 55,
					'dependency' => array(
						'zakra_header_top_enabled',
						'==',
						true,
					),
				),

				array(
					'name'       => 'zakra_header_top_left_content_html',
					'default'    => '',
					'type'       => 'control',
					'control'    => 'zakra-editor',
					'section'    => 'zakra_header_top',
					'transport'  => 'postMessage',
					'partial'    => array(
						'selector'        => '.tg-header-top-left-content',
						'render_callback' => 'Zakra_Customizer_Partials::customize_partial_header_top_left_content_html',
					),
					'label'      => esc_html__( 'Text/HTML for Left Content', 'zakra' ),
					'priority'   => 60,
					'dependency' => array(
						'conditions' => array(
							array(
								'zakra_header_top_enabled',
								'==',
								true,
							),
							array(
								'zakra_header_top_left_content',
								'==',
								'text_html',
							),
						),
						'operator'   => 'AND',
					),
				),

				array(
					'name'       => 'zakra_header_top_left_content_menu',
					'default'    => 'none',
					'type'       => 'control',
					'control'    => 'select',
					'section'    => 'zakra_header_top',
					'label'      => esc_html__( 'Select a Menu for Left Content', 'zakra' ),
					'choices'    => zakra_get_menu_options(),
					'priority'   => 65,
					'dependency' => array(
						'conditions' => array(
							array(
								'zakra_header_top_enabled',
								'==',
								true,
							),
							array(
								'zakra_header_top_left_content',
								'==',
								'menu',
							),
						),
						'operator'   => 'AND',
					),
				),

				array(
					'name'       => 'zakra_header_top_right_content_heading',
					'type'       => 'control',
					'control'    => 'zakra-title',
					'label'      => esc_html__( 'Right Content', 'zakra' ),
					'section'    => 'zakra_header_top',
					'priority'   => 75,
					'dependency' => array(
						'zakra_header_top_enabled',
						'==',
						true,
					),
				),

				array(
					'name'       => 'zakra_header_top_right_content',
					'default'    => 'none',
					'type'       => 'control',
					'control'    => 'select',
					'section'    => 'zakra_header_top',
					'choices'    => array(
						'none'      => esc_html__( 'None', 'zakra' ),
						'text_html' => esc_html__( 'Text/HTML', 'zakra' ),
						'menu'      => esc_html__( 'Menu', 'zakra' ),
						'widget'    => esc_html__( 'Widget', 'zakra' ),
					),
					'priority'   => 80,
					'dependency' => array(
						'zakra_header_top_enabled',
						'==',
						true,
					),
				),

				array(
					'name'       => 'zakra_header_top_right_content_html',
					'default'    => '',
					'type'       => 'control',
					'control'    => 'zakra-editor',
					'section'    => 'zakra_header_top',
					'transport'  => 'postMessage',
					'partial'    => array(
						'selector'        => '.tg-header-top-right-content',
						'render_callback' => 'Zakra_Customizer_Partials::customize_partial_header_top_right_content_html',
					),
					'label'      => esc_html__( 'Text/HTML for Right Content', 'zakra' ),
					'priority'   => 85,
					'dependency' => array(
						'conditions' => array(
							array(
								'zakra_header_top_enabled',
								'==',
								true,
							),
							array(
								'zakra_header_top_right_content',
								'==',
								'text_html',
							),
						),
						'operator'   => 'AND',
					),
				),

				array(
					'name'       => 'zakra_header_top_right_content_menu',
					'default'    => 'none',
					'type'       => 'control',
					'control'    => 'select',
					'section'    => 'zakra_header_top',
					'label'      => esc_html__( 'Select a Menu for Right Content', 'zakra' ),
					'choices'    => zakra_get_menu_options(),
					'priority'   => 90,
					'dependency' => array(
						'conditions' => array(
							array(
								'zakra_header_top_enabled',
								'==',
								true,
							),
							array(
								'zakra_header_top_right_content',
								'==',
								'menu',
							),
						),
						'operator'   => 'AND',
					),
				),

				array(
					'name'       => 'zakra_header_top_colors_heading',
					'type'       => 'control',
					'control'    => 'zakra-title',
					'label'      => esc_html__( 'Colors', 'zakra' ),
					'section'    => 'zakra_header_top',
					'priority'   => 115,
					'dependency' => array(
						'zakra_header_top_enabled',
						'==',
						true,
					),
				),

				array(
					'name'       => 'zakra_header_top_text_group',
					'type'       => 'control',
					'control'    => 'zakra-group',
					'label'      => esc_html__( 'Text', 'zakra' ),
					'section'    => 'zakra_header_top',
					'priority'   => 120,
					'dependency' => array(
						'zakra_header_top_enabled',
						'==',
						true,
					),
				),

				array(
					'name'       => 'zakra_header_top_text_color',
					'default'    => '#51585f',
					'type'       => 'sub-control',
					'control'    => 'zakra-color',
					'parent'     => 'zakra_header_top_text_group',
					'section'    => 'zakra_header_top',
					'transport'  => 'postMessage',
					'priority'   => 120,
					'dependency' => array(
						'zakra_header_top_enabled',
						'==',
						true,
					),
				),

				array(
					'name'       => 'zakra_header_top_bg_group',
					'type'       => 'control',
					'control'    => 'zakra-group',
					'label'      => esc_html__( 'Background', 'zakra' ),
					'section'    => 'zakra_header_top',
					'priority'   => 135,
					'dependency' => array(
						'zakra_header_top_enabled',
						'==',
						true,
					),
				),

				array(
					'name'       => 'zakra_header_top_bg',
					'default'    => array(
						'background-color'      => '#e9ecef',
						'background-image'      => '',
						'background-repeat'     => 'repeat',
						'background-position'   => 'center center',
						'background-size'       => 'contain',
						'background-attachment' => 'scroll',
					),
					'type'       => 'sub-control',
					'control'    => 'zakra-background',
					'section'    => 'zakra_header_top',
					'parent'     => 'zakra_header_top_bg_group',
					'transport'  => 'postMessage',
					'priority'   => 135,
					'dependency' => array(
						'zakra_header_top_enabled',
						'==',
						true,
					),
				),

			);

			$options = array_merge( $options, $configs );

			if ( ! zakra_is_zakra_pro_active() ) {

				$configs[] = array(
					'name'        => 'zakra_header_top_upgrade',
					'type'        => 'control',
					'control'     => 'zakra-upgrade',
					'label'       => esc_html__( 'Learn more', 'zakra' ),
					'description' => esc_html__( 'Unlock more features available for this section.', 'zakra' ),
					'url'         => esc_url( 'https://zakratheme.com/pricing/?utm_source=zakra-customizer&utm_medium=view-pro-link&utm_campaign=zakra-pricing' ),
					'section'     => 'zakra_header_top',
					'priority'    => 145,
				);

				$options = array_merge( $options, $configs );
			}

			return $options;
		}

	}

	new Zakra_Customize_Header_Top_Option();

endif;
