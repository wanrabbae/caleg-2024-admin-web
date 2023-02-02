<?php
/**
 * Container options.
 *
 * @package     zakra
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/*========================================== CONTAINER ==========================================*/
if ( ! class_exists( 'Zakra_Customize_Container_Option' ) ) :

	/**
	 * General option.
	 */
	class Zakra_Customize_Container_Option extends Zakra_Customize_Base_Option {

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
					'name'      => 'zakra_general_container_style',
					'default'   => 'tg-container--wide',
					'type'      => 'control',
					'control'   => 'zakra-radio-image',
					'section'   => 'zakra_container',
					'label'     => esc_html__( 'Container Style', 'zakra' ),
					'priority'  => 10,
					'transport' => 'postMessage',
					'image_col' => 2,
					'choices'   => array(
						'tg-container--wide'     => array(
							'label' => esc_html__( 'Wide', 'zakra' ),
							'url'   => ZAKRA_PARENT_INC_ICON_URI . '/wide.png',
						),
						'tg-container--boxed'    => array(
							'label' => esc_html__( 'Boxed', 'zakra' ),
							'url'   => ZAKRA_PARENT_INC_ICON_URI . '/boxed.png',
						),
						'tg-container--separate' => array(
							'label' => esc_html__( 'Separate', 'zakra' ),
							'url'   => ZAKRA_PARENT_INC_ICON_URI . '/separate.png',
						),
					),
				),

				array(
					'name'        => 'zakra_general_container_width',
					'default'     => 1160,
					'type'        => 'control',
					'control'     => 'zakra-slider',
					'suffix'      => 'px',
					'label'       => esc_html__( 'Container Width', 'zakra' ),
					'section'     => 'zakra_container',
					'priority'    => 20,
					'transport'   => 'postMessage',
					'input_attrs' => array(
						'min'  => 768,
						'max'  => 1920,
						'step' => 1,
					),
				),

				array(
					'name'        => 'zakra_general_content_width',
					'default'     => 70,
					'type'        => 'control',
					'control'     => 'zakra-slider',
					'suffix'      => '%',
					'label'       => esc_html__( 'Content Width', 'zakra' ),
					'section'     => 'zakra_container',
					'transport'   => 'postMessage',
					'priority'    => 30,
					'input_attrs' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),

				array(
					'name'        => 'zakra_general_sidebar_width',
					'default'     => 30,
					'type'        => 'control',
					'control'     => 'zakra-slider',
					'suffix'      => '%',
					'label'       => esc_html__( 'Side Width', 'zakra' ),
					'section'     => 'zakra_container',
					'transport'   => 'postMessage',
					'priority'    => 40,
					'input_attrs' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),

			);

			$options = array_merge( $options, $configs );

			if ( ! zakra_is_zakra_pro_active() ) {

				$configs[] = array(
					'name'        => 'zakra_container_upgrade',
					'type'        => 'control',
					'control'     => 'zakra-upgrade',
					'label'       => esc_html__( 'Learn more', 'zakra' ),
					'description' => esc_html__( 'Unlock more features available for this section.', 'zakra' ),
					'url'         => esc_url( 'https://zakratheme.com/pricing/?utm_source=zakra-customizer&utm_medium=view-pro-link&utm_campaign=zakra-pricing' ),
					'section'     => 'zakra_container',
					'priority'    => 100,
				);

				$options = array_merge( $options, $configs );
			}

			return $options;
		}

	}

	new Zakra_Customize_Container_Option();

endif;
