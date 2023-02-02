<?php
/**
 * Hooks from Zakra theme.
 *
 * @package    ThemeGrill
 * @subpackage Zakra
 * @since      Zakra 1.5.7
 */

if ( ! function_exists( 'zakra_get_fonts' ) ) {

	/**
	 * Action hook to get the required Google fonts for this theme.
	 */
	function zakra_get_fonts() {

		$base_typography_default = array(
			'font-family' => 'default',
			'font-weight' => '400',
		);

		$base_heading_typography_default = array(
			'font-family' => 'default',
			'font-weight' => '400',
		);

		$site_title_typography_default = array(
			'font-family' => 'default',
			'font-weight' => '400',
		);

		$site_tagline_typography_default = array(
			'font-family' => 'default',
			'font-weight' => '400',
		);

		$primary_menu_typography_default = array(
			'font-family' => 'default',
			'font-weight' => '400',
		);

		$primary_menu_dropdown_typography_default = array(
			'font-family' => 'default',
			'font-weight' => '400',
		);

		$mobile_menu_typography_default = array(
			'font-family' => 'default',
			'font-weight' => '400',
		);

		$post_page_title_typography_default = array(
			'font-family' => 'default',
			'font-weight' => '500',
		);

		$blog_post_title_typography_default = array(
			'font-family' => 'default',
			'font-weight' => '500',
		);

		$h1_typography_default = array(
			'font-family' => 'default',
			'font-weight' => '500',
		);

		$h2_typography_default = array(
			'font-family' => 'default',
			'font-weight' => '500',
		);

		$h3_typography_default = array(
			'font-family' => 'default',
			'font-weight' => '500',
		);

		$h4_typography_default = array(
			'font-family' => 'default',
			'font-weight' => '500',
		);

		$h5_typography_default = array(
			'font-family' => 'default',
			'font-weight' => '500',
		);

		$h6_typography_default = array(
			'font-family' => 'default',
			'font-weight' => '500',
		);

		$widget_heading_typography_default = array(
			'font-family' => 'default',
			'font-weight' => '500',
		);

		$widget_content_typography_default = array(
			'font-family' => 'default',
			'font-weight' => '500',
		);

		$base_typography                  = get_theme_mod( 'zakra_base_typography_body', $base_typography_default );
		$base_heading_typography          = get_theme_mod( 'zakra_base_typography_heading', $base_heading_typography_default );
		$site_title_typography            = get_theme_mod( 'zakra_typography_site_title', $site_title_typography_default );
		$site_tagline_typography          = get_theme_mod( 'zakra_typography_site_description', $site_tagline_typography_default );
		$primary_menu_typography          = get_theme_mod( 'zakra_typography_primary_menu', $primary_menu_typography_default );
		$primary_menu_dropdown_typography = get_theme_mod( 'zakra_typography_primary_menu_dropdown_item', $primary_menu_dropdown_typography_default );
		$mobile_menu_typography           = get_theme_mod( 'zakra_typography_mobile_menu', $mobile_menu_typography_default );
		$post_page_title_typography       = get_theme_mod( 'zakra_typography_post_page_title', $post_page_title_typography_default );
		$blog_post_title_typography       = get_theme_mod( 'zakra_typography_blog_post_title', $blog_post_title_typography_default );
		$h1_typography                    = get_theme_mod( 'zakra_typography_h1', $h1_typography_default );
		$h2_typography                    = get_theme_mod( 'zakra_typography_h2', $h2_typography_default );
		$h3_typography                    = get_theme_mod( 'zakra_typography_h3', $h3_typography_default );
		$h4_typography                    = get_theme_mod( 'zakra_typography_h4', $h4_typography_default );
		$h5_typography                    = get_theme_mod( 'zakra_typography_h5', $h5_typography_default );
		$h6_typography                    = get_theme_mod( 'zakra_typography_h6', $h6_typography_default );
		$widget_heading_typography        = get_theme_mod( 'zakra_typography_widget_heading', $widget_heading_typography_default );
		$widget_content_typography        = get_theme_mod( 'zakra_typography_widget_content', $widget_content_typography_default );

		// Grouped typography options with default font-wight of 400.
		$zakra_typography_options_one = array(
			$base_typography,
			$base_heading_typography,
			$site_title_typography,
			$site_tagline_typography,
			$primary_menu_typography,
			$primary_menu_dropdown_typography,
			$mobile_menu_typography,
		);

		// Grouped typography options with default font-wight of 500.
		$zakra_typography_options_two = array(
			$post_page_title_typography,
			$blog_post_title_typography,
			$h1_typography,
			$h2_typography,
			$h3_typography,
			$h4_typography,
			$h5_typography,
			$h6_typography,
			$widget_heading_typography,
			$widget_content_typography,
		);

		foreach ( $zakra_typography_options_one as $zakra_typography_option_one ) {

			if ( isset( $zakra_typography_option_one['font-family'] ) && 'default' === $zakra_typography_option_one['font-family'] ) {
				$zakra_typography_option_one['font-family'] = '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", Helvetica, Arial, sans-serif';
			}

			if ( isset( $zakra_typography_option_one['font-family'] ) ) {
				Zakra_Generate_Fonts::add_font( $zakra_typography_option_one['font-family'], isset( $zakra_typography_option_one['font-weight'] ) ? $zakra_typography_option_one['font-weight'] : '400' );
			}
		}

		foreach ( $zakra_typography_options_two as $zakra_typography_option_two ) {

			if ( isset( $zakra_typography_option_two['font-family'] ) && 'default' === $zakra_typography_option_two['font-family'] ) {
				$zakra_typography_option_two['font-family'] = '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", Helvetica, Arial, sans-serif';
			}

			if ( isset( $zakra_typography_option_two['font-family'] ) ) {
				Zakra_Generate_Fonts::add_font( $zakra_typography_option_two['font-family'], isset( $zakra_typography_option_two['font-weight'] ) ? $zakra_typography_option_two['font-weight'] : '500' );
			}
		}
	}
}

add_action( 'zakra_get_fonts', 'zakra_get_fonts' );

if ( zakra_is_zakra_pro_active() && zakra_plugin_version_compare( 'zakra-pro/zakra-pro.php', '1.2.9', '<' ) ) {

	// Remove actions and filters hooks if Zakra Pro version is less than 1.2.9.
	zakra_remove_filters_with_method_name( 'customize_register', 'zakra_pro_customize_register', 15 );
	zakra_remove_filters_with_method_name( 'after_setup_theme', 'zakra_pro_customize_options', 15 );
	remove_action( 'wp_enqueue_scripts', 'zakra_pro_add_metabox_styles', 12 );
	remove_filter( 'zakra_page_header_style_filter', 'zakra_pro_page_header_style_filter', 10, 2 );
	remove_filter( 'zakra_header_style_meta_save', 'zakra_pro_header_style_meta_save', 20 );
	remove_filter( 'zakra_page_setting', 'zakra_pro_page_setting', 15 );
	remove_action( 'zakra_page_settings', 'zakra_pro_page_settings' );
	remove_action( 'zakra_general_page_setting', 'zakra_pro_general_page_setting' );
	remove_action( 'zakra_header_page_setting', 'zakra_pro_header_page_setting' );
	remove_action( 'zakra_primary_menu_page_settings_before', 'zakra_pro_primary_menu_page_settings_before' );
	remove_action( 'zakra_page_header_page_setting', 'zakra_pro_page_header_style' );
	remove_action( 'zakra_page_settings_save', 'zakra_pro_page_settings_save' );
}
