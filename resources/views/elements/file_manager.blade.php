@section('css')
    <link rel="stylesheet" href="{{ asset('css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fancybox/jquery.fancybox-1.3.4.css') }}">
    <link rel="stylesheet" href="{{ asset('css/prettyPhoto.css') }}">

@endsection
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
<div class="form-group m-form__group row">
    <label class="col-lg-2 col-form-label">{{ !empty($label) ? $label : '' }}:</label>

    <div class="col-lg-8">
        <div class="input-group">
            <div class="input-group-prepend">
                <button
                    href="{{asset('responsive_filemanager/filemanager/dialog.php?'. $str)}}"
                    class="btn btn-primary {{ $id }}-btn" type="button">Chọn
                    files
                </button>
            </div>
            <input id="{{ $id }}" type="text" name="{{ $name }}"
                   class="form-control form-inline m-input" value="{{ !empty($files) ? json_encode($files) : '' }}"
                   readonly>
            <br>
            <div id="cont-{{ $id }}" class=" col-lg-12">
                @if(!empty($files))
                    <ul class="menu-files">
                        @foreach($files as $val)
                            <li>
                                <img src="{{ getenv('BASE_URL').'uploads/' . $val }}"/><span>{{$val}}</span>
                            </li>
                        @endforeach
                    </ul>
                @endif

            </div>
        </div>
    </div>
</div>

@section('js-file')
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery-migrate-1.2.1.min.js') }}"></script>
    <script src="{{ asset('js/jquery.easing.js') }}"></script>
    <script src="{{ asset('js/jquery.prettyPhoto-3.1.4-W3C.js') }}"></script>
    <script src="{{ asset('js/jquery.ui.totop.js') }}"></script>
    <script src="{{ asset('js/jquery.inview.js') }}"></script>
    <script src="{{ asset('js/jquery.parallax-1.1.3.js') }}"></script>
    <script src="{{ asset('js/jquery.localscroll-1.2.7-min.js') }}"></script>
    <script src="{{ asset('js/jquery.scrollTo-1.4.2-min.js') }}"></script>
    <script src="{{ asset('js/jquery.fancybox-1.3.4.pack.js') }}"></script>
    <script src="{{ asset('js/jquery.fitvids.min.js') }}"></script>
    <script src="{{ asset('js/jquery.nicescroll.min.js') }}"></script>
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
    <script>
        base_url = "http://bds_cms.test:8080/";

        function responsive_filemanager_callback(field_id) {
            $('#cont-{{ $id }}').html('');
            let fields, html = '<ul class="menu-files">';
            var url = $('#' + field_id).val();
            //alert('update '+field_id+" with "+url);
            //your code
            var str = document.getElementById(field_id).value;
            var patt1 = /\[/gm;
            var result = patt1.exec(str);
            if (result === null) {
                fields = str;
                html += '<li><img src="' + base_url + 'uploads/' + fields + '"/><span>' + fields + '</span></li>';
            } else {
                fields = JSON.parse("[" + str + "]");
                $.map(fields[0], function (value, index) {
                    a = '<li><img src="' + base_url + 'uploads/' + value + '"/><span>' + value + '</span></li>';
                    html += a;
                });
            }
            html += '</ul>';
            console.log(html);
            $('#cont-{{ $id }}').append(html);
            // console.log(JSON.parse("[" + document.getElementById(field_id).value + "]") == "undefined");
            // $('#image_preview').attr('src',base_url + 'uploads/'+ document.getElementById(field_id).value).show();
            parent.$.fancybox.close();
        }
    </script>
@endsection
