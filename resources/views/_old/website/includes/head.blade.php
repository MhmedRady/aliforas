<head>
    <title>@yield('title', env('APP_NAME'))</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="big-deal">
    <meta name="keywords" content="aliforas.com">
    <meta name="author" content="big-deal">
    <link rel="icon" href="{{ env('FAVICON_PATH') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ env('FAVICON_PATH') }}" type="image/x-icon">

    <!--Google font-->
    <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300&display=swap" rel="stylesheet">
    <!--icon css-->
    <link rel="stylesheet" type="text/css" href="{{asset("website/css/font-awesome.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("website/css/themify.css")}}">

    <!--Slick slider css-->
    <link rel="stylesheet" type="text/css" href="{{asset("website/css/slick.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("website/css/slick-theme.css")}}">

    <!--Animate css-->
    <link rel="stylesheet" type="text/css" href="{{asset("website/css/animate.css")}}">
    <!-- Bootstrap css -->
    <link rel="stylesheet" type="text/css" href="{{asset("website/css/bootstrap.css")}}">

    <!-- Theme css -->
    <link rel="stylesheet" type="text/css" href="{{asset("website/css/color5.min.css")}}" media="screen" id="color">
    <link rel="stylesheet" type="text/css" href="{{asset("website/css/myStyle.css")}}" media="screen" id="myStyle">
    @yield('stylesheet')

  </head>
