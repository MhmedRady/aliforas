<!DOCTYPE html>
<html lang="en">
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
    <link href="{{asset('assets/css/all.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">

    <link href="{{asset('admin-asset/assets/node_modules/morrisjs/morris.css')}}" rel="stylesheet">
    <!--Toaster Popup message CSS -->
    <link href="{{asset('admin-asset/assets/node_modules/toast-master/css/jquery.toast.css')}}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{asset('admin-asset/dist/css/style.min.css')}}" rel="stylesheet">
    <!-- Dashboard 1 Page CSS -->
    <link href="{{asset('admin-asset/dist/css/pages/dashboard1.css')}}" rel="stylesheet">
    {{--@toastr_css--}}
    @yield('style')
</head>

<body class="fixed-layout skin-blue-dark">
<!-- ============================================================== -->
<!-- Preloader - style you can find in spinners.css -->
<!-- ============================================================== -->
<div class="preloader">
    <div class="loader">
        <div class="loader__figure"></div>
        <p class="loader__label">{{ env('APP_NAME') }} Admin</p>
    </div>
</div>
<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<div id="main-wrapper">
    <!-- ============================================================== -->
    <!-- Topbar header - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
        @yield('container')
    <!-- ============================================================== -->

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
