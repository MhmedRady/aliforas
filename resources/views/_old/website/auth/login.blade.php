
<!--section start-->
    <section class="login-page section-big-py-space b-g-light">
        <div class="custom-container">
            <div class="row">
                <div class="col-xl-4 col-lg-6 col-md-8 offset-xl-4 offset-lg-3 offset-md-2">
                    <div class="theme-card">
                        <h3 class="text-center">{{__("Login.Login")}}</h3>

                        @include('website.message.message')

                        <form class="theme-form" action="{{route("web.userAuth")}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="Email">{{__("User.Email")}}</label>
                                <input id="Email" type="text" class="form-control" name="Email" value="{{old("Email")}}">
                                @error('Email')
                                    <div id="EmailFeedback" class="invalid-feedback font-85 d-block">
                                        <strong>{{$message}}</strong>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="Password">{{__("home.Password")}}</label>
                                <input id="Password" type="password" class="form-control" name="Password">
                                @error('Password')
                                    <div id="EmailFeedback" class="invalid-feedback font-85 d-block">
                                        <strong>{{$message}}</strong>
                                    </div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-normal">{{__("Login.Login")}}</button>
                            <a class="float-end txt-default mt-2" href="{{route("web.resetPassword")}}">{{__("Login.Forgot Your Password?")}}</a>
                            <a href="javascript:void(0)" class="btn btn-primary btn-md mt-3 p-2 btn-block">
                                <i class="fa fa-facebook-square" aria-hidden="true"></i>
                                {{__("Login.Login With Facebook")}}
                            </a>
                        </form>
                        <a href="{{route("web.user-register")}}" class="txt-default pt-3 badge btn-primary font-9" style="text-transform: capitalize;padding: 1rem !important;margin-top: 1rem;color: #fff;">{{__("Login.Register")}}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
<!--Section ends-->
