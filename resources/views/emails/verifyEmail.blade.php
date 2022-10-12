@component('mail::message')
# Verifcation Mail

<p> {{ $welcome }} </p>
<p>{{ $message }}<strong>{{ config('app.name') }}</strong></p>

@component('mail::button', ['url' => $url ])
Verify Now
@endcomponent

<hr>
<strong>{{ config('app.name') }}</strong>
@endcomponent
