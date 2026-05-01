<?php

class Shopping_List_RSS {

    private static $days = array( 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday' );

    public static function add_rewrite_rules() {
        add_rewrite_rule( '^shopping-list-feed\.rss$', 'index.php?shopping_list_rss=1', 'top' );
        add_rewrite_rule(
            '^shopping-list-feed-(monday|tuesday|wednesday|thursday|friday|saturday|sunday)\.rss$',
            'index.php?shopping_list_rss_day=$matches[1]',
            'top'
        );
        add_filter( 'query_vars', array( __CLASS__, 'add_query_vars' ) );
    }

    public static function add_query_vars( $vars ) {
        $vars[] = 'shopping_list_rss';
        $vars[] = 'shopping_list_rss_day';
        return $vars;
    }

    public static function handle_rss_request() {
        if ( get_query_var( 'shopping_list_rss' ) ) {
            self::generate_rss_feed();
            exit;
        }
        $day = get_query_var( 'shopping_list_rss_day' );
        if ( $day && in_array( $day, self::$days, true ) ) {
            self::generate_day_feed( $day );
            exit;
        }
    }

    public static function generate_rss_feed() {
        $current_selection = Shopping_List_Database::get_current_selection();

        if ( empty( $current_selection ) ) {
            status_header( 404 );
            return;
        }

        header( 'Content-Type: application/rss+xml; charset=UTF-8' );

        $site_url     = home_url();
        $site_name    = get_bloginfo( 'name' );
        $current_date = date( 'D, d M Y H:i:s O' );

        $list_html = '<ul>';
        foreach ( $current_selection as $item ) {
            $list_html .= '<li>' . esc_html( $item ) . '</li>';
        }
        $list_html .= '</ul>';

        echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        ?>
<rss version="2.0" xmlns:content="http://purl.org/rss/1.0/modules/content/">
<channel>
<title><?php echo esc_html( $site_name ); ?> - Shopping List</title>
<link><?php echo esc_url( $site_url ); ?></link>
<description>Weekly food bank shopping list</description>
<language>en-GB</language>
<lastBuildDate><?php echo esc_html( $current_date ); ?></lastBuildDate>

<item>
<title>This week's food bank shopping list:</title>
<link><?php echo esc_url( $site_url ); ?></link>
<description><![CDATA[<?php echo $list_html; ?>]]></description>
<content:encoded><![CDATA[<?php echo $list_html; ?>]]></content:encoded>
<pubDate><?php echo esc_html( $current_date ); ?></pubDate>
<guid><?php echo esc_url( $site_url ); ?>/shopping-list-<?php echo esc_html( date( 'Y-m-d' ) ); ?></guid>
</item>

</channel>
</rss>
        <?php
    }

    public static function generate_day_feed( $day ) {
        $snapshot = get_option( 'shopping_list_rss_snapshot_' . $day );

        if ( $snapshot && ! empty( $snapshot['items'] ) ) {
            $items    = $snapshot['items'];
            $pub_date = $snapshot['pub_date'];
        } else {
            $items    = Shopping_List_Database::get_current_selection();
            $pub_date = self::compute_last_occurrence_pub_date( $day );
        }

        if ( empty( $items ) ) {
            status_header( 404 );
            return;
        }

        header( 'Content-Type: application/rss+xml; charset=UTF-8' );

        $site_url  = home_url();
        $site_name = get_bloginfo( 'name' );
        $day_label = ucfirst( $day );

        $list_html = '<ul>';
        foreach ( $items as $item ) {
            $list_html .= '<li>' . esc_html( $item ) . '</li>';
        }
        $list_html .= '</ul>';

        $guid_date = date( 'Y-m-d', strtotime( $pub_date ) );

        echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        ?>
<rss version="2.0" xmlns:content="http://purl.org/rss/1.0/modules/content/">
<channel>
<title><?php echo esc_html( $site_name ); ?> - Shopping List (<?php echo esc_html( $day_label ); ?>)</title>
<link><?php echo esc_url( $site_url ); ?></link>
<description>Weekly food bank shopping list - <?php echo esc_html( $day_label ); ?> feed</description>
<language>en-GB</language>
<lastBuildDate><?php echo esc_html( $pub_date ); ?></lastBuildDate>

<item>
<title>This week's food bank shopping list:</title>
<link><?php echo esc_url( $site_url ); ?></link>
<description><![CDATA[<?php echo $list_html; ?>]]></description>
<content:encoded><![CDATA[<?php echo $list_html; ?>]]></content:encoded>
<pubDate><?php echo esc_html( $pub_date ); ?></pubDate>
<guid><?php echo esc_url( $site_url ); ?>/shopping-list-<?php echo esc_html( $day ); ?>-<?php echo esc_html( $guid_date ); ?></guid>
</item>

</channel>
</rss>
        <?php
    }

    /**
     * Called by each day's cron event. Stores a snapshot of the current list
     * with a fixed pub_date of "today at 06:00:00" in the site timezone.
     *
     * @param string|null $pub_date Override pub_date (used by init_all_snapshots).
     */
    public static function take_snapshot( $day, $pub_date = null ) {
        $items = Shopping_List_Database::get_current_selection();
        if ( empty( $items ) ) {
            return;
        }
        if ( null === $pub_date ) {
            $pub_date = self::compute_today_pub_date();
        }
        update_option(
            'shopping_list_rss_snapshot_' . $day,
            array(
                'items'    => $items,
                'pub_date' => $pub_date,
            ),
            false
        );
    }

    /**
     * Called on activation. Populates all 7 snapshots immediately so feeds
     * return valid content before the first cron fires.
     */
    public static function init_all_snapshots() {
        foreach ( self::$days as $day ) {
            $pub_date = self::compute_last_occurrence_pub_date( $day );
            self::take_snapshot( $day, $pub_date );
        }
    }

    private static function compute_today_pub_date() {
        $tz    = wp_timezone();
        $now   = new DateTime( 'now', $tz );
        $fixed = new DateTime( $now->format( 'Y-m-d' ) . ' 06:00:00', $tz );
        return $fixed->format( 'D, d M Y H:i:s O' );
    }

    private static function compute_last_occurrence_pub_date( $day ) {
        $tz         = wp_timezone();
        $now        = new DateTime( 'now', $tz );
        $today_name = strtolower( $now->format( 'l' ) );

        if ( $today_name === $day ) {
            $date_str = $now->format( 'Y-m-d' );
        } else {
            $ts       = strtotime( 'last ' . $day, $now->getTimestamp() );
            $date_str = ( new DateTime( '@' . $ts ) )->setTimezone( $tz )->format( 'Y-m-d' );
        }

        $fixed = new DateTime( $date_str . ' 06:00:00', $tz );
        return $fixed->format( 'D, d M Y H:i:s O' );
    }
}
