<?php
/**
 * Plugin Name: Shopping List
 * Description: Manages randomised item displays with administrative controls and weekly automated regeneration.
 * Version: 0.7.0
 * Author: Aidan Ashby
 * Text Domain: shopping-list
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Plugin constants
define( 'SHOPPING_LIST_VERSION',     '0.7.0' );
define( 'SHOPPING_LIST_PLUGIN_FILE', __FILE__ );
define( 'SHOPPING_LIST_PLUGIN_DIR',  plugin_dir_path( __FILE__ ) );
define( 'SHOPPING_LIST_PLUGIN_URL',  plugin_dir_url( __FILE__ ) );
define( 'SHOPPING_LIST_GITHUB_REPO', 'aidanashby/shopping-list' );

// List size constants
define( 'SHOPPING_LIST_SLOTS',       8 );
define( 'SHOPPING_LIST_RANDOM_ROWS', 40 );
define( 'SHOPPING_LIST_RANDOM_COLS', 4 );

/**
 * Main plugin class loader
 */
function run_shopping_list() {
    require_once SHOPPING_LIST_PLUGIN_DIR . 'includes/class-shopping-list.php';
    $plugin = new Shopping_List();
    $plugin->run();
}

/**
 * Activation: set up default options, schedule cron, generate initial list
 */
function activate_shopping_list() {
    require_once SHOPPING_LIST_PLUGIN_DIR . 'includes/class-shopping-list-database.php';
    require_once SHOPPING_LIST_PLUGIN_DIR . 'includes/class-shopping-list-cron.php';
    require_once SHOPPING_LIST_PLUGIN_DIR . 'includes/class-shopping-list-rss.php';

    Shopping_List_Database::create_default_options();
    Shopping_List_Cron::schedule_weekly_regeneration();
    Shopping_List_Database::generate_random_selection();
    flush_rewrite_rules();
}

/**
 * Deactivation: clear scheduled cron events
 */
function deactivate_shopping_list() {
    require_once SHOPPING_LIST_PLUGIN_DIR . 'includes/class-shopping-list-cron.php';
    Shopping_List_Cron::clear_scheduled_events();
}

// Bootstrap
add_action( 'plugins_loaded', 'run_shopping_list' );
register_activation_hook( __FILE__, 'activate_shopping_list' );
register_deactivation_hook( __FILE__, 'deactivate_shopping_list' );

// RSS rewrite rules
add_action( 'init', 'shopping_list_rss_init' );
function shopping_list_rss_init() {
    require_once SHOPPING_LIST_PLUGIN_DIR . 'includes/class-shopping-list-rss.php';
    Shopping_List_RSS::add_rewrite_rules();
}

add_action( 'template_redirect', array( 'Shopping_List_RSS', 'handle_rss_request' ) );
