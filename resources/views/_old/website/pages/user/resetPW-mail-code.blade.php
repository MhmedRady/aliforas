<div class="_web_email">
    <style>
        .button-primary{
            margin-bottom: 30px !important;
            background-color: #0c78b6 !important;
            border-color: #0c78b6 !important;
            font-weight: bold !important;
            padding-top: 5px !important;
        }
    </style>
    <h4 style="text-align: center">{{__("auth.hiUser",['Name'=>$username])}}</h4>

    <p style="padding: 20px;text-align: center;"> {{$message}} </p>
    @component('mail::button', ['url' => $url ])
        {{__('passwords.resetNPW')}}
    @endcomponent
    <br/>
    <hr>
    <strong>{{ config('app.name') }}</strong>
</div>
