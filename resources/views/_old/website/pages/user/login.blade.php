@extends('website.layouts.master')

@section('title',__("Login.Login"))

@section('stylesheet')

@endsection

@section('content')

    @include("website.includes.pageLink")
    @include("website.auth.login")

@endsection

@section('javascript')

@endsection
