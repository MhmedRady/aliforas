
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
        {{__('auth.orderSuccess')}}
    </h5>
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
