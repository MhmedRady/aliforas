@extends('seller.layouts.fullLayoutMaster')

@section('title', __('seller.login'))

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
                    <div class="lang-change">
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <a rel="alternate" class="{{$localeCode !== app()->getLocale() ? 'active':''}}" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                {{ $properties['native'] }}
                            </a>
                        @endforeach
                    </div>
                    <a href="#" class="brand-logo">
                        <img src="{{ env('LOGO_MINI_PATH') }}" width="64px" alt="{{ env('APP_NAME') }}">
                        <h2 class="brand-text text-primary ms-1" style="align-self: center;">{{ env('APP_NAME') }}</h2>
                    </a>

                    <h4 class="card-title text-center mb-1">{{__('passwords.resetNPW')}}</h4>
                    @include('seller.message.message')

                <form class="auth-login-form mt-2" action="{{ route('seller.password.rest') }}" method="POST">
                    @csrf
                    <input type="hidden" name="token" value="{{$token}}">

                    <div class="mb-1">
                        <div class="d-flex justify-content-between">
                            <label class="form-label" for="new_password">{{__('auth.Password')}}</label>

                        </div>
                        <div class="input-group input-group-merge form-password-toggle">
                            <input type="password" id="new_password"
                                   class="form-control form-control-merge "
                                   name="new_password" tabindex="2" aria-describedby="new_password"
                                   value="{{old('new_password')}}"
                                   placeholder=""/>
                            <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                        </div>
                        @error('new_password')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-1">
                        <div class="d-flex justify-content-between">
                            <label class="form-label" for="confirm_password">{{__('auth.pwConfirm')}}</label>

                        </div>
                        <div class="input-group input-group-merge form-password-toggle">
                            <input type="password" id="confirm_password"
                                   class="form-control form-control-merge"
                                   name="confirm_password" tabindex="2" aria-describedby="confirm_password"
                                   value="{{old('confirm_password')}}"
                                   placeholder=""/>
                            <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                        </div>
                        @error('confirm_password')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <button class="login-btn btn font-weight-bold btn-primary w-100" tabindex="4">{{__('auth.save')}}</button>

                </form>

            </div>
        </div>
    </div>
@endsection

@section('vendor-script')
    <script src="{{asset(mix('admin-asset/vendors/js/forms/validation/jquery.validate.min.js'))}}"></script>
@endsection

@section('page-script')
    <script src="{{asset(mix('admin-asset/js/scripts/pages/auth-login.js'))}}"></script>
@endsection
