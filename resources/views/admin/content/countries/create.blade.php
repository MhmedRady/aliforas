@extends('admin.layouts.contentLayoutMaster')
@section('content')
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Countries</h4>
            </div>
            <div class="col-md-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item "><a href="javascript:void(0)">Countries</a></li>
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

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body wizard-content">

                        {!! Form::open([
                            "enctype" => "multipart/form-data",
                            'url' => route('admin.countries.store'), 'class' => 'tab-wizard vertical wizard-circle', 'id' => 'add_brand_form']) !!}

                        @foreach($languages as $locale)
                            {{-- <h6>{{$locale->name}} content</h6> --}}
                            <section class="form-group m-2">
                                <div class="form-group">
                                    <label for="name[{{$locale->locale}}]">Country name in  {{$locale->name}} :</label>
                                    <input type="text" name="name[{{$locale->locale}}]" class="form-control">
                                </div>
                            </section>
                        @endforeach

                        <section class="form-group m-2">

                            <div class="form-group">
                                <label for="country_code">Country code</label>
                                <input type="text" class="form-control" name="country_code" id="country_code">
                            </div>
                            <div class="form-group" style="text-align: right">
                                <button type="submit" class="btn waves-effect waves-light btn-outline-success mt-2">Save</button>
                            </div>
                        </section>


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
