<?php
$str = 'field_id=' . $id;
if (isset($option['type'])) {
    $str .= '&type=' . $option['type'];
}
if (isset($option['relative_url'])) {
    $str .= '&relative_url=' . $option['relative_url'];
}
if (isset($option['multiple'])) {
    $str .= '&multiple=' . $option['multiple'];
}
?>

<label class="form-control-label">{{ !empty($label) ? $label : '' }}:</label>
<div class="input-group">
    <div class="input-group-prepend">
        <button
            href="{{asset('responsive_filemanager/filemanager/dialog.php?'. $str)}}"
            class="btn btn-primary {{ $id }}-btn" type="button">Chọn
            files
        </button>
    </div>
    <input id="{{ $id }}" type="text" name="{{ $name }}"
           class="form-control form-inline m-input" value=""
           readonly>
</div>
@section('js')
    <script>
        jQuery(document).ready(function ($) {
            $('.{{ $id }}-btn').fancybox({
                'width': 880,
                'height': 570,
                'type': 'iframe',
                'autoScale': false
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

            $('.{{ $id }}-btn').on('click', function () {
                $(window).on('message', OnMessage);
            });
        });
    </script>
@endsection
