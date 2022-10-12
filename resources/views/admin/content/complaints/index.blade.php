@extends('admin.layouts.contentLayoutMaster')
@section('content')
@section('tableColumns')
    <th>Sender</th>
    <th>recipient</th>
@endsection
@include('admin.table.ajaxTable-inline', [
    'url' => request()->url(),
    // 'createUrl' => request()->url() . '/create',
    'title' => 'Complaint',
    'columns' => ['sender', 'recipient'],
    'createPopup' => false
])
@endsection
