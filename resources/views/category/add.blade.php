@extends('layouts.base')
@section('title',$page_title)
@section('sub_header',$page_title)
@section('content')
    <div class="m-content">
        <div class="row">
            <div class="col-lg-12">

                <!--begin::Portlet-->
                <div class="m-portlet m-portlet--last m-portlet--head-lg m-portlet--responsive-mobile"
                     id="main_portlet">
                    <div class="m-portlet__body">
                        <form class="m-form m-form--label-align-left- m-form--state-" id="m_form_add_update"
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
                        <!--begin: Form Body -->
                            <div class="m-portlet__body">
                                <div class="row">
                                    <div class="col-xl-8 offset-xl-2">
                                        <div class="m-form__section m-form__section--first">
                                            <div class="form-group m-form__group row">
                                                <div class="col-lg-12 m-form__group-sub">
                                                    <label class="form-control-label">Ngôn ngữ:</label>
                                                    <select name="lang_code" class="form-control m-input">
                                                        @foreach(LANGUAGE as $k => $val)
                                                            <option
                                                                {{ !empty($data->lang_code) && $data->lang_code == $k ? 'selectrd' : '' }} value="{{ $k }}">{{$val}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group m-form__group row">
                                                <div class="col-lg-6 m-form__group-sub">
                                                    <label class="form-control-label"><i
                                                            class="text-danger">* </i>Tên:</label>
                                                    <input id="name_slug" type="text" name="name"
                                                           class="form-control m-input"
                                                           placeholder=" Nhập tên"
                                                           value="{{ isset($data->name) && !empty($data->name) ? $data->name : '' }}"
                                                    >
                                                </div>
                                                <div class="col-lg-6 m-form__group-sub">
                                                    <label class="form-control-label"><i
                                                            class="text-danger">* </i>Code:</label>
                                                    <input type="text" name="code" id="code_gen" readonly
                                                           class="form-control m-input" placeholder=" Nhập code"
                                                           value="{{ isset($data->code) && !empty($data->code) ? $data->code : '' }}"
                                                    >

                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <div class="col-lg-12">
                                                    <label class="form-control-label"><i
                                                            class="text-danger">* </i>Đường dẫn:</label>
                                                    <input type="text" name="url_alias" id="url_slug"
                                                           class="form-control m-input" placeholder=" Nhập đường dẫn"
                                                           value="{{ isset($data->url_alias) && !empty($data->url_alias) ? $data->url_alias : '' }}"
                                                    >
                                                    <span
                                                        class="m-form__help">Tự động tạo ra url hoặc bạn có thể thay đổi nó.</span>
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <div class="col-lg-12">
                                                    <label class="form-control-label">Mô tả:</label>
                                                    <textarea class="form-control"
                                                              name="description">{{ isset($data->description) && !empty($data->description) ? $data->description : '' }}</textarea>
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <div class="col-lg-6 m-form__group-sub">
                                                    <label class="form-control-label">Trạng thái:</label>
                                                    <select name="status" id="status" class="form-control">
                                                        @foreach(STATUS as $key => $val)
                                                            <option
                                                                {{ !empty($data->status) && $data->status == $key ? 'selected' : '' }} value="{{ $key }}">{{$val}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-6 m-form__group-sub">
                                                    <label class="form-control-label">Thứ tự:</label>
                                                    <input type="number" min="0" name="weight"
                                                           class="form-control m-input"
                                                           value="{{ isset($data->weight) && !empty($data->weight) ? $data->weight : '' }}"
                                                    >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__foot m-portlet__foot--fit">
                                <div class="col-xl-4 offset-xl-4">
                                    <div class="m-form__actions m-form__actions">
                                        <button type="submit" class="btn btn-primary"><i class="la la-check"></i> Đăng
                                        </button>
                                        <a href="{{ route('categories') }}" class="btn btn-secondary"><i
                                                class="la	la-close"></i>Hủy bỏ</a>
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
@endsection
@section('add-js')
    <script src="{{ asset('js/form-validate.js') }}"></script>
    <script src="{{ asset('assets/demo/default/custom/crud/forms/widgets/select2.js') }}">
        $(document).ready(function () {
            $("#district").select2({
                placeholder: "Add a tag",
                tags: !0
            });
        });

    </script>
@endsection
