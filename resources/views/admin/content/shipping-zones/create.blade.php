@extends('admin.layouts.contentLayoutMaster')
@section('content')
    <div class="container-fluid">

        {{--        @if ($errors->any())--}}
        {{--            <div class="alert alert-danger">--}}
        {{--                <ul>--}}
        {{--                    @foreach ($errors->all() as $error)--}}
        {{--                        <li>{{ $error }}</li>--}}
        {{--                    @endforeach--}}
        {{--                </ul>--}}
        {{--            </div>--}}
        {{--        @endif--}}

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body wizard-content">
                        <!-- ============================================================== -->
                        <!-- Bread crumb and right sidebar toggle -->
                        <!-- ============================================================== -->
                        <div class="row page-titles mb-2">
                            <div class="col-md-5 align-self-center">
                                <h4 class="text-themecolor">Sipping Zones</h4>
                            </div>
                            <div class="col-md-7 align-self-center text-right">
                                <div class="d-flex justify-content-end align-items-center">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                        <li class="breadcrumb-item "><a href="javascript:void(0)">Zones</a></li>
                                        <li class="breadcrumb-item active">Create</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        <!-- ============================================================== -->
                        <!-- End Bread crumb and right sidebar toggle -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- Start Page Content -->
                        <!-- ============================================================== -->

                        {!! Form::open([
                            "enctype" => "multipart/form-data",
                            'url' => route('admin.shipping_zones.store'), 'class' => 'tab-wizard vertical wizard-circle', 'id' => 'add_brand_form']) !!}

                        <section>
                            <div class="form-group mb-2">
                                <label class="mb-1" for="company_id">Company:</label>
                                <select name="company_id" class="select2 form-control">
                                    @foreach($companies as $company)
                                        <option value="{{$company->id}}">{{$company->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </section>
                        <section>
                            <div class="form-group mb-2">
                                <label class="mb-1" for="zone_name">Zone Name:</label>
                                <input type="text" name="zone_name" class="form-control">
                            </div>
                        </section>
                        <section>
                            <div class="form-group mb-2">
                                <label class="form-label mb-1" for="Area">Shipping Area</label>
                                <div class="mb-1">
                                    <select class="select2 form-select" name="areas[]" multiple="multiple" id="area" data-placeholder="Select Shipping Area">
                                        @foreach($areas as $area)
                                            <option value="{{$area->id}}">{{$area->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{--                                <label class="mb-1" for="areas">areas:</label>--}}
                                {{--                                <select class="js-example-basic-single form-control" name="areas[]" multiple="multiple">--}}
                                {{--                                    @foreach($areas as $area)--}}
                                {{--                                        <option value="{{$area->id}}">{{$area->name}}</option>--}}
                                {{--                                    @endforeach--}}
                                {{--                                </select>--}}
                                @error('areas')
                                <span class="error text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </section>
                        <section>
                            <div class="form-group mb-2">
                                <label class="mb-1" for="first_kg">First Kg:</label>
                                <input type="text" name="first_kg" class="form-control">
                            </div>
                        </section>
                        <section>
                            <div class="form-group mb-2">
                                <label class="mb-1" for="additional_kg">Additional Kg:</label>
                                <input type="text" name="additional_kg" class="form-control">
                            </div>
                        </section>
                        <section>
                            <div class="form-group mb-2">
                                <label class="mb-1" for="cod_values">Cod Values:</label>
                                <input type="text" name="cod_values" class="form-control">
                            </div>
                        </section>

                        <button type="submit" class="btn btn-success">Submit</button>

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
@section('page-style')

@endsection
@section('vendor-style')
    <link rel="stylesheet" type="text/css" href="{{asset('admin-asset/vendors/css/forms/select/select2.min.css')}}">
@endsection
@section('page-script')
    <script src="{{asset('admin-asset/js/scripts/forms/form-select2.js')}}"></script>
    </script>
@endsection