<?php
/**
 * Admin interface class
 */
class Shopping_List_Admin {

    private $plugin_name;
    private $version;

    public function __construct( $plugin_name, $version ) {
        $this->plugin_name = $plugin_name;
        $this->version     = $version;
    }

    /**
     * Enqueue admin CSS and JS — scoped to this plugin's settings page only.
     */
    public function enqueue_admin_assets( $hook ) {
        if ( 'settings_page_shopping-list-settings' !== $hook ) {
            return;
        }

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
            array( 'jquery' ),
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
            array( $this, 'display_admin_page' )
        );
    }

    public function admin_init() {
        register_setting( 'shopping_list_settings', 'shopping_list_always_include' );
        register_setting( 'shopping_list_settings', 'shopping_list_not_needed' );
        register_setting( 'shopping_list_settings', 'shopping_list_random_items' );

        add_settings_section(
            'shopping_list_always_section',
            'Always Include Items',
            array( $this, 'always_section_callback' ),
            'shopping-list-settings'
        );

        add_settings_section(
            'shopping_list_not_needed_section',
            'Not Needed Items',
            array( $this, 'not_needed_section_callback' ),
            'shopping-list-settings'
        );

        add_settings_section(
            'shopping_list_random_section',
            'Randomly Selected Needed Items',
            array( $this, 'random_section_callback' ),
            'shopping-list-settings'
        );
    }

    public function always_section_callback() {
        echo '<p>These items will always appear first in your shopping list (maximum ' . SHOPPING_LIST_SLOTS . ' items):</p>';
    }

    public function not_needed_section_callback() {
        echo '<p>Items in this list will be excluded from the shopping list and can be displayed separately using [noshop_list]:</p>';
    }

    public function random_section_callback() {
        echo '<p>Random items will be selected from these options (maximum one item per row):</p>';
    }

    public function display_admin_page() {
        if ( ! current_user_can( 'manage_options' ) ) {
            return;
        }

        if ( isset( $_POST['submit'] ) && check_admin_referer( 'shopping_list_settings', 'shopping_list_nonce' ) ) {
            $this->process_form_submission();
        }

        include_once SHOPPING_LIST_PLUGIN_DIR . 'admin/partials/admin-display.php';
    }

    private function process_form_submission() {
        // Type-enforce and unslash at point of reading; sanitisation happens inside database methods
        $always_include = isset( $_POST['always_include'] ) && is_array( $_POST['always_include'] )
            ? wp_unslash( $_POST['always_include'] )
            : array();
        $not_needed = isset( $_POST['not_needed'] ) && is_array( $_POST['not_needed'] )
            ? wp_unslash( $_POST['not_needed'] )
            : array();
        $random_items = isset( $_POST['random_items'] ) && is_array( $_POST['random_items'] )
            ? wp_unslash( $_POST['random_items'] )
            : array();

        $always_updated    = Shopping_List_Database::update_always_include_items( $always_include );
        $not_needed_updated = Shopping_List_Database::update_not_needed_items( $not_needed );
        $random_updated    = Shopping_List_Database::update_random_items( $random_items );

        if ( $always_updated || $not_needed_updated || $random_updated ) {
            Shopping_List_Database::generate_random_selection();

            add_settings_error(
                'shopping_list_messages',
                'shopping_list_message',
                'Settings saved and list regenerated successfully!',
                'updated'
            );

            // Warn if always-include items fill all slots — random items will not be added
            $always_include_count = count( array_filter( $always_include, function ( $item ) {
                return ! empty( trim( $item ) );
            } ) );

            if ( $always_include_count >= SHOPPING_LIST_SLOTS ) {
                add_settings_error(
                    'shopping_list_messages',
                    'shopping_list_capacity',
                    'All ' . SHOPPING_LIST_SLOTS . ' slots are filled by Always Include items — no randomly selected items will be added to the list.',
                    'warning'
                );
            }
        } else {
            add_settings_error(
                'shopping_list_messages',
                'shopping_list_message',
                'Error saving settings. Please try again.',
                'error'
            );
        }
    }

    public static function format_items_for_social( $items ) {
        if ( empty( $items ) ) {
            return '';
        }

        $formatted_items = array_map( function ( $item ) {
            $words = explode( ' ', $item );
            $formatted_words = array_map( function ( $word ) {
                return ctype_upper( $word ) ? $word : strtolower( $word );
            }, $words );
            return implode( ' ', $formatted_words );
        }, $items );

        if ( count( $formatted_items ) === 1 ) {
            return $formatted_items[0];
        }

        $last_item = array_pop( $formatted_items );
        return implode( ', ', $formatted_items ) . ' and ' . $last_item;
    }
}
