<?php

defined( 'ABSPATH' ) || exit;

class Hostinger_Extendify {
	public function init() {
		$settings_file = HOSTINGER_ABSPATH . 'includes/extendify/extendify.php';

		if ( file_exists( $settings_file ) ) {
			require_once $settings_file;
		}
	}
}
