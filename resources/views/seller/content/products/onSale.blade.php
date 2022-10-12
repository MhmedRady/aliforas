@extends('seller.layouts.contentLayoutMaster')
@section('content')

@section('tableColumns')
    {{--    @if(Session::has('success'))--}}
    {{--        <button class="btn btn-block btn-success m-auto mb-0 mt-1 font-85 d-flex w-auto font-bold" style="font-weight: bold;">--}}
    {{--            {{Session::get('success')}}--}}
    {{--        </button>--}}
    {{--    @endif--}}
    <th>@lang('Name')</th>
    <th>@lang('layouts.image')</th>
    <th>{{__('layouts.category')}}</th>
    <th>{{__('layouts.brand')}}</th>
    <th>{{__('layouts.branch')}}</th>
    <th>{{__('layouts.company')}}</th>
    <th>{{__('layouts.activate')}}</th>
@endsection
@include('seller.table.ajaxTable-inline', [
    'url' => request()->url(),
    'createUrl' => route('seller.products.create'),
    'title' => __('layouts.on_sale'),
    'columns' => ['name', 'image' ,'category_title', 'brand_title', 'branch_title', 'manufacturer_title', 'status'],
    'createPopup' => false
])
@endsection
