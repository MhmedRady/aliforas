@extends('website.layouts.master')

@section('title',__("passwords.newPW"))

@section('stylesheet')

@endsection

@section('content')

    @include("website.auth.set-newPassword")

@endsection

@section('javascript')

@endsection
