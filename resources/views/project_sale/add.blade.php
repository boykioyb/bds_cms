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
                                                    {{ !empty($data->status) && $data->status == $k ? 'selectrd' : '' }} value="{{ $key }}">{{$val}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">Thứ tự:</label>
                                    <div class="col-lg-8">
                                        <input type="number" class="form-control" name="weight" min="0"
                                               value="{{ isset($data->weight) && !empty($data->weight) ? $data->weight : '' }}">
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
                                        <select class="form-control m-select2" id="district" multiple
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
                                    <label class="col-lg-2 col-form-label">Mô tả:</label>
                                    <div class="col-lg-8">
                                        <textarea id="SeoDesc" class="tinymce"
                                                  name="description">{{ isset($data->description) && !empty($data->description) ? $data->description : '' }}</textarea>
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
                                    <label class="col-lg-2 col-form-label">Số điện thoại:</label>
                                    <div class="col-lg-8">
                                        <div class="m-input-icon m-input-icon--right">
                                            <input type="text" class="form-control m-input" name="phone"
                                                   placeholder="Nhập số điện thoại"
                                                   value="{{ isset($data->phone) && !empty($data->phone) ? $data->phone : '' }}">
                                            <span class="m-input-icon__icon m-input-icon__icon--right"><span><i
                                                        class="la la-mobile-phone"></i></span></span>
                                        </div>
                                    </div>
                                </div>
                                @include('elements.Seo.form_seo',['data' => $data])
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
    <script src="{{ asset('assets/tagsinput/bootstrap-tagsinput.js') }}"></script>
    <script>
        $(document).ready(function () {
            $("#district").select2({
                placeholder: "Add a tag",
                tags: !0,
                allowClear: true,
                closeOnSelect: true,
            });
        });
    </script>
@endsection
