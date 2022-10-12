@extends('root.layouts.app')
@section('title',__("Forgot Your Password"))

@section('content')
    <!--section start-->
    <section class="login-page section-big-py-space e-w ">
        <div class="custom-container">
            <div class="row">
                <div class="col-lg-4 col-md-6 offset-xl-4 offset-lg-4 offset-md-2">
                    <div class="theme-card">
                        <h3 class="text-center">{{__('auth.sendResetPWDLink')}}</h3>

                        @if (session('status'))
                            <div class="btn btn-success font-bold" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @include('root.message.message')
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="form-group">
                                <label for="email" class="font-bold">{{ __('auth.Email') }}</label>
                                <input id="email" type="email"
                                       class="form-control @error('email') 'is-invalid' @enderror" name="email"
                                       value="{{ old('email') }}" required autocomplete="on" autofocus>
                                @error('email')
                                <span class="invalid-feedback d-block text-center" role="alert"
                                      style="font-size: .8rem">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-xs-12" style="text-align: center;">
                                    <button type="submit" class="btn btn-primary btn-sm p-2 font-bold">
                                        {{ __('auth.send') }}
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
