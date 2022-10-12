@extends('website.layouts.master')

@section('title',__("Login.Reset Password"))

@section('stylesheet')

@endsection

@section('content')

    @include("website.includes.pageLink")
    @include("website.auth.reset-Password")

@endsection

@section('javascript')

@endsection
