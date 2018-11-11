@extends('layouts.base')
@section('title',$page_title)
@section('sub_header',$page_title)
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendors/custom/datatables/datatables.bundle.css') }}">
@endsection
@section('content')
    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            {{$page_title}}
                        </h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav">
                        <li class="m-portlet__nav-item">
                            <a href="{{ route('investors.add') }}" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
												<span>
													<i class="la la-cart-plus"></i>
													<span>Thêm mới</span>
												</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="m-portlet__body">
                <!--begin: Search Form -->
                <form class="m-form m-form--fit m--margin-bottom-20">
                    <div class="row m--margin-bottom-20">
                        <div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
                            <label>Ngôn ngữ:</label>
                            <select name="lang_code" class="form-control m-input" id="type" data-col-index="3">
                                <option value="">--- Chọn ngôn ngữ ---</option>
                                @foreach(LANGUAGE as $k => $val)
                                    <option value="{{ $k }}">{{ $val }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
                            <label>Số điện thoại:</label>
                            <input type="text" class="form-control m-input" name="phone" data-col-index="1">
                        </div>
                        <div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
                            <label>Tên:</label>
                            <input type="text" class="form-control m-input" name="name" placeholder="nhập tên tìm kiếm"
                                   data-col-index="2">
                        </div>

                        <div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
                            <label>Trạng thái:</label>
                            <select name="status" class="form-control m-input" id="status" data-col-index="5">
                                <option value="">--- Trạng thái ---</option>
                                @foreach(STATUS as $k => $val)
                                    <option value="{{ $k }}">{{ $val }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <button class="btn btn-brand m-btn m-btn--icon" id="m_search">
												<span>
													<i class="la la-search"></i>
													<span>Tìm kiếm</span>
												</span>
                            </button>
                            &nbsp;&nbsp;
                            <button class="btn btn-secondary m-btn m-btn--icon" id="m_reset">
												<span>
													<i class="flaticon-refresh"></i>
													<span>Làm mới</span>
												</span>
                            </button>
                        </div>
                    </div>
                </form>
                <div class="m-separator m-separator--md m-separator--dashed"></div>
                <!--begin: Datatable -->
                <table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Số điện thoại</th>
                        <th>Tên Slider</th>
                        <th>Ngôn ngữ</th>
                        <th>Địa chỉ</th>
                        <th>Trạng thái</th>
                        <th>Thao tác</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>

        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
@endsection
@section('js')
    <script src="{{ asset('assets/vendors/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('components/Api/investor-api.js') }}"></script>
@endsection
