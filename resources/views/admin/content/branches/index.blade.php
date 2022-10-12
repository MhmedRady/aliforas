@extends('admin.layouts.contentLayoutMaster')
@section('content')

@section('tableColumns')

{{--    @if(Session::has('success'))--}}
{{--        <button class="btn btn-block btn-success m-auto mb-0 mt-1 font-85 d-flex w-auto font-bold" style="font-weight: bold;">--}}
{{--            {{Session::get('success')}}--}}
{{--        </button>--}}
{{--    @endif--}}

    <th>Name</th>
    <th>Seller</th>
    <th>{{__('layouts.products')}}</th>
    <th>Active</th>
@endsection
@include('admin.table.ajaxTable-inline', [
    'url' => request()->url(),
    'title' => 'Branches',
    'columns' => ['name','seller', 'products', 'is_active'],
    'createPopup' => false
])
@endsection
