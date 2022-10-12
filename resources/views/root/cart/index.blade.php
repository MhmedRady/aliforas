@extends('root.layouts.app')

@section('stylesheet')
@endsection

@section('content')
    <!--section start-->
    <section class="cart-section section-big-py-space b-g-light">
        <div class="custom-container">
            @if(userCart()->isEmpty())
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 mb-5">
                            <div class="success-text">
                                <i class="fa fa-cart-plus" aria-hidden="true" style="color: #00c139;text-shadow: 0px 1px 0px #555;"></i>
                                <h2 class="m-2">
                                    {{__('layouts.cartEmptyH2')}}
                                </h2>
                                <p>
                                    {{__('layouts.cartEmpty')}}
                                </p>

                            </div>
                        </div>
                        <div class="col-md-4 m-auto">
                            <a href="{{route("products.index")}}" class="btn btn-primary btn-md btn-block font-bold">@lang('layouts.goShopping')</a>
                        </div>
                        <div class="col-md-4 m-auto">
                            <a href="{{route("index")}}" class="btn btn-outline-primary btn-md btn-block font-bold">@lang('layouts.backToHome')</a>
                        </div>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-sm-12">
                        <div class="alert cart-alert"></div>
                        <table class="table cart-table table-responsive-xs">
                            <thead>
                            <tr class="table-head">
                                <th scope="col">{{__('layouts.image')}}</th>
                                <th scope="col">{{__('layouts.productName')}}</th>
                                @if(config('setting.pricing'))
                                    <th scope="col">{{__('layouts.price')}}</th>
                                @endif
                                <th scope="col">{{__('layouts.quantity')}}</th>
                                @if(config('setting.pricing'))
                                    <th scope="col">{{__('layouts.total')}}</th>
                                @endif
                                <th scope="col">{{__('layouts.action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach(userCart()->getContent() as $item)
                                <tr id="cartItem">
                                    <td>
                                        <a href="{{ route('products.show', $item->associatedModel->slug) }}">
                                            @include('root.components.lazy-image', [
                                                    'default' => 'storage/uploads/312x340/default.png',
                                                    'url' => $item->associatedModel->images->count() > 0 ?  $item->associatedModel->images->first()->image_url(312, 340) : null,
                                                    'alt' => 'product',
                                                    'class' => 'img-fluid',
                                                ])
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('products.show', $item->associatedModel->slug) }}">
                                            {{ $item->associatedModel->name }}
                                            {{ $item->associatedModel->name }}
                                            @if($item->attributes->count())
                                             -  {{ $item->attributes->first()->attribute->parentAttr->name??'' }}
                                                {{ $item->attributes->first()->attribute->name??'' }}
                                            @endif
                                        </a>
                                        <div class="mobile-cart-content">
                                            <div class="col-xs-3">
                                                <div class="qty-box">
                                                    <div class="input-group border-0">

                                                        <input type="number" name="quantity" data-cart-route="{{route('cart.quantity',['item_id'=>$item->id])}}"
                                                               class="form-control input-number w-100 _cartItemCount"
                                                               data-item-price="{{$item->price}}" autocomplete="off"
                                                               value="{{$item->quantity}}" min="1" maxlength="{{$item->associatedModel->stock}}">
                                                        <button class="cart-item-update btn btn-primary w-100" style="padding: 0px 10px;margin: 0px;border-radius: 0px 0px 5px 5px;height: 20px;" type="button" data-total-item="#cart-total-item">
                                                            <i class="fa fa-refresh"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>

                                            @if(config('setting.pricing'))
                                                <div class="col-xs-3">
                                                    <h2>{{($item->price)}} EGP</h2>
                                                </div>
                                            @endif
                                            <div class="col-xs-3">
                                                <h2 class="td-color">
                                                    <a href="{{route('cart.product.remove',$item->id)}}" class="icon btn btn-outline-danger" style="font-size: 14px;">
                                                        <i class="ti-close"></i>
                                                    </a>
                                                </h2>
                                            </div>
                                        </div>
                                    </td>
                                    @if(config('setting.pricing'))
                                        <td>
                                            <h2>{{($item->price)}} EGP</h2>
                                        </td>
                                    @endif
                                    <td>
                                        <div class="qty-box">
                                            <div class="input-group">
                                                <input type="number" name="quantity" data-cart-route="{{route('cart.quantity',['item_id'=>$item->id])}}"
                                                       class="form-control input-number _cartItemCount"
                                                       data-item-price="{{$item->price}}" autocomplete="off"
                                                       value="{{$item->quantity}}" min="1" maxlength="{{$item->associatedModel->stock}}">
                                                <button class="cart-item-update btn btn-primary" style="padding: 0px 10px;margin: 0px;" type="button" data-total-item="#cart-total-item_{{$item->id}}">
                                                    <i class="fa fa-refresh"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                    @if(config('setting.pricing'))
                                        <td><h2 id="cart-total-item_{{$item->id}}" class="td-color item-total"><span>{{($item->quantity * $item->price)}}</span> EGP </h2></td>
                                    @endif
                                    <td>
                                        <a href="{{route('cart.product.remove',$item->id)}}" class="icon btn btn-outline-danger" style="font-size: 14px;">
                                            <i class="ti-close"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @if(config('setting.pricing'))
                            <table class="table cart-table table-responsive-md">
                                <tfoot>
                                    <tr>
                                        <td>{{__('layouts.orderPrice')}} :</td>
                                        <td>
                                            <h2 id="subTotal">
                                                <span>{{$totalPrices['sub_total']}} EGP</span>
                                            </h2>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        @endif
                    </div>
                </div>
                <div class="row cart-buttons">
                    <div class="col-12">
                        <a href="{{route("products.index")}}" class="btn btn-outline-success">
                            {{__('layouts.goShopping')}}
                        </a>
                        <a href="{{route('cart.checkout')}}" class="btn btn-success ms-3">
                            {{config('setting.pricing') ?  __('layouts.checkout') : __('layouts.priceRequest')}}
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </section>
    <!--section end-->
@endsection

@push('scripts')

@endpush
