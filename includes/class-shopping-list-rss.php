<?php

class Shopping_List_RSS {
    
    public static function add_rewrite_rules() {
        add_rewrite_rule('^shopping-list-feed\.rss$', 'index.php?shopping_list_rss=1', 'top');
        add_filter('query_vars', array(__CLASS__, 'add_query_vars'));
    }
    
    public static function add_query_vars($vars) {
        $vars[] = 'shopping_list_rss';
        return $vars;
    }
    
    public static function handle_rss_request() {
        if (get_query_var('shopping_list_rss')) {
            self::generate_rss_feed();
            exit;
        }
    }
    
    public static function generate_rss_feed() {
        $current_selection = Shopping_List_Database::get_current_selection();
        
        if (empty($current_selection)) {
            status_header(404);
            return;
        }
        
        // Set content type
        header('Content-Type: application/rss+xml; charset=UTF-8');
        
        $site_url = home_url();
        $site_name = get_bloginfo('name');
        $current_date = date('D, d M Y H:i:s O');
        
        // Generate list HTML
        $list_html = '<ul>';
        foreach ($current_selection as $item) {
            $list_html .= '<li>' . esc_html($item) . '</li>';
        }
        $list_html .= '</ul>';
        
        // RSS Feed XML
        echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        ?>
<rss version="2.0" xmlns:content="http://purl.org/rss/1.0/modules/content/">
<channel>
<title><?php echo esc_html($site_name); ?> - Shopping List</title>
<link><?php echo esc_url($site_url); ?></link>
<description>Weekly food bank shopping list</description>
<language>en-GB</language>
<lastBuildDate><?php echo $current_date; ?></lastBuildDate>

<item>
<title>This week's food bank shopping list:</title>
<link><?php echo esc_url($site_url); ?></link>
<description><![CDATA[<?php echo $list_html; ?>]]></description>
<content:encoded><![CDATA[<?php echo $list_html; ?>]]></content:encoded>
<pubDate><?php echo $current_date; ?></pubDate>
<guid><?php echo esc_url($site_url); ?>/shopping-list-<?php echo date('Y-m-d'); ?></guid>
</item>

</channel>
</rss>
        <?php
    }
    
    public static function update_rss_feed() {
        // This method can be called when the list is regenerated
        // The RSS feed is generated on-demand, so no file storage needed
        return true;
    }
}
