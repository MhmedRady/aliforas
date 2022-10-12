@extends('root.auth.user-profile-setting')
@section('title',__('auth.SHIPPING ADDRESS'))
@section('tabItem')
    <div id="_addresses" class="col-lg-8 _addNewUserAddress">
        <div class="card-body">
            <h3 class="m-2 mb-4 text-capitalize">
                {{__('auth.SHIPPING ADDRESS')}}
            </h3>
            <div id="addNewUserAddress" class="card col-md-12 _addNewUserAddress mb-4 m-auto">
                <div class="card-body text-center">
                    @include('root.message.message')
                    <h4 class="card-title m-2 mb-4 text-capitalize">
                        {{__('auth.addNewAddress')}}
                    </h4>
                    <hr/>

                    <button id="newAddress_msg" class="btn btn-block mb-3 font-85 res_message" style="font-weight: bold;"></button>
                    <form id="newUserAddress" action="{{route('new-user-address')}}" method="post">
                        @csrf
                        <div class="row">

                            <div class="col-md-6">
                                <label for="fName" class="mb-2 d-block font-bold">{{__('auth.fName')}}</label>
                                <input type="text" class="form-control" id="fName" name="first_name" value="{{old('first_name')??$user->first_name}}">
                                @error('first_name')
                                <span class="invalid-feedback font-85 d-block" role="alert">
                                        <strong style="color: red;font-size: 15px;">{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div id="first_name_error" class="invalid-feedback font-85 font-bold text-capitalize d-block" style="font-size: .85rem;">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="lName" class="mb-2 d-block font-bold">{{__('auth.lName')}}</label>
                                <input type="text" class="form-control" id="lName" name="last_name" value="{{old('last_name')??$user->last_name}}">
                                @error('last_name')
                                <span class="invalid-feedback font-85 d-block" role="alert">
                                        <strong style="color: red;font-size: 15px;">{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div id="last_name_error" class="invalid-feedback font-85 font-bold text-capitalize d-block" style="font-size: .85rem;">

                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                            {{--        <div class="row">            --}}
                                    <label for="phone" class="d-block font-bold">{{__('auth.phoneNumber')}}</label>
                                    <input id="phone" type="text" name="phone" class="form-control m-auto" value="{{old('phone')??$user->phone}}">
                                    @error('phone')
                                    <span class="invalid-feedback font-85 d-block" role="alert">
                                            <strong style="color: red;font-size: 15px;">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <div id="phone_error" class="invalid-feedback font-85 font-bold text-capitalize d-block" style="font-size: .85rem;"></div>
                            {{--            </div>            --}}
                            </div>
                            <div class="col-md-6">
                                {{--      <div class="row">      --}}
                                <label for="newAddress" class="d-block font-bold">{{__('auth.address')}}</label>
                                <input id="newAddress" type="text" name="address" class="form-control m-auto" value="{{old('address')}}">
                                @error('address')
                                <span class="invalid-feedback font-85 d-block" role="alert">
                                            <strong style="color: red;font-size: 15px;">{{ $message }}</strong>
                                        </span>
                                @enderror
                                <div id="address_error" class="invalid-feedback font-85 font-bold text-capitalize d-block" style="font-size: .85rem;"></div>
                                {{--                                </div>--}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-control border-0 text-center">
                                    <label for="state_id" class="d-block font-bold">{{__('auth.state')}}</label>

                                    <select id="state_selector" class="form-select state_selector text-center w-auto m-auto w-100"
                                            style="width: 100% !important;"
                                            data-city-target="#city_selector"
                                            data-state-route="{{route('get-sate-cities-onChange')}}"
                                            data-current_id="1"
                                            name="state_id" required>
                                        @foreach($states as $state)
                                            <option value="{{$state->id}}" {{$state->id == 1 ?'selected':''}}>
                                                {{$state->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('state_id')
                                    <span class="invalid-feedback font-85 d-block" role="alert">
                                        <strong style="color: red;font-size: 15px;">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <div id="state_id_error" class="invalid-feedback font-85 font-bold text-capitalize d-block" style="font-size: .85rem;"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-control border-0 text-center">
                                    <label for="city_selector" class="d-block font-bold">{{__('auth.city')}}</label>

                                    <select id="city_selector" class="form-select text-center w-100 m-auto" name="city_id">
                                        <option value="0" disabled></option>
                                        @foreach($states->find(1)->cities as $city)
                                            <option value="{{$city->id}}" {{$city->id == 1 ?'selected':''}}>
                                                {{$city->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('city_id')
                                    <span class="invalid-feedback font-85 d-block" role="alert">
                                            <strong style="color: red;font-size: 15px;">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <div id="city_id_error" class="invalid-feedback font-85 font-bold text-capitalize d-block" style="font-size: .85rem;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 m-auto mt-2 mb-3 border-0 text-center">
                                <label for="postal_code" class="d-block font-bold">{{__('auth.postal_code')}}</label>
                                <input id="postal_code" class="form-control" type="text" name="postal_code" value="{{old('postal_code')}}">
                                @error('postal_code')
                                    <span class="invalid-feedback font-85 d-block" role="alert">
                                        <strong style="color: red;font-size: 15px;">{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div id="postal_code_error" class="invalid-feedback font-85 font-bold text-capitalize d-block" style="font-size: .85rem;"></div>
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary btn-sm font-bold">
                                <i class="fa fa-plus"></i>
                                {{__('auth.addNewAddress')}}
                            </button>
                        </div>
                    </form>

                </div>
            </div>
            <div class="row mt-4">

                @if($user->userAddresses)
                    @foreach($user->userAddresses as $address)
                        <div class="col-md-6">
                            <div class="card mb-4 mb-3">
                                <div class="card-body">
                                    <div class="card-title mb-3">
                                        <h4>
                                            {{($address->first_name??$user->first_name) . ' ' . ($address->last_name??$user->last_name)}}
                                        </h4>
                                        <span>
                                            {{$address->created_at->diffForHumans()}}
                                        </span>

                                    </div>

                                    <hr/>

                                    <div class="row mb-2">
                                        <div class="col-sm-4">
                                            <h6 class="mb-1 font-bold text-capitalize">
                                                {{__('auth.address')}}
                                            </h6>
                                        </div>
                                        <div class="col-sm-8">
                                            <h6 class="text-muted mb-1 text-capitalize font-bold" style="text-align: right;">
                                                {{$address->address}}
                                            </h6>
                                        </div>
                                    </div>

                                    <div class="row mb-2">
                                        <div class="col-sm-6">
                                            <h6 class="mb-1 font-bold text-capitalize">
                                                {{__('auth.phoneNumber')}}
                                            </h6>
                                        </div>
                                        <div class="col-sm-6">
                                            <h6 class="text-muted mb-1 text-capitalize font-bold" style="text-align: right;">
                                                {{$address->phone}}
                                            </h6>
                                        </div>
                                    </div>

                                    <div class="row mb-2">
                                        <div class="col-sm-4">
                                            <h6 class="mb-1 font-bold text-capitalize">
                                                {{__('auth.state')}}
                                            </h6>
                                        </div>
                                        <div class="col-sm-8">
                                            <h6 class="text-muted mb-1 text-capitalize font-bold" style="text-align: right;">
                                                {{App\Models\State::find($address->state_id??1)->name}}
                                            </h6>
                                        </div>
                                    </div>

                                    <div class="row mb-2">
                                        <div class="col-sm-4">
                                            <h6 class="mb-1 font-bold text-capitalize">
                                                {{__('auth.city')}}
                                            </h6>
                                        </div>
                                        <div class="col-sm-8">
                                            <h6 class="text-muted mb-1 text-capitalize font-bold" style="text-align: right;">
                                                {{App\Models\City::find($address->city_id??1)->name}}
                                            </h6>
                                        </div>
                                    </div>

                                    <div class="row mb-2">
                                        <div class="col-sm-6">
                                            <h6 class="mb-1 font-bold text-capitalize">
                                                {{__('auth.postal_code')}}
                                            </h6>
                                        </div>
                                        <div class="col-sm-6">
                                            <h6 class="text-muted mb-1 text-capitalize font-bold" style="text-align: right;">
                                                {{$address->postal_code}}
                                            </h6>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection
