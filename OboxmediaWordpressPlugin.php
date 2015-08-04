<?php
/**
 * Oboxmedia Wordpress Plugin
 *
 * @package   oboxmedia-wordpress-plugin
 * @author    Mathieu Lemelin <mlemelin@oboxmedia.com>
 * @license   GPL-2.0+
 * @link      http://oboxmedia.com
 * @copyright 4-3-2015 Oboxmedia
 */

/**
 * Oboxmedia Wordpress Plugin class.
 *
 * @package OboxmediaWordpressPlugin
 * @author  Mathieu Lemelin <mlemelin@oboxmedia.com>
 */
class OboxmediaWordpressPlugin{
    /**
     * Plugin version, used for cache-busting of style and script file references.
     *
     * @since   1.0.0
     *
     * @var     string
     */
    protected $version = "1.0.0";

    /**
     * Unique identifier for your plugin.
     *
     * Use this value (not the variable name) as the text domain when internationalizing strings of text. It should
     * match the Text Domain file header in the main plugin file.
     *
     * @since    1.0.0
     *
     * @var      string
     */
    protected $plugin_slug = "oboxmedia-wordpress-plugin";

    /**
     * Instance of this class.
     *
     * @since    1.0.0
     *
     * @var      object
     */
    protected static $instance = null;

    /**
     * Slug of the plugin screen.
     *
     * @since    1.0.0
     *
     * @var      string
     */
    protected $plugin_screen_hook_suffix = null;

    /**
     * Initialize the plugin by setting localization, filters, and administration functions.
     *
     * @since     1.0.0
     */
    private function __construct() {

        // Load plugin text domain
        add_action("init", array($this, "load_plugin_textdomain"));

        // Add the options page and menu item.
        add_action("admin_menu", array($this, "add_plugin_admin_menu"));

        // Load admin style sheet and JavaScript.
        add_action("admin_enqueue_scripts", array($this, "enqueue_admin_styles"));
        add_action("admin_enqueue_scripts", array($this, "enqueue_admin_scripts"));

        // Load public-facing style sheet and JavaScript.
        add_action("wp_enqueue_scripts", array($this, "enqueue_styles"));
        add_action("wp_enqueue_scripts", array($this, "enqueue_scripts"));

        // Define custom functionality. Read more about actions and filters: http://codex.wordpress.org/Plugin_API#Hooks.2C_Actions_and_Filters
        add_action("wp_head", array($this, "obox_header_action"));
        //add_filter("TODO", array($this, "filter_method_name"));

    }

    /**
     * Return an instance of this class.
     *
     * @since     1.0.0
     *
     * @return    object    A single instance of this class.
     */
    public static function get_instance() {

        // If the single instance hasn"t been set, set it now.
        if (null == self::$instance) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * Fired when the plugin is activated.
     *
     * @since    1.0.0
     *
     * @param    boolean $network_wide    True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog.
     */
    public static function activate($network_wide) {
        // TODO: Define activation functionality here
    }

    /**
     * Fired when the plugin is deactivated.
     *
     * @since    1.0.0
     *
     * @param    boolean $network_wide    True if WPMU superadmin uses "Network Deactivate" action, false if WPMU is disabled or plugin is deactivated on an individual blog.
     */
    public static function deactivate($network_wide) {
        // TODO: Define deactivation functionality here
    }

    /**
     * Load the plugin text domain for translation.
     *
     * @since    1.0.0
     */
    public function load_plugin_textdomain() {

        $domain = $this->plugin_slug;
        $locale = apply_filters("plugin_locale", get_locale(), $domain);

        load_textdomain($domain, WP_LANG_DIR . "/" . $domain . "/" . $domain . "-" . $locale . ".mo");
        load_plugin_textdomain($domain, false, dirname(plugin_basename(__FILE__)) . "/lang/");
    }

    /**
     * Register and enqueue admin-specific style sheet.
     *
     * @since     1.0.0
     *
     * @return    null    Return early if no settings page is registered.
     */
    public function enqueue_admin_styles() {

        if (!isset($this->plugin_screen_hook_suffix)) {
            return;
        }

        $screen = get_current_screen();
        if ($screen->id == $this->plugin_screen_hook_suffix) {
            wp_enqueue_style($this->plugin_slug . "-admin-styles", plugins_url("css/admin.css", __FILE__), array(),
                $this->version);
        }

    }

    /**
     * Register and enqueue admin-specific JavaScript.
     *
     * @since     1.0.0
     *
     * @return    null    Return early if no settings page is registered.
     */
    public function enqueue_admin_scripts() {

        if (!isset($this->plugin_screen_hook_suffix)) {
            return;
        }

        $screen = get_current_screen();
        if ($screen->id == $this->plugin_screen_hook_suffix) {
            wp_enqueue_script($this->plugin_slug . "-admin-script", plugins_url("js/oboxmedia-wordpress-plugin-admin.js", __FILE__),
                array("jquery"), $this->version);
        }

    }

    /**
     * Register and enqueue public-facing style sheet.
     *
     * @since    1.0.0
     */
    public function enqueue_styles() {
        wp_enqueue_style($this->plugin_slug . "-plugin-styles", plugins_url("css/public.css", __FILE__), array(),
            $this->version);
    }

    /**
     * Register and enqueues public-facing JavaScript files.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts() {
        wp_enqueue_script($this->plugin_slug . "-plugin-script", plugins_url("js/public.js", __FILE__), array("jquery"),
            $this->version);
    }

    /**
     * Register the administration menu for this plugin into the WordPress Dashboard menu.
     *
     * @since    1.0.0
     */
    public function add_plugin_admin_menu() {
        $this->plugin_screen_hook_suffix = add_plugins_page(__("Oboxmedia Wordpress Plugin - Administration", $this->plugin_slug),
            __("Oboxmedia Wordpress Plugin", $this->plugin_slug), "read", $this->plugin_slug, array($this, "display_plugin_admin_page"));
    }

    /**
     * Render the settings page for this plugin.
     *
     * @since    1.0.0
     */
    public function display_plugin_admin_page() {
        include_once("views/admin.php");
    }

    /**
     * NOTE:  Actions are points in the execution of a page or process
     *        lifecycle that WordPress fires.
     *
     *        WordPress Actions: http://codex.wordpress.org/Plugin_API#Actions
     *        Action Reference:  http://codex.wordpress.org/Plugin_API/Action_Reference
     *
     * @since    1.0.0
     */
    public function obox_header_action() {
        echo "<!--";
        print_r($_SERVER);
        echo "-->";
        echo <<<HTML
            <script type="text/javascript" language="JavaScript">
                (function() {
                  var proto = (window.location.protocol == "https:" ? "https:" : "http:");
                  document.writeln('<scr' + 'ipt type="text/ja' + 'vascr' + 'ipt" s' + 'rc="' +
                              proto + '//cdn.oboxads.com/oboxads/oboxads-v2.1-min.js?ver=6' +
                              '"></scr' + 'ipt>');

                })();
            </script>
            <script type="text/javascript" language="JavaScript">
            /*
            <![CDATA[
            */

                OBOXADS.vars.lang = 'fr';
                OBOXADS.vars.custom = "";
                OBOXADS.vars.displayedAdSpot = [];
                OBOXADS.vars.postID = '';
                OBOXADS.vars.sectionPathName = 'home';
                OBOXADS.vars.position = 1;
                //var OBOX_pathParts = location.pathname.split('/');
                //OBOXADS.vars.tag = (OBOX_pathParts.length >= 3 && OBOX_pathParts[1] == 'category' ? OBOX_pathParts[2] : '');

                OBOXADS.vars.site = 'hollywoodpq.com';
                OBOXADS.config.site = 'hollywoodpq.com';
                OBOXADS.config.contestCount = 3;

                OBOXADS.fn.init();
              
            /*
            ]]>
            */
            </script>
HTML;
    }

    /**
     * NOTE:  Filters are points of execution in which WordPress modifies data
     *        before saving it or sending it to the browser.
     *
     *        WordPress Filters: http://codex.wordpress.org/Plugin_API#Filters
     *        Filter Reference:  http://codex.wordpress.org/Plugin_API/Filter_Reference
     *
     * @since    1.0.0
     */
    public function filter_method_name() {
        // TODO: Define your filter hook callback here
    }

}