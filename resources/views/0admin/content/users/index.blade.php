@extends('admin.layouts.contentLayoutMaster')
@section('content')
@section('tableColumns')
    <th>الإسم</th>
    <th>البريد الإلكتروني</th>
@endsection
@include('admin.table.ajaxTable-inline', [
    'url' => request()->url(),
    'createUrl' => request()->url() . '/create',
    'title' => 'title',
    'columns' => ['name', 'email'],
    'createPopup' => false
])
@endsection
