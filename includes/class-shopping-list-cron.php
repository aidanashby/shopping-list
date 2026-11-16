<?php
defined( 'ABSPATH' ) || exit;
/**
 * Cron management class
 */
class Shopping_List_Cron {

    private static $days = array( 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday' );

    // Identifies the current regeneration time. Change it whenever the time
    // changes so existing sites move their scheduled event on the next load.
    const REGEN_SCHEDULE_ID = 'mon-0000';

    public static function schedule_weekly_regeneration() {
        if ( ! wp_next_scheduled( 'shopping_list_weekly_regenerate' ) ) {
            // Next Monday at 12:00am in the site's timezone.
            $start = new DateTime( 'next monday 00:00', wp_timezone() );
            wp_schedule_event( $start->getTimestamp(), 'weekly', 'shopping_list_weekly_regenerate' );
        }
        update_option( 'shopping_list_regen_schedule', self::REGEN_SCHEDULE_ID );
    }

    /**
     * Move an event scheduled under an earlier regeneration time to the current one.
     */
    public static function maybe_reschedule_weekly_regeneration() {
        if ( get_option( 'shopping_list_regen_schedule' ) === self::REGEN_SCHEDULE_ID ) {
            return;
        }
        self::clear_scheduled_events();
        self::schedule_weekly_regeneration();
    }

    public static function clear_scheduled_events() {
        $timestamp = wp_next_scheduled('shopping_list_weekly_regenerate');
        if ($timestamp) {
            wp_unschedule_event($timestamp, 'shopping_list_weekly_regenerate');
        }
    }

    public static function schedule_daily_rss_snapshots() {
        foreach ( self::$days as $day ) {
            $hook = 'shopping_list_rss_snapshot_' . $day;
            if ( ! wp_next_scheduled( $hook ) ) {
                // Monday at 6:01 AM, kept from when list regeneration ran at 6:00 AM.
                // Regeneration now runs at 12:00 AM, so it still comes first.
                $time_str   = ( 'monday' === $day ) ? 'next Monday 6:01 AM' : 'next ' . ucfirst( $day ) . ' 6:00 AM';
                $start_time = strtotime( $time_str );
                wp_schedule_event( $start_time, 'weekly', $hook );
            }
        }
    }

    public static function clear_daily_rss_snapshots() {
        foreach ( self::$days as $day ) {
            $hook      = 'shopping_list_rss_snapshot_' . $day;
            $timestamp = wp_next_scheduled( $hook );
            if ( $timestamp ) {
                wp_unschedule_event( $timestamp, $hook );
            }
        }
    }

    public function regenerate_list() {
        Shopping_List_Database::generate_random_selection();
        if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
            error_log('Shopping List: Weekly regeneration completed at ' . current_time('mysql'));
        }
    }

    public static function regenerate_current_list() {
        return Shopping_List_Database::generate_random_selection();
    }

    public static function take_rss_snapshot( $day ) {
        Shopping_List_RSS::take_snapshot( $day );
        if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
            error_log( 'Shopping List: RSS snapshot taken for ' . $day . ' at ' . current_time( 'mysql' ) );
        }
    }
}
