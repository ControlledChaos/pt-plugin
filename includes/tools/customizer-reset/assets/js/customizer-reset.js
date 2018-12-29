/* global jQuery, _PTPCustomizerReset, ajaxurl, wp */

jQuery(function ($) {
    var $container = $('#customize-header-actions');


    var $button = $('<input type="submit" name="ptp-reset" id="ptp-reset" class="button-secondary button">')
        .attr('value', _PTPCustomizerReset.reset)
        .css({
            'float': 'right',
            'margin-right': '10px',
            'margin-top': '9px'
        });

    $button.on('click', function (event) {
        event.preventDefault();

        var data = {
            wp_customize: 'on',
            action: 'customizer_reset',
            nonce: _PTPCustomizerReset.nonce.reset
        };

        var r = confirm(_PTPCustomizerReset.confirm);

        if (!r) return;

        $button.attr('disabled', 'disabled');

        $.post(ajaxurl, data, function () {
            wp.customize.state('saved').set(true);
            location.reload();
        });
    });

    $container.append($button);
});
