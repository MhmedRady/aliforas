<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <title>Aliforas Seller</title>


    <link href="{{asset('admin-asset/dist/css/pages/login-register-lock.css')}}" rel="stylesheet">
    <link href="{{asset('admin-asset/dist/css/style.min.css')}}" rel="stylesheet">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="skin-default card-no-border">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">Elite admin</p>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <section id="wrapper">

        <div class="login-register {{\Lang::getLocale() == "en" ? "text-left": "text-right"}}"
             style="background-image:url(../assets/images/background/login-register.jpg);">
            
            @if($errors->any())
                @error('errorLogin')
                    <div id="Post-error" style="max-width: 400px;margin: 0 auto;"
                        class="btn btn-lg btn-block btn-danger font-weight-bold text-capitalize box-shadow-2 mb-2">
                        {{$errors->first()}}
                    </div>
                @enderror
            @endif
            <div class="login-box card">
                <div class="card-body">

                    @error('message')
                        {{ $message }}
                    @enderror
                    
                    {!! Form::open(['url' => route("seller.postLogin")]) !!}

                            <h6 class="text-center font-weight-bold">{{__("seller.Info")}}</h6>
                            <section>
                                
                                <div class="inner-cl ml-auto" style="font-size: 1.1rem;">
                                    <div class="block block-language form-language mr-2 ml-2 mb-3 mt-3" style="background-color: #006099;color: #eee;padding: 5px; margin-left: auto !important;max-width: max-content;">
                                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                        @if (\Lang::getLocale() == $localeCode)
                                            <span>
                                                <img class="m-1" src="{{ asset( "website/images/panel/{$localeCode}.png") }}" srcset="">
                                                {{ $properties['native'] }}
                                            </span>    
                                        @else
                                            <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                                <img class="m-1" src="{{ asset( "website/images/panel/{$localeCode}.png") }}" srcset="">
                                                {{ $properties['native'] }}
                                            </a>
                                        @endif
                                    @endforeach
                                    </div>
                                </div>

                            <div class="form-group">
                                {{ Form::label('ContactNum', __("seller.ContactNum")) }}
                                {{ Form::text('ContactNum', old('contact_number'),['class' => 'form-control']) }}
                                @error('name')
                                    {{$message}}
                                @enderror
                            </div>

                            <div class="form-group">
                                {{ Form::label('password', __('seller.Password') ) }}
                                {{ Form::password('password', ['class' => 'form-control']) }}
                                @error('password')
                                    {{$message}}
                                @enderror
                            </div>

                            <div class="form-group">
                                {{ Form::label('remember', __('seller.Remember') ) }}
                                {{ Form::checkbox('remember') }}
                                @error('remember')
                                    {{$message}}
                                @enderror
                            </div>

                            <div class="form-group">
                                {{ Form::submit(  __("seller.Submit"), ['class' => 'btn btn-block btn-lg btn-info btn-rounded']) }}
                            </div>
                        </section>

                        {!! Form::close() !!}
                        <a class="btn badge btn-info font-weight-bold" style="font-size:.8rem" href="{{route('sellers.register')}}">{{ __("seller.regSeller") }}</a>

                </div>
            </div>
        </div>
    </section>

    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{asset('admin-asset/assets/node_modules/jquery/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('admin-asset/assets/node_modules/popper/popper.min.js')}}"></script>
    <script src="{{asset('admin-asset/assets/node_modules/bootstrap/dist/js/bootstrap.min.js')}}"></script>


    <script type="text/javascript">
        $(function() {
            $(".preloader").fadeOut();
        });
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        });
        // ==============================================================
        // Login and Recover Password
        // ==============================================================
        $('#to-recover').on("click", function() {
            $("#loginform").slideUp();
            $("#recoverform").fadeIn();
        });
    </script>

</body>

</html>
