<?php

defined( 'ABSPATH' ) || exit;

class Hostinger_Affiliates {
	const AFFILIATE_ID = '3107422';

	/**
	 * @param string $astra_pro_url
	 * @param string $url
	 *
	 * @return mixed
	 */
	public function astra_pro_affiliate_link( $astra_pro_url, $url ) {
		return add_query_arg( 'bsf', '5643', $url );
	}

	/**
	 * @param mixed $id
	 *
	 * @return string
	 */
	public function affiliate_monsterinsights( $id ) {
		return self::AFFILIATE_ID;
	}

	/**
	 * @param string $link
	 *
	 * @return string
	 */
	public function wpforms_upgrade_link( $link ) {
		return 'https://shareasale.com/r.cfm?b=834775&u=3107422&m=64312&urllink=' . rawurlencode( $link );
	}

	/**
	 * @param string $link
	 *
	 * @return string
	 */
	public function aioseo_upgrade_link( $link ) {
		return 'https://shareasale.com/r.cfm?b=1491200&u=3107422&m=94778&urllink=' . rawurlencode( $link );
	}
}
