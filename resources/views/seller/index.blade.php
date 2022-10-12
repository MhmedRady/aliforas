@extends('seller.layouts.contentLayoutMaster')

@section('title', __('layouts.home'))

{{--@section('vendor-style')
    --}}{{-- vendor css files --}}{{--
    <link rel="stylesheet" href="{{ asset(mix('admin-asset/vendors/css/charts/apexcharts.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('admin-asset/vendors/css/extensions/toastr.min.css')) }}">
@endsection
@section('page-style')
    --}}{{-- Page css files --}}{{--
    <link rel="stylesheet" href="{{ asset(mix('admin-asset/css/base/pages/dashboard-ecommerce.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('admin-asset/css/base/plugins/charts/chart-apex.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('admin-asset/css/base/plugins/extensions/ext-component-toastr.css')) }}">
@endsection--}}

@section('content')
    <div class="container-fluid">
        <div class="content-body">
            <section id="dashboard-ecommerce">
                <div class="row match-height">
                    <div class="col-xl-12 col-md-12 col-12">
                        <div class="card card-statistics">
                            <div class="card-header pl-0">
                                <h4 class="card-title">{{__('layouts.statistics')}}</h4>
                                <div class="d-flex align-items-center">
                                    {{--                                    <p class="card-text font-small-2 mb-25 mb-0">Updated 1 month ago</p>--}}
                                </div>
                            </div>
                            <div class="card-body statistics-body" style="padding-top: 0 !important;">
                                <div class="row">
                                    <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                                        <div class="d-block flex-row text-center">
                                            <div class="avatar bg-light-primary mb-2">
                                                <div class="avatar-content">
                                                    <i data-feather="trending-up" class="avatar-icon"></i>
                                                </div>
                                            </div>
                                            <div class="my-auto">
                                                <h4 class="fw-bolder mb-0">{{$branchesCount??0}}</h4>
                                                <p class="card-text font-small-3 mb-0">{{__('seller.branches')}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                                        <div class="d-block flex-row text-center">
                                            <div class="avatar bg-light-info mb-2">
                                                <div class="avatar-content">
                                                    <i data-feather="archive" class="avatar-icon"></i>
                                                </div>
                                            </div>
                                            <div class="my-auto">
                                                <h4 class="fw-bolder mb-0">{{$ordersCount??0}}</h4>
                                                <p class="card-text font-small-3 mb-0">{{__('layouts.orders')}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
                                        <div class="d-block flex-row text-center">
                                            <div class="avatar bg-light-danger mb-2">
                                                <div class="avatar-content">
                                                    <i data-feather="box" class="avatar-icon"></i>
                                                </div>
                                            </div>
                                            <div class="my-auto">
                                                <h4 class="fw-bolder mb-0">{{$productsCount}}</h4>
                                                <p class="card-text font-small-3 mb-0">{{__('layouts.products')}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-sm-6 col-12">
                                        <div class="d-block flex-row text-center">
                                            <div class="avatar bg-light-success mb-2">
                                                <div class="avatar-content">
                                                    <i data-feather="dollar-sign" class="avatar-icon"></i>
                                                </div>
                                            </div>
                                            <div class="my-auto">
                                                <h4 class="fw-bolder mb-0">{{$ordersRevenue??0}}</h4>
                                                <p class="card-text font-small-3 mb-0">@lang('layouts.revenues')</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">{{__('layouts.bestSeller')}}</h4>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li>
                                            <a data-action="collapse">
                                                <i data-feather="chevron-down"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <div class="table-responsive">

                                        <table class="table table-bordered text-center">
                                            <thead>
                                            <tr>
                                                <th>{{__('layouts.productName')}}</th>
                                                <th>{{__('layouts.stock')}}</th>
                                                <th>{{__('layouts.actions')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @if($bestSeller->count() > 0)
                                                    @foreach($bestSeller as $item)
                                                    <tr>
                                                        <td>{{$item->name}}</td>
                                                        <td class="text-center">
                                                            <b>{{$item->stock}}</b>
                                                        </td><td class="text-center">
                                                            <a class="fw-3" href="{{route('seller.products.active',$item->id)}}">
                                                                <i data-feather="{{$item->is_active ? 'x-circle' : 'check-circle'}}" style="height: 25px; width: 25px;"></i>
                                                            </a>
                                                            <a class="fw-3" href="{{route('seller.products.edit',$item->id)}}">
                                                                <i data-feather="edit" style="height: 20px; width: 20px;"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                @else
                                                    <tr class="odd">
                                                        <td colspan="8" class="dataTables_empty" valign="top">
                                                            {{__('layouts.noTableItems')}}
                                                        </td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">{{__('layouts.latestOrders')}}</h4>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li>
                                            <a data-action="collapse"><i data-feather="chevron-down"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <div class="table-responsive">

                                        <table class="table table-bordered text-center">
                                            <thead>
                                            <tr>
                                                <th>{{__('layouts.productName')}}</th>

                                                <th>{{__('layouts.quantity')}}</th>
                                                <th>{{__('layouts.stock')}}</th>
                                                <th>{{__('layouts.total')}}</th>

                                                <th>{{__('layouts.actions')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if($orders->count() > 0)
                                                @foreach($orders as $order)
                                                    @if($order->orderProduct->count() > 0)
                                                        @foreach($order->orderProduct as $orderProducts)
                                                            @if($orderProducts->product->seller_id == \auth()->guard('seller')->id())
                                                                <tr>
                                                                    <td>{{$orderProducts->product->name}}</td>
                                                                    <td class="text-center">
                                                                        <b>{{$orderProducts->quantity}}</b>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <b>{{$orderProducts->product->stock}}</b>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <b>{{$orderProducts->total}}</b>
                                                                    </td>

                                                                    <td class="text-center">
{{--                                                                                                                                        <a class="fw-3" href="{{route('seller.products.active',$item->id)}}">--}}
{{--                                                                                                                                            <i data-feather="{{$item->is_active ? 'x-circle' : 'check-circle'}}" style="height: 25px; width: 25px;"></i>--}}
{{--                                                                                                                                        </a>--}}
                                                                        <a class="fw-3" href="{{route('seller.orders.show',$order)}}">
                                                                            <i data-feather="eye" style="height: 20px; width: 20px;"></i>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            @else
                                                <tr class="odd">
                                                    <td colspan="8" class="dataTables_empty" valign="top">
                                                        {{__('layouts.noTableItems')}}
                                                    </td>
                                                </tr>
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">{{__('layouts.latestProducts')}}</h4>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li>
                                            <a data-action="collapse">
                                                <i data-feather="chevron-down"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered text-center">
                                            <thead>
                                            <tr>
                                                <th>{{__('layouts.productName')}}</th>
                                                <th>{{__('layouts.stock')}}</th>
                                                <th>{{__('layouts.actions')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if($bestSeller->count() > 0)
                                                @foreach($bestSeller as $item)
                                                    <tr>
                                                        <td>{{$item->name}}</td>
                                                        <td class="text-center">
                                                            <b>{{$item->stock}}</b>
                                                        </td><td class="text-center">
                                                            <a class="fw-3" href="{{route('seller.products.active',$item->id)}}">
                                                                <i data-feather="{{$item->is_active ? 'x-circle' : 'check-circle'}}" style="height: 25px; width: 25px;"></i>
                                                            </a>
                                                            <a class="fw-3" href="{{route('seller.products.edit',$item->id)}}">
                                                                <i data-feather="edit" style="height: 20px; width: 20px;"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr class="odd">
                                                    <td colspan="8" class="dataTables_empty" valign="top">
                                                        {{__('layouts.noTableItems')}}
                                                    </td>
                                                </tr>
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">{{__('layouts.branches')}}</h4>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li>
                                            <a data-action="collapse">
                                                <i data-feather="chevron-down"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered text-center">
                                            <thead>
                                            <tr>
                                                <th>{{__('layouts.branchName')}}</th>
                                                <th>{{__('layouts.products')}}</th>
                                                <th>{{__('layouts.branchViews')}}</th>
                                                <th>{{__('layouts.actions')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if($branches->count() > 0)
                                                @foreach($branches as $item)
                                                    <tr>
                                                        <td>{{$item->name}}</td>
                                                        <td class="text-center">
                                                            <b>{{$item->products->count()}}</b>
                                                        <td class="text-center">
                                                            <b>{{$item->views}}</b>
                                                        </td><td class="text-center">
                                                            <a class="fw-3" href="{{route('seller.branch.activation',$item->id)}}">
                                                                <i data-feather="{{$item->is_active ? 'x-circle' : 'check-circle'}}" style="height: 25px; width: 25px;"></i>
                                                            </a>
                                                            <a class="fw-3" href="{{route('seller.branch.edit',$item->id)}}">
                                                                <i data-feather="edit" style="height: 20px; width: 20px;"></i>
                                                            </a>
                                                        </td>
                                                    </tr>

                                                @endforeach
                                            @else
                                                <tr class="odd">
                                                    <td colspan="8" class="dataTables_empty" valign="top">
                                                        {{__('layouts.noTableItems')}}
                                                    </td>
                                                </tr>
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection

{{--@section('vendor-script')
    --}}{{-- vendor files --}}{{--
    <script src="{{ asset(mix('admin-asset/vendors/js/charts/apexcharts.min.js')) }}"></script>
    <script src="{{ asset(mix('admin-asset/vendors/js/extensions/toastr.min.js')) }}"></script>
@endsection
@section('page-script')
    --}}{{-- Page js files --}}{{--
    <script src="{{ asset(mix('admin-asset/js/scripts/pages/dashboard-ecommerce.js')) }}"></script>
@endsection--}}
