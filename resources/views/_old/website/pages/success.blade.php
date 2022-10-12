@extends('website.layouts.master')

@section('title',$Bill->title)

@section('stylesheet')

@endsection

@section('content')

    <section class="section-big-py-space light-layout">
        <div class="custom-container">
            <div class="checkout-page contact-page">
                <div class="row">
                    <div class="col-md-12">
                        <div class="success-text"><i class="fa fa-check-circle" aria-hidden="true"></i>
                            <h2>thank you</h2>
                            <p>Price Request Save is successfully your order is on the way</p>
                            <p>Order ID:{{$Bill->code}}</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12 col-xs-12 m-auto">

                        <div class="checkout-details theme-form  section-big-mt-space">
                            <div class="order-box">
                                <h2 class="text-center p-3 m-2 font-bold btn btn-primary btn-block mb-4">Billing Details</h2>
                                <div class="title-box">
                                    <div>Product <span>Quantity</span></div>
                                </div>
                                <ul class="qty" style="max-height: 200px;overflow: hidden auto;">
                                    @foreach($Bill->products as $product)
                                        <li>{{$product['name']}}
{{--                                            <strong>× {{$product['quantity']}}</strong>--}}
                                            <span><strong>× {{$product['quantity']}}</strong></span>
                                        </li>
                                    @endforeach
                                </ul>
{{--                                <ul class="sub-total">--}}
{{--                                    <li>Subtotal <span class="count">EGP {{$Bill->subTotal}}</span></li>--}}
{{--                                    <li>Tax <span class="count">EGP %14.0</span></li>--}}
{{--                                </ul>--}}
                                <ul class="total">
                                    <li>Total <span class="count"> <strong>{{$Bill->Quantities}}</strong> </span></li>
                                </ul>
                            </div>
                            <div class="payment-box">
                                <div class="text-right mt-3 mb-3"><a href="javascript:void(0)" class="btn-primary btn">Print Billing Details</a></div>
                                <div class="text-right mb-3"><a href="{{route('web.shoppingPage')}}" class="btn-dark btn">Continue Shopping</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('javascript')

@endsection
