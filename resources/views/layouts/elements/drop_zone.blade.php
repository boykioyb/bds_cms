@if (isset($lang) && !empty($lang))
    <input type="hidden" id="lang-{{ $lang }}" value="{{$lang}}">
    <label class="form-control-label">{{ !empty($label) ? $label : 'Files' }}:</label>
    <div class="m-dropzone dropzone dz-clickable" action="{{ route('uploadFile') }}"
         id="m-dropzone-one-{{ $lang }}">
        <div class="m-dropzone__msg dz-message needsclick">
            <h3 class="m-dropzone__msg-title">Drop files here or click to upload.</h3>
            <span class="m-dropzone__msg-desc">This is just a demo dropzone. Selected files are <strong>not</strong> actually uploaded.</span>
        </div>


        <div class="fallback">
            <input name="file" type="file" multiple/>
        </div>

        <div class="dropzone-previews" id="dropzonePreview-{{ $lang }}"></div>

    </div>

    <!-- Dropzone Preview Template -->
    <div id="preview-template-{{ $lang }}" style="display: none;">

        <div class="dz-preview dz-file-preview">
            <div class="dz-image"><img data-dz-thumbnail=""></div>

            <div class="dz-details">
                <div class="dz-size"><span data-dz-size=""></span></div>
                <div class="dz-filename"><span data-dz-name=""></span></div>
            </div>
            <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress=""></span></div>
            <div class="dz-error-message"><span data-dz-errormessage=""></span></div>

            <div class="dz-success-mark">
                <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg"
                     xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
                    <!-- Generator: Sketch 3.2.1 (9971) - http://www.bohemiancoding.com/sketch -->
                    <title>Check</title>
                    <desc>Created with Sketch.</desc>
                    <defs></defs>
                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
                        <path
                            d="M23.5,31.8431458 L17.5852419,25.9283877 C16.0248253,24.3679711 13.4910294,24.366835 11.9289322,25.9289322 C10.3700136,27.4878508 10.3665912,30.0234455 11.9283877,31.5852419 L20.4147581,40.0716123 C20.5133999,40.1702541 20.6159315,40.2626649 20.7218615,40.3488435 C22.2835669,41.8725651 24.794234,41.8626202 26.3461564,40.3106978 L43.3106978,23.3461564 C44.8771021,21.7797521 44.8758057,19.2483887 43.3137085,17.6862915 C41.7547899,16.1273729 39.2176035,16.1255422 37.6538436,17.6893022 L23.5,31.8431458 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z"
                            id="Oval-2" stroke-opacity="0.198794158" stroke="#747474" fill-opacity="0.816519475"
                            fill="#FFFFFF" sketch:type="MSShapeGroup"></path>
                    </g>
                </svg>
            </div>

            <div class="dz-error-mark">
                <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg"
                     xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
                    <!-- Generator: Sketch 3.2.1 (9971) - http://www.bohemiancoding.com/sketch -->
                    <title>error</title>
                    <desc>Created with Sketch.</desc>
                    <defs></defs>
                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
                        <g id="Check-+-Oval-2" sketch:type="MSLayerGroup" stroke="#747474" stroke-opacity="0.198794158"
                           fill="#FFFFFF" fill-opacity="0.816519475">
                            <path
                                d="M32.6568542,29 L38.3106978,23.3461564 C39.8771021,21.7797521 39.8758057,19.2483887 38.3137085,17.6862915 C36.7547899,16.1273729 34.2176035,16.1255422 32.6538436,17.6893022 L27,23.3431458 L21.3461564,17.6893022 C19.7823965,16.1255422 17.2452101,16.1273729 15.6862915,17.6862915 C14.1241943,19.2483887 14.1228979,21.7797521 15.6893022,23.3461564 L21.3431458,29 L15.6893022,34.6538436 C14.1228979,36.2202479 14.1241943,38.7516113 15.6862915,40.3137085 C17.2452101,41.8726271 19.7823965,41.8744578 21.3461564,40.3106978 L27,34.6568542 L32.6538436,40.3106978 C34.2176035,41.8744578 36.7547899,41.8726271 38.3137085,40.3137085 C39.8758057,38.7516113 39.8771021,36.2202479 38.3106978,34.6538436 L32.6568542,29 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z"
                                id="Oval-2" sketch:type="MSShapeGroup"></path>
                        </g>
                    </g>
                </svg>
            </div>

        </div>
    </div>
    <script>
        var photo_counter = 0;
        Dropzone.autoDiscover = false;
        mydropzone = new Dropzone('#m-dropzone-one-{{ $lang }}', {
            paramName: "file",
            maxFiles: '{{ isset($maxFile) && !empty($maxFile) ? $maxFile : 5 }}',
            headers: {
                'X-CSRF-TOKEN': '{!! csrf_token() !!}'
            },
            maxFilesize: '{{ isset($maxFileSize) && !empty($maxFileSize) ? $maxFileSize : 5 }}',
            previewsContainer: '#dropzonePreview-{{ $lang }}',
            previewTemplate: document.querySelector('#preview-template-{{ $lang }}').innerHTML,
            acceptedFiles: '{{ isset($acceptedFiles) && !empty($acceptedFiles) ? $acceptedFiles : 'image/*' }}',
            addRemoveLinks: !0,
            dictFileTooBig: 'Image is bigger than 5MB',
            removedfile: function (file) {
                // var name = file.name;
                // name = name.replace(/\s+/g, '-').toLowerCase();
                /*only spaces*/
                data = JSON.parse(file.xhr.response);
                $.ajax({
                    type: 'POST',
                    url: '{{ route('removeFile') }}',
                    data: {id: data['id'], _token: '{!! csrf_token() !!}'},
                    dataType: 'html',
                    success: function (data) {
                        var rep = JSON.parse(data);
                        if (rep.code === 200) {
                            file.previewElement.remove();
                            $('#' + data['id']).remove();
                            photo_counter--;
                            $("#photoCounter").text("(" + photo_counter + ")");
                        }

                    }
                });
            },
            sending: function (file, xhr, formData) {
                formData.append('lang_code', $("#lang-{{ $lang }}").val());
            },
            error: function (file, response) {
                if ($.type(response) === "string")
                    var message = response; //dropzone sends it's own error messages in string
                else
                    var message = response.message;
                file.previewElement.classList.add("dz-error");
                _ref = file.previewElement.querySelectorAll("[data-dz-errormessage]");
                _results = [];
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i];
                    _results.push(node.textContent = message);
                }
                return _results;
            },
            success: function (file, done) {
                data = JSON.parse(file.xhr.response);

                $("#m_accordion_{{ $lang }}").append($('<input type="hidden" ' +
                    'id="' + data.id + '"  name="data[{{ $lang  }}][files][' + data.id + ']" ' +
                    'value="' + data.filename + '">'));
                photo_counter++;
                $("#photoCounter").text("(" + photo_counter + ")");
            }
        });
        var mockFile = {name: "img_lights.jpg", size: 12345};
        mydropzone.options.thumbnail.call(mydropzone, mockFile, "https://www.w3schools.com/w3css/img_lights.jpg");
    </script>
@endif

