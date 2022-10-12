<!DOCTYPE html>
<html lang="en" dir="{{ \Lang::getLocale() == 'ar' ? 'rtl':'ltr'}}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('admin-asset/assets/images/favicon.png')}}">
    <title>@yield('title', env('APP_NAME'))</title>
    <!-- This page CSS -->

    <!-- chartist CSS -->
    <link href="{{asset('admin-asset/dist/css/style.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/all.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">

    <link href="{{asset('admin-asset/assets/node_modules/morrisjs/morris.css')}}" rel="stylesheet">
    <!--Toaster Popup message CSS -->

    <!-- Custom CSS -->

    <!-- Dashboard 1 Page CSS -->
    <link href="{{asset('admin-asset/dist/css/style.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin-asset/dist/css/custom.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/seller.css')}}" rel="stylesheet">

    @if(App::getLocale() == "ar")
    <!-- Dashboard Style RTL Page CSS -->
    <link href="{{asset('admin-asset/dist/css/style-rtl.css')}}" rel="stylesheet">
    @endif
    <link href="{{asset('admin-asset/assets/icons/font-awesome/css/fontawesome-all.css')}}" rel="stylesheet">
    {{--@toastr_css--}}
    @yield('style')
</head>

<body class="fixed-layout skin-blue-dark" >
<!-- ============================================================== -->
<!-- Preloader - style you can find in spinners.css -->
<!-- ============================================================== -->
<div class="preloader">
    <div class="loader">
        <div class="loader__figure"></div>
        <p class="loader__label">aliforas seller</p>
    </div>
</div>
<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<div id="main-wrapper">
    <!-- ============================================================== -->
    <!-- Topbar header - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <header class="topbar">
        <nav class="navbar top-navbar navbar-expand-md navbar-dark">
            <!-- ============================================================== -->
            <!-- Logo -->
            <!-- ============================================================== -->
            <div class="navbar-header">
                <a class="navbar-brand" href="{{ route('admin.home') }}">

                    <!--End Logo icon -->
                    <!-- Logo text --><span>
                         <!-- dark Logo text -->

                        <!-- Light Logo text -->
                         <img src="{{asset('media/main/logo.png')}}" class="light-logo" alt="homepage" style="height: 60px;"/></span> </a>
            </div>
            <!-- ============================================================== -->
            <!-- End Logo -->
            <!-- ============================================================== -->
            <div class="navbar-collapse">
                <!-- ============================================================== -->
                <!-- toggle and nav items -->
                <!-- ============================================================== -->

                <ul class="navbar-nav mr-auto">
                    <!-- This is  -->
                    <li class="nav-item"> <a class="nav-link nav-toggler d-block d-md-none waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                    <li class="nav-item"> <a class="nav-link sidebartoggler d-none d-lg-block d-md-block waves-effect waves-dark" href="javascript:void(0)"><i class="icon-menu"></i></a> </li>
                    <!-- ============================================================== -->
                    <!-- Search -->
                    <!-- ============================================================== -->
                    <li class="nav-item d-none">
                        <form class="app-search d-none d-md-block d-lg-block">
                            <input type="text" class="form-control" placeholder="Search & enter">
                        </form>
                    </li>
                </ul>

            </div>
            <div class="navs-btn">

            </div>
        </nav>
    </header>
    @include('seller.layouts.sidebar')
    <!-- ============================================================== -->
    <div class="page-wrapper">
        @if (\Lang::getLocale() == "ar")
            <style>
                @media screen and (max-width: 780px) {
                    .footer,
                    .page-wrapper {
                        margin-right: auto !important;
                    }
                    .navbar-brand span {
                        display: block !important;
                    }
                }
            </style>
        @endif
        @yield('container')
    </div>
    <!-- ============================================================== -->

    <div class="navsModel">
        <div class="modal fade" id="seeNavs" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="staticBackdropLabel">{{__("seller.sellerNav")}}</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
        </div>
    </div>
{{--    @endif--}}

    <!-- =======================Start Footer======================================= -->
    <footer class="footer">
        © {{date("Y")}} aliforas seller
    </footer>
    <!-- ========================End Footer======================================== -->
</div>
<!-- =======================================Start Js Part============================================================== -->
    <!-- Bootstrap popper Core JavaScript -->

    <script src="{{asset('assets/js/all.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('admin-asset/assets/node_modules/jquery/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('admin-asset/assets/node_modules/popper/popper.min.js')}}"></script>
    <script src="{{asset('admin-asset/assets/node_modules/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{asset('admin-asset/dist/js/perfect-scrollbar.jquery.min.js')}}"></script>
    <!--Wave Effects -->
    <script src="{{asset('admin-asset/dist/js/waves.js')}}"></script>
    <!--Menu sidebar -->
    <script src="{{asset('admin-asset/dist/js/sidebarmenu.js')}}"></script>
    <!--Custom JavaScript -->
    <script src="{{asset('admin-asset/dist/js/custom.min.js')}}"></script>
    <script src="{{asset('admin-asset/assets/node_modules/jquery-sparkline/jquery.sparkline.min.js')}}"></script>
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <!--morris JavaScript -->
    <script src="{{asset('admin-asset/assets/node_modules/raphael/raphael-min.js')}}"></script>
    <script src="{{asset('admin-asset/assets/node_modules/morrisjs/morris.min.js')}}"></script>
    <script src="{{asset('admin-asset/assets/node_modules/jquery-sparkline/jquery.sparkline.min.js')}}"></script>
    <!-- Popup message jquery -->
    <script src="{{asset('admin-asset/assets/node_modules/toast-master/js/jquery.toast.js')}}"></script>
    <!-- Chart JS -->
    {{--<script src="{{asset('admin-asset/dist/js/dashboard1.js')}}"></script>--}}
    <script src="{{asset('admin-asset/assets/node_modules/toast-master/js/jquery.toast.js')}}"></script>

    @toastr_js
    @toastr_render
    <script>
        $(".navs-btn button").one("click", function() {
            $(".navs-btn button small").remove();
        });

        @if(count($errors) > 0)
            @foreach($errors->all() as $error)
                toastr.error("{{ $error }}");
            @endforeach
        @endif
    </script>
    @yield('scripts')
<!-- =======================================Start Js Part============================================================== -->
</body>

</html>
