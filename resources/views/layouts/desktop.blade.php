<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="rtl">
<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-132456884-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-132456884-1');
    </script>
    <title>@yield('title') | رمزینکس</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0">
    <meta name="description" content="سامانه تبادل ارزهای دیجیتال"/>
    <meta name="Ramzinex" content="Ramzinex"/>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('js/app.js')}}"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('fonts/flaticon/flaticon.css')}}" rel="stylesheet">
    <link href="{{asset('fonts/font-awesome/css/all.min.css')}}" rel="stylesheet"/>
    <link href="{{ asset('global/css/icons/line-icons/line-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('global/css/icons/line-icons/simple-line-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('global/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('global/plugins/bootstrap/css/bootstrap-rtl.min.css') }}" rel="stylesheet">
    <link href="{{ asset('global/plugins/mcustom-scrollbar/mcustom_scrollbar.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/public.css') }}" rel="stylesheet">
    @yield('css')
    <link href="{{ asset('css/ramzinex-public.css') }}?ver={{time()}}" rel="stylesheet">
</head>

<!-- BEGIN BODY -->
<body class="rtl sidebar-condensed fixed-topbar fixed-sidebar theme-sdtl color-ramzinex dashboard">
<div id="app-theme" class="ramzinex-Dark">
    <input type="text" id="copyTemp"/>
    <div id="app">
        <section>
            <!-- BEGIN SIDEBAR -->
            <div class="sidebar">
                <div class="logopanel text-center">
                    <h1>
                        <a href="{{ url('/') }}">رمزینکس</a>
                    </h1>
                </div>
                <ul class="sidebar-inner">
                @yield('sidebar')
                <!-- SIDEBAR WIDGET FOLDERS -->
                    @if(isset(\Illuminate\Support\Facades\Auth::user()->id))
                        <div class="sidebar-footer clearfix">
                            <a class="pull-left footer-settings poppy" popper="تنظیمات" href="#">
                                <i class="fas fa-cog"></i></a>
                            <a id="toggle_fullScreen" class="pull-left toggle_fullscreen poppy"
                               popper="تمام صفحه" href="#">
                                <i class="fas fa-expand"></i></a>
                            <a class="pull-left poppy poppy-click"
                               popper="تغییر پوسته" popper-box="#pop_themeBox" id="toggle-theme" href="#">
                                <i class="fas fa-palette"></i></a>
                            <a class="pull-left btn-effect poppy" popper="خروج" href="#"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-power-off"></i></a>
                        </div>
                    @else
                        <div class="sidebar-footer clearfix">
                            <a class="pull-left footer-settings poppy" popper="تنظیمات"
                               href="#">
                                <i class="fas fa-cog"></i></a>
                            <a id="toggle_fullScreen" class="pull-left toggle_fullscreen poppy"
                               popper="تمام صفحه" href="#">
                                <i class="fas fa-expand"></i></a>
                            <a class="pull-left poppy poppy-click"
                               popper="تغییر پوسته" popper-box="#pop_themeBox" id="toggle-theme" href="#">
                                <i class="fas fa-palette"></i></a>
                            <a class="pull-left btn-effect poppy" popper="خروج" href="{{url('/')}}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-power-off"></i></a>
                        </div>
                    @endif
                </ul>
            </div>
            <!-- END SIDEBAR -->

            <div class="main-content">
                <div class="bgWatermark noselect">
                    <div class="rmzWatermark text-center">
                        <div class="wmIcon text-center"><i class="#"></i></div>
                        <div class="wmText shabnamFD text-center">

                        </div>
                    </div>
                </div>
                <!-- BEGIN TOPBAR -->
                <div class="topbar">
                    <div class="header-left">
                        <div class="topnav">
                            <div class="hamburger hamburger--arrow js-hamburger"
                                 data-toggle="sidebar-collapsed">
                                <div class="hamburger-box">
                                    <div class="hamburger-inner"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- header-right -->
                </div>
                <!-- END TOPBAR -->
                <!-- BEGIN PAGE CONTENT -->
                <div class="page-content page-thin" style="padding-top: 64px !important;">
                    <div class="wholeWrapper" style="position: relative;">
                        @yield('desktop')
                        <div class="bgFooter noselect">
                            <div class="row">
                                <div class="col-xlg-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p class="text-right copyright">
                                                <span>کلیه حقوق برای رمزینکس محفوظ است. </span>
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="text-left footer-links">
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END PAGE CONTENT -->
            </div>
            <!-- END MAIN CONTENT -->
        </section>

        {{--BEGIN MODALS--}}
        <div class="modal left fade" id="modal-slideleft" tabindex="-1" role="dialog" aria-hidden="true">
            <input type="text" id="copyarea"/>
            <div class="modal-dialog">
                <div class="modal-header cursor-pointer rmz-flex-h rmz-center" data-dismiss="modal"
                     aria-hidden="true">
                    <div style="color: #a7a7a7;"><i class="fas fa-times"></i></div>
                </div>
                <div class="modal-content">
                    <div class="modal-body modalContent">

                    </div>
                </div>
            </div>
        </div>
        <div class="modal right fade" id="modal-slideright" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-header cursor-pointer rmz-flex-h rmz-center" data-dismiss="modal"
                     aria-hidden="true">
                    <div style="color: #a7a7a7;"><i class="fas fa-times"></i></div>
                </div>
                <div class="modal-content">
                    <div class="modal-body modalContent">

                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade modal-bottomfull" id="modal-bottomfull" tabindex="-1" role="dialog"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header cursor-pointer rmz-flex-h rmz-center" data-dismiss="modal"
                         aria-hidden="true">
                        <div style="color: #a7a7a7;"><i class="fas fa-times"></i></div>
                    </div>
                    <div class="modal-body modalContent">

                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade modal-topfull" id="modal-topfull" tabindex="-1" role="dialog"
             aria-hidden="true">
            <div class="modal-dialog modal-topfull">
                <div class="modal-content">
                    <div class="modal-header cursor-pointer rmz-flex-h rmz-center" data-dismiss="modal"
                         aria-hidden="true">
                        <div style="color: #a7a7a7;"><i class="fas fa-times"></i></div>
                    </div>
                    <div class="modal-body modalContent">

                    </div>
                </div>
            </div>
        </div>
        {{--END MODALS--}}

    <!-- BEGIN PRELOADER -->
        <div class="loader-overlay">
            <div class="spinner">
                <div class="bounce1"></div>
                <div class="bounce2"></div>
                <div class="bounce3"></div>
            </div>
        </div>
        <!-- END PRELOADER -->
        <a href="#" class="scrollup"><i class="fas fa-angle-up"></i></a>
        <div id="poppy" class="popper" style="display: none; z-index: 999999;"></div>
        @php($themes = ['Light' => 'روز', 'Evening' => 'غروب', 'Dark' => 'شب'])
        <div id="pop_themeBox" class="popper-box" style="display: none; z-index: 999999;">
            @auth
                @php($this_theme = ucfirst(\Illuminate\Support\Facades\Auth::user()->theme))
            @else
                @php($this_theme = 'Dark')
            @endauth
            @foreach($themes as $key=>$value)
                <div class="pa-0-8">
                    <label class="ma-0">
                        @if($key == $this_theme)
                            <div class="checkIcon" style="width: 16px; float: right;">
                                <i class="fas fa-check text-success"></i>
                            </div>
                            <input type="radio" name="theme" value="{{$key}}" class="hidden" checked> {{$value}}
                        @else
                            <div class="checkIcon" style="width: 16px; float: right;">
                                <i class="fas fa-circle"></i>
                            </div>
                            <input type="radio" name="theme" value="{{$key}}" class="hidden"> {{$value}}
                        @endif
                    </label>
                </div>
            @endforeach
        </div>
    </div>
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/jquery-migrate-3.0.0.min.js') }}"></script>
    <script src="{{ asset('global/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    @yield('js')
    <script src="{{ asset('js/scriptx.js') }}"></script>
    <script src="{{ asset('js/ramzinex.js') }}?ver={{time()}}"></script>
    <script>
        $(document).ready(function () {

            function bgFooter() {
                var docH = $(document).height();
                $(document).find(".wholeWrapper").css({minHeight: docH});
            }

            bgFooter();

            $(document).on('click', '.animatex', function () {
                $.when($(this).addClass('animated')).done(function () {
                    var timeout = setTimeout(function () {

                        $(document).find(".animatex").removeClass('animated');

                    }, 1000, function () {
                        clearTimeout(timeout);
                    });
                });
            });

            $('#modal-slideright,#modal-slideleft,#modal-bottomfull,#modal-topfull').on('hidden.bs.modal', function () {
                $(this).find('.modalContent').html('');
                $(document).find('body').css({padding: "0px"});
            });

            //COMMON WITH MOBILE LAYOUT
            $(document).on('click', '.order-details', function () {
                var dis = $(this);
                var orderId = dis.attr('order-id');
                var url = orderId;
                var targetModal = dis.attr('data-target');
                $.get(url, function (data) {
                    if (data.success == '200') {
                        $(targetModal + ' .modalContent').html(data.message);
                    } else if (data.success == '404') {
                        iziToast.info({
                            id: 'info',
                            message: data.message,
                            position: 'center',
                            transitionIn: 'bounceInRight',
                            timeout: 3000,
                        });
                    }
                });
            });

            $(document).on('mouseenter', '.poppy', function () {
                $(document).find('.popper-box').fadeOut(300);
                var reference = $(this);
                var text = $(this).attr('popper');
                var poppy = $(document).find('#poppy');
                poppy.text(text).show();
                var popperInstance = new Popper(reference, poppy, {
                    placement: 'top'
                });
            });
            $(document).on('mouseleave click', '.poppy', function () {
                $(document).find('.popper').hide();
            });

            $(document).on('mouseenter', '.poppy-custom', function () {
                var reference = $(this);
                var popper = $($(this).attr('popper'));
                popper.show();
                var popperInstance = new Popper(reference, popper, {
                    placement: 'top'
                });
            });
            $(document).on('mouseleave click', '.poppy-custom', function () {
                $(document).find('.popper').hide();
            });
            $(document).on('click', '.poppy-click', function (e) {
                e.preventDefault();
                var reference = $(this);
                var popper = $($(this).attr('popper-box'));
                popper.fadeToggle(300);
                var popperInstance = new Popper(reference, popper, {
                    placement: 'top'
                });
            });
            $(document).on('mouseleave', '.popper-box', function () {
                $(document).find('.popper-box').fadeOut(300);
            });
            $(document).on('click', '.copyThis', function () {

                var dis = $(this);

                var address = dis.attr('copy-value');

                $.when($(document).find("#copyTemp").val(address)).done(function () {
                    CopyToClipboard("copyTemp");

                    iziToast.show({
                        message: 'لینک در حافظه موقت کپی شد',
                        timeout: 2000,
                        position: 'topCenter',
                        theme: 'dark',
                        progressBarColor: 'rgb(79,195,247)',
                    });

                    $('#copyTemp').blur();

                });

            });

            $(document).on('keyup change', '.sepy', function () {

                var dis = $(this);

                var value = dis.val();

                $(this).val(number_format(value, 1));

            });
        });
    </script>
    <!---end GOFTINO code--->
</div>
</body>
</html>
