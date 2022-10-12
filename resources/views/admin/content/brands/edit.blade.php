@extends('admin.layouts.contentLayoutMaster')
@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body wizard-content">

                        <!-- ============================================================== -->
                        <!-- Bread crumb and right sidebar toggle -->
                        <!-- ============================================================== -->
                        <div class="row page-titles mb-3">
                            <div class="col-md-5 align-self-center">
                                <h4 class="text-themecolor">Brands</h4>
                            </div>
                            <div class="col-md-7 align-self-center text-right">
                                <div class="d-flex justify-content-end align-items-center">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
                                        <li class="breadcrumb-item "><a href="{{route('admin.brands.index')}}">Brands</a></li>
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
                            'url' => route('admin.brands.update',$row), 'class' => 'tab-wizard vertical wizard-circle', 'id' => 'add_brand_form']) !!}
                        @method('PUT')
                        @foreach($languages as $locale)

                            <section class="mb-2">
                                <h6 class="text-info fs-4">Name Info</h6>
                                <div class="form-group">
                                    <label class="mb-1" for="name[{{$locale->locale}}]">Name {{$locale->name}} :</label>
                                    <input type="text" name="name[{{$locale->locale}}]" class="form-control mb-2" maxlength="40"
                                           value="{{ old("name." . $locale->locale)??($row->translate($locale->locale)->name??'')}}">
                                    @if ($locale->name == 'Arabic')
                                        @error('name.ar')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    @endif
                                    @if ($locale->name == 'English')
                                        @error('name.en')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    @endif
                                </div>
                            </section>
                        @endforeach

                        <section class="mb-2">

                            <h6 class="text-info fs-4">Logo Info</h6>

                            <div class="form-group">
                                <label class="mb-1" for="logo">Logo:</label>
                                <input type="file" name="logo" accept="image/*" class="form-control mb-2">
                                @error('logo')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            {{--                            <div class="btn-group" data-toggle="buttons">--}}
                            {{--                                <label class=mb-1 class="btn btn-info active">--}}
                            {{--                                    <div class="custom-control custom-checkbox mr-sm-2">--}}
                            {{--                                        <input type="checkbox" class="custom-control-input" id="checkbox0" name="active">--}}
                            {{--                                        <label class=mb-1 class="custom-control-label" for="checkbox0">Brand Active</label>--}}
                            {{--                                    </div>--}}
                            {{--                                </label>--}}
                            {{--                            </div>--}}

                            <hr>

                            @foreach($languages as $locale)
                                <h6 class="text-info fs-4">Meta Info</h6>
                                <section class="mb-2">
                                    <div class="form-group">
                                        <label class="mb-1" for="meta_title[{{$locale->locale}}">Meta Title {{$locale->name}}:</label>
                                        <input type="text" name="meta_title[{{$locale->locale}}]" class="form-control mb-2" maxlength="40">
                                    </div>

                                    <div class="form-group">
                                        <label class="mb-1" for="meta_keywords[{{$locale->locale}}]">Meta Keywords {{$locale->name}} :</label>
                                        <input type="text" name="meta_keywords[{{$locale->locale}}]" class="form-control mb-2" maxlength="40" value="">
                                    </div>

                                    <div class="form-group">
                                        <label class="mb-1" for="meta_keywords[{{$locale->locale}}]">Meta Description {{$locale->name}} :</label>
                                        <textarea name="meta_keywords[{{$locale->locale}}]" rows="4" class="form-control mb-2" maxlength="160"></textarea>
                                    </div>
                                </section>
                            @endforeach

                        </section>

                        <button class="btn btn-primary mt-2" type="submit">Submit</button>

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
