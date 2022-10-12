<!--section start-->
    <section class="login-page section-big-py-space b-g-light">
        <div class="custom-container">
            <div class="row">
                <div class="col-lg-4 offset-lg-4">
                    <div class="theme-card">
                        <h3 class="text-center">{{__("Login.Register")}}</h3>

                        @include('website.message.message')

                        <form class="theme-form" action="{{route("web.addNew-user")}}" method="post">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-12 form-group">
                                    <label for="fName" requ>{{__("contact.First Name")}}</label>
                                    <input type="text" class="form-control" id="fName" name="first_name" required="" value="{{old("first_name")}}">
                                    @error('first_name')
                                        <div id="fNameFeedback" class="invalid-feedback font-85 d-block">
                                            <strong>{{$message}}</strong>
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for="lName" requ>{{__("contact.Last Name")}}</label>
                                    <input type="text" class="form-control" id="lName" name="last_name" required="" value="{{old("last_name")}}">
                                    @error('last_name')
                                        <div id="lNameFeedback" class="invalid-feedback font-85 d-block">
                                            <strong>{{$message}}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col-md-12 form-group">
                                    <label for="email" requ>{{__("User.Email")}}</label>
                                    <input type="text" id="email" class="form-control" name="email" placeholder="example@domain.com" required="" value="{{old("email")}}">
                                    @error('email')
                                        <div id="emailFeedback" class="invalid-feedback font-85 d-block">
                                            <strong>{{$message}}</strong>
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for="password" requ>{{__("home.Password")}}</label>
                                    <input type="password" id="password" class="form-control" name="password" placeholder="{{__("User.Password PlaceHolder")}}" required="">
                                    @error('password')
                                        <div id="passwordFeedback" class="invalid-feedback font-85 d-block">
                                            <strong>{{$message}}</strong>
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-12 form-group">
                                    <button type="submit" class="btn btn-normal">{{__("User.Register")}}</button>
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col-md-12 ">
                                    <p >{{__("auth.haveAccount")}} &nbsp;<a href="{{route("web.login")}}" class="txt-default" style="font-weight: bold">{{__("Review.Login")}}</a></p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
<!--Section ends-->
