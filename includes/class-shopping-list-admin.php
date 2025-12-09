<?php
/**
 * Admin interface class
 */
class Shopping_List_Admin {

    private $plugin_name;
    private $version;

    public function __construct($plugin_name, $version) {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    public function enqueue_styles() {
        wp_enqueue_style(
            $this->plugin_name,
            SHOPPING_LIST_PLUGIN_URL . 'admin/css/admin.css',
            array(),
            $this->version,
            'all'
        );
        
        wp_enqueue_script(
            $this->plugin_name,
            SHOPPING_LIST_PLUGIN_URL . 'admin/js/admin.js',
            array('jquery'),
            $this->version,
            true
        );
    }

    public function add_admin_menu() {
        add_options_page(
            'Shopping List Settings',
            'Shopping List',
            'manage_options',
            'shopping-list-settings',
            array($this, 'display_admin_page')
        );
    }

    public function admin_init() {
        register_setting('shopping_list_settings', 'shopping_list_always_include');
        register_setting('shopping_list_settings', 'shopping_list_not_needed');
        register_setting('shopping_list_settings', 'shopping_list_random_items');

        add_settings_section(
            'shopping_list_always_section',
            'Always Include Items',
            array($this, 'always_section_callback'),
            'shopping-list-settings'
        );

        add_settings_section(
            'shopping_list_not_needed_section',
            'Not Needed Items',
            array($this, 'not_needed_section_callback'),
            'shopping-list-settings'
        );

        add_settings_section(
            'shopping_list_random_section', 
            'Randomly Selected Needed Items',
            array($this, 'random_section_callback'),
            'shopping-list-settings'
        );
    }

    public function always_section_callback() {
        echo '<p>These items will always appear first in your shopping list (maximum 8 items):</p>';
    }

    public function not_needed_section_callback() {
        echo '<p>Items in this list will be excluded from the shopping list and can be displayed separately using [noshop_list]:</p>';
    }

    public function random_section_callback() {
        echo '<p>Random items will be selected from these options (maximum one item per row):</p>';
    }

    public function display_admin_page() {
        // Check user capabilities
        if (!current_user_can('manage_options')) {
            return;
        }

        // Handle form submission
        if (isset($_POST['submit']) && check_admin_referer('shopping_list_settings', 'shopping_list_nonce')) {
            $this->process_form_submission();
        }

        // Load template
        include_once SHOPPING_LIST_PLUGIN_DIR . 'admin/partials/admin-display.php';
    }

    private function process_form_submission() {
        $always_include = isset($_POST['always_include']) ? $_POST['always_include'] : array();
        $not_needed = isset($_POST['not_needed']) ? $_POST['not_needed'] : array();
        $random_items = isset($_POST['random_items']) ? $_POST['random_items'] : array();

        $always_updated = Shopping_List_Database::update_always_include_items($always_include);
        $not_needed_updated = Shopping_List_Database::update_not_needed_items($not_needed);
        $random_updated = Shopping_List_Database::update_random_items($random_items);

        if ($always_updated || $not_needed_updated || $random_updated) {
            // Regenerate list immediately when settings change
            Shopping_List_Database::generate_random_selection();
            
            add_settings_error(
                'shopping_list_messages',
                'shopping_list_message',
                'Settings saved and list regenerated successfully!',
                'updated'
            );
        } else {
            add_settings_error(
                'shopping_list_messages',
                'shopping_list_message',
                'Error saving settings. Please try again.',
                'error'
            );
        }
    }

    public static function format_items_for_social($items) {
        if (empty($items)) {
            return '';
        }

        // Format each item: lowercase except for words that are all uppercase
        $formatted_items = array_map(function($item) {
            $words = explode(' ', $item);
            $formatted_words = array_map(function($word) {
                // If word is all uppercase, keep it, otherwise make it lowercase
                return ctype_upper($word) ? $word : strtolower($word);
            }, $words);
            return implode(' ', $formatted_words);
        }, $items);

        if (count($formatted_items) === 1) {
            return $formatted_items[0];
        }

        $last_item = array_pop($formatted_items);
        return implode(', ', $formatted_items) . ' and ' . $last_item;
    }
}
