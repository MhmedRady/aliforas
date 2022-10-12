@extends('seller.layouts.contentLayoutMaster')
@section('content')

@section('tableColumns')
{{--    @if(Session::has('success'))--}}
{{--        <button class="btn btn-block btn-success m-auto mb-0 mt-1 font-85 d-flex w-auto font-bold" style="font-weight: bold;">--}}
{{--            {{Session::get('success')}}--}}
{{--        </button>--}}
{{--    @endif--}}
    <th>@lang('Name')</th>
    <th class="branch-products">{{__('layouts.products')}}</th>
    <th class="branch-products">{{__('layouts.branchViews')}}</th>
    <th>{{__('layouts.activate')}}</th>
@endsection
@include('seller.table.ajaxTable-inline', [
    'url' => request()->url(),
    'createUrl' => request()->url() . '/create',
    'title' => __('layouts.branches'),
    'columns' => ['name', 'products', 'views', 'status'],
    'createPopup' => false
])
@endsection
