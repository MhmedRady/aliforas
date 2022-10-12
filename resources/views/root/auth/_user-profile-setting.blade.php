@extends('root.layouts.app')
@section('title',__('userProfile'))

@section('content')
    <section class="contact-page register-page section-big-py-space b-g-light">

            <div class="custom-container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <img src="{{$user->profile_image_url}}" class="profile_image img-thumbnail rounded-circle d-block mb-3 m-auto" width="250" height="250" alt="profile_image" style="cursor: pointer;box-shadow: 1px 5px 10px -5px #aaa;" onclick="profile_image.click()">
                            <div id="profile_image_error" class="invalid-feedback d-block font-bold d-block mb-3 mt-3 text-center" style="font-size: .8rem;"></div>
                            <label for="profile_image" class="btn btn-info btn-md white content-center d-flex m-auto mb-4 mt-4" style="width: max-content">{{__('auth.image')}}</label>
                        </div>
                    </div>

                    <form action="{{route('update-profile')}}" method="post" enctype="multipart/form-data" class="col-lg-6">
                        <h3 class="mb-3">{{__('auth.PERSONAL DETAIL')}}</h3>
                        <div class="theme-form">
                            @csrf
                            <input id="profile_image" type="file" class="form-control d-none" name="user_image" accept="image/jpeg, image/png">
                            <div class="row">
                                <div class="col-md-12">
                                    @include('root.message.message')
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__('auth.fName')}}</label>
                                        <input type="text" class="form-control" name="first_name"
                                               value="{{old('first_name')??$user->userDetails->first_name}}" required="">
                                        @error('first_name')
                                        <div class="invalid-feedback font-85 d-block">
                                            <strong>{{$message}}</strong>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__('auth.lName')}}</label>
                                        <input type="text" class="form-control" name="last_name" value="{{old('last_name')??$user->userDetails->last_name}}" required="">
                                        @error('last_name')
                                        <div class="invalid-feedback font-85 d-block">
                                            <strong>{{$message}}</strong>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__('auth.phoneNumber')}}</label>
                                        <input type="text" class="form-control" name="contact_number" value="{{old('contact_number')??$user->contact_number}}" required="">
                                        @error('contact_number')
                                        <div id="fNameFeedback" class="invalid-feedback font-85 d-block">
                                            <strong>{{$message}}</strong>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>{{__('auth.Email')}}</label>
                                            <input type="email" name="email" class="form-control" value="{{old('email')??$user->email}}" required="">
                                            @error('email')
                                            <div class="invalid-feedback font-85 d-block">
                                                <strong>{{$message}}</strong>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label>{{__('auth.gender')}}</label>
                                                    <select class="form-select" name="gender">
                                                        <option value="0" disabled></option>
                                                        <option value="1" {{old('gender')??$user->gender=='Male'?'selected':''}}>
                                                            {{__('auth.male')}}
                                                        </option>
                                                        <option value="2" {{old('gender')??$user->gender=='Female'?'selected':''}}>
                                                            {{__('auth.female')}}
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label>{{__('auth.age')}}</label>
                                                    <input type="text" class="form-control rounded" name="age" value="{{old('age')??$user->userDetails->age}}" style="max-height: 38px;">
                                                    @error('age')
                                                    <span class="invalid-feedback font-85 d-block" role="alert">
                                                        <strong style="color: red;font-size: 15px;">{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>{{__('auth.birthDate')}}</label>
                                            <input type="date" class="form-control" name="dob"
                                                   value="{{old('dob')??$user->dob}}" style="padding: 5px 25px;">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="national_id">{{__('auth.NID')}}</label>
                                        <input id="national_id" type="text" class="form-control" name="national_id" value="{{old('national_id')??$user->userDetails->national_id}}">
                                        @error('national_id')
                                        <span class="invalid-feedback font-85 d-block" role="alert">
                                            <strong style="color: red;font-size: 15px;">{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="employer">{{__('auth.workPlace')}}</label>
                                        <input id="employer" type="text" class="form-control" name="employer" value="{{old('employer')??$user->userDetails->employer}}">
                                        @error('employer')
                                        <span class="invalid-feedback font-85 d-block" role="alert">
                                            <strong style="color: red;font-size: 15px;">{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{__('auth.address')}}</label>
                                        <input type="text" class="form-control" name="address" value="{{old('address')??$user->userDetails->address}}" required="">
                                        @error('address')
                                        <div class="invalid-feedback font-85 d-block">
                                            <strong>{{$message}}</strong>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="state_selector">{{__('auth.state')}}</label>
                                        <select id="state_selector" class="form-select state_selector"
                                                data-city-target="#city_selector"
                                                data-state-route="{{route('get-sate-cities-onChange')}}"
                                                data-current_id="{{$user->userDetails->state_id}}"
                                                name="state_id" required>
                                            @foreach($states as $state)
                                                <option value="{{$state->id}}" {{$state->id == $user->userDetails->state_id ?'selected':''}}>
                                                    {{$state->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('state_id')
                                        <span class="invalid-feedback font-85 d-block" role="alert">
                                            <strong style="color: red;font-size: 15px;">{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="city_selector">{{__('auth.city')}}</label>
                                        <select id="city_selector" class="form-select" name="city_id">
                                            <option value="0" disabled></option>
                                            @foreach($states->find($user->userDetails->state_id??1)->cities as $city)
                                                <option value="{{$city->id}}" {{$city->id == $user->userDetails->city_id ?'selected':''}}>
                                                    {{$city->city}}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('city_id')
                                        <span class="invalid-feedback font-85 d-block" role="alert">
                                            <strong style="color: red;font-size: 15px;">{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__('auth.postal_code')}} </label>
                                        <input type="text" class="form-control" name="postal_code" value="{{old('postal_code')??$user->userDetails->postal_code}}">
                                        @error('postal_code')
                                        <div class="invalid-feedback font-85 d-block">
                                            <strong>{{$message}}</strong>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <button class="btn btn-sm btn-normal mt-2" type="submit">{{__('auth.saveSetting')}}</button>
                                </div>

                            </div>

                        </div>
                    </form>

                    <div class="col-lg-6">
                        <h3 class="mb-3 spc-responsive">{{__('auth.SHIPPING ADDRESS')}}</h3>

                        <div class="theme-form">
                            <div class="order-box mb-0">
                                @if($user->userAddresses)
                                        <div class="title-box">
                                        <li class="m-2" style="display: list-item;">
                                            <h4 class="text-capitalize">{{__('layouts.shippingAddress')}}</h4>
                                        </li>
                                    </div>
                                    <div class="row">
                                    @foreach($user->userAddresses as $key => $address)

                                            <div class="col-12">
                                                <a href="{{route('view-user-address')}}">
                                                    <h4 class="mb-3 text-capitalize" style="display: list-item;list-style: inside;">{{$address->address}}</h4>
                                                </a>
                                            </div>

                                    @endforeach
                                        <div class="col-12">
                                            <a href="#addNewUserAddress" class="btn btn-sm btn-primary font-bold m-2">
                                                <i class="fa fa-plus"></i>
                                                {{__("auth.addNewAddress")}}
                                            </a>
                                        </div>
                                    </div>
                                @endif

                                <div class="title-box">
                                    <li class="m-2 mt-4" style="display: list-item;">
                                        <h4 class="text-capitalize">{{__('layouts.newShippingAddress')}}</h4>
                                    </li>
                                </div>

                                <form id="addNewUserAddress" action="{{route("new-user-address")}}" method="post">
                                    @csrf
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="state_selector">{{__('auth.state')}}</label>
                                                <select id="state_selector" class="form-select state_selector"
                                                        data-city-target="#new_city_selector"
                                                        data-state-route="{{route('get-sate-cities-onChange')}}"
                                                        data-current_id="{{$user->userDetails->state_id}}"
                                                        name="address_state_id" required>
                                                    @foreach($states as $state)
                                                        <option value="{{$state->id}}" {{$state->id == $user->userDetails->state_id ?'selected':''}}>
                                                            {{$state->name}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('address_state_id')
                                                <span class="invalid-feedback font-85 d-block" role="alert">
                                                    <strong style="color: red;font-size: 15px;">{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="new_city_selector">{{__('auth.city')}}</label>
                                                <select id="new_city_selector" class="form-select" name="address_city_id">
                                                    <option value="0" disabled></option>
                                                    @foreach($states->find($user->userDetails->state_id??1)->cities as $city)
                                                        <option value="{{$city->id}}" {{$city->id == $user->userDetails->city_id ?'selected':''}}>
                                                            {{$city->city}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('address_city_id')
                                                <span class="invalid-feedback font-85 d-block" role="alert">
                                                    <strong style="color: red;font-size: 15px;">{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{__('auth.address')}}</label>
                                                <input type="text" class="form-control" name="address_address" value="{{old('address_address')}}" required="">
                                                @error('address_address')
                                                <div class="invalid-feedback font-85 d-block">
                                                    <strong>{{$message}}</strong>
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{__('auth.postal_code')}} </label>
                                                <input type="text" class="form-control" name="address_postal_code" value="{{old('postal_code')}}">
                                                @error('address_postal_code')
                                                <div class="invalid-feedback font-85 d-block">
                                                    <strong>{{$message}}</strong>
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        {{--                        <div class="col-md-6">--}}
                                        {{--                            <div class="form-group">--}}
                                        {{--                                <label>{{__('auth.flat')}} </label>--}}
                                        {{--                                <input type="text" class="form-control" name="" value="{{$user->userDetails->address}}" required="">--}}
                                        {{--                            </div>--}}
                                        {{--                        </div>--}}

                                        <div class="col-md-12">
                                            <button class="btn btn-sm btn-normal mb-lg-5" type="submit">{{__('auth.addNewAddress')}}</button>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
    </section>
@endsection

@push('scripts')

    <script>
        let _IMG       = $("#profile_image");
        let _IMG_Err   = $("#profile_image_error");
        let _IMG_ch    = true;

        let imgEX = [ `jpg`,`png`,`jpeg` ];

        const _chEX = function (inputFile) {
            return inputFile.val().split('.').pop().toLowerCase();
        }

        function loadImg(){

            $(`input[id=profile_image][type=file]`).on('change',function () {
                console.log('profile_image')
                let file = $(this).get(0).files[0];
                if(imgEX.includes(_chEX(_IMG)))
                {
                    _IMG_ch = false;
                    _IMG_Err.text('');
                    if (file){
                        let reader = new FileReader();

                        reader.onloadstart = function () {
                            // imgLoader.show();
                        }
                        reader.onload = function () {
                            console.log(reader.result)
                            $(".profile_image").attr("src",reader.result);
                        }
                        reader.onloadend = function () {
                            // imgLoader.fadeOut(1000);
                        }
                        reader.readAsDataURL(file);
                    }
                }else{
                    _IMG_ch = true;
                    _IMG_Err.text('{{__('auth.imgErrorType')}}');
                }
            });
        }

        loadImg();
    </script>

@endpush
