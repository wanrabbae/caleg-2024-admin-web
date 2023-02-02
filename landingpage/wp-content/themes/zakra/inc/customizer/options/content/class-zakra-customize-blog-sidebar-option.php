<?php
/**
 * Sidebar options.
 *
 * @package     zakra
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Zakra_Customize_Blog_Sidebar_Option' ) ) :

	/**
	 * Sidebar options.
	 */
	class Zakra_Customize_Blog_Sidebar_Option extends Zakra_Customize_Base_Option {

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
					'name'     => 'zakra_typography_widget_title_heading',
					'type'     => 'control',
					'control'  => 'zakra-title',
					'label'    => esc_html__( 'Typography', 'zakra' ),
					'section'  => 'zakra_sidebar',
					'priority' => 70,
				),

				array(
					'name'     => 'zakra_typography_widget_heading_group',
					'type'     => 'control',
					'control'  => 'zakra-group',
					'label'    => esc_html__( 'Title', 'zakra' ),
					'section'  => 'zakra_sidebar',
					'priority' => 75,
				),

				array(
					'name'        => 'zakra_typography_widget_heading',
					'default'     => apply_filters(
						'zakra_typography_widget_heading_filter',
						array(
							'font-family'    => 'default',
							'font-weight'    => '500',
							'subsets'        => array( 'latin' ),
							'font-size'      => array(
								'desktop' => '1.2rem',
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
								'step' => 0.1,
								'min'  => 0.5,
								'max'  => 4,
							),
							'line-height' => array(
								'step' => 0.1,
								'min'  => 0,
								'max'  => 3,
							),
						),
						'tablet'  => array(
							'font-size'   => array(
								'step' => 0.1,
								'min'  => 0.5,
								'max'  => 3,
							),
							'line-height' => array(
								'step' => 0.1,
								'min'  => 0,
								'max'  => 3,
							),
						),
						'mobile'  => array(
							'font-size'   => array(
								'step' => 0.1,
								'min'  => 0.5,
								'max'  => 2,
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
					'parent'      => 'zakra_typography_widget_heading_group',
					'section'     => 'zakra_sidebar',
					'transport'   => 'postMessage',
					'priority'    => 75,
				),

				array(
					'name'     => 'zakra_typography_widget_content_group',
					'type'     => 'control',
					'control'  => 'zakra-group',
					'label'    => esc_html__( 'Content', 'zakra' ),
					'section'  => 'zakra_sidebar',
					'priority' => 80,
				),

				array(
					'name'        => 'zakra_typography_widget_content',
					'default'     => apply_filters(
						'zakra_typography_widget_content_filter',
						array(
							'font-family'    => 'default',
							'font-weight'    => '400',
							'subsets'        => array( 'latin' ),
							'font-size'      => array(
								'desktop' => '15px',
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
					'parent'      => 'zakra_typography_widget_content_group',
					'section'     => 'zakra_sidebar',
					'transport'   => 'postMessage',
					'priority'    => 80,
				),

			);

			$options = array_merge( $options, $configs );

			if ( ! zakra_is_zakra_pro_active() ) {

				$configs[] = array(
					'name'        => 'zakra_sidebar_upgrade',
					'type'        => 'control',
					'control'     => 'zakra-upgrade',
					'label'       => esc_html__( 'Learn more', 'zakra' ),
					'description' => esc_html__( 'Unlock more features available for this section.', 'zakra' ),
					'url'         => esc_url( 'https://zakratheme.com/pricing/?utm_source=zakra-customizer&utm_medium=view-pro-link&utm_campaign=zakra-pricing' ),
					'section'     => 'zakra_sidebar',
					'priority'    => 100,
				);

				$options = array_merge( $options, $configs );
			}

			return $options;
		}

	}

	new Zakra_Customize_Blog_Sidebar_Option();

endif;
