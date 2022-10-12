@extends('website.layouts.master')

@section('title','Orders List')

@section('stylesheet')

@endsection

@section('content')

    <!--order tracking start-->
        <section class="order-tracking section-big-my-space  ">
            <div class="container" >
                <div class="row">
                    <div class="col-md-12">
                        <div id="msform">
                            @if($CartList && count($CartList)>0)
                                @include('website.components.orders.progressBar')
                                <form action="{{route('web.postNewOrder',['id'=>$user->id,'code'=>$orderCode])}}" method="post">
                                    @csrf
                                    @include('website.components.orders.productsList')
                                    @include('website.components.orders.contactDetails')
                                <form/>
                            @else
                                <fieldset>
                                    <div class="container p-0">
                                        <div class="row shpping-block">
                                            <div class="col-lg-12">
                                                <div class="order-tracking-contain order-tracking-box">
                                                    <div class="tracking-group">

                                                        <div class="row">
                                                            <div class="alert alert-primary text-center rounded" role="alert" style="font-weight: bold">
                                                                No products have been added to your Shopping Cart yet!
                                                            </div>
                                                            <div class="col-4 m-auto">
                                                                <div class="form-group">
                                                                    <a href="{{route('web.webHome')}}"
                                                                       class="btn btn-primary btn-md btn-block font-bold">
                                                                        <i data-feather="home" style="height: 17px;"></i>
                                                                        Back To Home
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="col-4 m-auto">
                                                                <div class="form-group">
                                                                    <a href="{{route('web.shoppingPage')}}"
                                                                       class="btn btn-primary btn-md btn-block font-bold">
                                                                        <i data-feather="shopping-bag" style="height: 17px;"></i>
                                                                        Go To Shopping
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <fieldset/>

                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <!--order tracking end-->

@endsection

@section('javascript')

    <!-- menu js-->
    <script src="{{asset("website/js/order-tracking.js")}}"></script>

@endsection
