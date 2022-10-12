@extends('admin.layouts.fullLayoutMaster')

@section('title', 'Not Authorized!')

@section('page-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset('admin-asset/css-'.getPageDir().'/plugins/forms/form-validation.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-asset/css-'.getPageDir().'/pages/authentication.css') }}">
    <style>
        body{
            background-color: #1a202c !important;
            color: #ddd !important;
        }
    </style>

@endsection

@section('content')

    <!-- Not authorized-->
        <div class="container">
            <div class="misc-wrapper text-center mt-5">
                <a href="#" class="brand-logo">
                    <img src="{{ env('LOGO_MINI_PATH') }}" width="64px" alt="{{ env('APP_NAME') }}">
                    <h2 class="brand-text text-primary ms-1" style="align-self: center;">{{ env('APP_NAME') }}</h2>
                </a>
                <div class="misc-inner p-2 p-sm-3">
                    <div class="w-100 text-center">
                        <h2 class="mb-1 text-capitalize" style="color: #eee">You are not authorized! 🔐</h2>
                        <p class="mb-2" style="font-size: 1.5rem; line-height: 1.7">
                            Sorry You have <srtong class="text-capitalize" style="font-weight: bold"><u>{{\auth()->guard('admin')->user()->getRoleNames()->first()}}</u></srtong> rules So You are not authorized To Open This Page, Back To Your Administration To Give You This Authorization.
                        </p>
                        <a class="btn btn-primary mb-1 btn-sm-block text-bold" href="{{route('admin.home')}}">Back To Home</a>
                        <img class="img-fluid d-block m-auto" src="{{asset('admin-asset/images/pages/not-authorized-dark.svg')}}" alt="Not authorized page" />
                    </div>
                </div>
            </div>
        </div>
    <!-- / Not authorized-->

@endsection

@section('vendor-script')
    <script src="{{asset(mix('admin-asset/vendors/js/forms/validation/jquery.validate.min.js'))}}"></script>
@endsection

@section('page-script')
    <script src="{{asset(mix('admin-asset/js/scripts/pages/auth-login.js'))}}"></script>
@endsection
