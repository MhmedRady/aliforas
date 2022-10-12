@extends('root.auth.user-profile-setting')
@section('title',__('auth.editProfile'))
@section('tabItem')
    <div id="_editProfile" class="col-lg-8">

        <div class="card mb-4">
            <div class="card-body">
                @include('root.message.message')
                <h3 class="m-2 mb-4 text-capitalize">
                    {{__('auth.editProfile')}}
                </h3>
                <hr/>
{{--                <button id="profile_updated_msg" class="btn btn-block mb-3 font-85 res_message" style="font-weight: bold;"></button>--}}
                <form id="update-profile" action="{{route('update-profile')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="card-body text-center">
                                <img src="{{$user->profile_image_url}}" alt="avatar" class="profile_image rounded-circle img-fluid img-thumbnail" style="cursor: pointer;width: 200px;height: 200px;box-shadow: 1px 5px 10px -5px #aaa;">
                                <div id="profile_image_error" class="invalid-feedback d-block font-bold d-block mb-3 mt-3 text-center" style="font-size: .8rem;"></div>
                                <label for="profile_image" class="profile_image btn btn-info btn-md white content-center d-flex m-auto mb-4 mt-4" style="width: max-content">{{__('auth.image')}}</label>
                                <input id="profile_image" type="file" class="form-control d-none" name="user_image" accept="image/jpeg, image/png">

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label for="fName" class="mb-0 font-bold">{{__('auth.fName')}}</label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="fName" name="first_name" value="{{old('first_name', $user->first_name)}}">
                                </div>
                                @error('first_name')
                                <span class="invalid-feedback font-85 d-block" role="alert">
                                            <strong style="color: red;font-size: 15px;">{{ $message }}</strong>
                                        </span>
                                @enderror
                                <div id="first_name_error" class="invalid-feedback font-85 font-bold text-capitalize d-block" style="font-size: .85rem;">

                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label for="lName" class="mb-0 font-bold">{{__('auth.lName')}}</label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="lName" name="last_name" value="{{old('last_name', $user->last_name)}}">
                                </div>
                                @error('last_name')
                                <span class="invalid-feedback font-85 d-block" role="alert">
                                            <strong style="color: red;font-size: 15px;">{{ $message }}</strong>
                                        </span>
                                @enderror
                                <div id="last_name_error" class="invalid-feedback font-85 font-bold text-capitalize d-block" style="font-size: .85rem;">

                                </div>
                            </div>
                        </div>

                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label for="email" class="mb-0 font-bold">{{__('auth.Email')}}</label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="email" name="email" value="{{old('email', $user->email)}}">
                                </div>
                                @error('email')
                                <span class="invalid-feedback font-85 d-block" role="alert">
                                            <strong style="color: red;font-size: 15px;">{{ $message }}</strong>
                                        </span>
                                @enderror
                                <div id="email_error" class="invalid-feedback font-85 font-bold text-capitalize d-block" style="font-size: .85rem;">

                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label for="phone" class="mb-0 font-bold">{{__('auth.phoneNumber')}}</label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="phone" name="phone" value="{{old('phone', $user->phone)}}">
                                </div>
                                @error('phone')
                                <span class="invalid-feedback font-85 d-block" role="alert">
                                            <strong style="color: red;font-size: 15px;">{{ $message }}</strong>
                                        </span>
                                @enderror
                                <div id="phone_error" class="invalid-feedback font-85 font-bold text-capitalize d-block" style="font-size: .85rem;">

                                </div>
                            </div>
                        </div>

                    </div>
                    <hr>

                    @if(config('setting.pricing') === false)
                        <div class="row">

                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label for="workPlace" class="mb-0 font-bold">{{__('auth.workPlace')}}</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="workPlace" name="employer" value="{{ old('employer', $user->employer)}}">
                                    </div>
                                    @error('employer')
                                    <span class="invalid-feedback font-85 d-block" role="alert">
                                            <strong style="color: red;font-size: 15px;">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <div id="employer_error" class="invalid-feedback font-85 font-bold text-capitalize d-block" style="font-size: .85rem;">

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label for="national_id" class="mb-0 font-bold">{{__('auth.NID')}}</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="national_id" name="national_id" value="{{old('national_id', $user->national_id)}}">
                                    </div>
                                    @error('national_id')
                                    <span class="invalid-feedback font-85 d-block" role="alert">
                                            <strong style="color: red;font-size: 15px;">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <div id="national_id_error" class="invalid-feedback font-85 font-bold text-capitalize d-block" style="font-size: .85rem;">

                                    </div>
                                </div>
                            </div>

                        </div>
                        <hr>
                    @endif

                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label for="age" class="mb-0 font-bold">{{__('auth.age')}}</label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="age" name="age" value="{{old('age', $user->age)}}">
                                </div>
                                @error('age')
                                <span class="invalid-feedback font-85 d-block" role="alert">
                                            <strong style="color: red;font-size: 15px;">{{ $message }}</strong>
                                        </span>
                                @enderror
                                <div id="age_error" class="invalid-feedback font-85 font-bold text-capitalize d-block" style="font-size: .85rem;">

                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label for="gender" class="mb-0 font-bold">{{__('auth.gender')}}</label>
                                </div>
                                <div class="col-sm-8">
                                    <select id="gender" class="form-select" name="gender">
                                        <option value="0" disabled></option>
                                        <option value="1" {{old('gender')??$user->gender=='Male'?'selected':''}}>
                                            {{__('auth.male')}}
                                        </option>
                                        <option value="2" {{old('gender')??$user->gender=='Female'?'selected':''}}>
                                            {{__('auth.female')}}
                                        </option>
                                    </select>
                                </div>
                                @error('gender')
                                <span class="invalid-feedback font-85 d-block" role="alert">
                                            <strong style="color: red;font-size: 15px;">{{ $message }}</strong>
                                        </span>
                                @enderror
                                <div id="gender_error" class="invalid-feedback font-85 font-bold text-capitalize d-block" style="font-size: .85rem;">

                                </div>

                            </div>
                        </div>

                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label for="birthDate" class="mb-0 font-bold">{{__('auth.birthDate')}}</label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="date" class="form-control" id="birthDate" class="date" name="dob" value="{{old('dob',$user->dob)}}">
                                </div>
                                @error('dob')
                                <span class="invalid-feedback font-85 d-block" role="alert">
                                            <strong style="color: red;font-size: 15px;">{{ $message }}</strong>
                                        </span>
                                @enderror
                                <div id="dob_error" class="invalid-feedback font-85 font-bold text-capitalize d-block" style="font-size: .85rem;">

                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <div class="col-12">
                        <button type="submit" id="submit" class="btn btn-primary btn-sm font-bold">{{__('auth.saveChanges')}}</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection
