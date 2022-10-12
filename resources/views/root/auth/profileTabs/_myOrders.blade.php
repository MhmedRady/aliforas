@extends('root.auth.user-profile-setting')
@section('title',__('auth.myOrders'))
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
                        <div class="col-md-6">
                            <div class="card mb-4 mb-3">
                                <div class="card-body">

                                    <div class="card-title mb-3">
                                        <h4>
                                            {{$order->user_address->first_name .' ' .$order->user_address->last_name}}
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
                                    <hr/>
                                    <div class="row">
                                        <div class="col-sm-9">
                                            <h4 class="mb-1 font-bold text-capitalize">{{__('layouts.productName')}}</h4>
                                        </div>
                                        <div class="col-sm-3">
                                            <h6 class="text-muted mb-1 text-capitalize font-bold">{{__('layouts.quantity')}}</h6>
                                        </div>
                                    </div>

                                    @foreach($order->orderProduct as $item)
                                        <div class="row">
                                            <div class="col-sm-9">
                                                <p class="mb-1 font-bold" style="overflow: hidden;">
                                                    {{$item->product->name}}
                                                </p>
                                            </div>
                                            <div class="col-sm-3">
                                                <p class="text-muted mb-1">x {{$item->quantity}}</p>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                                @if($order->admin_id)
                                    <a href="{{route('viewOrderPrices',$order)}}" class="btn btn-primary fw-bold" style="border-radius: 0 0 5px 5px;">
                                        <i class="fa fa-list-alt"></i>
                                        {{__('layouts.pricesList')}}
                                    </a>
                                @endif
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
