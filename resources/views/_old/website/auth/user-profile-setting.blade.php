<section class="contact-page register-page section-big-py-space b-g-light">
    <form action="{{route('web.user-update-profile',$user->id)}}" method="post">
        <div class="custom-container">
            <div class="row">
                <div class="col-lg-6">
                    <h3 class="mb-3">{{__('auth.PERSONAL DETAIL')}}</h3>
                    <div class="theme-form">
                        @csrf
                        <div class="row">
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
                                        <label>{{__('auth.birthDate')}}</label>
                                        <input type="date" class="form-control" name="dob"
                                               value="{{old('dob')??$user->dob}}" style="padding: 5px 25px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <h3 class="mb-3 spc-responsive">{{__('auth.SHIPPING ADDRESS')}}</h3>
                    <div class="theme-form">
                        <div class="row">

                            {{--                        <div class="col-md-6">--}}
                            {{--                            <div class="form-group">--}}
                            {{--                                <label>{{__('auth.flat')}} </label>--}}
                            {{--                                <input type="text" class="form-control" name="" value="{{$user->userDetails->address}}" required="">--}}
                            {{--                            </div>--}}
                            {{--                        </div>--}}

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{__('auth.state')}}</label>
                                    <select id="country_selector" class="form-select"
                                            data-route="{{route('web.change-country')}}"
                                            data-current_id="{{$user->userDetails->country_id}}"
                                            name="country_id" required>
                                        @foreach($countries as $country)
                                            <option value="{{old('gender')??$country->id}}" {{$country->id == $user->userDetails->country_id ?'selected':''}}>
                                                {{$country->country}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{__('auth.city')}}</label>
                                    <select id="city_selector" class="form-select" name="city_id" required>
                                        @foreach($cities as $city)
                                            <option value="{{old('city_id')??$city->id}}" {{$city->id == $user->userDetails->city_id ?'selected':''}}>
                                                {{$city->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
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
                                <button class="btn btn-sm btn-normal mb-lg-5" type="submit">{{__('auth.saveSetting')}}</button>
                            </div>

                            <div class="col-md-12">
                                @include('website.message.message')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>
