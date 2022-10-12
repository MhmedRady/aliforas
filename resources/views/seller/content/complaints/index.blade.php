@extends('seller.layouts.contentLayoutMaster')
@section('content')
@section('tableColumns')
    <th>@lang('layouts.sender')</th>
    <th>@lang('layouts.recipient')</th>
    <th>@lang('layouts.sendDate')</th>
@endsection
@include('seller.table.ajaxTable-inline', [
    'url' => request()->url(),
    // 'createUrl' => request()->url() . '/create',
    'title' => __('layouts.messages'),
    'columns' => ['sender', 'recipient', 'created_at'],
    'createPopup' => false
])
@endsection
