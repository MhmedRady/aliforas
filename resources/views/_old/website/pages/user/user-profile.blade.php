@extends('website.layouts.master')

@section('title',__("auth.Profile"))

@section('stylesheet')

@endsection

@section('content')

    @include("website.includes.pageLink")
    @include("website.auth.user-profile-setting")

@endsection

@section('javascript')

@endsection
