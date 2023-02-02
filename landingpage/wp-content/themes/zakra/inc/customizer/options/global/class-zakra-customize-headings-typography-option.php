<?php
/**
 * Typography.
 *
 * @package     zakra
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/*========================================== TYPOGRAPHY > HEADINGS ( H1 - H6 ) ==========================================*/
if ( ! class_exists( 'Zakra_Customize_Headings_Typography_Option' ) ) :

	/**
	 * Typography option.
	 */
	class Zakra_Customize_Headings_Typography_Option extends Zakra_Customize_Base_Option {

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
					'name'     => 'zakra_typography_h1_group',
					'type'     => 'control',
					'control'  => 'zakra-group',
					'label'    => esc_html__( 'H1', 'zakra' ),
					'section'  => 'zakra_headings_typography',
					'priority' => 5,
				),

				array(
					'name'        => 'zakra_typography_h1',
					'default'     => apply_filters(
						'zakra_typography_h1_filter',
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
								'step' => 0.1,
								'min'  => 1,
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
								'min'  => 1,
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
								'min'  => 1,
								'max'  => 3,
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
					'parent'      => 'zakra_typography_h1_group',
					'section'     => 'zakra_headings_typography',
					'transport'   => 'postMessage',
					'priority'    => 5,
				),

				array(
					'name'     => 'zakra_typography_h2_group',
					'type'     => 'control',
					'control'  => 'zakra-group',
					'label'    => esc_html__( 'H2', 'zakra' ),
					'section'  => 'zakra_headings_typography',
					'priority' => 10,
				),

				array(
					'name'        => 'zakra_typography_h2',
					'default'     => apply_filters(
						'zakra_typography_h2_filter',
						array(
							'font-family'    => 'default',
							'font-weight'    => '500',
							'subsets'        => array( 'latin' ),
							'font-size'      => array(
								'desktop' => '2.25rem',
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
								'min'  => 1,
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
								'min'  => 1,
								'max'  => 4,
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
								'min'  => 1,
								'max'  => 4,
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
					'parent'      => 'zakra_typography_h2_group',
					'section'     => 'zakra_headings_typography',
					'transport'   => 'postMessage',
					'priority'    => 10,
				),

				array(
					'name'     => 'zakra_typography_h3_group',
					'type'     => 'control',
					'control'  => 'zakra-group',
					'label'    => esc_html__( 'H3', 'zakra' ),
					'section'  => 'zakra_headings_typography',
					'priority' => 15,
				),

				array(
					'name'        => 'zakra_typography_h3',
					'default'     => apply_filters(
						'zakra_typography_h3_filter',
						array(
							'font-family'    => 'default',
							'font-weight'    => '500',
							'subsets'        => array( 'latin' ),
							'font-size'      => array(
								'desktop' => '2rem',
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
								'min'  => 1,
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
								'min'  => 1,
								'max'  => 4,
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
								'min'  => 1,
								'max'  => 4,
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
					'parent'      => 'zakra_typography_h3_group',
					'section'     => 'zakra_headings_typography',
					'transport'   => 'postMessage',
					'priority'    => 15,
				),

				array(
					'name'     => 'zakra_typography_h4_group',
					'type'     => 'control',
					'control'  => 'zakra-group',
					'label'    => esc_html__( 'H4', 'zakra' ),
					'section'  => 'zakra_headings_typography',
					'priority' => 20,
				),

				array(
					'name'        => 'zakra_typography_h4',
					'default'     => apply_filters(
						'zakra_typography_h4_filter',
						array(
							'font-family'    => 'default',
							'font-weight'    => '500',
							'subsets'        => array( 'latin' ),
							'font-size'      => array(
								'desktop' => '1.75rem',
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
								'min'  => 1,
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
								'min'  => 1,
								'max'  => 4,
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
								'min'  => 1,
								'max'  => 4,
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
					'parent'      => 'zakra_typography_h4_group',
					'section'     => 'zakra_headings_typography',
					'transport'   => 'postMessage',
					'priority'    => 20,
				),

				array(
					'name'     => 'zakra_typography_h5_group',
					'type'     => 'control',
					'control'  => 'zakra-group',
					'label'    => esc_html__( 'H5', 'zakra' ),
					'section'  => 'zakra_headings_typography',
					'priority' => 25,
				),

				array(
					'name'        => 'zakra_typography_h5',
					'default'     => apply_filters(
						'zakra_typography_h5_filter',
						array(
							'font-family'    => 'default',
							'font-weight'    => '500',
							'subsets'        => array( 'latin' ),
							'font-size'      => array(
								'desktop' => '1.313rem',
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
								'min'  => 1,
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
								'min'  => 1,
								'max'  => 4,
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
								'min'  => 1,
								'max'  => 4,
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
					'parent'      => 'zakra_typography_h5_group',
					'section'     => 'zakra_headings_typography',
					'transport'   => 'postMessage',
					'priority'    => 25,
				),

				array(
					'name'     => 'zakra_typography_h6_group',
					'type'     => 'control',
					'control'  => 'zakra-group',
					'label'    => esc_html__( 'H6', 'zakra' ),
					'section'  => 'zakra_headings_typography',
					'priority' => 30,
				),

				array(
					'name'        => 'zakra_typography_h6',
					'default'     => apply_filters(
						'zakra_typography_h6_filter',
						array(
							'font-family'    => 'default',
							'font-weight'    => '500',
							'subsets'        => array( 'latin' ),
							'font-size'      => array(
								'desktop' => '1.125rem',
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
								'min'  => 1,
								'max'  => 3,
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
								'max'  => 2.5,
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
					'parent'      => 'zakra_typography_h6_group',
					'section'     => 'zakra_headings_typography',
					'transport'   => 'postMessage',
					'priority'    => 30,
				),

			);

			$options = array_merge( $options, $configs );

			return $options;
		}

	}

	new Zakra_Customize_Headings_Typography_Option();

endif;
