@extends('admin.layouts.contentLayoutMaster')

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

        <div class="card-group">
            <div class="card">
                <div class="card-body">
                    <div class="row match-height">
                        <div class="col-xl-12 col-md-12 col-12">
                            <div class="card card-statistics">
                                <div class="card-header pl-0" style="padding-left: 0; padding-top: 0;">
                                    <h4 class="card-title">{{__('layouts.statistics')}}</h4>
                                    <div class="d-flex align-items-center">
                                        {{--                                    <p class="card-text font-small-2 mb-25 mb-0">Updated 1 month ago</p>--}}
                                    </div>
                                </div>
                                <div class="card-body statistics-body" style="padding: 0 !important;">
                                    <div class="row">
                                        @if(config('setting.pricing'))
                                            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                                            <div class="d-block flex-row text-center">
                                                <div class="avatar bg-light-primary mb-2">
                                                    <div class="avatar-content">
                                                        <i data-feather="trending-up" class="avatar-icon"></i>
                                                    </div>
                                                </div>
                                                <div class="my-auto">
                                                    <h4 class="fw-bolder mb-0">{{$branchesCount ?? 0}}</h4>
                                                    <p class="card-text font-small-3 mb-0">{{__('seller.branches')}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        @else
                                            <div class="{{ config('setting.pricing') ? 'col-xl-2' : 'col-xl-3' }} col-sm-6 col-12 mb-2 mb-xl-0">
                                                <div class="d-block flex-row text-center">
                                                    <div class="avatar bg-light-primary mb-2">
                                                        <div class="avatar-content">
                                                            <i data-feather="trending-up" class="avatar-icon"></i>
                                                        </div>
                                                    </div>
                                                    <div class="my-auto">
                                                        <h4 class="fw-bolder mb-0">{{$companiesCount}}</h4>
                                                        <p class="card-text font-small-3 mb-0">Companies</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="{{ config('setting.pricing') ? 'col-xl-2' : 'col-xl-3' }} col-sm-6 col-12 mb-2 mb-xl-0">
                                            <div class="d-block flex-row text-center">
                                                <div class="avatar bg-light-info mb-2">
                                                    <div class="avatar-content">
                                                        <i data-feather="dollar-sign" class="avatar-icon"></i>
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
                                        @if(config('setting.pricing'))
                                            <div class="col-xl-2 col-sm-6 col-12">
                                                <div class="d-block flex-row text-center">
                                                    <div class="avatar bg-light-success mb-2">
                                                        <div class="avatar-content">
                                                            <i data-feather="users" class="avatar-icon"></i>
                                                        </div>
                                                    </div>
                                                    <div class="my-auto">
                                                        <h4 class="fw-bolder mb-0">{{$sellersCount??0}}</h4>
                                                        <p class="card-text font-small-3 mb-0">Sellers</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="{{ config('setting.pricing') ? 'col-xl-2' : 'col-xl-3' }} col-sm-6 col-12">
                                            <div class="d-block flex-row text-center">
                                                <div class="avatar bg-light-success mb-2">
                                                    <div class="avatar-content">
                                                        <i data-feather="users" class="avatar-icon"></i>
                                                    </div>
                                                </div>
                                                <div class="my-auto">
                                                    <h4 class="fw-bolder mb-0">{{$usersCount??0}}</h4>
                                                    <p class="card-text font-small-3 mb-0">Customers</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Comment - table -->
        <!-- ============================================================== -->
        <div class="row">
            <!-- ============================================================== -->
            <!-- Comment widgets -->
            <!-- ============================================================== -->

            {{--            <div class="col-lg-6">--}}
            {{--                <div class="card">--}}
            {{--                    <div class="card-body">--}}
            {{--                        <h5 class="card-title">Recent Reviews</h5>--}}
            {{--                    </div>--}}
            {{--                    <!-- ============================================================== -->--}}
            {{--                    <!-- Comment widgets -->--}}
            {{--                    <!-- ============================================================== -->--}}
            {{--                    <div class="comment-widgets">--}}
            {{--                        @if($reviews->count() > 0)--}}
            {{--                            @foreach($reviews as $review)--}}
            {{--                                <div class="d-flex no-block comment-row @if($i==1) border-top @endif">--}}
            {{--                                <!-- <div class="p-2"><span class="round"><img src="{{ asset('admin-asset/assets/images/users/1.jpg') }}" alt="user" width="50"></span></div> -->--}}
            {{--                                    <div class="comment-text w-100">--}}
            {{--                                        <h5 class="font-medium">{{$review->user->name}}</h5>--}}
            {{--                                        <p class="m-b-10 text-muted">{{$review->review}}</p>--}}
            {{--                                        <div class="comment-footer">--}}
            {{--                                            <span class="text-muted pull-right">{{$review->created_at}}</span> <span--}}
            {{--                                                class="badge badge-pill badge-info">@if($review->approved == 0)--}}
            {{--                                                    Pending @else Approved @endif</span> <span class="action-icons"--}}
            {{--                                                                                               style="display: none">--}}
            {{--                                                    <a href="javascript:void(0)"><i class="ti-pencil-alt"></i></a>--}}
            {{--                                                    <a href="javascript:void(0)"><i class="ti-check"></i></a>--}}
            {{--                                                    <a href="javascript:void(0)"><i class="ti-heart"></i></a>--}}
            {{--                                                </span>--}}
            {{--                                        </div>--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                            @endforeach--}}
            {{--                        @endif--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </div>--}}

            <!-- ============================================================== -->
            <!-- Table -->
            <!-- ============================================================== -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div>
                                <h5 class="card-title">Recent Orders</h5>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover text-center no-wrap">
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>NAME</th>
                                <th>STATUS</th>
                                <th>DATE</th>
                                <th>PRICE</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($orders_recent->count() > 0)
                                @foreach($orders_recent as $key => $rec_order)
                                    <tr>
                                        <td class="text-center">
                                            {{$key+1}}
                                        </td>
                                        <td class="txt-oflo">
                                            {{$rec_order->user_address->first_name}} {{$rec_order->user_address->last_name}}</td>
                                        <td>
                                            <span>{{$rec_order->status->name}}</span>
                                        </td>
                                        <td class="txt-oflo">
                                            {{$rec_order->created_at}}
                                        </td>
                                        <td>
                                            <span class="text-success">{{$rec_order->total??0}} EGP</span>
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
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div>
                                <h5 class="card-title">New Companies</h5>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover text-center no-wrap">
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>NAME</th>
                                <th>PRODUCTS</th>
                                <th>DATE</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($companiesCount > 0)
                                @foreach($companies as $key => $companies)
                                    <tr>
                                        <td class="text-center">
                                            {{$key+1}}
                                        </td>
                                        <td class="txt-oflo">
                                            {{$companies->name}}</td>
                                        <td>
                                            <span>
                                                {{$companies->products->count()??0}}
                                            </span>
                                        </td>
                                        <td class="txt-oflo">
                                            {{$companies->created_at}}
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
