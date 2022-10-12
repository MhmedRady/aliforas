@extends('admin.layouts.contentLayoutMaster')
@section('content')
@section('tableColumns')
    <th>الإسم</th>
    <th>البريد الإلكتروني</th>
    <th>فعال</th>
    <th>مؤكد</th>
@endsection
@include('admin.table.ajaxTable-inline', [
    'url' => request()->url(),
    'createUrl' => request()->url() . '/create',
    'title' => 'title',
    'columns' => ['name', 'email', 'is_active', 'email_verified_at'],
    'createPopup' => false
])
@endsection
