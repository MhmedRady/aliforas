@extends('website.layouts.master')

@section('title',__("passwords.changePW"))

@section('stylesheet')

@endsection

@section('content')

    @include("website.includes.pageLink")
    @include("website.auth.change_password")

@endsection

@section('javascript')

@endsection
