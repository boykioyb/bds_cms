jQuery(document).ready(function ($) {
    $('.iframe-btn').fancybox({
        'width'	: 880,
        'height'	: 570,
        'type'	: 'iframe',
        'autoScale'   : false
    });
    function OnMessage(e) {
        var event = e.originalEvent;
        console.log(event.data.sender);
        debugger;
        // Make sure the sender of the event is trusted
        if (event.data.sender === 'responsivefilemanager') {
            if (event.data.field_id) {
                var fieldID = event.data.field_id;
                var url = event.data.url;
                $('#' + fieldID).val(url).trigger('change');
                $.fancybox.close();

                // Delete handler of the message from ResponsiveFilemanager
                $(window).off('message', OnMessage);
            }
        }
    }

    $('.iframe-btn').on('click', function () {
        $(window).on('message', OnMessage);
    });
});
