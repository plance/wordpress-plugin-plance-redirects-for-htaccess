<?php
/**
 * Actions.
 *
 * @package Plance\Plugin\Redirects_For_Htaccess
 */

namespace Plance\Plugin\Redirects_For_Htaccess;

defined( 'ABSPATH' ) || exit;


use Plance\Plugin\Redirects_For_Htaccess\Assets;
use Plance\Plugin\Redirects_For_Htaccess\Admin_Page;


add_action( 'plance_plugin_redirects_for_htaccess_admin', array( Assets::class, 'instance' ) );
add_action( 'plance_plugin_redirects_for_htaccess_admin', array( Admin_Page::class, 'instance' ) );
