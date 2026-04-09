<?php
/**
 * Uninstall script — runs when the plugin is deleted via wp-admin.
 */

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit;
}

// Clear scheduled cron events
$timestamp = wp_next_scheduled( 'shopping_list_weekly_regenerate' );
if ( $timestamp ) {
    wp_unschedule_event( $timestamp, 'shopping_list_weekly_regenerate' );
}

// Remove plugin options
delete_option( 'shopping_list_always_include' );
delete_option( 'shopping_list_not_needed' );
delete_option( 'shopping_list_random_items' );
delete_option( 'shopping_list_current_selection' );

// Remove updater cache
delete_site_transient( 'shopping_list_github_release' );

wp_cache_flush();
