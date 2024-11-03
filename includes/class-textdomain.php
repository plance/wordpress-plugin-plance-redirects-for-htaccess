<?php
/**
 * Textdomain class.
 *
 * @package Plance\Plugin\Redirects_For_Htaccess
 */

namespace Plance\Plugin\Redirects_For_Htaccess;

defined( 'ABSPATH' ) || exit;

use Plance\Plugin\Redirects_For_Htaccess\Singleton;

/**
 * Textdomain class.
 */
class Textdomain {
	use Singleton;

	/**
	 * Init.
	 *
	 * @return void
	 */
	protected function init() {
		load_plugin_textdomain( 'plance-redirects-for-htaccess', false, '/plance-redirects-for-htaccess/languages' );
	}
}
