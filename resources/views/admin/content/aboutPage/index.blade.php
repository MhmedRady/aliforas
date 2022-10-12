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
                                            <div class="mb-1 col-md-12">
                                                <label class="form-label mb-4" for="document[{{$locale->locale}}]">Page Document {{$locale->name}}</label>
                                                @if($aboutUs)
                                                    <textarea id="document[{{$locale->locale}}]" name="document[{{$locale->locale}}]"
                                                              class="form-control summernote" cols="30" rows="10" autocomplete="on">
                                                    {{ old("document." . $locale->locale)??($aboutUs->translate($locale->locale)->document??'') }}
                                                </textarea>
                                                @else
                                                    <textarea id="document[{{$locale->locale}}]" name="document[{{$locale->locale}}]"
                                                              class="form-control summernote" cols="30" rows="10" autocomplete="on">
                                                    {{ old("document." . $locale->locale) }}
                                                </textarea>
                                                @endif

                                            </div>
                                            <hr />
                                        @endforeach
                                    </div>
                                    <div class="btn btn-warning">
                                        <input type="checkbox" class="custom-control-input m-0" id="Activate" name="is_active" {{$aboutUs?($aboutUs->is_active ? 'checked':''):null}} checked autocomplete="off">
                                        <label class="custom-control-label m-0" for="Activate">Page Activate</label>
                                    </div>
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
