@extends('root.layouts.app')
@section('title',__('auth.myOrders'))
@section('content')
    <!-- invoice start-->
    <section class="theme-invoice">
        <div class="container " >
            <div class="row">
                <div class="col-12">
                    <div class="invoice-popup overflow-auto">
                        <div>
                            <div class="row invoice-header">
                                <div class="checkout-header text-capitalize text-center font-weight-bold pb-5 mb-2" style="color: #444">
                                    <h2 class="text-center">{{__('layouts.BillingDetails')}}</h2>
                                </div>
                            </div>
                            <div class="invoice-breadcrumb">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="breadcrumb-left">
                                            <ul>
                                                <li>{{__('layouts.client')}}:-<span> {{$order->user_address->first_name . ' ' . $order->user_address->last_name}} </span></li>
                                                <li>{{__('auth.phoneNumber')}}:-<span> {{$order->user_address->phone}} </span></li>
                                                <li>{{__('auth.Email')}}:-<span> {{auth()->user()->email}} </span></li>

                                                <li>{{__('auth.city')}}:-<span> {{$order->user_address->city->name}} </span></li>
                                                <li>{{__('auth.state')}}:-<span> {{$order->user_address->state->name}} </span></li>

                                                <li>{{__('auth.address')}}:-<span> {{$order->user_address->address}} </span></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="breadcrumb-right">
                                            <ul>
                                                <li>{{__('layouts.orderDate')}}:- <span> {{$order->created_at->format('Y/m/d')}} </span></li>
                                                <li>{{__('layouts.orderReplayDate')}}:- <span>{{date('Y/m/d',strtotime($order->viewed_at))}}</span></li>
                                                <li>{{__('layouts.orderStatus')}}:- <span class="btn badge fw-bold {{$order->status->id == 6 ? 'btn-danger' : ($order->status->id == 5? 'btn-success':'btn-info')}}" style="color: #fff">
                                                        {{$order->status->name}}
                                                    </span>
                                                </li>
                                                @if(config('setting.pricing') === true)
                                                    @isset($order->shipped_at)
                                                        <li>
                                                            <strong>{{__('layouts.sippingDate')}} :</strong>
                                                            <span style="font-size: .95rem;">
                                                            {{date('Y/m/d',strtotime($order->shipped_at))}}
                                                        </span>
                                                        </li>
                                                    @endisset
                                                @endif
{{--                                                <li>Invoice No:-<span>909048</span></li>--}}
{{--                                                <li>Account Numbers:-<span>36590525744</span></li>--}}
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive-md">
                                <table class="invoice-table">
                                    <thead style="background-color: #00baf2;">
                                    <tr>

                                        <th>#</th>
                                        <th>{{__('layouts.productName')}}</th>
                                        <th>{{__('layouts.quantity')}}</th>
                                        <th>{{__('layouts.price')}}</th>
                                        <th>{{__('layouts.total')}}</th>

                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($order->orderProduct as $key => $item)
                                        <tr>
                                            <td class="text-center">{{$key+1}}</td>
                                            <td class="product-name">
                                                <a href="{{route('products.show',$item->product->slug)}}">
                                                    <h3>
                                                        {{$item->product->name}}
                                                    </h3>
                                                </a>
                                                <p></p>
                                            </td>
                                            <td class="text-center">{{$item->quantity}}</td>
                                            <td class="text-center">{{$item->price}}</td>
                                            <td class="text-center">{{$item->total}} EGP</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    @if(config('setting.pricing'))
                                        <tr>
                                            <td colspan="2"></td>
                                            <td colspan="2">{{__('layouts.subTotal')}}</td>
                                            <td>{{$order->total}} EGP</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"></td>
                                            <td colspan="2">{{__('layouts.shippingAmount')}}</td>
                                            <td>{{$order->shipping_amount}} EGP</td>
                                        </tr>
                                    @endif

                                    <tr>
                                        <td colspan="2"></td>
                                        <td colspan="2"></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td colspan="2">{{__('layouts.orderTotalPrice')}}</td>
                                        <td>{{$order->total +  $order->shipping_amount}} EGP</td>
                                    </tr>
                                    </tfoot>
                                </table>
{{--                                <div class="row print-bar">--}}
{{--                                    <div class="col-md-6">--}}
{{--                                        <div class="printbar-left">--}}
{{--                                            <button id="exportpdf" class="btn btn-solid btn-md">--}}
{{--                                                <i class="fa fa-file"></i>--}}
{{--                                                Export as PDF--}}
{{--                                            </button>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-6">--}}
{{--                                        <div class="printbar-right">--}}
{{--                                            <button id="printinvoice" class="btn btn-solid btn-md ">--}}
{{--                                                <i class="fa fa-print"></i>--}}
{{--                                                Print--}}
{{--                                            </button>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- invoice end -->
@endsection

@section('stylesheet')
    <style>
        thead th
        {
            color: #fff !important;
        }
        .theme-invoice .invoice-popup table.invoice-table th{
            text-align: center;
        }
        .theme-invoice .invoice-popup table.invoice-table tbody tr td{
            background-color: rgba(132, 215, 255, 0.3) !important;
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
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
@endsection

@push('scripts')

@endpush
