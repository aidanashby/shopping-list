<?php

class Shopping_List_Cron {
    
    public static function schedule_weekly_regeneration() {
        if (!wp_next_scheduled('shopping_list_weekly_regenerate')) {
            // Schedule for Sundays at 6 AM
            wp_schedule_event(strtotime('next Sunday 6:00 AM'), 'weekly', 'shopping_list_weekly_regenerate');
        }
    }
    
    public static function clear_scheduled_events() {
        $timestamp = wp_next_scheduled('shopping_list_weekly_regenerate');
        if ($timestamp) {
            wp_unschedule_event($timestamp, 'shopping_list_weekly_regenerate');
        }
    }
    
    public function regenerate_list() {
        // Generate new random selection
        Shopping_List_Database::generate_random_selection();
        
        // Update RSS feed (RSS is generated on-demand, so no action needed here)
        Shopping_List_RSS::update_rss_feed();
        
        // Log the regeneration
        error_log('Shopping List: Weekly list regenerated on ' . date('Y-m-d H:i:s'));
    }
}
