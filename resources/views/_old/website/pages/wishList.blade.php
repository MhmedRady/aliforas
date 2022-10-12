@extends('website.layouts.master')

@section('title','wishlist')

@section('stylesheet')

@endsection

@section('content')

    @include("website.includes.pageLink")
    @include("website.components.wishList.wishList")

@endsection

@section('javascript')

@endsection
