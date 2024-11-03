<?php
/**
 * Actions.
 *
 * @package Plance\Plugin\Redirects_For_Htaccess
 */

namespace Plance\Plugin\Redirects_For_Htaccess;

defined( 'ABSPATH' ) || exit;


use Plance\Plugin\Redirects_For_Htaccess\Assets;
use Plance\Plugin\Redirects_For_Htaccess\Textdomain;
use Plance\Plugin\Redirects_For_Htaccess\Admin_Page;


add_action( 'plugins_loaded', array( Textdomain::class, 'instance' ) );
add_action( 'plugins_loaded', array( Assets::class, 'instance' ) );
add_action( 'plugins_loaded', array( Admin_Page::class, 'instance' ) );
