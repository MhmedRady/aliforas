@extends('root.layouts.app')
@section('title',__('auth.changePass'))

@section('content')

    <!--section start-->
    <section class="login-page section-big-py-space b-g-light">
        <div class="custom-container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="theme-card">
                        <h3 class="text-center">{{__("passwords.resetNPW")}}</h3>
                        @include('root.message.message')
                        <form class="theme-form" action="{{route("password.update")}}" method="post">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('passwords.newPW') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control new_password" name="new_password" required autocomplete="new_password">

                                    @error('new_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('passwords.confirmNewPW') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="confirm_password" required autocomplete="confirm_password">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Reset Password') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Section ends-->

@endsection

@push('scripts')

@endpush
