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
                    <input type="text" name="data[{{ $lang }}][name]"
                           class="form-control m-input" placeholder=" Nhập tên"
                           value="{{ isset($request_data) && !empty($request_data['name']) ? $request_data['name'] : '' }}">
                </div>
                <div class="form-group m-form__group row">
                    <label class="form-control-label">* Url:</label>
                    <input type="text" name="data[{{ $lang }}][url_alias]"
                           class="form-control m-input" placeholder=" Nhập url"
                           value="{{ isset($request_data) && !empty($request_data['url_alias']) ? $request_data['url_alias'] : '' }}">
                    <span
                        class="m-form__help">Tự động tạo ra url hoặc bạn có thể thay đổi nó.</span>

                </div>
                <div class="form-group m-form__group row">
                    <label class="form-control-label">Mô tả:</label>

                    <textarea class="form-control"
                              name="data[{{ $lang }}][description]">{{ isset($request_data) && !empty($request_data['description']) ? $request_data['description'] : '' }}</textarea>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-6 m-form__group-sub">
                        <label class="form-control-label">Trạng thái:</label>
                        <select name="data[{{ $lang }}][status]" id="status" class="form-control">
                            @foreach(STATUS as $key => $val)
                                <option
                                    {{ isset($request_data) && !empty($request_data['status']) && $request_data['status'] == $key  ? 'selected' : '' }} value="{{ $key }}">{{$val}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-6 m-form__group-sub">
                        <label class="form-control-label">Thứ tự:</label>
                        <input type="number" min="0" name="data[{{$lang}}][weight]"
                               class="form-control m-input"
                               value="{{ isset($request_data) && !empty($request_data['weight']) ? $request_data['weight'] : '' }}"
                        >
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    @include('layouts.elements.drop_zone',['lang' => $lang, 'files' => isset($request_data) && !empty($request_data['files']) ? $request_data['files'] : ''])
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

{{--<script src="{{ asset('assets/demo/default/custom/crud/forms/widgets/summernote.js') }}"></script>--}}

