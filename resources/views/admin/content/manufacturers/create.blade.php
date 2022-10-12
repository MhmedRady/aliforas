@extends('admin.layouts.contentLayoutMaster')
@section('content')
    <div class="container-fluid">

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
                        <!-- ============================================================== -->
                        <!-- Bread crumb and right sidebar toggle -->
                        <!-- ============================================================== -->
                        <div class="row page-titles mb-2">
                            <div class="col-md-5 align-self-center">
                                <h4 class="text-themecolor">Manufacturers</h4>
                            </div>
                            <div class="col-md-7 align-self-center text-right">
                                <div class="d-flex justify-content-end align-items-center">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                        <li class="breadcrumb-item "><a href="javascript:void(0)">Manufacturers</a></li>
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

                        {!! Form::open(["enctype" => "multipart/form-data", 'url' => route('admin.manufacturers.store'), 'class' => 'tab-wizard vertical wizard-circle', 'id' => 'add_manufacturer_form']) !!}

                        @foreach($languages as $locale)

                            <section class="mb-2">
                                <h6 class="text-info">{{$locale->name}} content</h6>
                                <div class="form-group">
                                    <label class="mb-1" class="mb-1" class="mb-1" class="mb-1" class="mb-1" class="mb-1" for="name[{{$locale->locale}}]">Name {{$locale->name}} :</label>
                                    <input type="text" name="name[{{$locale->locale}}]" class="form-control" maxlength="40">
                                </div>
                            </section>
                        @endforeach

                        <h6>Meta Content</h6>
                        <section class="mb-2">

                            <h6 class="text-info">Main Info</h6>

{{--                            <div class="btn-group" data-toggle="buttons">--}}
{{--                                <label class="mb-1" class="mb-1" class="mb-1" class="mb-1" class="mb-1" class=mb-1 class="btn btn-info active">--}}
{{--                                    <div class="custom-control custom-checkbox mr-sm-2">--}}
{{--                                        <input type="checkbox" class="custom-control-input" id="checkbox0" name="active">--}}
{{--                                        <label class="mb-1" class="mb-1" class="mb-1" class="mb-1" class="mb-1" class=mb-1 class="custom-control-label" for="checkbox0">is Active</label>--}}
{{--                                    </div>--}}
{{--                                </label>--}}
{{--                            </div>--}}

                            <div class="form-group">
                                <label class="mb-1" for="logo">Logo:</label>
                                <input type="file" accept="image/*" name="logo" class="form-control">
                            </div>

                            <hr>

                            @foreach($languages as $locale)
                                <h6 class="text-info">{{$locale->name}} SEO</h6>
                                <section class="mb-2">
                                    <div class="form-group">
                                        <label class="mb-1" for="meta_title[{{$locale->locale}}">Meta Title {{$locale->name}}:</label>
                                        <input type="text" name="meta_title[{{$locale->locale}}]" class="form-control" maxlength="40">
                                    </div>

                                    <div class="form-group">
                                        <label class="mb-1" for="meta_keywords[{{$locale->locale}}]">Meta Keywords {{$locale->name}} :</label>
                                        <input type="text" name="meta_keywords[{{$locale->locale}}]" class="form-control" maxlength="40">
                                    </div>

                                    <div class="form-group">
                                        <label class="mb-1" for="meta_keywords[{{$locale->locale}}]">Meta Description {{$locale->name}} :</label>
                                        <textarea name="meta_keywords[{{$locale->locale}}]" rows="4" class="form-control" maxlength="160"></textarea>
                                    </div>
                                </section>
                            @endforeach

                        </section>

                        <button type="submit" class="btn btn-primary mt-2">Submit</button>

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
@section('page-script')

@endsection
