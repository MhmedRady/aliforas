<!--section start-->
    <section class="login-page pwd-page section-big-py-space b-g-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="theme-card">
                        <h3>{{__("Login.Reset Password")}}</h3>
                        <p class="font-8 mb-3 text-capitalize" style="color: #444;font-weight: bold;text-align: center"> {{__("auth.reset-p")}} </p>
                        <form class="theme-form" action="{{route("web.sendResetPW_Mail")}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input name="email" class="form-control" placeholder="example@domain.com" value="{{old("email")}}">
                                        @error('email')
                                            <div id="EmailFeedback" class="invalid-feedback font-85 d-block">
                                                <strong>{{$message}}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                    @include('website.message.message')
                                    <div class="form-group mb-0">
                                        <button type="submit" class="btn btn-normal">
                                            <i class="fa fa-paper-plane-o" aria-hidden="true"></i>
                                            {{__("auth.send")}}
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
