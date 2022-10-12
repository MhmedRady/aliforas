@extends('root.auth.user-profile-setting')
@section('title',__('auth.myOrders'))
@section('stylesheet')
    <style>
        .viewOrderPrices{
            position: absolute;
            width: 100%;
            left: 0;
            bottom: 1px;
            height: 50px;
            padding: 0.7rem 0;
            font-size: 1.1rem;
        }
    </style>

@endsection
@section('tabItem')
    <div id="_myOrders" class="col-lg-8">
        <div class="card-body">
            <h3 class="m-2 mb-4 text-capitalize">
                {{__('auth.myOrders')}}
            </h3>
            <hr/>
            <div class="row">
                @if($user->userOrders->count()>0)
                    @foreach($user->userOrders as $order)
                        <div class="col-md-12">
                            <div class="card mb-4 mb-3">
                                <div class="card-body">

                                    <div class="card-title mb-3">
                                        <h4>
                                            {{$order->user_address->first_name?? \auth()->user()->first_name . ' ' . $order->user_address->last_name?? \auth()->user()->last_name}}
                                            @if($order->status->id == 1)
                                            <span class="badge btn-primary float-end">
                                                {{$order->status->name}}
                                            </span>
                                            @elseif($order->status->id == 5)
                                            <span class="badge btn-success float-end">
                                                {{$order->status->name}}
                                            </span>
                                            @elseif($order->status->id == 6 || $order->status->id == 7)
                                            <span class="badge btn-danger float-end">
                                                {{$order->status->name}}
                                            </span>
                                            @elseif($order->status->id == 3 || $order->status->id == 4)
                                            <span class="badge btn-warning float-end">
                                                {{$order->status->name}}
                                            </span>
                                            @else
                                            <span class="badge btn-info float-end">
                                                {{$order->status->name}}
                                            </span>
                                            @endif
                                        </h4>
                                        <span>{{$order->created_at->diffForHumans()}}</span>

                                    </div>
                                    <hr/>
                                    <div class="row mb-2">
                                        <div class="col-sm-4">
                                            <h6 class="mb-1 font-bold text-capitalize">
                                                {{__('auth.address')}}
                                            </h6>
                                        </div>
                                        <div class="col-sm-8">
                                            <h6 class="text-muted mb-1 text-capitalize font-bold" style="text-align: right;">
                                                {{$order->user_address->address}}
                                            </h6>
                                        </div>
                                    </div>

                                    <div class="row mb-2">
                                        <div class="col-sm-4">
                                            <h6 class="mb-1 font-bold text-capitalize">
                                                {{__('auth.state')}}
                                            </h6>
                                        </div>
                                        <div class="col-sm-8">
                                            <h6 class="text-muted mb-1 text-capitalize font-bold" style="text-align: right;">
                                                {{App\Models\State::find($order->user_address->state_id??1)->name}}
                                            </h6>
                                        </div>
                                    </div>

                                    <div class="row mb-2">
                                        <div class="col-sm-4">
                                            <h6 class="mb-1 font-bold text-capitalize">
                                                {{__('auth.city')}}
                                            </h6>
                                        </div>
                                        <div class="col-sm-8">
                                            <h6 class="text-muted mb-1 text-capitalize font-bold" style="text-align: right;">
                                                {{App\Models\City::find($order->user_address->city_id??1)->name}}
                                            </h6>
                                        </div>
                                    </div>
                                    <hr style="height: 5px;"/>
                                    <div class="table-responsive-md mb-3 text-center">
                                        <div class="card-title">
                                            <h4 style="font-size: 1.2rem;text-decoration: underline;">
                                                {{__('layouts.orderDetails')}}
                                            </h4>
                                        </div>
                                        <table class="invoice-table">
                                            <thead style="border-bottom: 1px solid #ccc;">
                                            <tr>
                                                <th>#</th>
                                                <th>{{__('layouts.productName')}}</th>
                                                <th>{{__('layouts.quantity')}}</th>
                                                @if(config('setting.pricing'))
                                                    <th>{{__('layouts.price')}}</th>
                                                    <th>{{__('layouts.total')}}</th>
                                                @endif
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($order->orderProduct->load('product') as $key => $item)
                                                    <tr>
                                                        <td>{{$key+1}}</td>
                                                        <td>
                                                            <h3>
                                                                {{$item->product->name}}
                                                            </h3>
                                                        </td>
                                                        <td>{{$item->quantity}}</td>
                                                        @if(config('setting.pricing'))
                                                            <td>{{$item->price}}</td>
                                                            <td>{{$item->total}}</td>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                            </tbody>

                                        </table>
                                        @if($order->admin_id)
                                            <div class="row print-bar">
                                                <div class="col-md-6">
                                                    <div class="printbar-left">

                                                            <a href="{{route(config('setting.pricing') ? 'view.related.orders.details' : 'viewOrderPrices' ,$order)}}" target="_blank" class="btn btn-primary fw-bold viewOrderPrices" style="border-radius: 0 0 5px 5px;">
                                                                <i class="fa fa-list-alt"></i>
                                                                {{__('layouts.BillingDetails')}}
                                                            </a>

                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
{{--                                    @foreach($order->orderProduct as $item)--}}
{{--                                        <div class="row">--}}
{{--                                            <div class="col-sm-9">--}}
{{--                                                <p class="mb-1 font-bold" style="overflow: hidden;">--}}
{{--                                                    {{$item->product->name}}--}}
{{--                                                </p>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-sm-3">--}}
{{--                                                <p class="text-muted mb-1">x {{$item->quantity}}</p>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    @endforeach--}}

                                </div>

                            </div>
                        </div>
                    @endforeach
                @else
                    <h4>{{__('layouts.noOrders')}}</h4>
                    <div class="col-4">
                        <a href="{{route('products.index')}}" class="btn btn-primary btn-sm font-bold m-3">{{__('layouts.goShopping')}}</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
