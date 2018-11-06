@extends('layouts.base')
@section('title',$page_title)
@section('sub_header',$page_title)
@include('elements.file_manager_asset')
@section('content')
    <div class="m-content">
        <div class="row">
            <div class="col-lg-12">

                <!--begin::Portlet-->
                <div class="m-portlet m-portlet--last m-portlet--head-lg m-portlet--responsive-mobile"
                     id="main_portlet">
                    <div class="m-portlet__body">
                        <form class="m-form m-form--label-align-left- m-form--state-" id="m_form" method="post"
                              enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <!--begin: Form Body -->
                            <div class="m-portlet__body">
                                <div class="row">
                                    <div class="col-xl-8 offset-xl-2">
                                        <div class="m-form__section m-form__section--first">
                                            <div class="form-group m-form__group row">
                                                <div class="col-lg-12">
                                                    <label class="form-control-label">Ngôn ngữ:</label>
                                                    <select name="lang_code" class="form-control m-input">
                                                        @foreach(LANGUAGE as $k => $val)
                                                            <option value="{{ $k }}">{{$val}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <div class="col-lg-12">
                                                    <label class="form-control-label"><i class="text-danger">* </i>
                                                        CODE_SLIDER:</label>
                                                    <select name="code" id="code" class="form-control">
                                                        @foreach(CODE_SLIDER as $key => $val)
                                                            <option value="{{ $key }}">{{ $val }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <div class="col-lg-12">
                                                    <label class="form-control-label"><i
                                                            class="text-danger">* </i>Tên:</label>
                                                    <input type="text" name="name" class="form-control m-input"
                                                           placeholder=" Nhập tên">
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <div class="col-lg-12">
                                                    <label class="form-control-label"><i
                                                            class="text-danger">* </i>Url:</label>
                                                    <input type="text" name="url_alias"
                                                           class="form-control m-input" placeholder=" Nhập url"
                                                    >
                                                    <span
                                                        class="m-form__help">Tự động tạo ra url hoặc bạn có thể thay đổi nó.</span>
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <div class="col-lg-12">
                                                    <label class="form-control-label">Mô tả:</label>
                                                    <textarea class="form-control" name="description"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <div class="col-lg-6 m-form__group-sub">
                                                    <label class="form-control-label">Trạng thái:</label>
                                                    <select name="status" id="status" class="form-control">
                                                        @foreach(STATUS as $key => $val)
                                                            <option value="{{ $key }}">{{$val}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-6 m-form__group-sub">
                                                    <label class="form-control-label">Thứ tự:</label>
                                                    <input type="number" min="0" name="weight"
                                                           class="form-control m-input"
                                                           value="{{ isset($request_data) && !empty($request_data['weight']) ? $request_data['weight'] : '' }}"
                                                    >
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <div class="col-lg-12">
                                                    <label class="form-control-label">Chọn ảnh:</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <a href="{{asset('responsive_filemanager/filemanager/dialog.php?type=1&field_id=fieldID&relative_url=1&multiple=1')}}"
                                                               class="input-group-text iframe-btn" type="button">Chọn
                                                                files</a></div>
                                                        <input id="fieldID" type="text"
                                                               class="form-control form-inline m-input" value=""
                                                               disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="m-separator m-separator--dashed m-separator--lg"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__foot m-portlet__foot--fit">
                                <div class="m-form__actions m-form__actions">
                                    <button type="submit" class="btn btn-primary">Đăng</button>
                                    <button type="reset" class="btn btn-secondary">Hủy bỏ</button>
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
