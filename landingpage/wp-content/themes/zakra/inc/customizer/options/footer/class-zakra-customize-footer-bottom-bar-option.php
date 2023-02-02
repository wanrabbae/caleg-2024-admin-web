<?php
/**
 * Footer bottom bar options.
 *
 * @package     zakra
 */

defined( 'ABSPATH' ) || exit;

/*========================================== FOOTER > FOOTER  BAR ==========================================*/
if ( ! class_exists( 'Zakra_Customize_Footer_Bottom_Bar_Option' ) ) :

	/**
	 * Footer option.
	 */
	class Zakra_Customize_Footer_Bottom_Bar_Option extends Zakra_Customize_Base_Option {

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
					'name'       => 'zakra_footer_bar_style',
					'default'    => 'tg-site-footer-bar--center',
					'type'       => 'control',
					'control'    => 'zakra-radio-image',
					'label'      => esc_html__( 'Style', 'zakra' ),
					'section'    => 'zakra_footer_bottom_bar',
					'transport'  => 'postMessage',
					'image_col'  => 2,
					'choices'    => apply_filters(
						'zakra_footer_bar_style_choices',
						array(
							'tg-site-footer-bar--left'   => array(
								'label' => '',
								'url'   => ZAKRA_PARENT_INC_ICON_URI . '/footer-left.png',
							),
							'tg-site-footer-bar--center' => array(
								'label' => '',
								'url'   => ZAKRA_PARENT_INC_ICON_URI . '/footer-center.png',
							),
						)
					),
					'dependency' => apply_filters( 'zakra_footer_bar_style_cb', false ),
					'priority'   => 10,
				),

				array(
					'name'       => 'zakra_footer_bar_left_content_heading',
					'type'       => 'control',
					'control'    => 'zakra-title',
					'label'      => esc_html__( 'Left Content', 'zakra' ),
					'section'    => 'zakra_footer_bottom_bar',
					'priority'   => 20,
					'dependency' => apply_filters( 'zakra_footer_bar_section_one_cb', false ),
				),

				array(
					'name'       => 'zakra_footer_bar_section_one',
					'default'    => 'text_html',
					'type'       => 'control',
					'control'    => 'select',
					'section'    => 'zakra_footer_bottom_bar',
					'choices'    => apply_filters(
						'zakra_footer_bar_section_one_choices',
						array(
							'none'      => esc_html__( 'None', 'zakra' ),
							'text_html' => esc_html__( 'Text/HTML', 'zakra' ),
							'menu'      => esc_html__( 'Menu', 'zakra' ),
							'widget'    => esc_html__( 'Widget', 'zakra' ),
						)
					),
					'priority'   => 25,
					'dependency' => apply_filters( 'zakra_footer_bar_section_one_cb', false ),
				),

				array(
					'name'        => 'zakra_footer_bar_section_one_html',
					'default'     => sprintf(
						/* translators: 1: Current Year, 2: Site Name, 3: Theme Link, 4: WordPress Link. */
						esc_html__( 'Copyright &copy; %1$s %2$s. Powered by %3$s and %4$s.', 'zakra' ),
						'{the-year}',
						'{site-link}',
						'{theme-link}',
						'{wp-link}'
					),
					'type'        => 'control',
					'control'     => 'zakra-editor',
					'section'     => 'zakra_footer_bottom_bar',
					'label'       => esc_html__( 'Text/HTML for Left Content', 'zakra' ),
					'description' => wp_kses(
						'<a href="' . esc_url( 'https://docs.zakratheme.com/en/article/dynamic-strings-for-footer-copyright-content-13empt5/' ) . '" target="_blank">' . esc_html__( 'Docs Link', 'zakra' ) . '</a>',
						array(
							'a' => array(
								'href'   => true,
								'target' => true,
							),
						)
					),
					'priority'    => 30,
					'transport'   => 'postMessage',
					'partial'     => array(
						'selector'        => '.tg-site-footer-section-1',
						'render_callback' => 'Zakra_Customizer_Partials::customize_partial_footer_bar_section_one_html',
					),
					'dependency'  => apply_filters(
						'zakra_footer_bar_section_one_html_cb',
						array(
							'zakra_footer_bar_section_one',
							'==',
							'text_html',
						)
					),
				),

				array(
					'name'       => 'zakra_footer_bar_section_one_menu',
					'default'    => 'none',
					'type'       => 'control',
					'control'    => 'select',
					'section'    => 'zakra_footer_bottom_bar',
					'label'      => esc_html__( 'Select a Menu for Left Content', 'zakra' ),
					'choices'    => zakra_get_menu_options(),
					'priority'   => 35,
					'dependency' => array(
						'conditions' => array(
							apply_filters(
								'zakra_footer_bar_section_one_menu_cb',
								array(
									'zakra_footer_bar_section_one',
									'==',
									'menu',
								)
							),
							apply_filters( 'zakra_footer_bar_section_one_cb', false ),
						),
						'operator'   => 'AND',
					),
				),

				array(
					'name'       => 'zakra_footer_bar_right_content_heading',
					'type'       => 'control',
					'control'    => 'zakra-title',
					'label'      => esc_html__( 'Right Content', 'zakra' ),
					'section'    => 'zakra_footer_bottom_bar',
					'priority'   => 40,
					'dependency' => apply_filters( 'zakra_footer_bar_section_one_cb', false ),
				),

				array(
					'name'       => 'zakra_footer_bar_section_two',
					'default'    => 'text_html',
					'type'       => 'control',
					'control'    => 'select',
					'section'    => 'zakra_footer_bottom_bar',
					'choices'    => apply_filters(
						'zakra_footer_bar_section_two_choices',
						array(
							'none'      => esc_html__( 'None', 'zakra' ),
							'text_html' => esc_html__( 'Text/HTML', 'zakra' ),
							'menu'      => esc_html__( 'Menu', 'zakra' ),
							'widget'    => esc_html__( 'Widget', 'zakra' ),
						)
					),
					'priority'   => 45,
					'dependency' => apply_filters( 'zakra_footer_bar_section_two_cb', false ),
				),

				array(
					'name'       => 'zakra_footer_bar_section_two_html',
					'default'    => '',
					'type'       => 'control',
					'control'    => 'zakra-editor',
					'section'    => 'zakra_footer_bottom_bar',
					'label'      => esc_html__( 'Text/HTML for Left Content', 'zakra' ),
					'transport'  => 'postMessage',
					'partial'    => array(
						'selector'        => '.tg-site-footer-section-2',
						'render_callback' => 'Zakra_Customizer_Partials::customize_partial_footer_bar_section_two_html',
					),
					'priority'   => 50,
					'dependency' => apply_filters(
						'zakra_footer_bar_section_two_html_cb',
						array(
							'zakra_footer_bar_section_two',
							'===',
							'text_html',
						)
					),
				),

				array(
					'name'       => 'zakra_footer_bar_section_two_menu',
					'default'    => 'none',
					'type'       => 'control',
					'control'    => 'select',
					'section'    => 'zakra_footer_bottom_bar',
					'label'      => esc_html__( 'Select a Menu for Left Content', 'zakra' ),
					'choices'    => zakra_get_menu_options(),
					'priority'   => 55,
					'dependency' => apply_filters(
						'zakra_footer_bar_section_two_menu_cb',
						array(
							'zakra_footer_bar_section_two',
							'===',
							'menu',
						)
					),
				),

				array(
					'name'       => 'zakra_footer_bar_colors_heading',
					'type'       => 'control',
					'control'    => 'zakra-title',
					'label'      => esc_html__( 'Colors', 'zakra' ),
					'section'    => 'zakra_footer_bottom_bar',
					'priority'   => 70,
					'dependency' => apply_filters( 'zakra_footer_color_heading_cb', false ),
				),

				array(
					'name'       => 'zakra_footer_bar_bg_group',
					'type'       => 'control',
					'control'    => 'zakra-group',
					'label'      => esc_html__( 'Background', 'zakra' ),
					'section'    => 'zakra_footer_bottom_bar',
					'priority'   => 75,
					'dependency' => apply_filters( 'zakra_footer_bar_text_color_cb', false ),
				),

				array(
					'name'       => 'zakra_footer_bar_bg',
					'default'    => array(
						'background-color'      => '#ffffff',
						'background-image'      => '',
						'background-repeat'     => 'repeat',
						'background-position'   => 'center center',
						'background-size'       => 'contain',
						'background-attachment' => 'scroll',
					),
					'type'       => 'sub-control',
					'control'    => 'zakra-background',
					'parent'     => 'zakra_footer_bar_bg_group',
					'section'    => 'zakra_footer_bottom_bar',
					'transport'  => 'postMessage',
					'priority'   => 75,
					'dependency' => apply_filters( 'zakra_footer_bar_bg_cb', false ),
				),

				array(
					'name'       => 'zakra_footer_bar_text_color_group',
					'type'       => 'control',
					'control'    => 'zakra-group',
					'label'      => esc_html__( 'Text', 'zakra' ),
					'section'    => 'zakra_footer_bottom_bar',
					'priority'   => 80,
					'dependency' => apply_filters( 'zakra_footer_bar_text_color_cb', false ),
				),

				array(
					'name'       => 'zakra_footer_bar_text_color',
					'default'    => '#51585f',
					'type'       => 'sub-control',
					'control'    => 'zakra-color',
					'parent'     => 'zakra_footer_bar_text_color_group',
					'section'    => 'zakra_footer_bottom_bar',
					'transport'  => 'postMessage',
					'priority'   => 80,
					'dependency' => apply_filters( 'zakra_footer_bar_text_color_cb', false ),
				),

				array(
					'name'       => 'zakra_footer_bar_link_color_group',
					'default'    => '',
					'type'       => 'control',
					'control'    => 'zakra-group',
					'section'    => 'zakra_footer_bottom_bar',
					'label'      => esc_html__( 'Link', 'zakra' ),
					'priority'   => 85,
					'dependency' => apply_filters( 'zakra_footer_bar_link_color_group_cb', false ),
				),

				array(
					'name'       => 'zakra_footer_bar_link_color',
					'default'    => '#16181a',
					'type'       => 'sub-control',
					'control'    => 'zakra-color',
					'parent'     => 'zakra_footer_bar_link_color_group',
					'tab'        => esc_html__( 'Normal', 'zakra' ),
					'section'    => 'zakra_footer_bottom_bar',
					'transport'  => 'postMessage',
					'priority'   => 85,
					'dependency' => apply_filters( 'zakra_footer_bar_link_color_cb', false ),
				),

				array(
					'name'       => 'zakra_footer_bar_link_hover_color',
					'default'    => '#269bd1',
					'type'       => 'sub-control',
					'control'    => 'zakra-color',
					'parent'     => 'zakra_footer_bar_link_color_group',
					'tab'        => esc_html__( 'Hover', 'zakra' ),
					'section'    => 'zakra_footer_bottom_bar',
					'transport'  => 'postMessage',
					'priority'   => 85,
					'dependency' => apply_filters( 'zakra_footer_bar_link_hover_color_cb', false ),
				),

				array(
					'name'       => 'zakra_footer_bar_border_heading',
					'type'       => 'control',
					'control'    => 'zakra-title',
					'label'      => esc_html__( 'Border Top', 'zakra' ),
					'section'    => 'zakra_footer_bottom_bar',
					'priority'   => 120,
					'dependency' => apply_filters( 'zakra_footer_bar_border_heading_cb', false ),
				),

				array(
					'name'       => 'zakra_footer_bar_border_top_width',
					'default'    => 0,
					'suffix'     => 'px',
					'type'       => 'control',
					'control'    => 'zakra-slider',
					'label'      => esc_html__( 'Size', 'zakra' ),
					'section'    => 'zakra_footer_bottom_bar',
					'transport'  => 'postMessage',
					'priority'   => 125,
					'dependency' => apply_filters( 'zakra_footer_bar_border_top_width_cb', false ),
				),

				array(
					'name'       => 'zakra_footer_bar_border_top_color',
					'default'    => '#e9ecef',
					'type'       => 'control',
					'control'    => 'zakra-color',
					'label'      => esc_html__( 'Color', 'zakra' ),
					'section'    => 'zakra_footer_bottom_bar',
					'transport'  => 'postMessage',
					'priority'   => 130,
					'dependency' => apply_filters( 'zakra_footer_bar_border_top_color_cb', false ),
				),

			);

			$options = array_merge( $options, $configs );

			if ( ! zakra_is_zakra_pro_active() ) {

				$configs[] = array(
					'name'        => 'zakra_footer_bottom_bar_upgrade',
					'type'        => 'control',
					'control'     => 'zakra-upgrade',
					'label'       => esc_html__( 'Learn more', 'zakra' ),
					'description' => esc_html__( 'Unlock more features available for this section.', 'zakra' ),
					'url'         => esc_url( 'https://zakratheme.com/pricing/?utm_source=zakra-customizer&utm_medium=view-pro-link&utm_campaign=zakra-pricing' ),
					'section'     => 'zakra_footer_bottom_bar',
					'priority'    => 135,
				);

				$options = array_merge( $options, $configs );
			}

			return $options;
		}

	}

	new Zakra_Customize_Footer_Bottom_Bar_Option();

endif;
