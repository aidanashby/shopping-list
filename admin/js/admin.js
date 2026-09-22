jQuery(document).ready(function($) {
    // Clipboard functionality
    $('.copy-button').on('click', function(e) {
        e.preventDefault();

        var button = $(this);
        var targetId = button.data('clipboard-target');
        var textarea = $(targetId);

        // Select and copy text
        textarea.select();
        document.execCommand('copy');

        // Visual feedback
        var originalText = button.text();
        button.text('Copied!').addClass('copied');

        // Reset button after 2 seconds
        setTimeout(function() {
            button.text(originalText).removeClass('copied');
        }, 2000);

        // Deselect textarea
        textarea.blur();
    });

    // --- Social media template editing ---

    function syncSocialTemplate(field, value) {
        $('.social-block[data-template-field="' + field + '"]').each(function() {
            var $block = $(this);
            $block.find('.social-template-input').val(value);
            var $preview = $block.find('.social-preview');
            var items = $preview.data('items') || '';
            $preview.val(String(value).split('[items]').join(items));
        });
    }

    $(document).on('click', '.edit-button', function() {
        var $block = $(this).closest('.social-block');
        var $editor = $block.find('.social-template-editor');
        var opening = $editor.prop('hidden');
        $editor.prop('hidden', !opening);
        $block.find('.social-preview').prop('hidden', opening);
        $(this).text(opening ? 'Done' : 'Edit');
    });

    $(document).on('input', '.social-template-input', function() {
        var field = $(this).closest('.social-block').data('template-field');
        syncSocialTemplate(field, $(this).val());
    });

    $(document).on('click', '.reset-template', function() {
        var $block = $(this).closest('.social-block');
        var field = $block.data('template-field');
        syncSocialTemplate(field, $(this).data('default'));
    });

    // --- Clearable / deletable fields ---

    function uid(prefix) {
        return prefix + '_' + Date.now().toString(36) + Math.random().toString(36).slice(2, 8);
    }

    function fillTemplate($template, replacements) {
        var node = document.importNode($template[0].content, true);
        var html = $('<div>').append(node).html();
        $.each(replacements, function(token, value) {
            html = html.split(token).join(value);
        });
        return $(html);
    }

    // Simple single-column lists (Always Include / Not Needed)

    function renumberListRows($table) {
        $table.find('.list-row').each(function(idx) {
            $(this).find('.row-label').text('Item ' + (idx + 1));
        });
    }

    $(document).on('click', '.list-rows .clear-field', function() {
        var $btn = $(this);
        var $input = $btn.siblings('input');
        var $row = $btn.closest('.list-row');
        var $table = $row.closest('.list-rows');
        var minRows = parseInt($table.data('min-rows'), 10) || 3;

        if ($table.find('.list-row').length > minRows) {
            $row.remove();
            renumberListRows($table);
        } else {
            $input.val('').trigger('input').focus();
        }
    });

    $('.add-row').on('click', function() {
        var target = $(this).data('target');
        var templateId = '#' + target.replace(/-rows$/, '-row-template');
        var $section = $(this).closest('.shopping-list-section');
        var $table = $section.find('.list-rows');
        var $template = $section.find(templateId);

        var $newRow = fillTemplate($template, { '__INDEX__': uid('r') });
        $table.append($newRow);
        renumberListRows($table);
    });

    // Random items grid

    function renumberGrid($grid) {
        $grid.find('.grid-row').each(function(rowIdx) {
            $(this).find('.row-label').text('Row ' + (rowIdx + 1) + ':');
            $(this).find('.field-clearable input').each(function(colIdx) {
                $(this).attr('placeholder', 'Option ' + (colIdx + 1));
            });
        });
    }

    function isRowSoleContent($input) {
        if (!$input.val().trim()) {
            return false;
        }
        var $row = $input.closest('.grid-row');
        var others = $row.find('.field-clearable input').not($input);
        return others.toArray().every(function(el) {
            return !$(el).val().trim();
        });
    }

    function isColSoleContent($input) {
        if (!$input.val().trim()) {
            return false;
        }
        var $cellWrap = $input.closest('.field-clearable');
        var $row = $cellWrap.closest('.grid-row');
        var $grid = $row.closest('.random-items-grid');
        var colIndex = $row.find('.field-clearable').index($cellWrap);

        var soleContent = true;
        $grid.find('.grid-row').each(function() {
            var $cell = $(this).find('.field-clearable').eq(colIndex);
            if (!$cell.length || $cell.is($cellWrap)) {
                return;
            }
            if ($cell.find('input').val().trim()) {
                soleContent = false;
                return false;
            }
        });
        return soleContent;
    }

    $(document).on('click', '.random-items-grid .clear-field', function() {
        var $btn = $(this);
        var $input = $btn.siblings('input');
        var $cellWrap = $btn.closest('.field-clearable');
        var $row = $cellWrap.closest('.grid-row');
        var $grid = $row.closest('.random-items-grid');

        var minRows = parseInt($grid.data('min-rows'), 10) || 3;
        var minCols = parseInt($grid.data('min-cols'), 10) || 3;
        var rowCount = $grid.find('.grid-row').length;
        var colCount = $row.find('.field-clearable').length;

        var rowSole = isRowSoleContent($input);
        var colSole = isColSoleContent($input);

        if (rowSole && !colSole && rowCount > minRows) {
            $row.remove();
            renumberGrid($grid);
            return;
        }

        if (colSole && !rowSole && colCount > minCols) {
            var colIndex = $row.find('.field-clearable').index($cellWrap);
            $grid.find('.grid-row').each(function() {
                $(this).find('.field-clearable').eq(colIndex).remove();
            });
            renumberGrid($grid);
            return;
        }

        // Both, neither, or at the minimum floor: just clear the field.
        $input.val('').trigger('input').focus();
    });

    $('.add-grid-row').on('click', function() {
        var $section = $(this).closest('.shopping-list-section');
        var $grid = $section.find('.random-items-grid');
        var $rowTemplate = $section.find('#grid-row-template');
        var $cellTemplate = $section.find('#grid-cell-template');
        var $firstRow = $grid.find('.grid-row').first();
        var newRowIndex = uid('r');

        var $newRow = fillTemplate($rowTemplate, { '__ROW__': newRowIndex });
        var $cells = $newRow.find('.grid-cells');

        $firstRow.find('.field-clearable').each(function() {
            var colIndex = $(this).data('col-index');
            var $cell = fillTemplate($cellTemplate, {
                '__ROW__': newRowIndex,
                '__COL__': colIndex
            });
            $cells.append($cell);
        });

        $grid.append($newRow);
        renumberGrid($grid);
    });

    $('.add-grid-col').on('click', function() {
        var $section = $(this).closest('.shopping-list-section');
        var $grid = $section.find('.random-items-grid');
        var $cellTemplate = $section.find('#grid-cell-template');
        var newColIndex = uid('c');

        $grid.find('.grid-row').each(function() {
            var rowIndex = $(this).data('row-index');
            var $cell = fillTemplate($cellTemplate, {
                '__ROW__': rowIndex,
                '__COL__': newColIndex
            });
            $(this).find('.grid-cells').append($cell);
        });

        renumberGrid($grid);
    });
});
