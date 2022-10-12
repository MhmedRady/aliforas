

<form id="loginForm" class="theme-form" method="post" action="{{route('login')}}">
    <h3 class="text-start text-capitalize" style="color: #0d6efd;">{{ __('auth.loginWord') }}</h3>
    @csrf
    <div class="row">
        <div class="form-group col-12">
            <label for="email">{{__('Email')}}</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                   name="email" value="{{ old('email') }}"
                   placeholder="{{__('Email')}}" required autocomplete="email">
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong style="color: red;font-size: 15px;">{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group col-12">
            <label for="password">{{ __('Password') }}</label>
            <input id="password" class="form-control @error('password') is-invalid @enderror" name="password"
                   type="password" required autocomplete="password" placeholder="{{ __('Password') }}">
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong style="color: red;font-size: 15px;">{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="col-12 mb-3">
            <a class="float-end txt-default mt-2" href="{{route('password.request')}}">{{__('auth.forgetPW?')}}</a>
        </div>
        @if(currentRoute() == 'login')
            <div class="col-md-12">
                <a href="{{route('seller.Login')}}" class="w-100 btn btn-sm seller-login fw-bold mb-3" style=" font-size: 1rem;">@lang('auth.loginAsSeller')</a>
            </div>
        @endif
        <div class="col-12 mb-3">
            <button class="w-100 btn btn-sm btn-success font-bold" style="font-size: 1rem; background-color: #04C35C;">{{__('Login')}}</button>
        </div>
{{--        <div class="row">--}}

        <div class="col-md-12">
                <a href="{{$fbUrl ?? ('/login/facebook')}}" style="background-color: #3B5998;color: white; font-size: 1rem;"
                   class="w-100 btn btn-sm fw-bold mb-3">
                    <i class="fa fa-facebook-square"></i>&nbsp;{{ __('Login With Facebook') }}
                </a>
            </div>
            <div class="col-md-12">
                <strong class="text-capitalize" style="font-size: 1rem">
                    @lang('auth.loginHave?')&nbsp;
                    <a href="{{route("register")}}">
                        {{__("Create Account")}}
                    </a>
                </strong>
            </div>

{{--        </div>--}}

    </div>
</form>
