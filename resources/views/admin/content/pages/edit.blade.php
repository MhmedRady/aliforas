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
                        <form action="{{route('admin.page.update',$page)}}" class="tab-wizard vertical wizard-circle" method="post">
                            @method('PUT');
                            <!-- Step Content -->
                            {{csrf_field()}}
                            @foreach($page->translations as $p)
                                @php $localeName = \App\Models\Language::where('locale',$p->locale)->first()->name @endphp
                                <h6>{{$localeName}} content</h6>
                                <section>
                                    <div class="form-group">
                                        <h4 for="location1">Title {{$localeName}} :</h4>
                                        <input type="text" name="title_{{$p->locale}}" class="form-control" value="{{$p->name}}">
                                    </div>

                                    <textarea name="body_{{$p->locale}}" class="summernote" cols="30" rows="10">{!! ($p->body) !!}</textarea>
                                </section>
                        @endforeach
                        <!-- Step SEO -->
                            <h6>SEO Content</h6>
                            <section>
{{--                                <div class="btn-group" data-toggle="buttons">--}}
                                    <label class="btn btn-info active">
                                        <div class="custom-control custom-checkbox mr-sm-2">
                                            <input type="checkbox" class="custom-control-input" id="checkbox0" name="active" @if($page->is_active) checked @endif>
                                            <label class="custom-control-label mb-0" for="checkbox0">Page Active</label>
                                        </div>
                                    </label>
{{--                                </div>--}}
{{--                                <div class="btn-group" data-toggle="buttons">--}}
                                    <label class="btn btn-info form">
                                        <div class="custom-control custom-checkbox mr-sm-2">
                                            <input type="checkbox" class="custom-control-input" id="checkbox1" name="footer" @if($page->show_footer) checked @endif>
                                            <label class="custom-control-label mb-0" for="checkbox1">Show on footer</label>
                                        </div>
                                    </label>
{{--                                </div>--}}
{{--                                <div class="btn-group" data-toggle="buttons">--}}
                                    <label class="btn btn-info form">
                                        <div class="custom-control custom-checkbox mr-sm-2">
                                            <input type="checkbox" class="custom-control-input" id="checkbox2" name="header" @if($page->show_header) checked @endif>
                                            <label class="custom-control-label mb-0" for="checkbox2">Show on header</label>
                                        </div>
                                    </label>
{{--                                </div>--}}
                                <hr>
                                @foreach($page->translations as $p)
                                    @php $localeName = \App\Models\Language::where('locale',$p->locale)->first()->name @endphp
                                    <h2>{{$localeName}} SEO</h2>
                                    <hr>
                                    <div class="form-group">
                                        <h4>Meta Title {{$localeName}}</h4>
                                        <input type="text" name="meta_title_{{$p->locale}}" class="form-control" value="{{$p->meta_title}}">
                                    </div>
                                    <div class="form-group">
                                        <h4>Meta Keywords {{$localeName}}</h4>
                                        <input type="text" name="meta_keywords_{{$p->locale}}" class="form-control" value="{{$p->meta_keywords}}">
                                    </div>
                                    <div class="form-group">
                                        <h4>Meta Description {{$localeName}}</h4>
                                        <textarea name="meta_description_{{$p->locale}}" rows="4" class="form-control">{{strip_tags( $p->meta_description )}}</textarea>
                                    </div>
                                    <hr>
                        @endforeach
                        <button class="btn btn-success m-2">
                            Save Page
                        </button>
                    </div>
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
