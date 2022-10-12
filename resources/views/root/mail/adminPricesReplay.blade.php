
@component('mail::layout')
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            {{ config('app.name') }}
        @endcomponent
    @endslot

    <h4>
        #{{__("auth.hiUser",['Name'=>$data->name])}},
    </h4>
    <h5>
        {{__('layouts.orderReply')}}
    </h5>
    <h5>
        {{__('layouts.orderTotalPrice')}} : {{$data->total}} EGP
    </h5>
    <a href="{{ route('viewOrderPrices',$data->order_id) }}" class="button button-primary" target="_blank" rel="noopener">
        {{__('layouts.showPriceRequest')}}
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
