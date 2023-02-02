<?php
/**
 * Extend WP_Customize_Control to add the gradient control.
 *
 * Class Zakra_Gradient_Control
 *
 * @package    ThemeGrill
 * @subpackage Zakra
 * @since      Zakra 1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class to extend WP_Customize_Control to add the gradient customize control.
 *
 * Class Zakra_Gradient_Control
 */
class Zakra_Gradient_Control extends Zakra_Customize_Base_Additional_Control {


	/**
	 * Control's Type.
	 *
	 * @var string
	 */
	public $type = 'zakra-gradient';
	/**
	 * Suffix for slider.
	 *
	 * @var string
	 */
	public $suffix = '';

	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 *
	 * @see WP_Customize_Control::to_json()
	 */
	public function to_json() {
		parent::to_json();
		$this->json['default'] = $this->setting->default;

		if ( isset( $this->default ) ) {
			$this->json['default'] = $this->default;
		}

		$this->json['value']       = $this->value();
		$this->json['link']        = $this->get_link();
		$this->json['id']          = $this->id;
		$this->json['label']       = $this->label;
		$this->json['description'] = $this->description;
		$this->json['suffix']      = $this->suffix;
		$this->json['input_attrs'] = $this->input_attrs;
	}

	/**
	 * An Underscore (JS) template for this control's content (but not its container).
	 *
	 * Class variables for this control class are available in the `data` JS object;
	 * export custom variables by overriding {@see WP_Customize_Control::to_json()}.
	 *
	 * @see    WP_Customize_Control::print_template()
	 *
	 */
	protected function content_template() {
		?>
		<div class="customizer-text">
			<# if ( data.label ) { #>
			<span class="customize-control-title">{{{ data.label }}}</span>
			<# } #>

			<# if ( data.description ) { #>
			<span class="description customize-control-description">{{{ data.description }}}</span>
			<# } #>
		</div>

		<div class="color">
			<div class="customizer-wrapper">
				<div class="customizer-text color-1">
					<span class="customize-control-title">Color</span>

					<# if ( data.description ) { #>
					<span class="description customize-control-description">{{{ data.description }}}</span>
					<# } #>
				</div>

				<div class="customize-control-content">
					<input data-name="{{ data.name }}"
						   class="zakra-color-picker-alpha color-picker-hex"
						   type="text"
						   data-alpha-enabled="true"
						   data-default-color="{{ data.default['color'] }}"
						   value="{{ data.value['color'] }}"
					/>
				</div>

				<div class="customizer-text">
					<span class="customize-control-title">Location 1</span>
				</div>

				<div class="slider-wrapper <# if ( data.description ) { #>slider-description<# } #>">
					<input min="{{ data.input_attrs['location']['min'] }}"
						   max="{{ data.input_attrs['location']['max'] }}"
						   step="{{ data.input_attrs['location']['step'] }}"
						   suffix="{{ data.input_attrs['location']['suffix'] }}"
						   type="range"
						   value="{{ data.value['location'] }}"
						   data-reset_value="{{ data.default['location'] }}"
					/>

					<div class="zakra-range-value">
						<input type="number"
							   data-name="{{ data.name }}"
							   class="value zakra-range-input"
							   {{{ data.link }}}
							   value="{{ data.value['location'] }}"
							   min="{{ data.input_attrs['location']['min'] }}"
							   max="{{ data.input_attrs['location']['max'] }}"
							   step="{{ data.input_attrs['location']['step'] }}"
							   suffix="{{ data.input_attrs['location']['suffix'] }}"
						>
						<# if ( data.suffix ) { #>
						<span class="zakra-range-unit">{{ data.suffix }}</span>
						<# } #>
					</div>

					<div class="zakra-slider-reset">
						<span class="dashicons dashicons-image-rotate zakra-control-tooltip"
							title="<?php esc_attr_e( 'Back to default', 'zakra' ); ?>"
						>
						</span>
					</div>
				</div>
			</div>
		</div>

		<div class="second-color">
			<div class="customizer-wrapper">
				<div class="customizer-text">
					<span class="customize-control-title">Second Color</span>

					<# if ( data.description ) { #>
					<span class="description customize-control-description">{{{ data.description }}}</span>
					<# } #>
				</div>

				<div class="customize-control-content">
					<input data-name="{{ data.name }}"
						   class="zakra-color-picker-alpha color-picker-hex"
						   type="text"
						   data-alpha-enabled="true"
						   data-default-color="{{ data.default['second-color'] }}"
						   value="{{ data.value['second-color'] }}"
					/>
				</div>

				<div class="customizer-text">
					<span class="customize-control-title">Location 2</span>
				</div>

				<div class="slider-wrapper <# if ( data.description ) { #>slider-description<# } #>">
					<input min="{{ data.input_attrs['second-location']['min'] }}"
						   max="{{ data.input_attrs['second-location']['max'] }}"
						   step="{{ data.input_attrs['second-location']['step'] }}"
						   suffix="{{ data.input_attrs['second-location']['suffix'] }}"
						   type="range"
						   value="{{ data.value['second-location'] }}"
						   data-reset_value="{{ data.default }}"
					/>

					<div class="zakra-range-value">
						<input type="number"
							   data-name="{{ data.name }}"
							   class="value zakra-range-input"
							   {{{ data.link }}}
							   value="{{ data.value['second-location'] }}"
							   min="{{ data.input_attrs['second-location']['min'] }}"
							   max="{{ data.input_attrs['second-location']['max'] }}"
							   step="{{ data.input_attrs['second-location']['step'] }}"
							   suffix="{{ data.input_attrs['second-location']['suffix'] }}"
						>
						<# if ( data.suffix ) { #>
						<span class="zakra-range-unit">{{ data.suffix }}</span>
						<# } #>
					</div>

					<div class="zakra-slider-reset">
						<span class="dashicons dashicons-image-rotate zakra-control-tooltip"
							  title="<?php esc_attr_e( 'Back to default', 'zakra' ); ?>"
						>
						</span>
					</div>
				</div>
			</div>
		</div>


		<div class="type">
			<div class="types">
				<div class="customizer-text">
					<# if ( data.label['type'] ) { #>
					<span class="customize-control-title">{{{ data.label['type'] }}}</span>
					<# } else { #>
					<span class="customize-control-title">Type</span>
					<# } #>
				</div>
				<select data-name="{{ data.name }}" {{{ data.inputAttrs }}}>
					<option value="linear"
					<# if ( 'linear' === data.value['type'] ) { #> selected <# }
					#>><?php esc_html_e( 'Linear', 'zakra' ); ?></option>
					<option value="radial"
					<# if ( 'radial' === data.value['type'] ) { #> selected <# }
					#>><?php esc_html_e( 'Radial', 'zakra' ); ?></option>
				</select>
			</div>
			<hr>

			<div class="type-linear">
				<div class="customizer-text">
					<# if ( data.label['angle'] ) { #>
					<span class="customize-control-title">{{{ data.label['angle'] }}}</span>
					<# } else { #>
					<span class="customize-control-title">Angle</span>
					<# } #>
				</div>

				<div class="slider-wrapper <# if ( data.description ) { #>slider-description<# } #>angle">
					<input min="{{ data.input_attrs['angle']['min'] }}" max="{{ data.input_attrs['angle']['max'] }}" step="{{ data.input_attrs['angle']['step'] }}" suffix="{{ data.input_attrs['angle']['suffix'] }}" type="range" value="{{ data.value['angle'] }}"/>
					<div class="zakra-range-value">
						<input type="number" data-name="{{ data.name }}" class="value zakra-range-input" value="{{ data.value['angle'] }}" min="{{ data.input_attrs['angle']['min'] }}" max="{{ data.input_attrs['angle']['max'] }}" step="{{ data.input_attrs['angle']['step'] }}" suffix="{{ data.input_attrs['angle']['suffix'] }}" >
						<# if ( data.suffix ) { #>
						<span class="zakra-range-unit">{{ data.suffix }}</span>
						<# } #>
					</div>
				</div>
			</div>

			<div class="type-radial">
				<div class="customizer-text">
					<# if ( data.label['position'] ) { #>
					<span class="customize-control-title">{{{ data.label['position'] }}}</span>
					<# } else { #>
					<span class="customize-control-title">Position</span>
					<# } #>
				</div>
				<select data-name="{{ data.name }}" {{{ data.inputAttrs }}}>
					<option value="center center"
					<# if ( 'center center' === data.value['position'] ) { #> selected <# }
					#>><?php esc_html_e( 'Center Center', 'zakra' ); ?></option>
					<option value="center left"
					<# if ( 'center left' === data.value['position'] ) { #> selected <# }
					#>><?php esc_html_e( 'Center Left', 'zakra' ); ?></option>
					<option value="center right"
					<# if ( 'center right' === data.value['position'] ) { #> selected <# }
					#>><?php esc_html_e( 'Center Right', 'zakra' ); ?></option>
					<option value="top center"
					<# if ( 'top center' === data.value['position'] ) { #> selected <# }
					#>><?php esc_html_e( 'Top Center', 'zakra' ); ?></option>
					<option value="top left"
					<# if ( 'top left' === data.value['position'] ) { #> selected <# }
					#>><?php esc_html_e( 'Top Left', 'zakra' ); ?></option>
					<option value="top right"
					<# if ( 'top right' === data.value['position'] ) { #> selected <# }
					#>><?php esc_html_e( 'Top Right', 'zakra' ); ?></option>
					<option value="bottom center"
					<# if ( 'bottom center' === data.value['position'] ) { #> selected <# }
					#>><?php esc_html_e( 'Bottom Center', 'zakra' ); ?></option>
					<option value="bottom left"
					<# if ( 'bottom left' === data.value['position'] ) { #> selected <# }
					#>><?php esc_html_e( 'Bottom Left', 'zakra' ); ?></option>
					<option value="bottom right"
					<# if ( 'bottom right' === data.value['position'] ) { #> selected <# }
					#>><?php esc_html_e( 'Bottom Right', 'zakra' ); ?></option>
				</select>
			</div>

		</div>

		<?php
	}

	/**
	 * Don't render the control content from PHP, as it's rendered via JS on load.
	 */
	public function render_content() {
	}
}
