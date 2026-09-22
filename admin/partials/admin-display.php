<?php
// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Renders one text input wrapped with a grey clear/delete button.
 * Used for every field on this page so the button markup only lives here.
 */
function shopping_list_clearable_input( $name, $value, $classes = 'regular-text', $placeholder = '', $wrapper_attrs = array() ) {
    $attr_str = '';
    foreach ( $wrapper_attrs as $attr => $attr_value ) {
        $attr_str .= ' ' . esc_attr( $attr ) . '="' . esc_attr( $attr_value ) . '"';
    }
    printf(
        '<span class="field-clearable"%s><input type="text" name="%s" value="%s" class="%s" placeholder="%s" /><button type="button" class="clear-field dashicons dashicons-no-alt" tabindex="-1" aria-label="Clear field"></button></span>',
        $attr_str,
        esc_attr( $name ),
        esc_attr( $value ),
        esc_attr( $classes ),
        esc_attr( $placeholder )
    );
}

$always_include = Shopping_List_Database::get_always_include_items();
$not_needed = Shopping_List_Database::get_not_needed_items();
$random_items = Shopping_List_Database::get_random_items();
$current_selection = Shopping_List_Database::get_current_selection();
$social_template_intro = Shopping_List_Database::get_social_template_intro();
$social_template_pair = Shopping_List_Database::get_social_template_pair();

// Prepare social media texts
$formatted_items = Shopping_List_Admin::format_items_for_social($current_selection);
$social_texts = array();

if (!empty($current_selection)) {
    // First block - all items
    $social_texts[0] = array(
        'template' => $social_template_intro,
        'items'    => $formatted_items,
        'text'     => str_replace( '[items]', $formatted_items, $social_template_intro ),
    );

    // Blocks 2-5 - pairs of items
    for ($i = 1; $i <= 4; $i++) {
        $start_index = ($i - 1) * 2;
        $pair_items = array_slice($current_selection, $start_index, 2);
        if (!empty($pair_items)) {
            $formatted_pair = Shopping_List_Admin::format_items_for_social($pair_items);
            $social_texts[$i] = array(
                'template' => $social_template_pair,
                'items'    => $formatted_pair,
                'text'     => str_replace( '[items]', $formatted_pair, $social_template_pair ),
            );
        }
    }
}
?>

<div class="wrap shopping-list-wrap">
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>

    <?php settings_errors('shopping_list_messages'); ?>

    <form method="post" action="">
        <?php wp_nonce_field('shopping_list_settings', 'shopping_list_nonce'); ?>

        <?php if (!empty($social_texts)): ?>
        <div class="social-media-blocks">
            <h2>Social Media Posts</h2>
            <div class="social-blocks-container">
                <?php foreach ($social_texts as $index => $block):
                    $is_pair = $index > 0;
                    $template_field = $is_pair ? 'social_template_pair' : 'social_template_intro';
                ?>
                    <div class="social-block" data-template-field="<?php echo esc_attr( $template_field ); ?>">
                        <div class="social-block-actions">
                            <button type="button" class="edit-button">Edit</button>
                            <button type="button" class="copy-button" data-clipboard-target="#social-text-<?php echo $index; ?>">Copy</button>
                        </div>
                        <textarea id="social-text-<?php echo $index; ?>" class="social-preview" data-items="<?php echo esc_attr( $block['items'] ); ?>" readonly><?php echo esc_textarea($block['text']); ?></textarea>
                        <div class="social-template-editor" hidden>
                            <p class="template-hint">Use <code>[items]</code> where the current needed items should appear.<?php echo $is_pair ? ' This template is shared by all four "pair" posts above.' : ''; ?></p>
                            <textarea class="social-template-input" name="<?php echo esc_attr( $template_field ); ?>"><?php echo esc_textarea($block['template']); ?></textarea>
                            <button type="button" class="button reset-template" data-default="<?php echo esc_attr( $is_pair ? Shopping_List_Database::DEFAULT_SOCIAL_TEMPLATE_PAIR : Shopping_List_Database::DEFAULT_SOCIAL_TEMPLATE_INTRO ); ?>">Reset to default</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

        <div class="side-by-side-sections">
            <div class="shopping-list-section half-width">
                <h2><span class="dashicons dashicons-star-filled"></span> Always Include Items</h2>
                <p>These items will always appear first in your shopping list:</p>
                <table class="form-table list-rows" data-min-rows="3">
                    <?php foreach ( $always_include as $i => $value ): ?>
                        <tr class="list-row">
                            <th scope="row" class="row-label">Item <?php echo $i + 1; ?></th>
                            <td>
                                <?php shopping_list_clearable_input( "always_include[$i]", $value, 'regular-text', 'Enter item name' ); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
                <button type="button" class="button add-row" data-target="always-include-rows">+ Add row</button>
                <template id="always-include-row-template">
                    <tr class="list-row">
                        <th scope="row" class="row-label">Item</th>
                        <td>
                            <?php shopping_list_clearable_input( 'always_include[__INDEX__]', '', 'regular-text', 'Enter item name' ); ?>
                        </td>
                    </tr>
                </template>
            </div>

            <div class="shopping-list-section half-width">
                <h2><span class="dashicons dashicons-hidden"></span> Not Needed Items</h2>
                <p>Items excluded from shopping list, displayed via <code>[noshop_list]</code>:</p>
                <table class="form-table list-rows" data-min-rows="3">
                    <?php foreach ( $not_needed as $i => $value ): ?>
                        <tr class="list-row">
                            <th scope="row" class="row-label">Item <?php echo $i + 1; ?></th>
                            <td>
                                <?php shopping_list_clearable_input( "not_needed[$i]", $value, 'regular-text', 'Enter item name' ); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
                <button type="button" class="button add-row" data-target="not-needed-rows">+ Add row</button>
                <template id="not-needed-row-template">
                    <tr class="list-row">
                        <th scope="row" class="row-label">Item</th>
                        <td>
                            <?php shopping_list_clearable_input( 'not_needed[__INDEX__]', '', 'regular-text', 'Enter item name' ); ?>
                        </td>
                    </tr>
                </template>
            </div>
        </div>

        <div class="shopping-list-section">
            <h2><span class="dashicons dashicons-randomize"></span> Randomly Selected Needed Items</h2>
            <p>One item will be randomly selected from each row (if that row contains items):</p>
            <div class="random-items-grid" data-min-rows="3" data-min-cols="3">
                <?php foreach ( $random_items as $r => $row ): ?>
                    <div class="grid-row" data-row-index="<?php echo esc_attr( $r ); ?>">
                        <label class="row-label">Row <?php echo $r + 1; ?>:</label>
                        <div class="grid-cells">
                            <?php foreach ( $row as $c => $value ): ?>
                                <?php shopping_list_clearable_input(
                                    "random_items[$r][$c]",
                                    $value,
                                    'grid-input',
                                    'Option ' . ( $c + 1 ),
                                    array( 'data-col-index' => $c )
                                ); ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="grid-actions">
                <button type="button" class="button add-grid-row">+ Add row</button>
                <button type="button" class="button add-grid-col">+ Add column</button>
            </div>
            <template id="grid-row-template">
                <div class="grid-row" data-row-index="__ROW__">
                    <label class="row-label">Row</label>
                    <div class="grid-cells"></div>
                </div>
            </template>
            <template id="grid-cell-template">
                <?php shopping_list_clearable_input(
                    'random_items[__ROW__][__COL__]',
                    '',
                    'grid-input',
                    'Option',
                    array( 'data-col-index' => '__COL__' )
                ); ?>
            </template>
        </div>

        <?php submit_button('Save Settings & Regenerate List'); ?>
    </form>
</div>
