@extends('website.layouts.master')

@section('title',$name)

@section('stylesheet')

@endsection

@section('content')

    @include("website.includes.pageLink")
    @include("website.components.details.productDetails")

    @if($related)
        @include("website.components.relatedProducts")
    @endif

@endsection

@section('javascript')

@endsection
