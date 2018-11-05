<?php
$dom_id = !empty($id) ? $id : rand(1, 100);
$upload_id = 'upload-' . $dom_id;
$file_hidden_id = 'file-hidden-' . $dom_id;
$template_upload_id = 'template-upload-' . $dom_id;
$template_download_id = 'template-download-' . $dom_id;
$default_upload_options = array(
    'uploadTemplateId' => "$template_upload_id",
    'downloadTemplateId' => "$template_download_id",
    'acceptFileTypes' => '/(\.|\/)(gif|jpe?g|png|mp4)$/i',
    'url' => route('medias.store'),
    'disableImageResize' => '/Android(?!.*Chrome)|Opera/.test(window.navigator.userAgent)',
    'maxFileSize' => 5,
);
$playerPreview = !empty($options['playerPreview']) ? $options['playerPreview'] : '';
if (!empty($upload_options['acceptFileTypes'])) {

    $upload_options['acceptFileTypes'] = '/(\.|\/)(' . $upload_options['acceptFileTypes'] . ')$/i';
}
if (!empty($upload_options)) {

    $upload_options = array_merge($default_upload_options, $upload_options);
} else {

    $upload_options = $default_upload_options;
}
$class = !empty($class) ? $class : '';
$nameOri = !empty($name) ? $name : '';
if (!empty($multiple)) {
    $nameOri = $name . '[]';
}
$required_clss = !empty($required) ? 'required' : '';

// xác định lỗi validate
$validationErrors = !empty($validationErrors) ?
    $validationErrors : $nameOri;
$validate_error_clss = !empty($validationErrors) ? 'error' : '';

// xác định xem video có upload lên youtube hay không?
$uploadYoutube = !empty($uploadYoutube) ? $uploadYoutube : 0;

// tạo ra tên input dành cho cờ upload youtube
if (!empty($uploadYoutube)) {

    $extract_youtube_name = $nameOri;
    $extract_youtube_name[count($nameOri) - 1] = 'upload_youtube';
    $upload_youtube_name = 'data[' . implode('][', $extract_youtube_name) . ']';

    if (!empty($multiple)) {

        $upload_youtube_name = $upload_youtube_name . '[]';
    }
}
?>

<!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
<?php if (!empty($label)): ?>
<label for="<?php echo $upload_id ?>" class="control-label">
    <?php echo $label ?>
</label>
<?php endif; ?>
<div id="<?php echo $upload_id ?>" class="fileupload-input">
    <div class="row fileupload-buttonbar">
        <div class="col-lg-12">
            <!-- The fileinput-button span is used to style the file input field as button -->
            <span class="btn btn-success fileinput-button">
                    <i class="glyphicon glyphicon-plus"></i>
                    <span>Add files...</span>
                    <input type="file" name="files[]" multiple>
                </span>
            <button type="submit" class="btn btn-primary start">
                <i class="glyphicon glyphicon-upload"></i>
                <span>Start upload</span>
            </button>
            <button type="reset" class="btn btn-warning cancel">
                <i class="glyphicon glyphicon-ban-circle"></i>
                <span>Cancel upload</span>
            </button>
            <button type="button" class="btn btn-danger delete">
                <i class="glyphicon glyphicon-trash"></i>
                <span>Delete</span>
            </button>
            <input type="checkbox" class="toggle">
            <!-- The global file processing state -->
            <span class="fileupload-process"></span>
        </div>
        <!-- The global progress state -->
        <div class="col-lg-5 fileupload-progress fade">
            <!-- The global progress bar -->
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                <div class="progress-bar progress-bar-success" style="width:0%;"></div>
            </div>
            <!-- The extended global progress state -->
            <div class="progress-extended">&nbsp;</div>
        </div>
    </div>
    <!-- The table listing the files available for upload/download -->
    <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
</div>
<!-- The blueimp Gallery widget -->
<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls" data-filter=":even">
    <div class="slides"></div>
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
</div>
<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td>
            <span class="preview"></span>
        </td>
        <td>
            <p class="name">{%=file.name%}</p>
            <strong class="error text-danger"></strong>
        </td>
        <td>
            <p class="size">Processing...</p>
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
        </td>
        <td>
            {% if (!i && !o.options.autoUpload) { %}
                <button class="btn btn-primary start" disabled>
                    <i class="glyphicon glyphicon-upload"></i>
                    <span>Start</span>
                </button>
            {% } %}
            {% if (!i) { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download fade">
        <td>
            <span class="preview">
                {% if (file.thumbnailUrl) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                {% } %}
            </span>
        </td>
        <td>
            <p class="name">
                {% if (file.url) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                {% } else { %}
                    <span>{%=file.name%}</span>
                {% } %}
            </p>
            {% if (file.error) { %}
                <div><span class="label label-danger">Error</span> {%=file.error%}</div>
            {% } %}
        </td>
        <td>
            <span class="size">{%=o.formatFileSize(file.size)%}</span>
        </td>
        <td>
            {% if (file.deleteUrl) { %}
                <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                    <i class="glyphicon glyphicon-trash"></i>
                    <span>Delete</span>
                </button>
                <input type="checkbox" name="delete" value="1" class="toggle">
            {% } else { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>

@section('js')
    <script type="text/javascript">
        $(function(){
            'use strict';

            // set the csrf-token for all AJAX requests
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // fileupload() related actions
            if ($().fileupload) {

                // Initialize the jQuery File Upload widget:
                $('#{{$upload_id}}').fileupload({
                    // Uncomment the following to send cross-domain cookies:
                    //xhrFields: {withCredentials: true},
                    url: '{{ route('medias.store') }}',
                    // Enable image resizing, except for Android and Opera,
                    // which actually support image resizing, but fail to
                    // send Blob objects via XHR requests:
                    disableImageResize: /Android(?!.*Chrome)|Opera/
                        .test(window.navigator.userAgent),
                    maxFileSize: 2000000,
                    acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i
                });

                // Enable iframe cross-domain access via redirect option:
                $('#{{$upload_id}}').fileupload(
                    'option',
                    'redirect',
                    window.location.href.replace(
                        /\/[^\/]*$/,
                        '/cors/result.html?%s'
                    )
                );

                // Load existing files:
                $('#{{ $upload_id }}').addClass('fileupload-processing');
                $.ajax({
                    // Uncomment the following to send cross-domain cookies:
                    //xhrFields: {withCredentials: true},
                    url: '{{ route('medias.store') }}',
                    dataType: 'json',
                    context: $('#{{ $upload_id }}')[0]
                }).always(function () {
                    $(this).removeClass('fileupload-processing');
                }).done(function (result) {
                    $(this).fileupload('option', 'done')
                        .call(this, $.Event('done'), {result: result});
                });
            }
        });


    </script>
@endsection
