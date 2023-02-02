<?php
/**
 * Page header options
 *
 * @package     zakra
 */

defined( 'ABSPATH' ) || exit;

/*== CONTENT > PAGE HEADER ==*/
if ( ! class_exists( 'Zakra_Customize_Blog_General_Option' ) ) :

	/**
	 * Archive/Blog option.
	 */
	class Zakra_Customize_Blog_General_Option extends Zakra_Customize_Base_Option {

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
					'name'     => 'zakra_page_title_heading',
					'type'     => 'control',
					'control'  => 'zakra-title',
					'label'    => esc_html__( 'Page Title', 'zakra' ),
					'section'  => 'zakra_page_header',
					'priority' => 5,
				),

				array(
					'name'     => 'zakra_page_title_enabled',
					'default'  => 'page-header',
					'type'     => 'control',
					'control'  => 'radio',
					'label'    => esc_html__( 'Position', 'zakra' ),
					'section'  => 'zakra_page_header',
					'choices'  => array(
						'page-header'  => esc_html__( 'Page Header', 'zakra' ),
						'content-area' => esc_html__( 'Content Area', 'zakra' ),
					),
					'priority' => 10,
				),

				array(
					'name'       => 'zakra_page_title_markup',
					'default'    => 'h1',
					'type'       => 'control',
					'control'    => 'select',
					'label'      => esc_html__( 'Markup', 'zakra' ),
					'section'    => 'zakra_page_header',
					'choices'    => array(
						'h1'   => esc_html__( 'Heading 1', 'zakra' ),
						'h2'   => esc_html__( 'Heading 2', 'zakra' ),
						'h3'   => esc_html__( 'Heading 3', 'zakra' ),
						'h4'   => esc_html__( 'Heading 4', 'zakra' ),
						'h5'   => esc_html__( 'Heading 5', 'zakra' ),
						'h6'   => esc_html__( 'Heading 6', 'zakra' ),
						'span' => esc_html__( 'Span', 'zakra' ),
						'p'    => esc_html__( 'Paragraph', 'zakra' ),
						'div'  => esc_html__( 'Div', 'zakra' ),
					),
					'priority'   => 15,
					'dependency' => array(
						'zakra_page_title_enabled',
						'==',
						'page-header',
					),
				),

				array(
					'name'      => 'zakra_page_title_alignment',
					'default'   => 'tg-page-header--left-right',
					'type'      => 'control',
					'control'   => 'zakra-radio-image',
					'label'     => esc_html__( 'Alignment', 'zakra' ),
					'section'   => 'zakra_page_header',
					'transport' => 'postMessage',
					'image_col' => 2,
					'choices'   => array(
						'tg-page-header--left-right'  => array(
							'label' => '',
							'url'   => ZAKRA_PARENT_INC_ICON_URI . '/breadcrumb-right.png',
						),
						'tg-page-header--right-left'  => array(
							'label' => '',
							'url'   => ZAKRA_PARENT_INC_ICON_URI . '/breadcrumb-left.png',
						),
						'tg-page-header--both-center' => array(
							'label' => '',
							'url'   => ZAKRA_PARENT_INC_ICON_URI . '/breadcrumb-center.png',
						),
						'tg-page-header--both-left'   => array(
							'label' => '',
							'url'   => ZAKRA_PARENT_INC_ICON_URI . '/both-on-left.png',
						),
						'tg-page-header--both-right'  => array(
							'label' => '',
							'url'   => ZAKRA_PARENT_INC_ICON_URI . '/both-on-right.png',
						),
					),
					'priority'  => 20,
				),

				array(
					'name'     => 'zakra_breadcrumbs_heading',
					'type'     => 'control',
					'control'  => 'zakra-title',
					'label'    => esc_html__( 'Breadcrumbs', 'zakra' ),
					'section'  => 'zakra_page_header',
					'priority' => 30,
				),

				array(
					'name'     => 'zakra_breadcrumbs_enabled',
					'default'  => true,
					'type'     => 'control',
					'control'  => 'zakra-toggle',
					'label'    => esc_html__( 'Enable Breadcrumbs', 'zakra' ),
					'section'  => 'zakra_page_header',
					'priority' => 30,
				),

				array(
					'name'        => 'zakra_breadcrumbs_font_size',
					'default'     => 16,
					'suffix'      => 'px',
					'type'        => 'control',
					'control'     => 'zakra-slider',
					'label'       => esc_html__( 'Font Size', 'zakra' ),
					'section'     => 'zakra_page_header',
					'transport'   => 'postMessage',
					'input_attrs' => array(
						'min'  => 8,
						'max'  => 26,
						'step' => 1,
					),
					'priority'    => 55,
					'dependency'  => array(
						'zakra_breadcrumbs_enabled',
						'==',
						true,
					),
				),

				array(
					'name'     => 'zakra_page_title_dimensions_heading',
					'type'     => 'control',
					'control'  => 'zakra-title',
					'label'    => esc_html__( 'Dimensions', 'zakra' ),
					'section'  => 'zakra_page_header',
					'priority' => 65,
				),

				array(
					'name'      => 'zakra_page_title_padding',
					'default'   => array(
						'top'    => '20px',
						'right'  => '0px',
						'bottom' => '20px',
						'left'   => '0px',
					),
					'type'      => 'control',
					'control'   => 'zakra-dimensions',
					'label'     => esc_html__( 'Padding', 'zakra' ),
					'section'   => 'zakra_page_header',
					'transport' => 'postMessage',
					'priority'  => 70,
				),

				array(
					'name'     => 'zakra_page_header_colors_heading',
					'type'     => 'control',
					'control'  => 'zakra-title',
					'label'    => esc_html__( 'Colors', 'zakra' ),
					'section'  => 'zakra_page_header',
					'priority' => 75,
				),

				array(
					'name'     => 'zakra_page_title_bg_group',
					'type'     => 'control',
					'control'  => 'zakra-group',
					'label'    => esc_html__( 'Background', 'zakra' ),
					'section'  => 'zakra_page_header',
					'priority' => 80,
				),

				array(
					'name'      => 'zakra_page_title_bg',
					'default'   => array(
						'background-color'      => '#ffffff',
						'background-image'      => '',
						'background-repeat'     => 'repeat',
						'background-position'   => 'top left',
						'background-size'       => 'contain',
						'background-attachment' => 'scroll',
					),
					'type'      => 'sub-control',
					'control'   => 'zakra-background',
					'parent'    => 'zakra_page_title_bg_group',
					'section'   => 'zakra_page_header',
					'transport' => 'postMessage',
					'priority'  => 80,
				),

				array(
					'name'     => 'zakra_post_page_title_color_group',
					'type'     => 'control',
					'control'  => 'zakra-group',
					'label'    => esc_html__( 'Post/Page Title', 'zakra' ),
					'section'  => 'zakra_page_header',
					'priority' => 85,
				),

				array(
					'name'      => 'zakra_post_page_title_color',
					'default'   => '#16181a',
					'type'      => 'sub-control',
					'control'   => 'zakra-color',
					'parent'    => 'zakra_post_page_title_color_group',
					'section'   => 'zakra_page_header',
					'transport' => 'postMessage',
					'priority'  => 85,
				),

				array(
					'name'       => 'zakra_breadcrumbs_text_color_group',
					'type'       => 'control',
					'control'    => 'zakra-group',
					'label'      => esc_html__( 'Text', 'zakra' ),
					'section'    => 'zakra_page_header',
					'priority'   => 90,
					'dependency' => array(
						'zakra_breadcrumbs_enabled',
						'==',
						true,
					),
				),

				array(
					'name'       => 'zakra_breadcrumbs_text_color',
					'default'    => '#16181a',
					'type'       => 'sub-control',
					'control'    => 'zakra-color',
					'section'    => 'zakra_page_header',
					'parent'     => 'zakra_breadcrumbs_text_color_group',
					'transport'  => 'postMessage',
					'priority'   => 90,
					'dependency' => array(
						'zakra_breadcrumbs_enabled',
						'==',
						true,
					),
				),

				array(
					'name'       => 'zakra_breadcrumbs_seperator_color_group',
					'type'       => 'control',
					'control'    => 'zakra-group',
					'label'      => esc_html__( 'Separator', 'zakra' ),
					'section'    => 'zakra_page_header',
					'priority'   => 95,
					'dependency' => array(
						'zakra_breadcrumbs_enabled',
						'==',
						true,
					),
				),

				array(
					'name'       => 'zakra_breadcrumbs_seperator_color',
					'default'    => '#16181a',
					'type'       => 'sub-control',
					'control'    => 'zakra-color',
					'section'    => 'zakra_page_header',
					'parent'     => 'zakra_breadcrumbs_seperator_color_group',
					'transport'  => 'postMessage',
					'priority'   => 95,
					'dependency' => array(
						'zakra_breadcrumbs_enabled',
						'==',
						true,
					),
				),

				array(
					'name'       => 'zakra_breadcrumbs_link_color_group',
					'default'    => '',
					'type'       => 'control',
					'control'    => 'zakra-group',
					'label'      => esc_html__( 'Link', 'zakra' ),
					'section'    => 'zakra_page_header',
					'priority'   => 100,
					'dependency' => array(
						'zakra_breadcrumbs_enabled',
						'==',
						true,
					),
				),

				array(
					'name'       => 'zakra_breadcrumbs_link_color',
					'default'    => '#16181a',
					'type'       => 'sub-control',
					'control'    => 'zakra-color',
					'parent'     => 'zakra_breadcrumbs_link_color_group',
					'tab'        => esc_html__( 'Normal', 'zakra' ),
					'section'    => 'zakra_page_header',
					'transport'  => 'postMessage',
					'priority'   => 100,
					'dependency' => array(
						'zakra_breadcrumbs_enabled',
						'==',
						true,
					),
				),

				array(
					'name'       => 'zakra_breadcrumbs_link_hover_color',
					'default'    => '#269bd1',
					'type'       => 'sub-control',
					'control'    => 'zakra-color',
					'parent'     => 'zakra_breadcrumbs_link_color_group',
					'tab'        => esc_html__( 'Hover', 'zakra' ),
					'section'    => 'zakra_page_header',
					'transport'  => 'postMessage',
					'priority'   => 100,
					'dependency' => array(
						'zakra_breadcrumbs_enabled',
						'==',
						true,
					),
				),

				array(
					'name'     => 'zakra_typography_page_header_heading',
					'type'     => 'control',
					'control'  => 'zakra-title',
					'label'    => esc_html__( 'Typography', 'zakra' ),
					'section'  => 'zakra_page_header',
					'priority' => 101,
				),

				array(
					'name'     => 'zakra_typography_post_page_title_group',
					'type'     => 'control',
					'control'  => 'zakra-group',
					'label'    => esc_html__( 'Post/Page Title', 'zakra' ),
					'section'  => 'zakra_page_header',
					'priority' => 105,
				),

				array(
					'name'        => 'zakra_typography_post_page_title',
					'default'     => apply_filters(
						'zakra_typography_post_page_title_filter',
						array(
							'font-family'    => 'default',
							'font-weight'    => '500',
							'subsets'        => array( 'latin' ),
							'font-size'      => array(
								'desktop' => '2.5rem',
								'tablet'  => '',
								'mobile'  => '',
							),
							'line-height'    => array(
								'desktop' => '1.3',
								'tablet'  => '',
								'mobile'  => '',
							),
							'font-style'     => 'normal',
							'text-transform' => 'none',
						)
					),
					'input_attrs' => array(
						'desktop' => array(
							'font-size'   => array(
								'step' => 1,
								'min'  => 14,
								'max'  => 40,
							),
							'line-height' => array(
								'step' => 0.1,
								'min'  => 0,
								'max'  => 3,
							),
						),
						'tablet'  => array(
							'font-size'   => array(
								'step' => 1,
								'min'  => 14,
								'max'  => 40,
							),
							'line-height' => array(
								'step' => 0.1,
								'min'  => 0,
								'max'  => 3,
							),
						),
						'mobile'  => array(
							'font-size'   => array(
								'step' => 1,
								'min'  => 14,
								'max'  => 40,
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
					'parent'      => 'zakra_typography_post_page_title_group',
					'section'     => 'zakra_page_header',
					'transport'   => 'postMessage',
					'priority'    => 105,
				),

			);

			$options = array_merge( $options, $configs );

			if ( ! zakra_is_zakra_pro_active() ) {

				$configs[] = array(
					'name'        => 'zakra_page_header_upgrade',
					'type'        => 'control',
					'control'     => 'zakra-upgrade',
					'label'       => esc_html__( 'Learn more', 'zakra' ),
					'description' => esc_html__( 'Unlock more features available for this section.', 'zakra' ),
					'url'         => esc_url( 'https://zakratheme.com/pricing/?utm_source=zakra-customizer&utm_medium=view-pro-link&utm_campaign=zakra-pricing' ),
					'section'     => 'zakra_page_header',
					'priority'    => 110,
				);

				$options = array_merge( $options, $configs );
			}

			return $options;
		}



	}

	new Zakra_Customize_Blog_General_Option();

endif;
