<!doctype html>
<html lang="en">
<head>
    <title>Activate Account</title>
</head>
<body>
<main dir="ltr">
    <header dir="ltr"
            style="overflow:hidden;padding: 0 15px;">
        <div style="text-align: left">
{{--            <img src="https://qrpastpapers.com/eimages/activation_code.png" style="float: right;max-width: 400px">--}}
            <h1 style="float: left;margin-top: 50px;margin-bottom: 0;min-width: 51%">
                Welcome
                <span style="padding: 10px;border-radius: 10px;background: #EEE">{{$people->firstName.' '.$people->lastName}}</span> In website</h1>
            <h3 style="float: left;margin-bottom: 0;min-width: 51%">We Are Happy That You Are Here</h3>
            <h3 style="float: left;margin-bottom: 0;min-width: 51%">Your Activation Code Is
                <span style="padding: 10px;border-radius: 10px;background: #EEE">{{$code}}</span>
            </h3>
        </div>
    </header>
</main>
</body>
</html>
