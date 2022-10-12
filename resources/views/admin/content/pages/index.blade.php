@extends('admin.layouts.contentLayoutMaster')

@section('content')
@section('tableColumns')
    <th>Name</th>
    <th>Header</th>
    <th>Footer</th>
    <th>Visible</th>
@endsection
@include('admin.table.ajaxTable-inline', [
    'url' => request()->url(),
    'createUrl' => request()->url() . '/create',
    'title' => 'Pages',
    'columns' => ['name', 'Header', 'Footer', 'Visible'],
])
@endsection
