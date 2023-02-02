<?php
/**
 * Helper class for font settings for this theme.
 *
 * Class Zakra_Fonts
 *
 * @package    ThemeGrill
 * @subpackage Zakra
 * @since      Zakra 3.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Helper class for font settings for this theme.
 *
 * Class Zakra_Fonts
 */
class Zakra_Fonts {

	/**
	 * System Fonts
	 *
	 * @var array
	 */
	public static $system_fonts = array();

	/**
	 * Google Fonts
	 *
	 * @var array
	 */
	public static $google_fonts = array();

	/**
	 * Custom Fonts
	 *
	 * @var array
	 */
	public static $custom_fonts = array();

	/**
	 * Font variants
	 *
	 * @var array
	 */
	public static $font_variants = array();

	/**
	 * Google font subsets
	 *
	 * @var array
	 */
	public static $google_font_subsets = array();

	/**
	 * Get system fonts.
	 *
	 * @return mixed|void
	 */
	public static function get_system_fonts() {

		if ( empty( self::$system_fonts ) ) :

			self::$system_fonts = array(

				'default'                               => array(
					'family' => 'default',
					'label'  => 'Default',
				),
				'Georgia,Times,"Times New Roman",serif' => array(
					'family' => 'Georgia,Times,"Times New Roman",serif',
					'label'  => 'serif',
				),
				'-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", Helvetica, Arial, sans-serif' => array(
					'family' => '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", Helvetica, Arial, sans-serif',
					'label'  => 'sans-serif',
				),
				'Monaco,"Lucida Sans Typewriter","Lucida Typewriter","Courier New",Courier,monospace' => array(
					'family' => 'Monaco,"Lucida Sans Typewriter","Lucida Typewriter","Courier New",Courier,monospace',
					'label'  => 'monospace',
				),

			);

		endif;

		/**
		 * Filter for system fonts.
		 *
		 * @since   1.0.0
		 */
		return apply_filters( 'zakra_system_fonts', self::$system_fonts );

	}

	/**
	 * Get Google fonts.
	 * It's array is generated from the google-fonts.json file.
	 *
	 * @return mixed|void
	 */
	public static function get_google_fonts() {

		if ( empty( self::$google_fonts ) ) :

			global $wp_filesystem;

			/**
			 * Filter for google fonts json file.
			 *
			 * @since   1.0.0
			 */
			$google_fonts_file = apply_filters( 'zakra_google_fonts_json_file', dirname( __FILE__ ) . '/custom-controls/typography/google-fonts.json' );

			if ( ! file_exists( dirname( __FILE__ ) . '/custom-controls/typography/google-fonts.json' ) ) {
				return array();
			}

			// Require `file.php` file of WordPress to include filesystem check for getting the file contents.
			if ( ! $wp_filesystem ) {
				require_once ABSPATH . '/wp-admin/includes/file.php';
			}

			// Proceed only if the file is readable.
			if ( is_readable( $google_fonts_file ) ) {
				WP_Filesystem();

				$file_contents     = $wp_filesystem->get_contents( $google_fonts_file );
				$google_fonts_json = json_decode( $file_contents, 1 );

				foreach ( $google_fonts_json['items'] as $key => $font ) {

					$google_fonts[ $font['family'] ] = array(
						'family'   => $font['family'],
						'label'    => $font['family'],
						'variants' => $font['variants'],
						'subsets'  => $font['subsets'],
					);

					self::$google_fonts = $google_fonts;

				}
			}

		endif;

		/**
		 * Filter for system fonts.
		 *
		 * @since   1.0.0
		 */
		return apply_filters( 'zakra_system_fonts', self::$google_fonts );

	}

	/**
	 * Get custom fonts.
	 *
	 * @return mixed|void
	 */
	public static function get_custom_fonts() {

		/**
		 * Filter for custom fonts.
		 *
		 * @since   1.0.0
		 */
		return apply_filters( 'zakra_custom_fonts', self::$custom_fonts );

	}

	/**
	 * Get font variants.
	 *
	 * @return mixed|void
	 */
	public static function get_font_variants() {

		if ( empty( self::$font_variants ) ) :

			self::$font_variants = array(
				'100'       => esc_html__( 'Thin 100', 'zakra' ),
				'100italic' => esc_html__( 'Thin 100 Italic', 'zakra' ),
				'200'       => esc_html__( 'Extra-Light 200', 'zakra' ),
				'200italic' => esc_html__( 'Extra-Light 200 Italic', 'zakra' ),
				'300'       => esc_html__( 'Light 300', 'zakra' ),
				'300italic' => esc_html__( 'Light 300 Italic', 'zakra' ),
				'regular'   => esc_html__( 'Regular 400', 'zakra' ),
				'italic'    => esc_html__( 'Regular 400 Italic', 'zakra' ),
				'500'       => esc_html__( 'Medium 500', 'zakra' ),
				'500italic' => esc_html__( 'Medium 500 Italic', 'zakra' ),
				'600'       => esc_html__( 'Semi-Bold 600', 'zakra' ),
				'600italic' => esc_html__( 'Semi-Bold 600 Italic', 'zakra' ),
				'700'       => esc_html__( 'Bold 700', 'zakra' ),
				'700italic' => esc_html__( 'Bold 700 Italic', 'zakra' ),
				'800'       => esc_html__( 'Extra-Bold 800', 'zakra' ),
				'800italic' => esc_html__( 'Extra-Bold 800 Italic', 'zakra' ),
				'900'       => esc_html__( 'Black 900', 'zakra' ),
				'900italic' => esc_html__( 'Black 900 Italic', 'zakra' ),
			);

		endif;

		/**
		 * Filter for font variants.
		 *
		 * @since   1.0.0
		 */
		return apply_filters( 'zakra_font_variants', self::$font_variants );

	}

	/**
	 * Get Google font subsets.
	 *
	 * @return mixed|void
	 */
	public static function get_google_font_subsets() {

		if ( empty( self::$google_font_subsets ) ) :

			self::$google_font_subsets = array(
				'arabic'              => esc_html__( 'Arabic', 'zakra' ),
				'bengali'             => esc_html__( 'Bengali', 'zakra' ),
				'chinese-hongkong'    => esc_html__( 'Chinese (Hong Kong)', 'zakra' ),
				'chinese-simplified'  => esc_html__( 'Chinese (Simplified)', 'zakra' ),
				'chinese-traditional' => esc_html__( 'Chinese (Traditional)', 'zakra' ),
				'cyrillic'            => esc_html__( 'Cyrillic', 'zakra' ),
				'cyrillic-ext'        => esc_html__( 'Cyrillic Extended', 'zakra' ),
				'devanagari'          => esc_html__( 'Devanagari', 'zakra' ),
				'greek'               => esc_html__( 'Greek', 'zakra' ),
				'greek-ext'           => esc_html__( 'Greek Extended', 'zakra' ),
				'gujarati'            => esc_html__( 'Gujarati', 'zakra' ),
				'gurmukhi'            => esc_html__( 'Gurmukhi', 'zakra' ),
				'hebrew'              => esc_html__( 'Hebrew', 'zakra' ),
				'japanese'            => esc_html__( 'Japanese', 'zakra' ),
				'kannada'             => esc_html__( 'Kannada', 'zakra' ),
				'khmer'               => esc_html__( 'Khmer', 'zakra' ),
				'korean'              => esc_html__( 'Korean', 'zakra' ),
				'latin'               => esc_html__( 'Latin', 'zakra' ),
				'latin-ext'           => esc_html__( 'Latin Extended', 'zakra' ),
				'malayalam'           => esc_html__( 'Malayalam', 'zakra' ),
				'myanmar'             => esc_html__( 'Myanmar', 'zakra' ),
				'oriya'               => esc_html__( 'Oriya', 'zakra' ),
				'sinhala'             => esc_html__( 'Sinhala', 'zakra' ),
				'tamil'               => esc_html__( 'Tamil', 'zakra' ),
				'telugu'              => esc_html__( 'Telugu', 'zakra' ),
				'thai'                => esc_html__( 'Thai', 'zakra' ),
				'tibetan'             => esc_html__( 'Tibetan', 'zakra' ),
				'vietnamese'          => esc_html__( 'Vietnamese', 'zakra' ),
			);

		endif;

		/**
		 * Filter for font variants.
		 *
		 * @since   1.0.0
		 */
		return apply_filters( 'zakra_font_variants', self::$google_font_subsets );

	}

}
