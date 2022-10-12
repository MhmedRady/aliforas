<!--section start-->
<section class="login-page pwd-page section-big-py-space b-g-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="theme-card">
                    <h3>{{__("passwords.changePW")}}</h3>
                    <form class="theme-form" action="{{route('web.setNewPassword',['id'=>$id,'token'=>$token])}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="newPassword" requ>{{__('passwords.newPW')}}</label>
                                    <input id="newPassword" name="password" class="form-control" value="{{old("password")}}">
                                    @error('password')
                                    <div id="EmailFeedback" class="invalid-feedback font-85 d-block">
                                        <strong>{{$message}}</strong>
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="confirm_password" requ>{{__('passwords.confirmNewPW')}}</label>
                                    <input id="confirm_password" name="confirm_password" class="form-control" value="{{old("email")}}">
                                    @error('confirm_password')
                                    <div id="EmailFeedback" class="invalid-feedback font-85 d-block">
                                        <strong>{{$message}}</strong>
                                    </div>
                                    @enderror
                                </div>
                                @include('website.message.message')
                                <div class="form-group mb-0">
                                    <button type="submit" class="btn btn-normal">
                                        {{__("auth.save")}}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Section ends-->
