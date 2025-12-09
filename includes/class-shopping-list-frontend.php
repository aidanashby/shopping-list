<?php
/**
 * Frontend display class
 */
class Shopping_List_Frontend {

    private $plugin_name;
    private $version;

    public function __construct($plugin_name, $version) {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    public function display_shopping_list($atts) {
        $current_selection = Shopping_List_Database::get_current_selection();
        
        if (empty($current_selection)) {
            return '<p>No shopping list items available.</p>';
        }

        $output = '<div class="shopping-list">';
        foreach ($current_selection as $item) {
            $output .= '<p>' . esc_html($item) . '</p>';
        }
        $output .= '</div>';

        return $output;
    }

    public function display_not_needed_list($atts) {
        $not_needed_items = Shopping_List_Database::get_not_needed_items();
        
        // Filter out empty items
        $not_needed_filtered = array_filter($not_needed_items, function($item) {
            return !empty(trim($item));
        });
        
        if (empty($not_needed_filtered)) {
            return '<p>No items marked as not needed.</p>';
        }

        $output = '<div class="not-needed-list">';
        foreach ($not_needed_filtered as $item) {
            $output .= '<p>' . esc_html($item) . '</p>';
        }
        $output .= '</div>';

        return $output;
    }
}
