<style>
    .m-dropzone {
        border: 2px dashed #ebedf2;
        width: 100%;
    }
</style>
<div class="m-accordion m-accordion--default m-accordion--toggle-arrow check-lang" id="m_accordion_{{ $lang }}"
     role="tablist" data-lang='{{ $lang }}'>

    <!--begin::Item-->
    <div class="m-accordion__item m-accordion__item--brand">
        <div class="m-accordion__item-head collapsed" role="tab" id="m_accordion_{{ $lang }}_item_2_head"
             data-toggle="collapse"
             href="#m_accordion_{{ $lang }}_item_2_body" aria-expanded="false">
            <span class="m-accordion__item-title">{{ LANGUAGE[$lang] }}
                <span class="pull-right">
                <button class="btn btn-danger" onclick="removeLang('{{ $lang }}')" type="button"><i
                        class="fa fa-trash"></i></button>
            </span>
            </span>
        </div>
        <div class="m-accordion__item-body collapse" id="m_accordion_{{ $lang }}_item_2_body" role="tabpanel"
             aria-labelledby="m_accordion_{{ $lang }}_item_2_head" data-parent="#m_accordion_{{ $lang }}" style="">
            <div class="m-accordion__item-content">
                <div class="form-group m-form__group row">
                    <label class="form-control-label">* Tên:</label>
                    <input type="text" name="[{{ $lang }}][name]"
                           class="form-control m-input" placeholder=" Nhập tên"
                           value="">
                </div>
                <div class="form-group m-form__group row">
                    <label class="form-control-label">* Url:</label>
                    <input type="text" name="[{{ $lang }}][url_alias]"
                           class="form-control m-input" placeholder=" Nhập url"
                           value="">
                    <span
                        class="m-form__help">Tự động tạo ra url hoặc bạn có thể thay đổi nó.</span>

                </div>
                <div class="form-group m-form__group row">
                    <label class="form-control-label">Mô tả:</label>

                    <textarea class="form-control" name="[{{ $lang }}][description]"></textarea>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-6 m-form__group-sub">
                        <label class="form-control-label">Trạng thái:</label>
                        <select name="[{{ $lang }}][status]" id="status" class="form-control">
                            @foreach(STATUS as $key => $val)
                                <option value="{{ $key }}">{{$val}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-6 m-form__group-sub">
                        <label class="form-control-label">Thứ tự:</label>
                        <input type="number" min="0" name="[{{$lang}}][weight]"
                               class="form-control m-input">
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <input type="hidden" id="lang-{{ $lang }}" value="{{$lang}}">
                    <label class="form-control-label">Thứ tự:</label>
                    <div class="m-dropzone dropzone dz-clickable" action="{{ route('uploadFile') }}"
                         id="m-dropzone-one-{{ $lang }}">
                        <div class="m-dropzone__msg dz-message needsclick">
                            <h3 class="m-dropzone__msg-title">Drop files here or click to upload.</h3>
                            <span class="m-dropzone__msg-desc">This is just a demo dropzone. Selected files are <strong>not</strong> actually uploaded.</span>
                        </div>
                        <div class="fallback">
                            <input name="file" type="file" multiple/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Item-->
</div>
<script>
    function removeLang(lang_code) {
        $('#m_accordion_' + lang_code).remove();
    }

</script>
{{--<script src="{{ asset('assets/demo/default/custom/crud/forms/widgets/dropzone.js') }}"></script>--}}
<script>

    mydropzone = new Dropzone('#m-dropzone-one-{{ $lang }}', {
        paramName: "file",
        maxFiles: 5,
        headers: {
            'X-CSRF-TOKEN': '{!! csrf_token() !!}'
        },
        maxFilesize: 5,
        acceptedFiles: 'image/*',
        addRemoveLinks: !0,
        dictFileTooBig: 'Image is bigger than 5MB',
        removedfile: function(file) {
            var name = file.name;
            name =name.replace(/\s+/g, '-').toLowerCase();    /*only spaces*/
            $.ajax({
                type: 'POST',
                url: '{{ url('admincp/deleteImg') }}',
                headers: {
                    'X-CSRF-TOKEN': '{!! csrf_token() !!}'
                },
                data: "id="+name,
                dataType: 'html',
                success: function(data) {
                    $("#msg").html(data);
                }
            });
            var _ref;
            if (file.previewElement) {
                if ((_ref = file.previewElement) != null) {
                    _ref.parentNode.removeChild(file.previewElement);
                }
            }
            return this._updateMaxFilesReachedClass();
        },
        sending:function(file, xhr, formData){
            formData.append('lang_code',$("#lang-{{ $lang }}").val() );

        },
    });
</script>
{{--<script src="{{ asset('assets/demo/default/custom/crud/forms/widgets/summernote.js') }}"></script>--}}

