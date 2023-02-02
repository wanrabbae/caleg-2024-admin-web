<?php

defined( 'ABSPATH' ) || exit;

class Hostinger {
	/** @var string */
	protected $plugin_name = 'Hostinger';
	/** @var string */
	protected $version;

	public function bootstrap() {
		$this->define_constants();
		$this->version = $this->get_plugin_version();

		require_once HOSTINGER_ABSPATH . 'includes/class-hostinger-bootstrap.php';
		$bootstrap = new Hostinger_Bootstrap();
		$bootstrap->run();
	}

	/**
	 * @return void
	 */
	public function run() {
		$this->bootstrap();
	}

	private function define_constants() {
		$this->define( 'HOSTINGER_ABSPATH', plugin_dir_path( __DIR__ ) );
	}

	/**
	 * Define constant
	 *
	 * @param string $name Constant name.
	 * @param string|bool $value Constant value.
	 */
	private function define( $name, $value ) {
		if ( ! defined( $name ) ) {
			define( $name, $value );
		}
	}


	/**
	 * @return string
	 */
	private function get_plugin_version() {
		if ( defined( 'HOSTINGER_VERSION' ) ) {
			return HOSTINGER_VERSION;
		}

		return '1.0.0';
	}
}
