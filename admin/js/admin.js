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
});
