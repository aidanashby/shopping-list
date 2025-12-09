<?php
/**
 * Uninstall script
 */

// Prevent direct access
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

// Clear scheduled cron events
$timestamp = wp_next_scheduled('shopping_list_weekly_regenerate');
if ($timestamp) {
    wp_unschedule_event($timestamp, 'shopping_list_weekly_regenerate');
}

// Remove plugin options
delete_option('shopping_list_always_include');
delete_option('shopping_list_not_needed');
delete_option('shopping_list_random_items');
delete_option('shopping_list_current_selection');

// Clear any cached data
wp_cache_flush();
