@extends('layouts.base')
@section('title',$page_title)
@section('sub_header',$page_title)
@section('content')
    <style>
        .m-portlet .m-portlet__body {
            padding: 0 !important;
        }
    </style>
    <div class="m-content">
        <div class="row">
            <div class="col-lg-12">

                <!--begin::Portlet-->
                <div class="m-portlet m-portlet--last m-portlet--head-lg m-portlet--responsive-mobile"
                     id="main_portlet">
                    <div class="m-portlet__body">
                        <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed"
                              id="m_form_add_update"
                              method="post"
                              enctype="multipart/form-data">
                            <div class="m-form__content">
                                <div class="m-alert m-alert--icon alert alert-danger m--hide" role="alert"
                                     id="m_form_1_msg">
                                    <div class="m-alert__icon">
                                        <i class="la la-warning"></i>
                                    </div>
                                    <div class="m-alert__text">
                                        Oh snap! Change a few things up and try submitting again.
                                    </div>
                                    <div class="m-alert__close">
                                        <button type="button" class="close" data-close="alert" aria-label="Close">
                                        </button>
                                    </div>
                                </div>
                            </div>
                            {{ csrf_field() }}
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">Ngôn ngữ:</label>
                                    <div class="col-lg-8">
                                        <select id="locale" name="lang_code" class="form-control m-input">
                                            @foreach(LANGUAGE as $k => $val)
                                                <option
                                                    {{ !empty($data->lang_code) && $data->lang_code == $k ? 'selectrd' : '' }} value="{{ $k }}">{{$val}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">Trạng thái:</label>
                                    <div class="col-lg-8">
                                        <select name="status" id="status" class="form-control">
                                            @foreach(STATUS as $key => $val)
                                                <option
                                                    {{ !empty($data->status) && $data->status == $k ? 'selected' : '' }} value="{{ $key }}">{{$val}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">Chế độ ưu tiên:</label>
                                    <div class="col-lg-3">
                                        <select name="priority" id="priority" class="form-control">
                                            @foreach(PRIORITY as $key => $val)
                                                <option
                                                    {{ !empty($data->priority) && $data->priority == $k ? 'selected' : '' }} value="{{ $key }}">{{$val}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <label class="col-lg-2 col-form-label">Thứ tự:</label>
                                    <div class="col-lg-3">
                                        <input type="number" class="form-control" name="weight" min="0"
                                               value="{{ isset($data->weight) && !empty($data->weight) ? $data->weight : '' }}">
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">Nhà đầu tư:</label>
                                    <div class="col-lg-8">
                                        <select name="investor" id="investors" class="form-control">
                                            <option value="">--- Chọn nhà đầu tư ---</option>
                                            @foreach($investors as $key => $val)
                                                <option
                                                    {{ !empty($data->investor) && $data->investor == $val->_id ? 'selected' : '' }} value="{{ $val->_id }}">{{ $val->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">Tỉnh/Thành Phố:</label>
                                    <div class="col-lg-3">
                                        <select name="city" id="city" class="form-control">
                                            <option value="">--- Chọn Tỉnh/Thành phố ---</option>
                                            @foreach($city as $key => $val)
                                                <option
                                                    {{ !empty($data->city) && $data->city == $val->name ? 'selected' : '' }} value="{{ $val->name }}">{{ $val->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <label class="col-lg-2 col-form-label">Quận/Huyện:</label>
                                    <div class="col-lg-3">
                                        <select name="district" id="district" class="form-control">
                                            <option value="">--- Chọn Quận/Huyện ---</option>
                                            @if(isset($data) && !empty($data))
                                                @foreach($district as $val)
                                                    <option
                                                        {{ !empty($data->district) && $data->district == $val ? 'selected' : '' }} value="{{ $val }}">{{ $val }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>

                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">Địa chỉ:</label>
                                    <div class="col-lg-8">
                                        <div class="m-input-icon m-input-icon--right">
                                            <input type="text" name="address" class="form-control m-input"
                                                   placeholder="Enter your address"
                                                   value="{{ isset($data->address) && !empty($data->address) ? $data->address : '' }}">
                                            <span class="m-input-icon__icon m-input-icon__icon--right"><span><i
                                                        class="la la-map-marker"></i></span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">Kinh độ:</label>
                                    <div class="col-lg-3">
                                        <input type="text" class="form-control" name="loc[]" placeholder="nhập kịnh độ"
                                               value="{{ isset($data->loc) && !empty($data->loc) ? $data->loc[0] : '' }}"
                                        >
                                    </div>
                                    <label class="col-lg-2 col-form-label">Vĩ độ:</label>
                                    <div class="col-lg-3">
                                        <input type="text" class="form-control" name="loc[]" placeholder="nhập vĩ độ"
                                               value="{{ isset($data->loc) && !empty($data->loc) ? $data->loc[1] : '' }}"
                                        >
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label"><i class="text-danger"></i> Tên:</label>
                                    <div class="col-lg-8">
                                        <input id="name_slug" type="text" name="name"
                                               class="form-control m-input"
                                               placeholder=" Nhập tên"
                                               value="{{ isset($data->name) && !empty($data->name) ? $data->name : '' }}"
                                        >
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label"><i class="text-danger"></i> Đường
                                        dẫn:</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="url_alias" id="url_slug"
                                               class="form-control m-input" placeholder=" Nhập đường dẫn"
                                               value="{{ isset($data->url_alias) && !empty($data->url_alias) ? $data->url_alias : '' }}"
                                        >
                                        <span
                                            class="m-form__help">Tự động tạo ra url hoặc bạn có thể thay đổi nó.</span>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">Thẻ(Tags):</label>
                                    <div class="col-lg-8">
                                        <select class="form-control tags-input" multiple
                                                name="tags[]">
                                            <option></option>
                                            @if(isset($data->tags) && !empty($data->tags))
                                                @foreach($data->tags as $key=> $val)
                                                    <option selected value="{{ $val }}">{{ $val }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">Mô tả ngắn:</label>
                                    <div class="col-lg-8">
                                        <textarea rows="5" class="form-control" placeholder="nhập mô tả ngắn"
                                                  name="short_description">{{ isset($data->short_description) && !empty($data->short_description) ? $data->short_description : '' }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">Mô tả:</label>
                                    <div class="col-lg-8">
                                        <textarea id="SeoDesc" class="tinymce" placeholder="nhập mô tả"
                                                  name="description">{{ isset($data->description) && !empty($data->description) ? $data->description : '' }}</textarea>
                                    </div>
                                </div>

                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">Loại hình phát triển:</label>
                                    <div class="col-lg-3">
                                        <input type="text" class="form-control" name="type"
                                               placeholder="nhập loại hình phát triển"
                                                value="{{ isset($data->type) && !empty($data->type) ? $data->type : '' }}"
                                        >
                                    </div>
                                    <label class="col-lg-2 col-form-label">Quy mô dự án:</label>
                                    <div class="col-lg-3">
                                        <input type="text" class="form-control" name="scale"
                                               placeholder="nhập quy mô dự án"
                                               value="{{ isset($data->scale) && !empty($data->scale) ? $data->scale : '' }}"
                                        >
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">Phân khúc chức năng:</label>
                                    <div class="col-lg-3">
                                        <input type="text" class="form-control" name="functional"
                                               placeholder="nhập phân khúc chức năng"
                                               value="{{ isset($data->functional) && !empty($data->functional) ? $data->functional : '' }}"
                                        >
                                    </div>
                                    <label class="col-lg-2 col-form-label">Tư vấn thiết kế:</label>
                                    <div class="col-lg-3">
                                        <input type="text" class="form-control" name="design_consultancy"
                                               placeholder="nhập tư vấn thiết kế"
                                               value="{{ isset($data->design_consultancy) && !empty($data->design_consultancy) ? $data->design_consultancy : '' }}"
                                        >
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">Tư vấn quản lý và giám sát dự án:</label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" name="pm_mc"
                                               placeholder="nhập tư vấn quản lý và giám sát dự án"
                                               value="{{ isset($data->pm_mc) && !empty($data->pm_mc) ? $data->pm_mc : '' }}"
                                        >
                                    </div>
                                </div>

                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">Diện tích đất nghiên cứu:</label>
                                    <div class="col-lg-3">
                                        <div class="m-input-icon m-input-icon--right">
                                            <input id="land_area_of_study" type="number" min="0"
                                                   class="form-control m-input" name="land_area_of_study"
                                                   value="{{ isset($data->land_area_of_study) && !empty($data->land_area_of_study) ? $data->land_area_of_study : '' }}">
                                            <span
                                                class="m-input-icon__icon m-input-icon__icon--right"><span><i>m<sup>2</sup></i></span></span>
                                        </div>

                                    </div>
                                    <label class="col-lg-2 col-form-label">Khu vực:</label>
                                    <div class="col-lg-3">
                                        <select id="area" class="form-control" name="area">
                                            @foreach(AREA as $key => $val)
                                                <option
                                                    {{ !empty($data->area) && $data->area == $key ? 'selected' : '' }} value="{{ $key }}">{{$val}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">

                                    <label class="col-lg-2 col-form-label">Diện tích đất xây dựng:</label>
                                    <div class="col-lg-3">
                                        <div class="m-input-icon m-input-icon--right">
                                            <input id="construction_land_area" type="number" min="0"
                                                   class="form-control m-input" name="construction_land_area"
                                                   value="{{ isset($data->construction_land_area) && !empty($data->construction_land_area) ? $data->construction_land_area : '' }}">
                                            <span
                                                class="m-input-icon__icon m-input-icon__icon--right"><span><i>m<sup>2</sup></i></span></span>
                                        </div>
                                    </div>
                                    <label class="col-lg-2 col-form-label">Mật độ:</label>
                                    <div class="col-lg-3">
                                        <div class="m-input-icon m-input-icon--right">
                                            <input id="construction_density" type="number" min="0" max="99"
                                                   class="form-control m-input" name="construction_density"
                                                   value="{{ isset($data->construction_density) && !empty($data->construction_density) ? $data->construction_density : '' }}">
                                            <span
                                                class="m-input-icon__icon m-input-icon__icon--right"><span><i>%</i></span></span>
                                        </div>

                                    </div>
                                </div>
                                @include('elements.file_manager',[
                                                  'id' => 'image-id',
                                                  'files' => !empty($data->files) ? $data->files : null,
                                                  'name' => 'files',
                                                  'label' => 'Chọn ảnh',
                                                  'option' => array(
                                                      'type' => 1,
                                                      'relative_url' => 1,
                                                      'multiple' => 1
                                                  )
                                              ])
                                @include('elements.Seo.form_seo',['data' => !empty($data) ? $data : null])
                            </div>
                            <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                                <div class="m-form__actions m-form__actions--solid">
                                    <div class="row">
                                        <div class="col-lg-2"></div>
                                        <div class="col-lg-10">
                                            <button type="submit" class="btn btn-primary"><i class="la la-check"></i>
                                                Đăng
                                            </button>
                                            <a href="{{ route('sliders') }}" class="btn btn-secondary"><i
                                                    class="la	la-close"></i>Hủy bỏ</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!--end::Portlet-->
            </div>
        </div>
    </div>
    @include('elements.Seo.yoastseo')
@endsection
@section('add-js')
    <script src="{{ asset('js/form-validate.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#city').on('change', function () {
                let val = $(this).val();
                $('select#district').html('<option></option>');
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{ route('project-sales.getDistrict') }}',
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        name: val
                    },
                    success: function (data) {
                        $.map(data, function (value, index) {
                            let option = '<option value="' + value + '">' + value + '</option>';
                            $('select#district').append(option);
                        })
                    }
                });
            });


        });

        // function suburban() {
        //
        // }
    </script>
@endsection
