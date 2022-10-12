@component('mail::message')
    # Reset Password Mail
    <h3>{{ env('APP_NAME') }}</h3>
    <p>{!! $message !!} </p>
    @component('mail::button', ['url' => $url ])
        Reset Password
    @endcomponent
    <hr>
    <strong>{{ config('app.name') }}</strong>
@endcomponent
