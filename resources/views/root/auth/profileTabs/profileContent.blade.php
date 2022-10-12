@extends('root.auth.user-profile-setting')
@section('title',__('auth.PERSONAL DETAIL'))
@section('tabItem')
    <div class="col-lg-8 _profileContent d-block">
        <div class="card mb-4">
            <div class="card-body">

                <h3 class="m-2 mb-4 text-capitalize">
                    {{__('auth.PERSONAL DETAIL')}}
                </h3>
                <hr/>
                <div class="row">
                    <div class="col-sm-3">
                        <p class="mb-0 font-bold">{{__('auth.fullName')}}</p>
                    </div>
                    <div class="col-sm-9">
                        <p class="text-muted mb-0">{{$user->name}}</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <p class="mb-0 font-bold">{{__('auth.Email')}}</p>
                    </div>
                    <div class="col-sm-9">
                        <p class="text-muted mb-0">{{$user->email}}</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <p class="mb-0 font-bold">{{__('auth.phoneNumber')}}</p>
                    </div>
                    <div class="col-sm-9">
                        <p class="text-muted mb-0">{{$user->phone}}</p>
                    </div>
                </div>
                <hr>
                @if(config('setting.pricing') === false)
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0 font-bold">{{__('auth.workPlace')}}</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0">{{$user->employer}}</p>
                        </div>
                    </div>
                    <hr>
                @endif
                <div class="row">

                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0 font-bold">{{__('auth.age')}}</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{$user->age}}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-sm-6">
                                <p class="mb-0 font-bold">{{__('auth.birthDate')}}</p>
                            </div>
                            <div class="col-sm-6">
                                <p class="text-muted mb-0">{{$user->dob??'--/--/--'}}</p>
                            </div>
                        </div>
                    </div>

                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <p class="mb-0 font-bold">{{__('auth.gender')}}</p>
                    </div>
                    <div class="col-sm-9">
                        <p class="text-muted mb-0">{{$user->gender}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
