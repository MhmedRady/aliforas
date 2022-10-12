@extends('admin.layouts.contentLayoutMaster')
@section('content')
@section('tableColumns')
    <th>Name</th>
    <th>Email</th>
@endsection
@include('admin.table.ajaxTable-inline', [
    'url' => request()->url(),
    'createUrl' => request()->url() . '/create',
    'title' => 'title',
    'columns' => ['name', 'email'],
    'createPopup' => false
])
@endsection
