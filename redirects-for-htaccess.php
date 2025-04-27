<?php
/**
 * Main plugin file.
 *
 * @package Plance\Plugin\Redirects_For_Htaccess
 *
 * Plugin Name: Redirects for Htaccess
 * Description: Generates redirect code for .htaccess file
 * Plugin URI:  https://plance.top/
 * Version:     1.0.1
 * Author:      plance
 * License:     GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: redirects-for-htaccess
 * Domain Path: /languages/
 */

namespace Plance\Plugin\Redirects_For_Htaccess;

defined( 'ABSPATH' ) || exit;


/**
 * Bootstrap.
 */
require __DIR__ . '/bootstrap.php';

/**
 * Actions.
 */
require __DIR__ . '/actions.php';
