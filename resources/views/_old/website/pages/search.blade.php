@extends('website.layouts.master')

@section('title','Search Page')

@section('stylesheet')

@endsection

@section('content')

    @include("website.includes.pageLink")
    @include('website.components.search.searchInput')
    @include('website.components.search.searchOutput')

@endsection

@section('javascript')

@endsection
