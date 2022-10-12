<!--section start-->
<section class="login-page section-big-py-space b-g-light">
    <div class="custom-container">
        <div class="row">
            <div class="col-lg-4 offset-lg-4">
                <div class="theme-card">
                    <h3 class="text-center">{{__("passwords.changePW")}}</h3>

                    @include('website.message.message')

                    <form class="theme-form" action="{{route("web.put-change-password",auth()->id())}}" method="post">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-12 form-group">
                                <label for="currentPW" requ>{{__("passwords.currentPW")}}</label>
                                <input type="text" class="form-control" id="currentPW" name="currentPW" required="">
                                @error('currentPW')
                                <div id="lNameFeedback" class="invalid-feedback font-85 d-block">
                                    <strong>{{$message}}</strong>
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="password" requ>{{__("passwords.newPW")}}</label>
                                <input type="text" class="form-control" id="password" name="password" required="" value="{{old("newPW")}}">
                                @error('password')
                                <div id="fNameFeedback" class="invalid-feedback font-85 d-block">
                                    <strong>{{$message}}</strong>
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="confirm_password" requ>{{__("passwords.confirmNewPW")}}</label>
                                <input type="text" class="form-control" id="confirm_password" name="confirm_password" required="" value="{{old("confirmNewPW")}}">
                                @error('confirm_password')
                                <div id="lNameFeedback" class="invalid-feedback font-85 d-block">
                                    <strong>{{$message}}</strong>
                                </div>
                                @enderror
                            </div>

                        </div>
                        <div class="row g-3">
                            <div class="col-md-12 form-group">
                                <button type="submit" class="btn btn-normal">{{__("auth.save")}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Section ends-->
