@extends('seller.layouts.fullLayoutMaster')

@section('title', __('auth.forgetPW?'))

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
                    <form class="auth-login-form mt-2" action="{{ route('seller.send.rest.link') }}" method="POST">
                        @csrf
                        <div class="mb-1">
                            <label for="email" class="form-label">{{__('auth.emailOrPhone')}}</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                                   name="email" autofocus
                                   aria-describedby="login-email" tabindex="1"
                                   value="{{ old('email') }}"/>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button class="login-btn btn font-weight-bold btn-primary w-100" tabindex="4">{{__('auth.Submit')}}</button>
                    </form>

                </div>
            </div>
            <!-- /Login basic -->
        </div>
    </div>
@endsection

@section('vendor-script')
    <script src="{{asset('admin-asset/vendors/js/forms/validation/jquery.validate.min.js')}}"></script>
@endsection

@section('page-script')
    <script src="{{asset('admin-asset/js/scripts/pages/auth-login.js')}}"></script>
@endsection
