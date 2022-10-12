@extends('admin.layouts.contentLayoutMaster')
@section('content')

    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body wizard-content ">
                        <div class="row">
                            <h4 class="card-title">
                                About Us Page
                            </h4>

                        </div>


                        <!-- Two-steps verification -->
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-50">AboutUs Page Content</h4>
                                <hr />
                                <form action="{{route('admin.aboutUsStore')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        @foreach($languages as $locale)
                                            <div class="mb-1 form-password-toggle col-md-12">
                                                <label class="form-label" for="document[{{$locale->locale}}]">Page Document {{$locale->name}}</label>
                                                <textarea id="document[{{$locale->locale}}]" name="document[{{$locale->locale}}]"
                                                          class="form-control summernote" cols="30" rows="10" autocomplete="on">
                                                    {{ old("document." . $locale->locale)??($aboutUs?$aboutUs->translate($locale->locale)->document:'') }}
                                                </textarea>
                                            </div>
                                            <hr />
                                        @endforeach

                                    </div>
                                    <bu class="btn btn-warning">
                                        <input type="checkbox" class="custom-control-input m-0" id="Activate" name="is_active" checked autocomplete="off">
                                        <label class="custom-control-label m-0" for="Activate">Page Activate</label>
                                    </bu>
                                    <button class="btn btn-primary font-bold">Save Page Content</button>
                                </form>
                            </div>
                        </div>
                        <!--/ Two-steps verification -->

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

    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet">
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.7.0/summernote.css" rel="stylesheet">

    <style>
        label{
            font-size: 1rem !important;
            margin-bottom: 1rem !important;
        }
    </style>

@endsection

@section('page-script')
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.7.0/summernote.js"></script>

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
