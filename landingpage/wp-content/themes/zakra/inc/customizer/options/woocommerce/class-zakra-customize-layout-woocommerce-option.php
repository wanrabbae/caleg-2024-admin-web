<?php
/**
 * Layout WooCommerce layout.
 *
 * @package     zakra
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Return if WooCommerce plugin is not activated.
if ( ! zakra_is_woocommerce_active() ) {
	return;
}

/*========================================== LAYOUT > WooCommerce ==========================================*/
if ( ! class_exists( 'Zakra_Customize_Layout_WooCommerce_Option' ) ) :

	/**
	 * Layout WooCommerce option.
	 */
	class Zakra_Customize_Layout_WooCommerce_Option extends Zakra_Customize_Base_Option {

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
					'name'      => 'zakra_structure_wc',
					'default'   => 'tg-site-layout--right',
					'type'      => 'control',
					'control'   => 'zakra-radio-image',
					'section'   => 'zakra_woocommerce_sidebar_layout',
					'label'     => esc_html__( 'WooCommerce', 'zakra' ),
					'priority'  => 10,
					'image_col' => 2,
					'choices'   => $sidebar_layout_choices,
				),

				array(
					'name'      => 'zakra_structure_wc_product',
					'default'   => 'tg-site-layout--right',
					'type'      => 'control',
					'control'   => 'zakra-radio-image',
					'section'   => 'zakra_woocommerce_sidebar_layout',
					'label'     => esc_html__( 'Single Product', 'zakra' ),
					'priority'  => 20,
					'image_col' => 2,
					'choices'   => $sidebar_layout_choices,
				),

			);

			$options = array_merge( $options, $configs );

			return $options;
		}

	}

	new Zakra_Customize_Layout_WooCommerce_Option();

endif;
