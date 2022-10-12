@extends('website.layouts.master')

@section('title',$name??'All Products')

@section('stylesheet')

@endsection

@section('content')

    @include("website.components.allProducts.products")

@endsection

@section('javascript')

@endsection
