<?php

defined( 'ABSPATH' ) || exit;

class Hostinger_Bootstrap {
	/** @var Hostinger_Loader */
	protected $loader;

	public function __construct() {
		require_once HOSTINGER_ABSPATH . 'includes/class-hostinger-loader.php';
		$this->loader = new Hostinger_Loader();
	}

	public function run() {
		$this->load_dependencies();
		$this->load_extendify();

		$this->loader->run();
	}

	private function load_dependencies() {
		if ( is_admin() ) {
			$this->load_admin_dependencies();
			$this->define_admin_hooks();
		}
	}

	public function load_extendify() {
		require_once HOSTINGER_ABSPATH . 'includes/extendify/class-hostinger-extendify.php';
		$extendify = new Hostinger_Extendify();
		$extendify->init();
	}

	/**
	 * @return void
	 */
	private function load_admin_dependencies() {
		require_once HOSTINGER_ABSPATH . 'includes/admin/class-hostinger-affiliates.php';
	}

	private function define_admin_hooks() {
		$hostinger_affiliate = new Hostinger_Affiliates();

		$this->loader->add_filter( 'astra_get_pro_url', $hostinger_affiliate, 'astra_pro_affiliate_link', 10, 2 );
		$this->loader->add_filter( 'optinmonster_sas_id', $hostinger_affiliate, 'affiliate_monsterinsights' );
		$this->loader->add_filter( 'monsterinsights_shareasale_id', $hostinger_affiliate, 'affiliate_monsterinsights' );
		$this->loader->add_filter( 'wpforms_upgrade_link', $hostinger_affiliate, 'wpforms_upgrade_link' );
		$this->loader->add_filter( 'aioseo_upgrade_link', $hostinger_affiliate, 'aioseo_upgrade_link' );
	}
}
