<!DOCTYPE html>

<html lang="en">

<head>

    <title>{{env("APP_NAME")}}</title>

</head>

<body>

    <h4>{{ "Welcome".$mailData["name"] }}</h4>
    <span> We Are {{env("APP_NAME")}} Team </span> <br>
    <p>This Seller Verification Code: </p>
    <h3>{{ $mailData['code'] }}</h3>
    
    @component('mail::button', ['url' => $url ])
        Verify Now
    @endcomponent
    
<hr>
<strong>{{ config('app.name') }}</strong>
<p>Thank you</p>

</body>

</html>
