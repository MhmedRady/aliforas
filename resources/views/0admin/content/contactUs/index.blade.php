@extends('admin.layouts.contentLayoutMaster')

@section('content')
@section('tableColumns')
    <th>Name</th>
    <th>email</th>
    <th>phone</th>
@endsection
@include('admin.table.ajaxTable-inline', [
    'url' => request()->url(),
    'title' => 'Contact Messages',
    'columns' => ['name', 'email', 'phone'],
])
@endsection
