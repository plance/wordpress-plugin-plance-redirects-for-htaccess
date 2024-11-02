<?php
/**
 * Singleton class.
 *
 * @package Plance\Plugin\Redirects_For_Htaccess
 */

namespace Plance\Plugin\Redirects_For_Htaccess;

defined( 'ABSPATH' ) || exit;

/**
 * Singleton class.
 */
trait Singleton {
	/**
	 * Object instance
	 *
	 * @var object
	 */
	protected static $instance = null;

	/**
	 * Gets the instance
	 *
	 * @return self
	 */
	final public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * The constructor
	 */
	final protected function __construct() {
		if ( method_exists( $this, 'init' ) ) {
			$this->init();
		}
	}
}
