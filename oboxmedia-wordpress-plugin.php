<?php
/**
 * Oboxmedia Wordpress Plugin
 *
 * Complete set of Oboxmedia Advertising solution for Wordpress
 *
 * @package   oboxmedia-wordpress-plugin
 * @author    Mathieu Lemelin <mlemelin@oboxmedia.com>
 * @license   GPL-2.0+
 * @link      http://oboxmedia.com
 * @copyright 4-3-2015 Oboxmedia
 *
 * @wordpress-plugin
 * Plugin Name: Oboxmedia Wordpress Plugin
 * Plugin URI:  http://oboxmedia.com
 * Description: Complete set of Oboxmedia Advertising solution for Wordpress
 * Version:     1.0.0
 * Author:      Mathieu Lemelin
 * Author URI:  http://oboxmedia.com
 * Text Domain: oboxmedia-wordpress-plugin-locale
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path: /lang
 */

// If this file is called directly, abort.
if (!defined("WPINC")) {
	die;
}

require_once(plugin_dir_path(__FILE__) . "OboxmediaWordpressPlugin.php");

// Register hooks that are fired when the plugin is activated, deactivated, and uninstalled, respectively.
register_activation_hook(__FILE__, array("OboxmediaWordpressPlugin", "activate"));
register_deactivation_hook(__FILE__, array("OboxmediaWordpressPlugin", "deactivate"));

OboxmediaWordpressPlugin::get_instance();