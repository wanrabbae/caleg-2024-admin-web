<?php
/**
 * Footer widgets options.
 *
 * @package     zakra
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/*== FOOTER > FOOTER WIDGETS ==*/
if ( ! class_exists( 'Zakra_Customize_Footer_Widget_Option' ) ) :

	/**
	 * Option: Footer widget Option.
	 */
	class Zakra_Customize_Footer_Widget_Option extends Zakra_Customize_Base_Option {

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
					'name'     => 'zakra_footer_widgets_enabled',
					'default'  => true,
					'type'     => 'control',
					'control'  => 'zakra-toggle',
					'label'    => esc_html__( 'Enable Footer Widgets', 'zakra' ),
					'section'  => 'zakra_footer_widgets',
					'priority' => 5,
				),

				array(
					'name'       => 'zakra_footer_widgets_hide_title',
					'default'    => false,
					'type'       => 'control',
					'control'    => 'zakra-toggle',
					'label'      => esc_html__( 'Hide Widget Title', 'zakra' ),
					'section'    => 'zakra_footer_widgets',
					'priority'   => 10,
					'dependency' => array(
						'zakra_footer_widgets_enabled',
						'==',
						true,
					),
				),

				array(
					'name'       => 'zakra_footer_widgets_style',
					'default'    => 'tg-footer-widget-col--four',
					'type'       => 'control',
					'control'    => 'zakra-radio-image',
					'label'      => esc_html__( 'Footer Widgets Style', 'zakra' ),
					'section'    => 'zakra_footer_widgets',
					'image_col'  => 2,
					'choices'    => apply_filters(
						'zakra_footer_widgets_style_choices',
						array(
							'tg-footer-widget-col--one'   => array(
								'label' => '',
								'url'   => ZAKRA_PARENT_INC_ICON_URI . '/one-column.png',
							),
							'tg-footer-widget-col--two'   => array(
								'label' => '',
								'url'   => ZAKRA_PARENT_INC_ICON_URI . '/two-columns.png',
							),
							'tg-footer-widget-col--three' => array(
								'label' => '',
								'url'   => ZAKRA_PARENT_INC_ICON_URI . '/three-columns.png',
							),
							'tg-footer-widget-col--four'  => array(
								'label' => '',
								'url'   => ZAKRA_PARENT_INC_ICON_URI . '/four-columns.png',
							),
						)
					),
					'priority'   => 25,
					'dependency' => array(
						'zakra_footer_widgets_enabled',
						'==',
						true,
					),
				),

				array(
					'name'       => 'zakra_footer_widgets_colors_heading',
					'type'       => 'control',
					'control'    => 'zakra-title',
					'label'      => esc_html__( 'Colors', 'zakra' ),
					'section'    => 'zakra_footer_widgets',
					'priority'   => 75,
					'dependency' => array(
						'zakra_footer_widgets_enabled',
						'==',
						true,
					),
				),

				array(
					'name'       => 'zakra_footer_widgets_bg_group',
					'type'       => 'control',
					'control'    => 'zakra-group',
					'label'      => esc_html__( 'Background', 'zakra' ),
					'section'    => 'zakra_footer_widgets',
					'priority'   => 80,
					'dependency' => array(
						'zakra_footer_widgets_enabled',
						'==',
						true,
					),
				),

				array(
					'name'       => 'zakra_footer_widgets_bg',
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
					'parent'     => 'zakra_footer_widgets_bg_group',
					'section'    => 'zakra_footer_widgets',
					'priority'   => 80,
					'transport'  => 'postMessage',
					'dependency' => array(
						'zakra_footer_widgets_enabled',
						'==',
						true,
					),
				),

				array(
					'name'       => 'zakra_footer_widgets_title_color_group',
					'type'       => 'control',
					'control'    => 'zakra-group',
					'label'      => esc_html__( 'Widget Title', 'zakra' ),
					'section'    => 'zakra_footer_widgets',
					'priority'   => 85,
					'dependency' => array(
						'conditions' => array(
							array(
								'zakra_footer_widgets_enabled',
								'==',
								true,
							),
							array(
								'zakra_footer_widgets_hide_title',
								'==',
								false,
							),
						),
						'operator'   => 'AND',
					),
				),

				array(
					'name'       => 'zakra_footer_widgets_title_color',
					'default'    => '#16181a',
					'type'       => 'sub-control',
					'control'    => 'zakra-color',
					'section'    => 'zakra_footer_widgets',
					'parent'     => 'zakra_footer_widgets_title_color_group',
					'transport'  => 'postMessage',
					'priority'   => 85,
					'dependency' => array(
						'conditions' => array(
							array(
								'zakra_footer_widgets_enabled',
								'==',
								true,
							),
							array(
								'zakra_footer_widgets_hide_title',
								'==',
								false,
							),
						),
						'operator'   => 'AND',
					),
				),

				array(
					'name'       => 'zakra_footer_widgets_text_color_group',
					'type'       => 'control',
					'control'    => 'zakra-group',
					'label'      => esc_html__( 'Widget Content', 'zakra' ),
					'section'    => 'zakra_footer_widgets',
					'priority'   => 90,
					'dependency' => array(
						'zakra_footer_widgets_enabled',
						'==',
						true,
					),
				),

				array(
					'name'       => 'zakra_footer_widgets_text_color',
					'default'    => '#51585f',
					'type'       => 'sub-control',
					'control'    => 'zakra-color',
					'section'    => 'zakra_footer_widgets',
					'parent'     => 'zakra_footer_widgets_text_color_group',
					'transport'  => 'postMessage',
					'priority'   => 90,
					'dependency' => array(
						'zakra_footer_widgets_enabled',
						'==',
						true,
					),
				),

				array(
					'name'       => 'zakra_footer_widgets_link_color_group',
					'default'    => '',
					'type'       => 'control',
					'control'    => 'zakra-group',
					'section'    => 'zakra_footer_widgets',
					'label'      => esc_html__( 'Widget Link Item', 'zakra' ),
					'priority'   => 95,
					'dependency' => array(
						'zakra_footer_widgets_enabled',
						'==',
						true,
					),
				),

				array(
					'name'       => 'zakra_footer_widgets_link_color',
					'default'    => '#16181a',
					'type'       => 'sub-control',
					'control'    => 'zakra-color',
					'parent'     => 'zakra_footer_widgets_link_color_group',
					'section'    => 'zakra_footer_widgets',
					'transport'  => 'postMessage',
					'tab'        => esc_html__( 'Normal', 'zakra' ),
					'priority'   => 95,
					'dependency' => array(
						'zakra_footer_widgets_enabled',
						'==',
						true,
					),
				),

				array(
					'name'       => 'zakra_footer_widgets_link_hover_color',
					'default'    => '#269bd1',
					'type'       => 'sub-control',
					'control'    => 'zakra-color',
					'parent'     => 'zakra_footer_widgets_link_color_group',
					'section'    => 'zakra_footer_widgets',
					'transport'  => 'postMessage',
					'tab'        => esc_html__( 'Hover', 'zakra' ),
					'priority'   => 95,
					'dependency' => array(
						'zakra_footer_widgets_enabled',
						'==',
						true,
					),
				),

				array(
					'name'       => 'zakra_footer_widgets_border_heading',
					'type'       => 'control',
					'control'    => 'zakra-title',
					'label'      => esc_html__( 'Border Top', 'zakra' ),
					'section'    => 'zakra_footer_widgets',
					'priority'   => 135,
					'dependency' => array(
						'zakra_footer_widgets_enabled',
						'==',
						true,
					),
				),

				array(
					'name'        => 'zakra_footer_widgets_border_top_width',
					'default'     => 1,
					'suffix'      => 'px',
					'type'        => 'control',
					'control'     => 'zakra-slider',
					'label'       => esc_html__( 'Size', 'zakra' ),
					'section'     => 'zakra_footer_widgets',
					'transport'   => 'postMessage',
					'input_attrs' => array(
						'min'  => 0,
						'max'  => 20,
						'step' => 1,
					),
					'priority'    => 140,
					'dependency'  => array(
						'zakra_footer_widgets_enabled',
						'==',
						true,
					),
				),

				array(
					'name'       => 'zakra_footer_widgets_border_top_color',
					'default'    => '#e9ecef',
					'type'       => 'control',
					'control'    => 'zakra-color',
					'section'    => 'zakra_footer_widgets',
					'label'      => esc_html__( 'Color', 'zakra' ),
					'transport'  => 'postMessage',
					'priority'   => 145,
					'dependency' => array(
						'zakra_footer_widgets_enabled',
						'==',
						true,
					),
				),

				array(
					'name'       => 'zakra_footer_widgets_item_border_heading',
					'type'       => 'control',
					'control'    => 'zakra-title',
					'label'      => esc_html__( 'List Item Border Bottom', 'zakra' ),
					'section'    => 'zakra_footer_widgets',
					'priority'   => 150,
					'dependency' => array(
						'zakra_footer_widgets_enabled',
						'==',
						true,
					),
				),

				array(
					'name'        => 'zakra_footer_widgets_item_border_bottom_width',
					'default'     => 1,
					'suffix'      => 'px',
					'type'        => 'control',
					'control'     => 'zakra-slider',
					'label'       => esc_html__( 'Size', 'zakra' ),
					'section'     => 'zakra_footer_widgets',
					'transport'   => 'postMessage',
					'input_attrs' => array(
						'min'  => 0,
						'max'  => 20,
						'step' => 1,
					),
					'priority'    => 155,
					'dependency'  => array(
						'zakra_footer_widgets_enabled',
						'==',
						true,
					),
				),

				array(
					'name'       => 'zakra_footer_widgets_item_border_bottom_color',
					'default'    => '#e9ecef',
					'type'       => 'control',
					'control'    => 'zakra-color',
					'section'    => 'zakra_footer_widgets',
					'transport'  => 'postMessage',
					'label'      => esc_html__( 'Color', 'zakra' ),
					'priority'   => 160,
					'dependency' => array(
						'zakra_footer_widgets_enabled',
						'==',
						true,
					),
				),

			);

			$options = array_merge( $options, $configs );

			if ( ! zakra_is_zakra_pro_active() ) {

				$configs[] = array(
					'name'        => 'zakra_footer_widgets_upgrade',
					'type'        => 'control',
					'control'     => 'zakra-upgrade',
					'label'       => esc_html__( 'Learn more', 'zakra' ),
					'description' => esc_html__( 'Unlock more features available for this section.', 'zakra' ),
					'url'         => esc_url( 'https://zakratheme.com/pricing/?utm_source=zakra-customizer&utm_medium=view-pro-link&utm_campaign=zakra-pricing' ),
					'section'     => 'zakra_footer_widgets',
					'priority'    => 165,
				);

				$options = array_merge( $options, $configs );
			}

			return $options;
		}

	}

	new Zakra_Customize_Footer_Widget_Option();

endif;
