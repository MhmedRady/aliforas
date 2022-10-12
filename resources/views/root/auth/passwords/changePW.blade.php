@extends('root.auth.user-profile-setting')
@section('title',__('auth.changePass'))
@section('tabItem')

    <div id="_changePassword" class="col-lg-6 m-auto d-block">
        <div class="card mb-4">
            <div class="card-body">

                <h3 class="m-2 mb-4 text-capitalize">
                    {{__('auth.changePass')}}
                </h3>

                @include('root.message.message')
                <hr/>
                <button id="changePW_msg" class="btn btn-block mb-3 font-85 res_message" style="font-weight: bold;"></button>

                <form id="change_password_form" action="{{route("update-password")}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="currentPW" class="mb-0 font-bold">{{__("passwords.currentPW")}}</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="currentPW" name="currentPW">
                        </div>
                        @error('currentPW')
                        <div class="invalid-feedback font-85 d-block">
                            <strong>{{$message}}</strong>
                        </div>
                        @enderror
                        <div id="currentPW_error" class="invalid-feedback font-85 font-bold text-capitalize d-block" style="font-size: .85rem;">

                        </div>
                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-sm-4">
                            <label for="new_password" class="mb-0 font-bold">{{__("passwords.newPW")}}</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="new_password" name="new_password">
                        </div>
                        @error('new_password')
                        <div class="invalid-feedback font-85 d-block">
                            <strong>{{$message}}</strong>
                        </div>
                        @enderror
                        <div id="new_password_error" class="invalid-feedback font-85 font-bold text-capitalize d-block" style="font-size: .85rem;">

                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-sm-4">
                            <label for="currentPW" class="mb-0 font-bold">{{__("auth.pwConfirm")}}</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                        </div>
                        @error('confirm_password')
                        <div class="invalid-feedback font-85 d-block">
                            <strong>{{$message}}</strong>
                        </div>
                        @enderror
                        <div id="confirm_password_error" class="invalid-feedback font-85 font-bold text-capitalize d-block" style="font-size: .85rem;">

                        </div>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-sm float-end font-bold mt-3">{{__('auth.saveChanges')}}</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection
