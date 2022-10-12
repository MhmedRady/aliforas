@component('mail::message')
    # {{ env('APP_NAME') }} Products Offers
    @foreach($products as $product)
        ## {{ optional($product->translate('en'))->name}}
        > Price: {{$product->price}}
        > PriceBefore: {{$product->before_price}}

    @endforeach
    Thanks,
    {{ config('app.name') }}
@endcomponent
