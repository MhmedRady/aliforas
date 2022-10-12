@extends('website.layouts.master')

@section('title','elgomhouria')

@section('stylesheet')

@endsection

@section('content')
    @include("website.components.home.home-slide")
    @include("website.components.home.product-box")
    @include("website.components.home.collection-banner")
    @include("website.components.home.services")
    @include("website.components.home.media-banner")
    @include("website.components.home.rounded-category")
    @include("website.components.home.tab-product")
    @include("website.components.home.hot-deal")


@endsection

@section('javascript')

@endsection
