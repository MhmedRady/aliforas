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
    <title>{{ env('APP_NAME') }} Admin</title>


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
        <div class="login-register" style="background-image:url(../assets/images/background/login-register.jpg);">
            <div class="login-box card">
                <div class="card-body">

                    @error('message')
                        {{ $message }}
                    @enderror

                    {!! Form::open(['url' => route('admin.login')]) !!}

                            <h6>User Information</h6>
                            <section>
                                <div class="form-group">
                                {{ Form::label('email', 'Email') }}
                                {{ Form::text('email', null, ['class' => 'form-control']) }}
                                @error('name')
                                    {{$message}}
                                @enderror
                            </div>

                            <div class="form-group">
                                {{ Form::label('password', 'Password') }}
                                {{ Form::password('password', ['class' => 'form-control']) }}
                                @error('password')
                                    {{$message}}
                                @enderror
                            </div>

                            <div class="form-group">
                                {{ Form::label('remember', 'Remember Me') }}
                                {{ Form::checkbox('remember') }}
                                @error('remember')
                                    {{$message}}
                                @enderror
                            </div>


                            <div class="form-group">
                                {{ Form::submit('Submit', ['class' => 'btn btn-block btn-lg btn-info btn-rounded']) }}
                            </div>
                            </section>

                        {!! Form::close() !!}


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
