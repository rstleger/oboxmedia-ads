<?php
/**
 * Oboxmedia Ads Plugin
 *
 * Provides an easy way to implement Oboxmedia's ad solution
 *
 * @package   oboxmedia-ads-plugin
 * @author    Patrick Forget <patforg@oboxmedia.com>
 * @license   GPL-2.0+
 * @link      http://oboxmedia.com
 * @copyright 4-3-2015 Oboxmedia
 *
 * @wordpress-plugin
 * Plugin Name: Oboxmedia Ads Plugin
 * Plugin URI:  http://oboxmedia.com
 * Description: Provides an easy way to implement Oboxmedia's ad solution
 * Version:     1.0.0
 * Author:      Patrick Forget
 * Author URI:  http://oboxmedia.com
 * Text Domain: oboxads
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path: /lang
 */

// If this file is called directly, abort.
if (!defined("WPINC")) {
	die;
}

require_once(plugin_dir_path(__FILE__) . "OboxmediaAdsPlugin.php");
require_once(plugin_dir_path(__FILE__) . "includes/functions.php");
require_once(plugin_dir_path(__FILE__) . "includes/oboxads-showAd-function.php");
require_once(plugin_dir_path(__FILE__) . "includes/oboxads-options-page-functions.php");
require_once(plugin_dir_path(__FILE__) . "includes/oboxads-ad-widget.php");

// Register hooks that are fired when the plugin is activated, deactivated, and uninstalled, respectively.
register_activation_hook(__FILE__, array("OboxmediaAdsPlugin", "activate"));
register_deactivation_hook(__FILE__, array("OboxmediaAdsPlugin", "deactivate"));

OboxmediaAdsPlugin::get_instance();
