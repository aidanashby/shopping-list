<?php
/**
 * Database operations class
 */
class Shopping_List_Database {

    public static function create_default_options() {
        if ( ! get_option( 'shopping_list_always_include' ) ) {
            add_option( 'shopping_list_always_include', array_fill( 0, SHOPPING_LIST_SLOTS, '' ) );
        }

        if ( ! get_option( 'shopping_list_not_needed' ) ) {
            add_option( 'shopping_list_not_needed', array_fill( 0, SHOPPING_LIST_SLOTS, '' ) );
        }

        if ( ! get_option( 'shopping_list_random_items' ) ) {
            $random_items = array();
            for ( $i = 0; $i < SHOPPING_LIST_RANDOM_ROWS; $i++ ) {
                $random_items[ $i ] = array_fill( 0, SHOPPING_LIST_RANDOM_COLS, '' );
            }
            add_option( 'shopping_list_random_items', $random_items );
        }

        if ( ! get_option( 'shopping_list_current_selection' ) ) {
            add_option( 'shopping_list_current_selection', array() );
        }
    }

    public static function get_always_include_items() {
        return get_option( 'shopping_list_always_include', array_fill( 0, SHOPPING_LIST_SLOTS, '' ) );
    }

    public static function get_not_needed_items() {
        return get_option( 'shopping_list_not_needed', array_fill( 0, SHOPPING_LIST_SLOTS, '' ) );
    }

    public static function get_random_items() {
        $default = array();
        for ( $i = 0; $i < SHOPPING_LIST_RANDOM_ROWS; $i++ ) {
            $default[ $i ] = array_fill( 0, SHOPPING_LIST_RANDOM_COLS, '' );
        }
        return get_option( 'shopping_list_random_items', $default );
    }

    public static function get_current_selection() {
        return get_option( 'shopping_list_current_selection', array() );
    }

    /**
     * Minimum number of rows enforced server-side for the Always Include /
     * Not Needed / random-items lists. The UI already prevents deleting
     * below this floor; this is the defensive backstop on save.
     */
    const MIN_LIST_ROWS = 3;
    const MIN_GRID_COLS = 3;

    public static function update_always_include_items( $items ) {
        $items = array_values( $items );
        $items = array_pad( $items, self::MIN_LIST_ROWS, '' );
        $items = array_map( 'sanitize_text_field', $items );
        return update_option( 'shopping_list_always_include', $items );
    }

    public static function update_not_needed_items( $items ) {
        $items = array_values( $items );
        $items = array_pad( $items, self::MIN_LIST_ROWS, '' );
        $items = array_map( 'sanitize_text_field', $items );
        return update_option( 'shopping_list_not_needed', $items );
    }

    public static function update_random_items( $items ) {
        $rows = array_values( is_array( $items ) ? $items : array() );
        $rows = array_pad( $rows, self::MIN_LIST_ROWS, array() );

        $col_count = self::MIN_GRID_COLS;
        foreach ( $rows as $row ) {
            $col_count = max( $col_count, count( (array) $row ) );
        }

        $sanitised = array();
        foreach ( $rows as $row ) {
            $row = array_values( (array) $row );
            $row = array_pad( $row, $col_count, '' );
            $sanitised[] = array_map( 'sanitize_text_field', $row );
        }

        return update_option( 'shopping_list_random_items', $sanitised );
    }

    public static function update_current_selection( $selection ) {
        $selection = array_map( 'sanitize_text_field', $selection );
        return update_option( 'shopping_list_current_selection', $selection );
    }

    const DEFAULT_SOCIAL_TEMPLATE_INTRO = "🌟 Good Monday morning, Shopporters!\nOur shelves are running low on some essentials this week. If you're out shopping, could you pick up an extra item or two for your local food bank?\nThis week's urgent needs are [items].\nYou can drop off donations at any of our collection points, or shop for us online for direct delivery: givetoday.co.uk/nbsgfoodbank";

    const DEFAULT_SOCIAL_TEMPLATE_PAIR = "📢 Today's urgent food bank needs: [items]\nOur warehouse is running low. Can you add something to your shop for your neighbours?\nDrop off at a collection point or shop online: http://givetoday.co.uk/nbsgfoodbank";

    public static function get_social_template_intro() {
        return get_option( 'shopping_list_social_template_intro', self::DEFAULT_SOCIAL_TEMPLATE_INTRO );
    }

    public static function get_social_template_pair() {
        return get_option( 'shopping_list_social_template_pair', self::DEFAULT_SOCIAL_TEMPLATE_PAIR );
    }

    public static function update_social_template_intro( $template ) {
        return update_option( 'shopping_list_social_template_intro', sanitize_textarea_field( $template ) );
    }

    public static function update_social_template_pair( $template ) {
        return update_option( 'shopping_list_social_template_pair', sanitize_textarea_field( $template ) );
    }

    public static function generate_random_selection() {
        $always_include = self::get_always_include_items();
        $random_items   = self::get_random_items();
        $not_needed     = self::get_not_needed_items();

        // Build lowercase exclusion lists for case-insensitive comparison
        $not_needed_lowercase = array_map(
            'strtolower',
            array_map( 'trim', array_filter( $not_needed, function ( $item ) {
                return ! empty( trim( $item ) );
            } ) )
        );

        // Always-include items: exclude empties and anything on the not-needed list
        $always_include_filtered = array_filter( $always_include, function ( $item ) use ( $not_needed_lowercase ) {
            $trimmed = trim( $item );
            return ! empty( $trimmed ) && ! in_array( strtolower( $trimmed ), $not_needed_lowercase, true );
        } );

        // Lowercase list of always-include items — used to prevent duplicates in random picks
        $always_include_lowercase = array_map( 'strtolower', array_map( 'trim', $always_include_filtered ) );

        $selection       = array_values( $always_include_filtered );
        $remaining_slots = SHOPPING_LIST_SLOTS - count( $selection );

        if ( $remaining_slots > 0 ) {
            $available_random = array();

            foreach ( $random_items as $row ) {
                // From each row, pick one item — excluding not-needed and already-included items
                $row_candidates = array_filter( $row, function ( $item ) use ( $not_needed_lowercase, $always_include_lowercase ) {
                    $trimmed = trim( $item );
                    $lower   = strtolower( $trimmed );
                    return ! empty( $trimmed )
                        && ! in_array( $lower, $not_needed_lowercase, true )
                        && ! in_array( $lower, $always_include_lowercase, true );
                } );

                if ( ! empty( $row_candidates ) ) {
                    $available_random[] = $row_candidates[ array_rand( $row_candidates ) ];
                }
            }

            shuffle( $available_random );
            $selection = array_merge( $selection, array_slice( $available_random, 0, $remaining_slots ) );
        }

        self::update_current_selection( $selection );
        return $selection;
    }
}
