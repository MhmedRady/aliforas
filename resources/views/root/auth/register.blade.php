@extends('root.layouts.app')
@section('title',__('Register'))

@section('content')

    <!-- personal deatail section start -->
    <section class="contact-page register-page section-big-py-space b-g-light">
        <div class="custom-container">
            <div class="row">
                <div class="col-md-6 m-auto text-center">
                    <div class="theme-card">
                        <h3 class="m-auto text-center mb-3">
                            {{__('auth.userRegister')}}
                        <p class="text-center text-capitalize my-3" style="color: #555">
                            @lang('auth.haveAccount?')
                            <a href="{{route('login')}}">@lang('Login')</a>
                        </p>
                        </h3>
                        <form class="theme-form" action="{{route('register')}}" method="post">
                            @csrf
                            <div class="row">

                                {{--<div class="col-md-12">
                                    <div class="form-group">
                                        <img src="{{asset('assets/images/Profile_avatar.png')}}"
                                             class="profile_image img-thumbnail rounded-circle d-block mb-3 m-auto"
                                             width="200" height="200" alt="profile_image" style="cursor: pointer"
                                             onclick="profile_image.click()">
                                        <div id="profile_image_error"
                                             class="invalid-feedback d-block font-bold d-block mb-3 mt-3"
                                             style="font-size: .8rem;">
                                        </div>
                                        <label for="profile_image"
                                               class="btn btn-info btn-md white">{{__('auth.image')}}</label>
                                        <input id="profile_image" type="file" class="form-control d-none"
                                               name="profile_image" accept="image/jpeg, image/png">

                                    </div>
                                </div>--}}

                                @if(config('setting.pricing') === false)
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fName">{{__('auth.fName')}}</label>
                                            <input id="fName" type="text" class="form-control" name="first_name"
                                                   value="{{old('first_name')}}">
                                            @error('first_name')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong style="color: red;font-size: 15px;">{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="lName">{{__('auth.lName')}}</label>
                                            <input id="lName" type="text" class="form-control" name="last_name"
                                                   value="{{old('last_name')}}">
                                            @error('last_name')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong style="color: red;font-size: 15px;">{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                @endif

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">{{__('auth.Email')}}</label>
                                        <input id="email" type="email" class="form-control" name="email"
                                               value="{{old('email')}}">
                                        @error('email')
                                        <span class="invalid-feedback d-block" role="alert">
                                                <strong style="color: red;font-size: 15px;">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">{{__('auth.phoneNumber')}}</label>
                                        <input id="phone" type="text" class="form-control" name="phone" autocomplete="off" aria-autocomplete="false"
                                               value="{{old('phone')}}">
                                        @error('phone')
                                        <span class="invalid-feedback d-block" role="alert">
                                                <strong style="color: red;font-size: 15px;">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Password">{{__('auth.Password')}}</label>
                                        <input id="Password" type="password" class="form-control" name="Password">
                                        @error('Password')
                                        <span class="invalid-feedback d-block" role="alert">
                                                <strong style="color: red;font-size: 15px;">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="confirm_password">{{__('auth.pwConfirm')}}</label>
                                        <input id="confirm_password" type="password" class="form-control" name="confirm_password">
                                        @error('confirm_password')
                                        <span class="invalid-feedback d-block" role="alert">
                                                <strong style="color: red;font-size: 15px;">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

{{--                                <div class="col-md-12">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="address">{{__('auth.address')}}</label>--}}
{{--                                        <input id="address" type="text" class="form-control" name="address"--}}
{{--                                               value="{{old('address')}}">--}}
{{--                                        @error('address')--}}
{{--                                        <span class="invalid-feedback d-block" role="alert">--}}
{{--                                                <strong style="color: red;font-size: 15px;">{{ $message }}</strong>--}}
{{--                                            </span>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                            @if(config('setting.pricing') === false)
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="employer">{{__('auth.workPlace')}}</label>
                                        <input id="employer" type="text" class="form-control" name="employer"
                                               value="{{old('employer')}}">
                                        @error('employer')
                                        <span class="invalid-feedback d-block" role="alert">
                                                <strong style="color: red;font-size: 15px;">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="national_id">{{__('auth.NID')}}</label>
                                        <input id="national_id" type="text" class="form-control" name="national_id"
                                               value="{{old('national_id')}}">
                                        @error('national_id')
                                        <span class="invalid-feedback d-block" role="alert">
                                                <strong style="color: red;font-size: 15px;">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="gender">{{__('auth.gender')}}</label>
                                                <select id="gender" class="form-select" name="gender">
                                                    <option value="male">{{__('auth.male')}}</option>
                                                    <option value="female">{{__('auth.female')}}</option>
                                                </select>
                                                @error('gender')
                                                <span class="invalid-feedback d-block" role="alert">
                                                    <strong style="color: red;font-size: 15px;">{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="age">{{__('auth.age')}}</label>
                                                <input id="age" type="number" class="form-control rounded" name="age"
                                                       min="0" value="{{old('age')}}" style="max-height: 38px;">
                                                @error('age')
                                                <span class="invalid-feedback d-block" role="alert">
                                                <strong style="color: red;font-size: 15px;">{{ $message }}</strong>
                                            </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <a href="{{$fbUrl ?? ('/login/facebook')}}" style="background-color: #0049b5"
                                               class="btn btn-primary btn-md font-bold w-100">
                                                <i class="fa fa-facebook-square"></i>&nbsp;{{ __('Login With Facebook') }}
                                            </a>
                                        </div>
                                        <div class="col-md-6">
                                            <button type="submit"
                                                    class="btn btn-success btn-md font-bold w-100">
                                                {{__('Register')}}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- Section ends -->

@endsection

@push('scripts')
    <script>
        $(function () {
            let _IMG = $("#profile_image");
            let _IMG_Err = $("#profile_image_error");
            let _IMG_ch = true;

            let imgEX = [`jpg`, `png`, `jpeg`];

            const _chEX = function (inputFile) {
                return inputFile.val().split('.').pop().toLowerCase();
            }

            function loadImg() {


                $(`input[id=profile_image][type=file]`).on('change', function () {
                    let file = $(this).get(0).files[0];
                    if (imgEX.includes(_chEX(_IMG))) {
                        _IMG_ch = false;
                        _IMG_Err.text('');
                        if (file) {
                            let reader = new FileReader();

                            reader.onloadstart = function () {
                                // imgLoader.show();
                            }
                            reader.onload = function () {
                                console.log(reader.result)
                                $(".profile_image").attr("src", reader.result);
                            }
                            reader.onloadend = function () {
                                // imgLoader.fadeOut(1000);
                            }
                            reader.readAsDataURL(file);
                        }
                    } else {
                        _IMG_ch = true;
                        _IMG_Err.text('{{__('auth.imgErrorType')}}');
                    }
                });
            }

            loadImg();
        })
    </script>
@endpush
