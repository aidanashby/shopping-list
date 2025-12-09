<?php
/**
 * Database operations class
 */
class Shopping_List_Database {

    public static function create_default_options() {
        // Always include items (8 slots)
        if (!get_option('shopping_list_always_include')) {
            add_option('shopping_list_always_include', array_fill(0, 8, ''));
        }

        // Not needed items (8 slots)
        if (!get_option('shopping_list_not_needed')) {
            add_option('shopping_list_not_needed', array_fill(0, 8, ''));
        }

        // Random items matrix (40 rows × 4 columns)
        if (!get_option('shopping_list_random_items')) {
            $random_items = array();
            for ($i = 0; $i < 40; $i++) {
                $random_items[$i] = array_fill(0, 4, '');
            }
            add_option('shopping_list_random_items', $random_items);
        }

        // Current selection
        if (!get_option('shopping_list_current_selection')) {
            add_option('shopping_list_current_selection', array());
        }
    }

    public static function get_always_include_items() {
        return get_option('shopping_list_always_include', array_fill(0, 8, ''));
    }

    public static function get_not_needed_items() {
        return get_option('shopping_list_not_needed', array_fill(0, 8, ''));
    }

    public static function get_random_items() {
        $default = array();
        for ($i = 0; $i < 40; $i++) {
            $default[$i] = array_fill(0, 4, '');
        }
        return get_option('shopping_list_random_items', $default);
    }

    public static function get_current_selection() {
        return get_option('shopping_list_current_selection', array());
    }

    public static function update_always_include_items($items) {
        // Ensure exactly 8 items
        $items = array_pad(array_slice($items, 0, 8), 8, '');
        
        // Sanitise each item
        $items = array_map('sanitize_text_field', $items);
        
        return update_option('shopping_list_always_include', $items);
    }

    public static function update_not_needed_items($items) {
        // Ensure exactly 8 items
        $items = array_pad(array_slice($items, 0, 8), 8, '');
        
        // Sanitise each item
        $items = array_map('sanitize_text_field', $items);
        
        return update_option('shopping_list_not_needed', $items);
    }

    public static function update_random_items($items) {
        // Ensure exactly 40 rows × 4 columns
        $sanitised_items = array();
        for ($i = 0; $i < 40; $i++) {
            for ($j = 0; $j < 4; $j++) {
                $value = isset($items[$i][$j]) ? $items[$i][$j] : '';
                $sanitised_items[$i][$j] = sanitize_text_field($value);
            }
        }
        
        return update_option('shopping_list_random_items', $sanitised_items);
    }

    public static function update_current_selection($selection) {
        $selection = array_map('sanitize_text_field', $selection);
        return update_option('shopping_list_current_selection', $selection);
    }

    public static function generate_random_selection() {
        $always_include = self::get_always_include_items();
        $random_items = self::get_random_items();
        $not_needed = self::get_not_needed_items();
        
        // Filter out empty not needed items and convert to lowercase for comparison
        $not_needed_filtered = array_filter($not_needed, function($item) {
            return !empty(trim($item));
        });
        $not_needed_lowercase = array_map('strtolower', array_map('trim', $not_needed_filtered));

        // Filter out empty always include items and exclude not needed items
        $always_include_filtered = array_filter($always_include, function($item) use ($not_needed_lowercase) {
            $item_trimmed = trim($item);
            return !empty($item_trimmed) && !in_array(strtolower($item_trimmed), $not_needed_lowercase);
        });

        $selection = array_values($always_include_filtered);
        $remaining_slots = 8 - count($selection);

        if ($remaining_slots > 0) {
            // Get random items from each row, excluding not needed items
            $available_random = array();
            foreach ($random_items as $row) {
                $row_items = array_filter($row, function($item) use ($not_needed_lowercase) {
                    $item_trimmed = trim($item);
                    return !empty($item_trimmed) && !in_array(strtolower($item_trimmed), $not_needed_lowercase);
                });
                if (!empty($row_items)) {
                    $available_random[] = $row_items[array_rand($row_items)];
                }
            }

            // Shuffle and take what we need
            shuffle($available_random);
            $random_selection = array_slice($available_random, 0, $remaining_slots);
            $selection = array_merge($selection, $random_selection);
        }

        self::update_current_selection($selection);
        return $selection;
    }
}
