@component('mail::layout')
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            {{ config('app.name') }}
        @endcomponent
    @endslot

    <h4>
        #{{__("auth.hiUser",['Name'=>$user->name])}},
    </h4>
    <h5>
        {{$message}}
    </h5>
    <a href="{{ $url }}" class="button button-primary" target="_blank" rel="noopener" style="">
        {{__('passwords.resetNPW')}}
    </a>
    <strong>
        {{__('layouts.thanks')}},
    </strong>
    <strong>
        {{ config('app.name') }}
    </strong>
    @slot('footer')
        @component('mail::footer')
            © {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')
        @endcomponent
    @endslot
@endcomponent
