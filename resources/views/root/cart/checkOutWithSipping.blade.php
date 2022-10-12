@extends('root.layouts.app')
@section('stylesheet')
    <style>
        .theme-invoice .invoice-popup table.invoice-table th{
            text-align: center;
        }
        .theme-invoice .invoice-popup table.invoice-table tbody tr td{
            background-color: rgba(65, 80, 181, 0.1) !important;
            text-align: center;
        }
        .product-name
        {
            text-transform: capitalize !important;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 100px;
        }
        .product-name h3{
            text-align: start;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .product-name h3 a{
            color: #777;
        }
    </style>
@endsection
@section('content')
    <!-- invoice start-->
    <section class="theme-invoice">
        <div class="container" >
            <div class="row">
                <div class="col-12">
                    <div class="invoice-popup overflow-auto">
                        <div>
                            <form action="{{route('cart.order.checkout')}}" method="post">
                                @csrf
                                @method('POST')
                                <div class="checkout-header text-capitalize text-center font-weight-bold pb-5 mb-2" style="color: #444">
                                    <h2 class="text-center">{{__('layouts.checkOrder')}}</h2>
                                </div>
                                <div class="invoice-breadcrumb">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="breadcrumb-left">
                                                <ul>
                                                    <li>{{__('layouts.client')}}:-<span> {{$order->get('first_name', auth()->user()->first_name) . ' ' . $order->get('last_name', auth()->user()->last_name)}} </span></li>
                                                    <li>{{__('auth.phoneNumber')}}:-<span> {{$order->get('phone', auth()->user()->phone)}} </span></li>
                                                    <li>{{__('auth.Email')}}:-<span> {{auth()->user()->email}} </span></li>
                                                    <li>{{__('layouts.orderDate')}}:- <span> {{\Carbon\Carbon::now()->toDateString()}} </span></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="breadcrumb-right">
                                                <ul>
                                                    <li>{{__('auth.city')}}:-<span> {{$state->cities->find($order->get('city_id',1))->name}} </span></li>
                                                    <li>{{__('auth.state')}}:-<span> {{$state->name}} </span></li>
                                                    <li>{{__('auth.postal_code')}}:-<span> {{$order->get('postal_code', '-')}} </span></li>
                                                    <li>{{__('auth.address')}}:-<span> {{$order->get('address')}} </span></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="d-none">
                                            <input type="hidden" readonly name="first_name" value="{{$order->get('first_name', auth()->user()->first_name)}}">
                                            <input type="hidden" readonly name="last_name" value="{{$order->get('last_name', auth()->user()->last_name)}}">
                                            <input type="hidden" readonly name="email" value="{{$order->get('email', auth()->user()->email)}}">
                                            <input type="hidden" readonly name="phone" value="{{$order->get('phone', auth()->user()->phone)}}">
                                            <input type="hidden" readonly name="address" value="{{$order->get('address')}}">
                                            <input type="hidden" readonly name="postal_code" value="{{$order->get('postal_code')}}">
                                            <input type="hidden" readonly name="address" value="{{$order->get('address')}}">
                                            <input type="hidden" readonly name="state_id" value="{{$order->get('state_id')}}">
                                            <input type="hidden" readonly name="city_id" value="{{$order->get('city_id')}}">
                                            @if($order->has('user_address_id'))
                                                <input type="hidden" readonly name="user_address_id" value="{{$order->get('user_address_id')}}">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive-md">
                                    <table class="invoice-table " >
                                        <thead>
                                        <tr>
                                            <th>#.</th>
                                            <th>{{__('layouts.productName')}}</th>
                                            <th>{{__('layouts.quantity')}}</th>
                                            <th>{{__('layouts.price')}}</th>
                                            <th>{{__('layouts.total')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach(userCart()->getContent() as $key => $item)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td class="product-name">
                                                    <h3>
                                                        <a class="font-bold text-capitalize"
                                                           href="{{ route('products.show', $item->associatedModel->slug) }}">
                                                            @include('root.components.lazy-image', [
                                                                'default' => 'storage/uploads/312x340/default.png',
                                                                'url' => $item->associatedModel->images->count() > 0 ?  $item->associatedModel->images->first()->image_url(35, 35) : null,
                                                                'alt' => 'product',
                                                                'class' => 'img-thumbnail',
                                                            ])
                                                           {{ $item->associatedModel->name }}
                                                            @if($item->attributes->count())
                                                                @php($attr = \App\Models\AttributeProduct::find($item->attributes->first()['id']))
                                                                @if($attr)
                                                                    -  {{ $attr->attribute->parentAttr->name??'' }}
                                                                    {{ $attr->attribute->name??'' }}
                                                                @endif
                                                            @endif
                                                        </a>
                                                    </h3>
                                                </td>
                                                <td>{{$item->quantity}}</td>
                                                <td>{{$item->price}}</td>
                                                <td class="text-center">{{round($item->quantity * $item->price)}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td colspan="2"></td>
                                            <td colspan="2">{{__('layouts.subTotal')}}</td>
                                            <td class="text-center">{{$totalPrices['sub_total']}} EGP</td>
                                        </tr>
                                        @if($tax)
                                        <tr>
                                            <td colspan="2"></td>
                                            <td colspan="2">{{__('layouts.taxes')}} x {{$tax->value}}%</td>
                                            <td class="text-center">{{$totalPrices['taxes']}} EGP</td>
                                        </tr>
                                        @endif
                                        <tr>
                                            <td colspan="2"></td>
                                            <td colspan="2">{{__('layouts.shippingAmount')}}</td>
                                            <td class="text-center">{{$totalPrices['sipping']}} EGP</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"></td>
                                            <td colspan="2">{{__('layouts.orderTotalPrice')}}</td>
                                            <td class="text-center">{{$totalPrices['total']}} EGP</td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                    <div class="row print-bar">
                                        <div class="col-md-9">

                                        </div>
                                        <div class="col-md-3">
                                            <button class="btn btn-primary btn-lg btn-block float-end fw-bold" style="background-color: rgb(60, 86, 255);">{{__('layouts.checkout')}}</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- invoice end -->

@endsection
@push('scripts')

@endpush
