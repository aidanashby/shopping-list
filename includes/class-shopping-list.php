<?php
/**
 * Core plugin class
 */
class Shopping_List {

    protected $loader;
    protected $plugin_name;
    protected $version;

    public function __construct() {
        $this->plugin_name = 'shopping-list';
        $this->version = SHOPPING_LIST_VERSION;
        $this->load_dependencies();
        $this->define_admin_hooks();
        $this->define_public_hooks();
        $this->define_cron_hooks();
    }

    private function load_dependencies() {
		require_once SHOPPING_LIST_PLUGIN_DIR . 'includes/class-shopping-list-database.php';
		require_once SHOPPING_LIST_PLUGIN_DIR . 'includes/class-shopping-list-admin.php';
		require_once SHOPPING_LIST_PLUGIN_DIR . 'includes/class-shopping-list-frontend.php';
		require_once SHOPPING_LIST_PLUGIN_DIR . 'includes/class-shopping-list-cron.php';
		require_once SHOPPING_LIST_PLUGIN_DIR . 'includes/class-shopping-list-rss.php';
	}

    private function define_admin_hooks() {
        $plugin_admin = new Shopping_List_Admin($this->get_plugin_name(), $this->get_version());
        add_action('admin_menu', array($plugin_admin, 'add_admin_menu'));
        add_action('admin_init', array($plugin_admin, 'admin_init'));
        add_action('admin_enqueue_scripts', array($plugin_admin, 'enqueue_styles'));
    }

    private function define_public_hooks() {
        $plugin_public = new Shopping_List_Frontend($this->get_plugin_name(), $this->get_version());
        add_shortcode('shop_list', array($plugin_public, 'display_shopping_list'));
        add_shortcode('noshop_list', array($plugin_public, 'display_not_needed_list'));
    }

    private function define_cron_hooks() {
        $plugin_cron = new Shopping_List_Cron();
        add_action('shopping_list_weekly_regenerate', array($plugin_cron, 'regenerate_list'));
    }

    public function run() {
        // Plugin is now loaded and ready
    }

    public function get_plugin_name() {
        return $this->plugin_name;
    }

    public function get_version() {
        return $this->version;
    }
}
