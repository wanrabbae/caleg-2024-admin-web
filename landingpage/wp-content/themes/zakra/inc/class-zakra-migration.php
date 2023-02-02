<?php

if ( ! class_exists( 'Zakra_Migration' ) ) {

	class Zakra_Migration {

		public function __construct() {

			if ( ! self::is_fresh_install() || self::demo_import_migration() ) {
				add_action( 'after_setup_theme', array( $this, 'stretched_style_migration' ), 10 );
				add_action( 'after_setup_theme', array( $this, 'customizer_migration_v1' ), 15 );
				add_action( 'after_setup_theme', array( $this, 'customizer_migration_v2' ), 20 );
				add_action( 'zakra_customizer_migration_v2', array( $this, 'migrate_typography_options' ) );
				add_action( 'zakra_customizer_migration_v2', array( $this, 'migrate_background_color_options' ) );
				add_action( 'zakra_customizer_migration_v2', array( $this, 'migrate_slider_options' ) );
			}
		}

		/**
		 * Migrate `Stretched` container style to `Layout`.
		 *
		 * @since 1.0.8
		 */
		public function stretched_style_migration() {
			$container_style = get_theme_mod( 'zakra_general_container_style', 'tg-container--wide' );

			$layout_arr = array( 'tg-site-layout--left', 'tg-site-layout--right' );

			$page_types = array( 'default', 'archive', 'post', 'page' );

			// Lets bail out if container style is not stretched.
			if ( 'tg-container--stretched' !== $container_style ) {
				return;
			}

			// Lets bail out if 'zakra_stretched_style_transfer' option found.
			if ( get_option( 'zakra_stretched_style_transfer' ) ) {
				return;
			}

			set_theme_mod( 'zakra_general_container_style', 'tg-container--wide' );

			foreach ( $page_types as $page_type ) {
				$layout = get_theme_mod( 'zakra_structure_' . $page_type, 'tg-site-layout--right' );

				// Do nothing if left or right sidebar enabled.
				if ( ! in_array( $layout, $layout_arr, true ) ) {
					set_theme_mod( 'zakra_structure_' . $page_type, 'tg-site-layout--stretched' );
				}
			}

			// Set transfer as complete.
			update_option( 'zakra_stretched_style_transfer', 1 );
		}

		/**
		 * Customizer options migration.
		 *
		 * @since 1.5.3
		 */
		public function customizer_migration_v1() {

			if ( get_option( 'zakra_migrations' ) ) {
				return;
			}

			// Update id: `zakra_typography_page_title` to `zakra_typography_post_page_title`
			$old_page_title_typography = get_theme_mod( 'zakra_typography_page_title' );

			if ( $old_page_title_typography ) {
				set_theme_mod( 'zakra_typography_post_page_title', $old_page_title_typography );
				remove_theme_mod( 'zakra_typography_page_title' );
			}

			// Migrate Page Header Text Color to Typography.
			$old_page_title_color       = get_theme_mod( 'zakra_page_header_text_color' );
			$old_page_title_font_size   = get_theme_mod( 'zakra_page_title_font_size' );
			$post_page_title_typography = get_theme_mod(
				'zakra_typography_post_page_title',
				apply_filters(
					'zakra_typography_post_page_title_filter',
					array(
						'font-family' => '-apple-system, blinkmacsystemfont, segoe ui, roboto, oxygen-sans, ubuntu, cantarell, helvetica neue, helvetica, arial, sans-serif',
						'variant'     => '500',
						'line-height' => '1.3',
						'color'       => '#16181a',
					)
				)
			);

			if ( $old_page_title_color ) {
				$post_page_title_typography['color'] = $old_page_title_color;
				set_theme_mod( 'zakra_typography_post_page_title', $post_page_title_typography );
				remove_theme_mod( 'zakra_page_header_text_color' );
			}

			if ( $old_page_title_font_size ) {
				$post_page_title_typography['font-size'] = $old_page_title_font_size['slider'] . $old_page_title_font_size['suffix'];
				set_theme_mod( 'zakra_typography_post_page_title', $post_page_title_typography );
				remove_theme_mod( 'zakra_page_title_font_size' );
			}

			// Migrate headings colors from typography to heading colors.
			$headings_typography = get_theme_mod(
				'zakra_base_typography_heading',
				apply_filters(
					'zakra_base_typography_heading_filter',
					array(
						'font-family' => '-apple-system, blinkmacsystemfont, segoe ui, roboto, oxygen-sans, ubuntu, cantarell, helvetica neue, helvetica, arial, sans-serif',
						'variant'     => '400',
						'line-height' => '1.3',
						'color'       => '#16181a',
					)
				)
			);

			$h1_typography = get_theme_mod(
				'zakra_typography_h1',
				apply_filters(
					'zakra_typography_h1_filter',
					array(
						'font-family' => '-apple-system, blinkmacsystemfont, segoe ui, roboto, oxygen-sans, ubuntu, cantarell, helvetica neue, helvetica, arial, sans-serif',
						'variant'     => '500',
						'font-size'   => '2.5rem',
						'line-height' => '1.3',
						'color'       => '#16181a',
					)
				)
			);

			$h2_typography = get_theme_mod(
				'zakra_typography_h2',
				apply_filters(
					'zakra_typography_h2_filter',
					array(
						'font-family' => '-apple-system, blinkmacsystemfont, segoe ui, roboto, oxygen-sans, ubuntu, cantarell, helvetica neue, helvetica, arial, sans-serif',
						'variant'     => '500',
						'font-size'   => '2.25rem',
						'line-height' => '1.3',
						'color'       => '#16181a',
					)
				)
			);

			$h3_typography = get_theme_mod(
				'zakra_typography_h3',
				apply_filters(
					'zakra_typography_h3_filter',
					array(
						'font-family' => '-apple-system, blinkmacsystemfont, segoe ui, roboto, oxygen-sans, ubuntu, cantarell, helvetica neue, helvetica, arial, sans-serif',
						'variant'     => '500',
						'font-size'   => '2rem',
						'line-height' => '1.3',
						'color'       => '#16181a',
					)
				)
			);

			$h4_typography = get_theme_mod(
				'zakra_typography_h4',
				apply_filters(
					'zakra_typography_h4_filter',
					array(
						'font-family' => '-apple-system, blinkmacsystemfont, segoe ui, roboto, oxygen-sans, ubuntu, cantarell, helvetica neue, helvetica, arial, sans-serif',
						'variant'     => '500',
						'font-size'   => '1.75rem',
						'line-height' => '1.3',
						'color'       => '#16181a',
					)
				)
			);

			$h5_typography = get_theme_mod(
				'zakra_typography_h5',
				apply_filters(
					'zakra_typography_h5_filter',
					array(
						'font-family' => '-apple-system, blinkmacsystemfont, segoe ui, roboto, oxygen-sans, ubuntu, cantarell, helvetica neue, helvetica, arial, sans-serif',
						'variant'     => '500',
						'font-size'   => '1.313rem',
						'line-height' => '1.3',
						'color'       => '#16181a',
					)
				)
			);

			$h6_typography = get_theme_mod(
				'zakra_typography_h6',
				apply_filters(
					'zakra_typography_h6_filter',
					array(
						'font-family' => '-apple-system, blinkmacsystemfont, segoe ui, roboto, oxygen-sans, ubuntu, cantarell, helvetica neue, helvetica, arial, sans-serif',
						'variant'     => '500',
						'font-size'   => '1.125rem',
						'line-height' => '1.3',
						'color'       => '#16181a',
					)
				)
			);

			if ( in_array( 'color', $headings_typography, true ) && isset( $headings_typography['color'] ) ) {
				set_theme_mod( 'zakra_color_headings', $headings_typography['color'] );
				unset( $headings_typography['color'] );
				set_theme_mod( 'zakra_base_typography_heading', $headings_typography );
			}

			if ( in_array( 'color', $h1_typography, true ) && isset( $h1_typography['color'] ) ) {
				set_theme_mod( 'zakra_color_h1', $headings_typography['color'] );
				unset( $h1_typography['color'] );
				set_theme_mod( 'zakra_typography_h1', $h1_typography );
			}

			if ( in_array( 'color', $headings_typography, true ) && isset( $headings_typography['color'] ) ) {
				set_theme_mod( 'zakra_color_h2', $h2_typography['color'] );
				unset( $h2_typography['color'] );
				set_theme_mod( 'zakra_typography_h2', $h2_typography );
			}

			if ( in_array( 'color', $h3_typography, true ) && isset( $h3_typography['color'] ) ) {
				set_theme_mod( 'zakra_color_h3', $h3_typography['color'] );
				unset( $h3_typography['color'] );
				set_theme_mod( 'zakra_typography_h3', $h3_typography );
			}

			if ( in_array( 'color', $h4_typography, true ) && isset( $h4_typography['color'] ) ) {
				set_theme_mod( 'zakra_color_h4', $h4_typography['color'] );
				unset( $h4_typography['color'] );
				set_theme_mod( 'zakra_typography_h4', $h4_typography );
			}

			if ( in_array( 'color', $h5_typography, true ) && isset( $h5_typography['color'] ) ) {
				set_theme_mod( 'zakra_color_h5', $h5_typography['color'] );
				unset( $h5_typography['color'] );
				set_theme_mod( 'zakra_typography_h5', $h5_typography );
			}

			if ( in_array( 'color', $h6_typography, true ) && isset( $h6_typography['color'] ) ) {
				set_theme_mod( 'zakra_color_h6', $h6_typography['color'] );
				unset( $h6_typography['color'] );
				set_theme_mod( 'zakra_typography_h6', $h6_typography );
			}

			// Set flag to not repeat the migration process, ie, run it only once.
			update_option( 'zakra_migrations', true );
		}

		/**
		 * Customizer options migration after implementation of customizer framework.
		 *
		 * @since 2.0.0
		 */
		public function customizer_migration_v2() {

			if ( ! self::demo_import_migration() ) {

				if ( get_option( 'zakra_customizer_migration_v2' ) ) {
					return;
				}
			}

			do_action( 'zakra_customizer_migration_v2' );

			// Set flag to not repeat the migration process, ie, run it only once.
			update_option( 'zakra_customizer_migration_v2', true );

			// Set flag for demo import migration to not repeat the migration process, ie, run it only once.
			if ( self::demo_import_migration() ) {
				update_option( 'zakra_demo_import_migration_notice_dismiss', true );
			}
		}

		public function migrate_typography_options() {

			// Remove theme mod.
			remove_theme_mod( 'zakra_typography_primary_menu_dropdown' );

			$old_typography_header_icon = get_theme_mod(
				'zakra_typograyphy_header_icon',
				array(
					'color'     => '',
					'font-size' => '1rem',
				)
			);

			if ( $old_typography_header_icon ) {
				set_theme_mod(
					'zakra_typography_header_icon',
					array(
						'font-size' => array(
							'desktop' => isset( $old_typography_header_icon['font-size'] ) ? $old_typography_header_icon['font-size'] : '',
							'tablet'  => '',
							'mobile'  => '',
						),
					)
				);
				set_theme_mod( 'zakra_header_icon_color', $old_typography_header_icon['color'] );
				remove_theme_mod( 'zakra_typograyphy_header_icon' );
			}

			$old_base_typography_heading = get_theme_mod(
				'zakra_base_typography_heading',
				apply_filters(
					'zakra_base_typography_heading_filter',
					array(
						'font-family' => '-apple-system, blinkmacsystemfont, segoe ui, roboto, oxygen-sans, ubuntu, cantarell, helvetica neue, helvetica, arial, sans-serif',
						'variant'     => '400',
						'line-height' => '1.3',
					)
				)
			);

			if ( isset( $old_base_typography_heading ) && array_key_exists( 'variant', $old_base_typography_heading ) ) {
				set_theme_mod(
					'zakra_base_typography_heading',
					array(
						'font-family'    => isset( $old_base_typography_heading['font-family'] ) ? $old_base_typography_heading['font-family'] : 'default',
						'font-weight'    => isset( $old_base_typography_heading['font-weight'] ) && array_key_exists( 'font-weight', $old_base_typography_heading ) ? $old_base_typography_heading['font-weight'] : ( isset( $old_base_typography_heading['variant'] ) ? (int) $old_base_typography_heading['variant'] : '' ),
						'line-height'    => array(
							'desktop' => isset( $old_base_typography_heading['line-height'] ) ? $old_base_typography_heading['line-height'] : '',
							'tablet'  => '',
							'mobile'  => '',
						),
						'font-style'     => array_key_exists( 'font-style', $old_base_typography_heading ) ? $old_base_typography_heading['font-style'] : 'normal',
						'text-transform' => 'none',
					)
				);
			}

			$typography_option_keys = array(
				'zakra_typography_paragraph',
				'zakra_typography_preformatted_text',
				'zakra_typography_blockquote',
				'zakra_typography_header_top_widget_title',
				'zakra_typography_header_top_widget_content',
				'zakra_typography_header_top_menu',
				'zakra_typography_header_top_text',
				'zakra_typography_header_button_one',
				'zakra_typography_header_button_two',
				'zakra_typography_mobile_submenu',
				'zakra_typography_read_more',
				'zakra_typography_post_meta',
				'zakra_typography_post_meta_content',
				'zakra_typography_widget_list_item',
				'zakra_typography_page_title',
				'zakra_typography_post_title',
				'zakra_typography_footer_bar_widget_title',
				'zakra_typography_footer_bar_widget_content',
				'zakra_typography_footer_bar_menu',
				'zakra_typography_footer_bar_text',
				'zakra_typography_footer_widgets_title',
				'zakra_typography_footer_widgets_content',
				'zakra_typography_footer_widgets_list_item',
				'zakra_base_typography_body',
				'zakra_typography_site_title',
				'zakra_typography_site_description',
				'zakra_typography_primary_menu',
				'zakra_typography_primary_menu_dropdown_item',
				'zakra_typography_mobile_menu',
				'zakra_typography_post_page_title',
				'zakra_typography_blog_post_title',
				'zakra_typography_h1',
				'zakra_typography_h2',
				'zakra_typography_h3',
				'zakra_typography_h4',
				'zakra_typography_h5',
				'zakra_typography_h6',
				'zakra_typography_widget_heading',
				'zakra_typography_widget_content',
			);

			$typography_option_with_color_keys = array(
				'zakra_typography_paragraph'         => 'zakra_paragraph_color',
				'zakra_typography_preformatted_text' => 'zakra_preformatted_color',
				'zakra_typography_blockquote'        => 'zakra_blockquote_color',
				'zakra_typography_post_page_title'   => 'zakra_post_page_title_color',
			);

			$system_fonts = array(
				'-apple-system',
				'blinkmacsystemfont',
				'segoe ui',
				'roboto',
				'oxygen-sans',
				'ubuntu',
				'cantarell',
				'helvetica neue',
				'helvetica',
				'arial',
				'sans-serif',
			);

			foreach ( $typography_option_with_color_keys as $typography_option_with_color_key => $new_color_key ) {
				$old_typography_option_with_color = get_theme_mod( $typography_option_with_color_key );

				if ( ! empty( $old_typography_option_with_color ) && is_array( $old_typography_option_with_color ) && array_key_exists( 'color', $old_typography_option_with_color ) ) {
					set_theme_mod( $new_color_key, $old_typography_option_with_color['color'] );
					unset( $old_typography_option_with_color['color'] );
				}
			}

			foreach ( $typography_option_keys as $typography_option_key ) {
				$old_typography_option = get_theme_mod( $typography_option_key );

				if ( ! empty( $old_typography_option ) && is_array( $old_typography_option ) && array_key_exists( 'variant', $old_typography_option ) ) {
					set_theme_mod(
						$typography_option_key,
						array(
							'font-family'    => ( isset( $old_typography_option['font-family'] ) && ! zakra_strpos( $old_typography_option['font-family'], $system_fonts ) ) ? $old_typography_option['font-family'] : 'default',
							'font-weight'    => isset( $old_typography_option['font-weight'] ) && array_key_exists( 'font-weight', $old_typography_option ) ? $old_typography_option['font-weight'] : ( isset( $old_typography_option['variant'] ) ? (int) $old_typography_option['variant'] : '' ),
							'font-size'      => array(
								'desktop' => isset( $old_typography_option['font-size'] ) ? $old_typography_option['font-size'] : '',
								'tablet'  => '',
								'mobile'  => '',
							),
							'line-height'    => array(
								'desktop' => isset( $old_typography_option['line-height'] ) ? $old_typography_option['line-height'] : '',
								'tablet'  => '',
								'mobile'  => '',
							),
							'font-style'     => array_key_exists( 'font-style', $old_typography_option ) ? $old_typography_option['font-style'] : 'normal',
							'text-transform' => 'none',
						)
					);
				}
			}
		}

		public function migrate_background_color_options() {

			// Background color options key.
			$bg_color_option_keys = array(
				'zakra_blog_archive_read_more_button_bg',
				'zakra_blog_archive_pagination_bg',
				'zakra_blog_archive_read_more_button_hover_bg',
				'zakra_blog_archive_pagination_number_item_link_hover_bg',
				'zakra_blog_archive_post_bg',
				'zakra_archive_blog_post_grid_bg',
				'zakra_archive_blog_post_thumbnail_bg',
				'zakra_footer_widgets_item_bg',
				'zakra_primary_menu_item_bg_color_button',
				'zakra_primary_menu_item_bg_hover_color_button',
				'zakra_primary_menu_item_bg_active_color_button',
			);

			foreach ( $bg_color_option_keys as $bg_color_option_key ) {
				$old_bg_color_option = get_theme_mod( $bg_color_option_key );

				if ( ! empty( $old_bg_color_option ) && is_array( $old_bg_color_option ) && array_key_exists( 'background-color', $old_bg_color_option ) ) {
					set_theme_mod( $bg_color_option_key, $old_bg_color_option['background-color'] );
				}
			}
		}

		public function migrate_slider_options() {

			// Slider options key.
			$slider_option_keys = array(
				'zakra_primary_menu_border_bottom_width',
				'zakra_breadcrumbs_font_size',
				'zakra_footer_bar_border_top_width',
				'zakra_footer_widgets_border_top_width',
				'zakra_footer_widgets_item_border_bottom_width',
				'zakra_button_roundness',
				'zakra_general_container_width',
				'zakra_general_content_width',
				'zakra_general_sidebar_width',
				'zakra_header_button_roundness',
				'zakra_header_main_border_bottom_width',
				'zakra_mobile_menu_breakpoint',
				'zakra_mobile_menu_toggle_font_size',
				'zakra_mobile_menu_toggle_fill_border_radius',
				'zakra_mobile_menu_toggle_outline_border',
				'zakra_mobile_menu_toggle_outline_border_radius',
				'zakra_mobile_submenu_max_height',
				'zakra_mobile_menu_item_border_bottom',
				'zakra_blog_archive_blog_thumbnail_image_style',
				'zakra_blog_archive_post_title_spacing',
				'zakra_blog_archive_read_more_button_border_width',
				'zakra_meta_border_width',
				'zakra_sidebar_widgets_spacing',
				'zakra_sidebar_widgets_border_width',
				'zakra_site_logo_width',
				'zakra_woocommerce_related_products_count',
				'zakra_woocommerce_related_products_per_row',
				'zakra_pro_content_margin_option',
				'zakra_blog_archive_excerpt_length',
				'zakra_primary_menu_dropdown_width',
				'zakra_header_button_border_width',
				'zakra_button_border_width',
				'zakra_sidebar_widgets_item_border_bottom_width',
				'zakra_scroll_to_top_width',
				'zakra_scroll_to_top_height',
				'zakra_scroll_to_top_roundness',
				'zakra_scroll_to_top_bottom_position',
				'zakra_scroll_to_top_icon_font_size',
				'zakra_header_image_cta_title_spacing',
				'zakra_header_image_cta_text_spacing',
				'zakra_header_top_border_bottom',
				'zakra_header_button_two_border_width',
				'zakra_header_button_two_roundness',
				'zakra_primary_menu_dropdown_item_border_width',
			);

			foreach ( $slider_option_keys as $slider_option_key ) {
				$old_slider_option = get_theme_mod( $slider_option_key );

				if ( ! empty( $old_slider_option ) && is_array( $old_slider_option ) && array_key_exists( 'slider', $old_slider_option ) ) {
					set_theme_mod( $slider_option_key, $old_slider_option['slider'] );
				}
			}
		}

		/**
		 * Return the value for customize migration on demo import.
		 *
		 * @return bool
		 */
		public static function demo_import_migration() {

			if ( isset( $_GET['zakra_notice_dismiss'] ) && isset( $_GET['_zakra_demo_import_migration_notice_dismiss_nonce'] ) ) {

				if ( ! wp_verify_nonce( wp_unslash( $_GET['_zakra_demo_import_migration_notice_dismiss_nonce'] ), 'zakra_demo_import_migration_notice_dismiss_nonce' ) ) { // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
					wp_die( esc_html__( 'Action failed. Please refresh the page and retry.', 'zakra' ) );
				}

				return true;
			}

			return false;
		}

		/**
		 * @return bool
		 */
		public static function is_fresh_install() {

			/**
			 * If the option with keys zakra_stretched_style_transfer ( introduced in V1.0.8 )
			 * or zakra_migrations ( introduced V1.5.3 ) is available in the option table.
			 * It is not a fresh install of the theme.
			 *
			 * @TODO Better way to check if it is a fresh installation of theme.
			 */
			if ( get_option( 'zakra_stretched_style_transfer' ) || get_option( 'zakra_migrations' ) ) {
				return false;
			}

			return true;
		}
	}

	new Zakra_Migration();

}
