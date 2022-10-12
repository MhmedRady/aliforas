@extends('admin.layouts.fullLayoutMaster')

@section('title', 'Login Page')

@section('page-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset('admin-asset/css-'.getPageDir().'/plugins/forms/form-validation.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-asset/css-'.getPageDir().'/pages/authentication.css') }}">
@endsection

@section('content')
    <div class="auth-wrapper auth-basic px-2">
        <div class="auth-inner my-2">
            <!-- Login basic -->
            <div class="card mb-0">
                <div class="card-body">
                    <a href="#" class="brand-logo">
                        <img src="{{ env('LOGO_MINI_PATH') }}" width="64px" alt="{{ env('APP_NAME') }}">
                        <h2 class="brand-text text-primary ms-1" style="align-self: center;">{{ env('APP_NAME') }}</h2>
                    </a>

                    <h4 class="card-title text-center mb-1">Admin Login</h4>
                    <form class="auth-login-form mt-2" action="{{ route('admin.login') }}" method="POST">
                        @csrf
                        <div class="mb-1">
                            <label for="email" class="form-label">{{__('auth.Email')}}</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                                   name="email" autofocus
                                   placeholder="john@example.com" aria-describedby="login-email" tabindex="1"
                                   value="{{ old('email') }}"/>
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-1">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="password">{{__('auth.Password')}}</label>
                                <a href="{{url('auth/forgot-password-basic')}}">
                                    <small>{{__('auth.forgetPW?')}}</small>
                                </a>
                            </div>
                            <div class="input-group input-group-merge form-password-toggle @error('password') is-invalid @enderror">
                                <input type="password" id="password"
                                       class="form-control form-control-merge @error('password') is-invalid @enderror"
                                       name="password" tabindex="2" aria-describedby="password"
                                       placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"/>
                                <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                            </div>

                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-1">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remember-me" tabindex="3"/>
                                <label class="form-check-label" for="remember-me">{{__('auth.remMe')}}</label>
                            </div>
                        </div>
                        <button class="btn btn-primary w-100" tabindex="4">{{__('auth.Submit')}}</button>
                    </form>

                    {{--<p class="text-center mt-2">
                        <span>New on our platform?</span>
                        <a href="{{url('auth/register-basic')}}">
                            <span>Create an account</span>
                        </a>
                    </p>--}}

{{--                    <div class="divider my-2">--}}
{{--                        <div class="divider-text">or</div>--}}
{{--                    </div>--}}

{{--                    <div class="auth-footer-btn d-flex justify-content-center">--}}
{{--                        <a href="#" class="btn btn-facebook">--}}
{{--                            <i data-feather="facebook"></i>--}}
{{--                        </a>--}}
{{--                        <a href="#" class="btn btn-twitter white">--}}
{{--                            <i data-feather="twitter"></i>--}}
{{--                        </a>--}}
{{--                        <a href="#" class="btn btn-google">--}}
{{--                            <i data-feather="mail"></i>--}}
{{--                        </a>--}}
{{--                        <a href="#" class="btn btn-github">--}}
{{--                            <i data-feather="github"></i>--}}
{{--                        </a>--}}
{{--                    </div>--}}
                </div>
            </div>
            <!-- /Login basic -->
        </div>
    </div>
@endsection

@section('vendor-script')
    <script src="{{asset('admin-asset/vendors/js/forms/validation/jquery.validate.min.js')}}" ></script>
@endsection

@section('page-script')
    <script src="{{asset('admin-asset/js/scripts/pages/auth-login.js')}}"></script>
@endsection
