<?php
/**
 * Header main options.
 *
 * @package zakra
 */

defined( 'ABSPATH' ) || exit;

/*========================================== HEADER > HEADER MAIN ==========================================*/
if ( ! class_exists( 'Zakra_Customize_Header_Main_Option' ) ) :

	/**
	 * Header main customizer options.
	 */
	class Zakra_Customize_Header_Main_Option extends Zakra_Customize_Base_Option {

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
					'name'       => 'zakra_header_main_style',
					'default'    => 'tg-site-header--left',
					'type'       => 'control',
					'control'    => 'zakra-radio-image',
					'label'      => esc_html__( 'Style', 'zakra' ),
					'section'    => 'zakra_header_main',
					'transport'  => 'postMessage',
					'priority'   => 20,
					'choices'    => apply_filters(
						'zakra_header_main_style_choices',
						array(
							'tg-site-header--left'   => array(
								'label' => '',
								'url'   => ZAKRA_PARENT_INC_ICON_URI . '/header-left.png',
							),
							'tg-site-header--center' => array(
								'label' => '',
								'url'   => ZAKRA_PARENT_INC_ICON_URI . '/header-center.png',
							),
							'tg-site-header--right'  => array(
								'label' => '',
								'url'   => ZAKRA_PARENT_INC_ICON_URI . '/header-right.png',
							),
						)
					),
					'image_col'  => 2,
					'dependency' => apply_filters(
						'zakra_header_main_style_cb',
						array()
					),
				),

				array(
					'name'     => 'zakra_search_heading',
					'type'     => 'control',
					'control'  => 'zakra-title',
					'label'    => esc_html__( 'Search', 'zakra' ),
					'section'  => 'zakra_header_main',
					'priority' => 60,
				),

				array(
					'name'     => 'tg_header_menu_search_enabled',
					'default'  => true,
					'type'     => 'control',
					'control'  => 'zakra-toggle',
					'label'    => esc_html__( 'Enable Search Icon', 'zakra' ),
					'section'  => 'zakra_header_main',
					'priority' => 65,
				),

				array(
					'name'     => 'zakra_header_main_colors_heading',
					'type'     => 'control',
					'control'  => 'zakra-title',
					'label'    => esc_html__( 'Colors', 'zakra' ),
					'section'  => 'zakra_header_main',
					'priority' => 105,
				),

				array(
					'name'      => 'zakra_header_main_bg',
					'default'   => array(
						'background-color'      => '#ffffff',
						'background-image'      => '',
						'background-repeat'     => 'repeat',
						'background-position'   => 'center center',
						'background-size'       => 'contain',
						'background-attachment' => 'scroll',
					),
					'type'      => 'control',
					'control'   => 'zakra-background',
					'section'   => 'zakra_header_main',
					'transport' => 'postMessage',
					'priority'  => 110,
				),

				array(
					'name'     => 'zakra_header_main_border_bottom_heading',
					'type'     => 'control',
					'control'  => 'zakra-title',
					'label'    => esc_html__( 'Border Bottom', 'zakra' ),
					'section'  => 'zakra_header_main',
					'priority' => 115,
				),

				array(
					'name'        => 'zakra_header_main_border_bottom_width',
					'default'     => 1,
					'type'        => 'control',
					'control'     => 'zakra-slider',
					'suffix'      => 'px',
					'label'       => esc_html__( 'Size', 'zakra' ),
					'section'     => 'zakra_header_main',
					'transport'   => 'postMessage',
					'priority'    => 120,
					'input_attrs' => array(
						'min'  => 0,
						'max'  => 20,
						'step' => 1,
					),
				),

				array(
					'name'      => 'zakra_header_main_border_bottom_color',
					'default'   => '#e9ecef',
					'type'      => 'control',
					'control'   => 'zakra-color',
					'label'     => esc_html__( 'Color', 'zakra' ),
					'section'   => 'zakra_header_main',
					'transport' => 'postMessage',
					'priority'  => 125,
				),
			);

			$options = array_merge( $options, $configs );

			if ( ! zakra_is_zakra_pro_active() ) {

				$configs[] = array(
					'name'        => 'zakra_header_main_upgrade',
					'type'        => 'control',
					'control'     => 'zakra-upgrade',
					'label'       => esc_html__( 'Learn more', 'zakra' ),
					'description' => esc_html__( 'Unlock more features available for this section.', 'zakra' ),
					'url'         => esc_url( 'https://zakratheme.com/pricing/?utm_source=zakra-customizer&utm_medium=view-pro-link&utm_campaign=zakra-pricing' ),
					'section'     => 'zakra_header_main',
					'priority'    => 130,
				);

				$options = array_merge( $options, $configs );
			}

			return $options;
		}

	}

	new Zakra_Customize_Header_Main_Option();

endif;
