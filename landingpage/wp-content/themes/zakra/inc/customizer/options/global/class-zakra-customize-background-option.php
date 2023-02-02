<?php
/**
 * Background options.
 *
 * @package     zakra
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/*========================================== BACKGROUND ==========================================*/
if ( ! class_exists( 'Zakra_Customize_Background_Option' ) ) :

	/**
	 * General option.
	 */
	class Zakra_Customize_Background_Option extends Zakra_Customize_Base_Option {

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
					'name'     => 'zakra_inside_container_background_heading',
					'type'     => 'control',
					'control'  => 'zakra-title',
					'label'    => esc_html__( 'Inside Container', 'zakra' ),
					'section'  => 'zakra_background',
					'priority' => 5,
				),

				array(
					'name'      => 'zakra_inside_container_background',
					'default'   => array(
						'background-color'      => '#ffffff',
						'background-image'      => '',
						'background-position'   => 'center center',
						'background-size'       => 'auto',
						'background-attachment' => 'scroll',
						'background-repeat'     => 'repeat',
					),
					'type'      => 'control',
					'control'   => 'zakra-background',
					'section'   => 'zakra_background',
					'transport' => 'postMessage',
					'priority'  => 10,
				),

				array(
					'name'     => 'zakra_outside_container_background_heading',
					'type'     => 'control',
					'control'  => 'zakra-title',
					'label'    => esc_html__( 'Outside Container', 'zakra' ),
					'section'  => 'zakra_background',
					'priority' => 15,
				),

			);

			$options = array_merge( $options, $configs );

			return $options;
		}

	}

	new Zakra_Customize_Background_Option();

endif;
