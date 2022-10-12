@extends('website.layouts.master')

@section('title','cart view')

@section('stylesheet')

@endsection

@section('content')

    @include("website.includes.pageLink")
    @include("website.components.cartList.cartList")

@endsection

@section('javascript')

@endsection
