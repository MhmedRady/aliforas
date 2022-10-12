@extends('admin.layouts.contentLayoutMaster')
@section('content')
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Pages</h4>
            </div>
            <div class="col-md-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item "><a href="javascript:void(0)">Pages</a></li>
                        <li class="breadcrumb-item active">create</li>
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
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body wizard-content ">
                        <h4 class="card-title">
                            Page Information
                        </h4>
                        <form action="{{ route('admin.page.store') }}" method="post" class="tab-wizard vertical wizard-circle">
                            <!-- Step Content -->
                            {{csrf_field()}}
                            @foreach($len as $locale)
                            <h6>{{$locale->name}} content</h6>
                            <section>
                                    <div class="form-group">
                                        <h4 for="location1">Title {{$locale->name}} :</h4>
                                        <input type="text" name="title_{{$locale->locale}}" class="form-control" required>
                                        <label for="title_{{$locale->locale}}" generated="true" class="error text-danger"></label>
                                        @error('title_{{$locale->locale}}')
                                        <span class="text-danger">
                                        {{$message}}
                                         </span>
                                        @enderror

                                    </div>

{{--                                <div id ="body_{{$locale->locale}}" ></div>--}}
                                <textarea id ="body_{{$locale->locale}}" name="body_{{$locale->locale}}" class="summernote" cols="30" rows="10" required></textarea>
                                <label for="body_{{$locale->locale}}" generated="true" class="error text-danger"></label>
                                @error('body_{{$locale->locale}}')
                                <span class="text-danger">
                                    {{$message}}
                                </span>
                                @enderror

                            </section>
                            @endforeach
                            <!-- Step SEO -->
                            <h6>SEO Content</h6>
                            <section>
{{--                                <div class="btn-group" data-toggle="buttons">--}}
                                    <div class="btn btn-primary">
                                        <input type="checkbox" class="custom-control-input" id="checkbox0" name="active">
                                        <label class="custom-control-label mb-0" for="checkbox0">Page Active</label>
                                    </div>
{{--                                </div>--}}
{{--                                <div class="btn-group" data-toggle="buttons">--}}
                                    <div class="btn btn-primary">
                                        <input type="checkbox" class="custom-control-input" id="checkbox1" name="footer">
                                        <label class="custom-control-label mb-0" for="checkbox1">Show on footer</label>
                                    </div>
{{--                                </div>--}}
{{--                                <div class="btn-group" data-toggle="buttons">--}}
                                    <div class="btn btn-primary">
                                        <input type="checkbox" class="custom-control-input" id="checkbox2" name="header">
                                        <label class="custom-control-label mb-0" for="checkbox2">Show on header</label>
                                    </div>
{{--                                </div>--}}
                                <hr>
                            @foreach($len as $locale)
                                       <h2>{{$locale->name}} SEO</h2>
                                    <hr>
                                    <div class="form-group">
                                        <h4>Meta Title {{$locale->name}}</h4>
                                        <input type="text" name="meta_title_{{$locale->locale}}" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <h4>Meta Keywords {{$locale->name}}</h4>
                                        <input type="text" name="meta_keywords_{{$locale->locale}}" class="form-control">
                                    </div>
                                    <div class="form-group">
                                            <h4>Meta Description {{$locale->name}}</h4>
                                            <textarea name="meta_description_{{$locale->locale}}" rows="4" class="form-control"></textarea>
                                        </div>
                                    <hr>
                                        @endforeach
                                <button class="btn btn-success m-2">
                                    Save Page
                                </button>
                            </section>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->
    </div>
@endsection
@section('vendor-style')

{{--    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">--}}
{{--    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet">--}}
{{--    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.7.0/summernote.css" rel="stylesheet">--}}

    <style>
        label{
            font-size: 1rem !important;
            margin-bottom: 1rem !important;
        }
        .note-popover.popover{
            display: none;
        }
    </style>

@endsection

@section('page-script')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 250, // set editor height
                minHeight: null, // set minimum height of editor
                maxHeight: null, // set maximum height of editor
                focus: false // set focus to editable area after initializing summernote
            });
        });
    </script>
@endsection
