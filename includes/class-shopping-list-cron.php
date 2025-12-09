<?php
/**
 * Cron management class
 */
class Shopping_List_Cron {

    public static function schedule_weekly_regeneration() {
        if (!wp_next_scheduled('shopping_list_weekly_regenerate')) {
            // Schedule for every Monday at 6:00 AM
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

    public function regenerate_list() {
        Shopping_List_Database::generate_random_selection();
        
        // Log the regeneration for debugging
        error_log('Shopping List: Weekly regeneration completed at ' . current_time('mysql'));
    }

    public static function regenerate_current_list() {
        return Shopping_List_Database::generate_random_selection();
    }
}
