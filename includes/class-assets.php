<?php
/**
 * Singleton class.
 *
 * @package Plance\Plugin\Redirects_For_Htaccess
 */

namespace Plance\Plugin\Redirects_For_Htaccess;

defined( 'ABSPATH' ) || exit;

use const Plance\Plugin\Redirects_For_Htaccess\URL;
use const Plance\Plugin\Redirects_For_Htaccess\VERSION;
use Plance\Plugin\Redirects_For_Htaccess\Singleton;

/**
 * Assets class.
 */
class Assets {
	use Singleton;

	/**
	 * Init.
	 *
	 * @return void
	 */
	protected function init() {
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
	}

	/**
	 * Hook: admin_enqueue_scripts.
	 *
	 * @return void
	 */
	public function admin_enqueue_scripts() {
		wp_register_style(
			'plance-redirects-for-htaccess',
			URL . '/assets/css/admin-style.css',
			array(),
			VERSION
		);
	}
}
