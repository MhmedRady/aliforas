@component('mail::message')
<h1>Hello {{$client->people->firstName}},</h1>
<P>Unfortunately, you are Blocked</P>
<p>
    {{$request->msg}}
</p>
Thanks,<br>
{{ config('app.name') }}
@endcomponent
