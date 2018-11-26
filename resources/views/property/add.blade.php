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
                                                    {{ $data->status != '' && $data->status == $key ? 'selected' : '' }} value="{{ $key }}">{{$val}}</option>
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
                                                    {{ !empty($data->priority) && $data->priority == $key ? 'selected' : '' }} value="{{ $key }}">{{$val}}</option>
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
                                    <label class="col-lg-2 col-form-label">Danh mục:</label>
                                    <div class="col-lg-8">
                                        <select name="categories" id="categories" class="form-control">
                                            <option value="">--- Chọn danh mục ---</option>
                                            @foreach($categories as $key => $val)
                                                <option
                                                    {{ !empty($data->categories) && $data->categories == $val->_id ? 'selected' : '' }} value="{{ $val->_id }}">{{ $val->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">Dự án:</label>
                                    <div class="col-lg-8">
                                        <select name="project_sales" id="project_sales" class="form-control">
                                            <option value="">--- Chọn dự án ---</option>
                                            @foreach($project_sale as $key => $val)
                                                <option
                                                    {{ !empty($data->project_sales) && $data->project_sales == $val->_id ? 'selected' : '' }} value="{{ $val->_id }}">{{ $val->name }}</option>
                                            @endforeach
                                        </select>
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
                                    <label class="col-lg-2 col-form-label">Phòng ngủ:</label>
                                    <div class="col-lg-1">
                                        <select name="beds" id="" class="form-control">
                                            @foreach(NUMBERS as $k => $val)
                                                <option
                                                    {{ !empty($data->beds) && $data->beds == $k ? 'selected' : '' }} value="{{ $k }}">{{$val}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <label class="col-lg-1 col-form-label">Phòng tắm:</label>
                                    <div class="col-lg-1">
                                        <select name="baths" id="" class="form-control">
                                            @foreach(NUMBERS as $k => $val)
                                                <option
                                                    {{ !empty($data->baths) && $data->baths == $k ? 'selected' : '' }} value="{{ $k }}">{{$val}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <label class="col-lg-2 col-form-label">Gara ô tô:</label>
                                    <div class="col-lg-1">
                                        <select name="garages" id="" class="form-control">
                                            @foreach(NUMBERS as $k => $val)
                                                <option
                                                    {{ !empty($data->garages) && $data->garages == $k ? 'selected' : '' }} value="{{ $k }}">{{$val}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <label class="col-lg-1 col-form-label">Phòng bếp:</label>
                                    <div class="col-lg-1">
                                        <select name="kitchen" id="" class="form-control">
                                            @foreach(NUMBERS as $k => $val)
                                                <option
                                                    {{ !empty($data->kitchen) && $data->kitchen == $k ? 'selected' : '' }} value="{{ $k }}">{{$val}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">Ban công:</label>
                                    <div class="col-lg-1">
                                        <select name="balcony" id="" class="form-control">
                                            @foreach(NUMBERS as $k => $val)
                                                <option
                                                    {{ !empty($data->balcony) && $data->balcony == $k ? 'selected' : '' }} value="{{ $k }}">{{$val}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <label class="col-lg-1 col-form-label">Diện tích:</label>
                                    <div class="col-lg-2">
                                        <div class="m-input-icon m-input-icon--right">
                                            <input type="number" min="0" name="acreage" class="form-control"
                                                   value="{{ isset($data->acreage) && !empty($data->acreage) ? $data->acreage : '' }}"
                                            >
                                            <span
                                                class="m-input-icon__icon m-input-icon__icon--right"><span><i>m<sup>2</sup></i></span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">Giá:</label>
                                    <div class="col-lg-3">
                                        <div class="m-input-icon m-input-icon--right">
                                            <input type="text" class="form-control" name="price"
                                                   onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                                   onkeyup="this.value=FormatNumber(this.value);"
                                                   value="{{ isset($data->price) && !empty($data->price) ? number_format($data->price, 0, ',', ',') : '' }}"
                                            >
                                            <span
                                                class="m-input-icon__icon m-input-icon__icon--right"><span><i class="fa fa-money-bill-wave"></i></span></span>
                                        </div>
                                    </div>
                                    <label class="col-lg-2 col-form-label">Giá Sale:</label>
                                    <div class="col-lg-3">
                                        <div class="m-input-icon m-input-icon--right">
                                        <input type="text" class="form-control" name="price_sale"
                                               onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                               onkeyup="this.value=FormatNumber(this.value);"
                                               value="{{ isset($data->price_sale) && !empty($data->price_sale) ? number_format($data->price_sale, 0, ',', ',') : '' }}"
                                        >
                                            <span
                                                class="m-input-icon__icon m-input-icon__icon--right"><span><i class="fa fa-money-bill-wave"></i></span></span>
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">Ngày bắt đầu:</label>
                                    <div class="col-lg-3">
                                        <div class="input-group date">
                                            <input type="text" name="start_date" class="form-control m-input datepicker"
                                                   readonly=""
                                                   placeholder="Select date" id=""
                                                   value="{{ isset($data->start_date) && !empty($data->start_date) ? \AppClass::formatDate($data->start_date) : '' }}"
                                            >
                                            <div class="input-group-append">
													<span class="input-group-text">
														<i class="la la-calendar-check-o"></i>
													</span>
                                            </div>
                                        </div>
                                    </div>
                                    <label class="col-lg-2 col-form-label">Ngày kết thúc:</label>
                                    <div class="col-lg-3">
                                        <div class="input-group date">
                                            <input type="text" name="end_date" class="form-control m-input datepicker"
                                                   readonly=""
                                                   placeholder="Select date" id=""
                                                   {{--value="{{ isset($data->end_date) && !empty($data->end_date) ? \AppClass::formatDate($data->end_date)  : '' }}"--}}
                                            >
                                            <div class="input-group-append">
													<span class="input-group-text">
														<i class="la la-calendar-check-o"></i>
													</span>
                                            </div>
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

@endsection
