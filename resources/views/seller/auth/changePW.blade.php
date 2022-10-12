@extends('seller.layouts.contentLayoutMaster')

@section('title', __('seller.login'))

@section('page-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset('admin-asset/css-'.getPageDir().'/plugins/forms/form-validation.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-asset/css-'.getPageDir().'/pages/authentication.css') }}">
@endsection

@section('content')
    <div class="col-md-6 m-auto mt-5">
        <div class="card mb-0">
            <div class="card-body">
                <div class="card-header border-bottom">
                    <h4 class="card-title">{{__('auth.changePass')}}</h4>
                </div>

                <form class="auth-login-form mt-2" action="{{ route('seller.update.password') }}" method="POST">
                    @csrf
                    <div class="mb-1">
                        <label for="currentPW" class="form-label">{{__("passwords.currentPW")}}</label>
                        <input type="password" class="form-control" id="currentPW"
                               name="currentPW" autofocus
                               aria-describedby="login-email" tabindex="1"
                               value="{{ old('currentPW') }}"/>
                        @error('currentPW')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

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
    <script src="{{asset('admin-asset/vendors/js/forms/validation/jquery.validate.min.js')}}"></script>
@endsection

@section('page-script')
    <script src="{{asset('admin-asset/js/scripts/pages/auth-login.js')}}"></script>
@endsection
