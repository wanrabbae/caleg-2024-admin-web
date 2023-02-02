<?php
/**
 * Typography.
 *
 * @package     zakra
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/*========================================== TYPOGRAPHY ==========================================*/
if ( ! class_exists( 'Zakra_Customize_Typography_Option' ) ) :

	/**
	 * Typography option.
	 */
	class Zakra_Customize_Typography_Option extends Zakra_Customize_Base_Option {

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
					'name'     => 'zakra_base_typography_body_heading',
					'type'     => 'control',
					'control'  => 'zakra-title',
					'section'  => 'zakra_base_typography',
					'label'    => esc_html__( 'Body', 'zakra' ),
					'priority' => 4,
				),

				array(
					'name'        => 'zakra_base_typography_body',
					'default'     => array(
						'font-family'    => 'default',
						'font-weight'    => '400',
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
					),
					'input_attrs' => array(
						'desktop' => array(
							'font-size'   => array(
								'step' => 1,
								'min'  => 10,
								'max'  => 36,
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
								'min'  => 10,
								'max'  => 36,
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
								'min'  => 10,
								'max'  => 36,
							),
							'line-height' => array(
								'step' => 0.1,
								'min'  => 0,
								'max'  => 3,
							),
						),
					),
					'type'        => 'control',
					'control'     => 'zakra-typography',
					'section'     => 'zakra_base_typography',
					'priority'    => 5,
				),

				array(
					'name'     => 'zakra_body_typography_separator',
					'type'     => 'control',
					'control'  => 'zakra-divider',
					'section'  => 'zakra_base_typography',
					'priority' => 6,
				),

				array(
					'name'     => 'zakra_base_typography_heading_group',
					'default'  => '',
					'type'     => 'control',
					'control'  => 'zakra-group',
					'label'    => esc_html__( 'Heading', 'zakra' ),
					'section'  => 'zakra_base_typography',
					'priority' => 10,
				),

				array(
					'name'        => 'zakra_base_typography_heading',
					'default'     => apply_filters(
						'zakra_base_typography_heading_filter',
						array(
							'font-family'    => 'default',
							'font-weight'    => '400',
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
							'line-height' => array(
								'step' => 0.1,
								'min'  => 0,
								'max'  => 3,
							),
						),
						'tablet'  => array(
							'line-height' => array(
								'step' => 0.1,
								'min'  => 0,
								'max'  => 3,
							),
						),
						'mobile'  => array(
							'line-height' => array(
								'step' => 0.1,
								'min'  => 0,
								'max'  => 3,
							),
						),
					),
					'type'        => 'sub-control',
					'control'     => 'zakra-typography',
					'parent'      => 'zakra_base_typography_heading_group',
					'section'     => 'zakra_base_typography',
					'transport'   => 'postMessage',
					'priority'    => 10,
				),

			);

			$options = array_merge( $options, $configs );

			if ( ! zakra_is_zakra_pro_active() ) {

				$configs[] = array(
					'name'        => 'zakra_base_typography_upgrade',
					'type'        => 'control',
					'control'     => 'zakra-upgrade',
					'label'       => esc_html__( 'Learn more', 'zakra' ),
					'description' => esc_html__( 'Unlock more features available for this section.', 'zakra' ),
					'url'         => esc_url( 'https://zakratheme.com/pricing/?utm_source=zakra-customizer&utm_medium=view-pro-link&utm_campaign=zakra-pricing' ),
					'section'     => 'zakra_base_typography',
					'priority'    => 100,
				);

				$options = array_merge( $options, $configs );
			}

			return $options;
		}

	}

	new Zakra_Customize_Typography_Option();

endif;
