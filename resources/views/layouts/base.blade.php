<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<!-- begin::Head -->
<head>
    <meta charset="utf-8"/>
    <title>@yield('title','dashboard')</title>
    <meta name="description" content="Latest updates and statistic charts">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--begin::Web font -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
            google: {"families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]},
            active: function () {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!--end::Web font -->

    <!--begin::Global Theme Styles -->
    <link href="{{ asset('assets/vendors/base/vendors.bundle.css') }}" rel="stylesheet" type="text/css"/>

    <!--RTL version:<link href="assets/vendors/base/vendors.bundle.rtl.css" rel="stylesheet" type="text/css" />-->
    <link href="{{ asset('assets/demo/default/base/style.bundle.css') }}" rel="stylesheet" type="text/css"/>

    <!--RTL version:<link href="assets/demo/default/base/style.bundle.rtl.css" rel="stylesheet" type="text/css" />-->

    <!--end::Global Theme Styles -->

    <!--begin::Page Vendors Styles -->
    <link href="{{ asset('assets/vendors/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet"
          type="text/css"/>
    <link rel="stylesheet" href="{{ asset('css/rainbow.css') }}">
@yield('css')
@yield('css-yoast')
<!--RTL version:<link href="assets/vendors/custom/fullcalendar/fullcalendar.bundle.rtl.css" rel="stylesheet" type="text/css" />-->

    <!--end::Page Vendors Styles -->
    <link rel="shortcut icon" href="{{ asset('assets/demo/default/media/img/logo/favicon.ico') }}"/>

    <script src="{{ asset('assets/vendors/base/vendors.bundle.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/demo/default/base/scripts.bundle.js') }}" type="text/javascript"></script>

    <!--end::Global Theme Bundle -->

    <!--begin::Page Vendors -->
    <script src="{{ asset('assets/vendors/custom/fullcalendar/fullcalendar.bundle.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('tinymce/tinymce.min.js') }}"></script>
    <!--end::Page Vendors -->
    <!--begin::Page Scripts -->
    {{--<script src="{{ asset('assets/app/js/dashboard.js') }}" type="text/javascript"></script>--}}
    <script>
        var $ = jQuery.noConflict();

        @foreach (['danger', 'warning', 'success', 'info'] as $msg)

        @if(\Illuminate\Support\Facades\Session::has($msg))
        toastr.{{ $msg  }}('{{ \Illuminate\Support\Facades\Session::get($msg) }}');
        @endif
        @endforeach
    </script>
    @yield('script')
    @yield('add-js')
    <script src="{{ asset('js/global.js') }}"></script>
    @yield('js')
    @yield('js-file')
</head>

<!-- end::Head -->

<!-- begin::Body -->
<body
    class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">

<!-- begin:: Page -->
<div class="m-grid m-grid--hor m-grid--root m-page">
    <!-- BEGIN: Header -->
@include('layouts.header')
<!-- END: Header -->

    <!-- begin::Body -->
    <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">

        <!-- BEGIN: Left Aside -->
        <button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn"><i
                class="la la-close"></i></button>
    @include('layouts.sider_bar')
    <!-- END: Left Aside -->
        <div class="m-grid__item m-grid__item--fluid m-wrapper">

            <!-- BEGIN: Subheader -->
            <div class="m-subheader ">
                <div class="d-flex align-items-center">
                    <div class="mr-auto">
                        <h3 class="m-subheader__title ">@yield('sub_header','Dashboard')</h3>
                        <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                            <li class="m-nav__item m-nav__item--home">
                                <a href="#" class="m-nav__link m-nav__link--icon">
                                    <i class="m-nav__link-icon la la-home"></i>
                                </a>
                            </li>
                            @if (!empty($breadcrumb))

                                @foreach($breadcrumb as $item)

                                    <li class="m-nav__separator">-</li>
                                    <li class="m-nav__item">
                                        <a href="{{ $item['url'] }}" class="m-nav__link">
                                            <span class="m-nav__link-text">{{ $item['label'] }}</span>
                                        </a>
                                    </li>
                                @endforeach

                            @endif
                        </ul>
                    </div>
                    <div>
								<span class="m-subheader__daterange" id="m_dashboard_daterangepicker">
									<span class="m-subheader__daterange-label">
										<span class="m-subheader__daterange-title"></span>
										<span class="m-subheader__daterange-date m--font-brand"></span>
									</span>
									<a href="#"
                                       class="btn btn-sm btn-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill">
										<i class="la la-angle-down"></i>
									</a>
								</span>
                    </div>
                </div>
            </div>

            <!-- END: Subheader -->
            @yield('content')
        </div>
    </div>

    <!-- end:: Body -->
    <!-- begin::Footer -->
@include('layouts.footer')
<!-- end::Footer -->
</div>

<!-- end:: Page -->
<!-- begin::Quick Sidebar -->

<!-- end::Quick Sidebar -->

<!-- begin::Scroll Top -->
<div id="m_scroll_top" class="m-scroll-top">
    <i class="la la-arrow-up"></i>
</div>

<!-- end::Scroll Top -->

<!-- begin::Quick Nav -->


<!-- end::Quick Nav -->
<!--begin::Global Theme Bundle -->

<script>
    base_url = '{{ getenv('BASE_URL') }}';
</script>

<!--end::Page Scripts -->
</body>

<!-- end::Body -->
</html>
