<?php
/**
 * Cron management class
 */
class Shopping_List_Cron {

    private static $days = array( 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday' );

    public static function schedule_weekly_regeneration() {
        if (!wp_next_scheduled('shopping_list_weekly_regenerate')) {
            $start_time = strtotime('next Monday 6:00 AM');
            wp_schedule_event($start_time, 'weekly', 'shopping_list_weekly_regenerate');
        }
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
                // Monday at 6:01 AM so list regeneration (6:00 AM) always runs first.
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
        error_log('Shopping List: Weekly regeneration completed at ' . current_time('mysql'));
    }

    public static function regenerate_current_list() {
        return Shopping_List_Database::generate_random_selection();
    }

    public static function take_rss_snapshot( $day ) {
        Shopping_List_RSS::take_snapshot( $day );
        error_log( 'Shopping List: RSS snapshot taken for ' . $day . ' at ' . current_time( 'mysql' ) );
    }
}
