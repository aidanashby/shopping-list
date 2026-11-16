<?php
defined( 'ABSPATH' ) || exit;
/**
 * Cron management class
 */
class Shopping_List_Cron {

    private static $days = array( 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday' );

    const REGEN_HOOK = 'shopping_list_weekly_regenerate';

    /**
     * Timestamp of the next given weekday at the given time in the site's timezone.
     */
    private static function next_local( $day, $time ) {
        $dt = new DateTime( 'next ' . $day . ' ' . $time, wp_timezone() );
        return $dt->getTimestamp();
    }

    /**
     * Each event's hook mapped to its weekday and site-time H:i.
     * Lists regenerate at 12:00 AM Monday. Each day feed snapshots at 12:00 AM
     * on its day, except Monday at 12:01 AM so regeneration always runs first.
     */
    private static function expected_times() {
        $times = array( self::REGEN_HOOK => array( 'monday', '00:00' ) );
        foreach ( self::$days as $day ) {
            $times[ 'shopping_list_rss_snapshot_' . $day ] = array( $day, 'monday' === $day ? '00:01' : '00:00' );
        }
        return $times;
    }

    private static function schedule( $hook ) {
        $times = self::expected_times();
        if ( ! wp_next_scheduled( $hook ) ) {
            wp_schedule_event( self::next_local( $times[ $hook ][0], $times[ $hook ][1] ), 'weekly', $hook );
        }
    }

    public static function schedule_weekly_regeneration() {
        self::schedule( self::REGEN_HOOK );
    }

    public static function clear_scheduled_events() {
        $timestamp = wp_next_scheduled( self::REGEN_HOOK );
        if ( $timestamp ) {
            wp_unschedule_event( $timestamp, self::REGEN_HOOK );
        }
    }

    public static function schedule_daily_rss_snapshots() {
        foreach ( self::$days as $day ) {
            self::schedule( 'shopping_list_rss_snapshot_' . $day );
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

    /**
     * Keep every event on its weekday and site-time H:i. WP-Cron repeats
     * 'weekly' events every 604,800 seconds, so a clock change shifts them by
     * an hour; this also moves events scheduled by older versions (6:00 AM UTC).
     * Overdue events are left alone so a pending run is never skipped.
     */
    public static function realign_events() {
        $tz  = wp_timezone();
        $now = time();
        foreach ( self::expected_times() as $hook => $when ) {
            $timestamp = wp_next_scheduled( $hook );
            if ( ! $timestamp ) {
                self::schedule( $hook );
                continue;
            }
            if ( $timestamp <= $now ) {
                continue;
            }
            $local = ( new DateTime( '@' . $timestamp ) )->setTimezone( $tz );
            if ( strtolower( $local->format( 'l' ) ) === $when[0] && $local->format( 'H:i' ) === $when[1] ) {
                continue;
            }
            wp_unschedule_event( $timestamp, $hook );
            wp_schedule_event( self::next_local( $when[0], $when[1] ), 'weekly', $hook );
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
