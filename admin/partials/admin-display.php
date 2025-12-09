<?php
// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

$always_include = Shopping_List_Database::get_always_include_items();
$not_needed = Shopping_List_Database::get_not_needed_items();
$random_items = Shopping_List_Database::get_random_items();
$current_selection = Shopping_List_Database::get_current_selection();

// Prepare social media texts
$formatted_items = Shopping_List_Admin::format_items_for_social($current_selection);
$social_texts = array();

if (!empty($current_selection)) {
    // First block - all items
    $social_texts[0] = "🌟 Good Monday morning, Shopporters!\nOur shelves are running low on some essentials this week. If you're out shopping, could you pick up an extra item or two for your local food bank?\nThis week's urgent needs are " . $formatted_items . ".\nYou can drop off donations at any of our collection points, or shop for us online for direct delivery: givetoday.co.uk/nbsgfoodbank";
    
    // Blocks 2-5 - pairs of items
    for ($i = 1; $i <= 4; $i++) {
        $start_index = ($i - 1) * 2;
        $pair_items = array_slice($current_selection, $start_index, 2);
        if (!empty($pair_items)) {
            $formatted_pair = Shopping_List_Admin::format_items_for_social($pair_items);
            $social_texts[$i] = "📢 Today's urgent food bank needs: " . $formatted_pair . "\nOur warehouse is running low. Can you add something to your shop for your neighbours?\nDrop off at a collection point or shop online: http://givetoday.co.uk/nbsgfoodbank";
        }
    }
}
?>

<div class="wrap">
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
    
    <?php settings_errors('shopping_list_messages'); ?>
    
    <?php if (!empty($social_texts)): ?>
    <div class="social-media-blocks">
        <h2>Social Media Posts</h2>
        <div class="social-blocks-container">
            <?php foreach ($social_texts as $index => $text): ?>
                <div class="social-block">
                    <button class="copy-button" data-clipboard-target="#social-text-<?php echo $index; ?>">Copy</button>
                    <textarea id="social-text-<?php echo $index; ?>" readonly><?php echo esc_textarea($text); ?></textarea>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>

    <form method="post" action="">
        <?php wp_nonce_field('shopping_list_settings', 'shopping_list_nonce'); ?>
        
        <div class="side-by-side-sections">
            <div class="shopping-list-section half-width">
                <h2>Always Include Items</h2>
                <p>These items will always appear first in your shopping list:</p>
                <table class="form-table">
                    <?php for ($i = 0; $i < 8; $i++): ?>
                        <tr>
                            <th scope="row">Item <?php echo $i + 1; ?></th>
                            <td>
                                <input type="text" 
                                       name="always_include[<?php echo $i; ?>]" 
                                       value="<?php echo esc_attr($always_include[$i]); ?>" 
                                       class="regular-text" 
                                       placeholder="Enter item name" />
                            </td>
                        </tr>
                    <?php endfor; ?>
                </table>
            </div>

            <div class="shopping-list-section half-width">
                <h2>Not Needed Items</h2>
                <p>Items excluded from shopping list, displayed via <code>[noshop_list]</code>:</p>
                <table class="form-table">
                    <?php for ($i = 0; $i < 8; $i++): ?>
                        <tr>
                            <th scope="row">Item <?php echo $i + 1; ?></th>
                            <td>
                                <input type="text" 
                                       name="not_needed[<?php echo $i; ?>]" 
                                       value="<?php echo esc_attr($not_needed[$i]); ?>" 
                                       class="regular-text" 
                                       placeholder="Enter item name" />
                            </td>
                        </tr>
                    <?php endfor; ?>
                </table>
            </div>
        </div>

        <div class="shopping-list-section">
            <h2>Randomly Selected Needed Items</h2>
            <p>One item will be randomly selected from each row (if that row contains items):</p>
            <div class="random-items-grid">
                <?php for ($row = 0; $row < 40; $row++): ?>
                    <div class="grid-row">
                        <label class="row-label">Row <?php echo $row + 1; ?>:</label>
                        <?php for ($col = 0; $col < 4; $col++): ?>
                            <input type="text" 
                                   name="random_items[<?php echo $row; ?>][<?php echo $col; ?>]" 
                                   value="<?php echo esc_attr($random_items[$row][$col]); ?>" 
                                   class="grid-input" 
                                   placeholder="Option <?php echo $col + 1; ?>" />
                        <?php endfor; ?>
                    </div>
                <?php endfor; ?>
            </div>
        </div>

        <?php submit_button('Save Settings & Regenerate List'); ?>
    </form>
</div>
