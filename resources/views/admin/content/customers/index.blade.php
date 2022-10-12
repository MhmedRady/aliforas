@extends('admin.layouts.contentLayoutMaster')
@section('content')
@section('tableColumns')
    <th>Name</th>
    <th>Email</th>
    <th class="activate">active</th>
    <th class="verify">verify</th>
@endsection
@include('admin.table.ajaxTable-inline', [
    'url' => request()->url(),
    'createUrl' => request()->url() . '/create',
    'title' => 'Customers',
    'columns' => ['name', 'email', 'is_active', 'email_verified_at'],
    'createPopup' => false
])

@endsection
