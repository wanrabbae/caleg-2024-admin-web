<?php
/**
 * Site Identity Options.
 *
 * @package     zakra
 */

defined( 'ABSPATH' ) || exit;

/*========================================== HEADER > SITE IDENTITY ==========================================*/
if ( ! class_exists( 'Zakra_Customize_Site_Identity_Option' ) ) :

	/**
	 * Site Identity customizer options.
	 */
	class Zakra_Customize_Site_Identity_Option extends Zakra_Customize_Base_Option {

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
					'name'        => 'zakra_retina_logo',
					'type'        => 'control',
					'control'     => 'image',
					'label'       => esc_html__( 'Retina Logo', 'zakra' ),
					'description' => esc_html__( 'Upload 2X times the size of your current logo. Eg: If your current logo size is 120*60 then upload 240*120 sized logo.', 'zakra' ),
					'section'     => 'title_tagline',
					'priority'    => 8,
				),

				array(
					'name'     => 'zakra_site_identity_color_heading',
					'type'     => 'control',
					'control'  => 'zakra-title',
					'label'    => esc_html__( 'Colors', 'zakra' ),
					'section'  => 'title_tagline',
					'priority' => 19,
				),

				array(
					'name'     => 'zakra_site_identity_typography_heading',
					'type'     => 'control',
					'control'  => 'zakra-title',
					'label'    => esc_html__( 'Typography', 'zakra' ),
					'section'  => 'title_tagline',
					'priority' => 23,
				),

				array(
					'name'     => 'zakra_typography_site_title_group',
					'default'  => '',
					'type'     => 'control',
					'control'  => 'zakra-group',
					'label'    => esc_html__( 'Site Title', 'zakra' ),
					'section'  => 'title_tagline',
					'priority' => 24,
				),

				array(
					'name'        => 'zakra_typography_site_title',
					'default'     => array(
						'font-family'    => 'default',
						'font-weight'    => '400',
						'subsets'        => array( 'latin' ),
						'font-size'      => array(
							'desktop' => '1.313rem',
							'tablet'  => '',
							'mobile'  => '',
						),
						'line-height'    => array(
							'desktop' => '1.5',
							'tablet'  => '',
							'mobile'  => '',
						),
						'font-style'     => 'normal',
						'text-transform' => 'none',
					),
					'input_attrs' => array(
						'desktop' => array(
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
					'parent'      => 'zakra_typography_site_title_group',
					'section'     => 'title_tagline',
					'transport'   => 'postMessage',
					'priority'    => 24,
				),

				array(
					'name'     => 'zakra_typography_site_description_group',
					'default'  => '',
					'type'     => 'control',
					'control'  => 'zakra-group',
					'label'    => esc_html__( 'Site Tagline', 'zakra' ),
					'section'  => 'title_tagline',
					'priority' => 25,
				),

				array(
					'name'        => 'zakra_typography_site_description',
					'default'     => array(
						'font-family'    => 'default',
						'font-weight'    => '400',
						'subsets'        => array( 'latin' ),
						'font-size'      => array(
							'desktop' => '1rem',
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
					'parent'      => 'zakra_typography_site_description_group',
					'section'     => 'title_tagline',
					'transport'   => 'postMessage',
					'priority'    => 25,
				),

			);

			$options = array_merge( $options, $configs );

			if ( ! zakra_is_zakra_pro_active() ) {

				$configs[] = array(
					'name'        => 'zakra_site_identity_upgrade',
					'type'        => 'control',
					'control'     => 'zakra-upgrade',
					'label'       => esc_html__( 'Learn more', 'zakra' ),
					'description' => esc_html__( 'Unlock more features available for this section.', 'zakra' ),
					'url'         => esc_url( 'https://zakratheme.com/pricing/?utm_source=zakra-customizer&utm_medium=view-pro-link&utm_campaign=zakra-pricing' ),
					'section'     => 'title_tagline',
					'priority'    => 100,
				);

				$options = array_merge( $options, $configs );
			}

			return $options;
		}

	}

	new Zakra_Customize_Site_Identity_Option();

endif;
