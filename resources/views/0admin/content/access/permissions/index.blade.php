@extends('admin.layouts.contentLayoutMaster')
@section('content')
@section('tableColumns')
    <th>الإسم</th>
    <th>المجموعة</th>
@endsection
@include('admin.table.ajaxTable-inline', [
    'url' => request()->url(),
    'createUrl' => request()->url() . '/create',
    'title' => 'title',
    'columns' => ['name', 'group_id'],
    'createPopup' => false
])
@endsection
