<?php
/**
 * Sidebar Layout.
 *
 * @package     zakra
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/*========================================== LAYOUT > General ==========================================*/
if ( ! class_exists( 'Zakra_Customize_Sidebar_Layout_Option' ) ) :

	/**
	 * Layout general option.
	 */
	class Zakra_Customize_Sidebar_Layout_Option extends Zakra_Customize_Base_Option {

		/**
		 * Include customize options.
		 *
		 * @param array                 $options      Customize options provided via the theme.
		 * @param \WP_Customize_Manager $wp_customize Theme Customizer object.
		 *
		 * @return mixed|void Customizer options for registering panels, sections as well as controls.
		 */
		public function register_options( $options, $wp_customize ) {

			$sidebar_layout_choices = apply_filters(
				'zakra_site_layout_choices',
				array(
					'tg-site-layout--default'    => array(
						'label' => '',
						'url'   => ZAKRA_PARENT_INC_ICON_URI . '/layout-default.png',
					),
					'tg-site-layout--left'       => array(
						'label' => '',
						'url'   => ZAKRA_PARENT_INC_ICON_URI . '/left-sidebar.png',
					),
					'tg-site-layout--right'      => array(
						'label' => '',
						'url'   => ZAKRA_PARENT_INC_ICON_URI . '/right-sidebar.png',
					),
					'tg-site-layout--no-sidebar' => array(
						'label' => '',
						'url'   => ZAKRA_PARENT_INC_ICON_URI . '/full-width.png',
					),
					'tg-site-layout--stretched'  => array(
						'label' => '',
						'url'   => ZAKRA_PARENT_INC_ICON_URI . '/stretched.png',
					),
				)
			);

			$configs = array(

				array(
					'name'      => 'zakra_structure_default',
					'default'   => 'tg-site-layout--right',
					'type'      => 'control',
					'control'   => 'zakra-radio-image',
					'section'   => 'zakra_sidebar_layout',
					'label'     => esc_html__( 'Default', 'zakra' ),
					'priority'  => 10,
					'image_col' => 2,
					'choices'   => $sidebar_layout_choices,
				),

				array(
					'name'      => 'zakra_structure_archive',
					'default'   => 'tg-site-layout--right',
					'type'      => 'control',
					'control'   => 'zakra-radio-image',
					'section'   => 'zakra_sidebar_layout',
					'label'     => esc_html__( 'Blog/Archive', 'zakra' ),
					'priority'  => 20,
					'image_col' => 2,
					'choices'   => $sidebar_layout_choices,
				),

				array(
					'name'      => 'zakra_structure_post',
					'default'   => 'tg-site-layout--right',
					'type'      => 'control',
					'control'   => 'zakra-radio-image',
					'section'   => 'zakra_sidebar_layout',
					'label'     => esc_html__( 'Single Post', 'zakra' ),
					'priority'  => 30,
					'image_col' => 2,
					'choices'   => $sidebar_layout_choices,
				),

				array(
					'name'      => 'zakra_structure_page',
					'default'   => 'tg-site-layout--right',
					'type'      => 'control',
					'control'   => 'zakra-radio-image',
					'section'   => 'zakra_sidebar_layout',
					'label'     => esc_html__( 'Page', 'zakra' ),
					'priority'  => 40,
					'image_col' => 2,
					'choices'   => $sidebar_layout_choices,
				),

			);

			$options = array_merge( $options, $configs );

			if ( ! zakra_is_zakra_pro_active() ) {

				$configs[] = array(
					'name'        => 'zakra_layout_structure_upgrade',
					'type'        => 'control',
					'control'     => 'zakra-upgrade',
					'label'       => esc_html__( 'Learn more', 'zakra' ),
					'description' => esc_html__( 'Unlock more features available for this section.', 'zakra' ),
					'url'         => esc_url( 'https://zakratheme.com/pricing/?utm_source=zakra-customizer&utm_medium=view-pro-link&utm_campaign=zakra-pricing' ),
					'section'     => 'zakra_sidebar_layout',
					'priority'    => 100,
				);

				$options = array_merge( $options, $configs );
			}

			return $options;
		}

	}

	new Zakra_Customize_Sidebar_Layout_Option();

endif;
