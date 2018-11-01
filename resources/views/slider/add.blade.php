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
                    <div class="m-portlet__head" style="">
                        <div class="m-portlet__head-progress">

                            <!-- here can place a progress bar-->
                        </div>
                        <div class="m-portlet__head-wrapper">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">
                                        {{ $page_title }}
                                    </h3>
                                </div>
                            </div>
                            <div class="m-portlet__head-tools">
                                <a href="#"
                                   class="btn btn-secondary m-btn m-btn--icon m-btn--wide m-btn--md m--margin-right-10">
													<span>
														<i class="la la-arrow-left"></i>
														<span>Back</span>
													</span>
                                </a>
                                <div class="btn-group">
                                    <button type="button"
                                            class="btn btn-accent  m-btn m-btn--icon m-btn--wide m-btn--md">
														<span>
															<i class="la la-check"></i>
															<span>Save</span>
														</span>
                                    </button>
                                    <button type="button"
                                            class="btn btn-accent  dropdown-toggle dropdown-toggle-split m-btn m-btn--md"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#"><i class="la la-plus"></i> Save &amp; New</a>
                                        <a class="dropdown-item" href="#"><i class="la la-copy"></i> Save &amp;
                                            Duplicate</a>
                                        <a class="dropdown-item" href="#"><i class="la la-undo"></i> Save &amp;
                                            Close</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#"><i class="la la-close"></i> Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <form class="m-form m-form--label-align-left- m-form--state-" id="m_form" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                            <!--begin: Form Body -->
                            <div class="m-portlet__body">
                                <div class="row">
                                    <div class="col-xl-8 offset-xl-2">


                                        <div class="m-form__section m-form__section--first">
                                            <div class="form-group m-form__group row">
                                                <div class="col-lg-12">
                                                    <label class="form-control-label">* Language:</label>

                                                    <div class="input-group m-input-group m-input-group--air">

                                                        <select id="selectLang" class="form-control">
                                                            @foreach(LANGUAGE as $k => $val)
                                                                <option value="{{ $k }}">{{$val}}</option>
                                                            @endforeach
                                                        </select>
                                                        <div class="input-group-prepend">
                                                            <button class="btn btn-success" id="addLang" type="button">
                                                                +
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="wrap-lang" style="margin-top: 20px">
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="m-separator m-separator--dashed m-separator--sm"></div>
                                            <div class="form-group m-form__group row">
                                                <div class="col-lg-12">
                                                    <label class="form-control-label">* CODE_SLIDER:</label>
                                                    <select name="code" id="code" class="form-control">
                                                        @foreach(CODE_SLIDER as $key => $val)
                                                            <option value="{{ $key }}">{{ $val }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="m-separator m-separator--dashed m-separator--lg"></div>
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
@section('script')
    @include('layouts.elements.newLang')
@endsection
