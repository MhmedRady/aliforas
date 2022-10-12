
@extends('admin.layouts.contentLayoutMaster')

@section('page-style')
    <style>
        table.dataTable td, table.dataTable th{
            text-align: center !important;
        }
    </style>
@endsection
@section('content')

@section('tableColumns')
{{--    <th>Title</th>--}}
    <th>Product</th>
    <th>image</th>
    <th>type</th>
    <th>status</th>
@endsection
@include('admin.table.ajaxTable-inline', [
    'url' => request()->url(),
    'createUrl' => request()->url() . '/create',
    'title' => 'Slider Tabs',
    'columns' => [ 'product', 'image', 'type','status'],
    'createPopup' => false
])
@endsection
