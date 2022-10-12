@extends('admin.layouts.contentLayoutMaster')
@section('content')
@section('tableColumns')
    <th>user</th>
@endsection
@include('admin.table.ajaxTable-inline', [
    'url' => request()->url(),
    'createUrl' => request()->url() . '/create',
    'title' => 'title',
    'columns' => ['name'],
    'createPopup' => false
])
@endsection
