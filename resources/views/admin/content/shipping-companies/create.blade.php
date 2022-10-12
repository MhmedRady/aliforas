@extends('admin.layouts.contentLayoutMaster')
@section('content')
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->

        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body wizard-content">

                        <div class="row page-titles mb-3">
                            <div class="col-md-5 align-self-center">
                                <h4 class="text-themecolor">Shipping Company</h4>
                            </div>
                            <div class="col-md-7 align-self-center text-right">
                                <div class="d-flex justify-content-end align-items-center">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                        <li class="breadcrumb-item "><a href="javascript:void(0)">Companies</a></li>
                                        <li class="breadcrumb-item active">Create</li>
                                    </ol>
                                </div>
                            </div>
                        </div>

                        {!! Form::open([
                            'url' => route('admin.shipping_companies.store'), 'class' => 'tab-wizard vertical wizard-circle', 'id' => 'add_brand_form']) !!}

                        <div class="row">

                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label class="mb-1" for="name">Name:</label>
                                    <input id="name" type="text" name="name" class="form-control" value="{{old('name')}}">
                                    @error('name')
                                    <div class="valid-feedback d-block">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
{{--                            <div class="col-md-6 mb-2">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label class="mb-1" for="fuel">Fuel:</label>--}}
{{--                                    <input id="fuel" type="text" name="fuel" class="form-control" value="{{old('fuel')}}">--}}
{{--                                    @error('fuel')--}}
{{--                                    <div class="valid-feedback d-block">--}}
{{--                                        {{$message}}--}}
{{--                                    </div>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-6 mb-2">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label class="mb-1" for="post">Post:</label>--}}
{{--                                    <input id="post" type="text" name="post" class="form-control" value="{{old('post')}}">--}}
{{--                                    @error('post')--}}
{{--                                    <div class="valid-feedback d-block">--}}
{{--                                        {{$message}}--}}
{{--                                    </div>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-6 mb-2">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label class="mb-1" for="vat">Vat:</label>--}}
{{--                                    <input id="vat" type="text" name="vat" class="form-control" value="{{old('vat')}}">--}}
{{--                                    @error('vat')--}}
{{--                                    <div class="valid-feedback d-block">--}}
{{--                                        {{$message}}--}}
{{--                                    </div>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-6 mb-2">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label class="mb-1" for="cod">Cod:</label>--}}
{{--                                    <input id="cod" type="text" name="cod" class="form-control" value="{{old('cod')}}">--}}
{{--                                    @error('cod')--}}
{{--                                    <div class="valid-feedback d-block">--}}
{{--                                        {{$message}}--}}
{{--                                    </div>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-6 mb-2">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label class="mb-1" for="weight">First Kg Number</label>--}}
{{--                                    <input id="weight" type="text" class="form-control" name="first_kg_number" value="{{old('first_kg_number')}}">--}}
{{--                                    @error('first_kg_number')--}}
{{--                                    <div class="valid-feedback d-block">--}}
{{--                                        {{$message}}--}}
{{--                                    </div>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
{{--                            </div>--}}

                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>

                        {!! Form::close() !!}

                    </div>

                </div>
            </div>
        </div>

        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->
    </div>
@endsection
