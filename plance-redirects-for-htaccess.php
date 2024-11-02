<?php
/**
 * Main plugin file.
 *
 * @package Plance\Plugin\Redirects_For_Htaccess
 * @wordpress-plugin
 *
 * Plugin Name: Redirects for Htaccess
 * Plugin URI:  https://wordpress.org/plugins/redirects-for-htaccess/
 * Description: Generates redirect code for .htaccess file
 * Version:     1.0.0
 * Author:      Pavel
 * Author URI:  https://plance.top/
 * License:     GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: redirects4htaccess
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
