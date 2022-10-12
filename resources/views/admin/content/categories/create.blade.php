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

                        {!! Form::open([
                            "enctype" => "multipart/form-data",
                            'url' => route('admin.categories.store'), 'class' => 'tab-wizard vertical wizard-circle', 'id' => 'add_category_form']) !!}

                        @foreach($languages as $locale)

                            <section class="mt-2">
                                <h6>{{$locale->name}} content</h6>
                                <div class="form-group mt-2">
                                    <label for="name[{{$locale->locale}}]">Name {{$locale->name}} :</label>
                                    <input type="text" name="name[{{$locale->locale}}]" class="form-control" maxlength="40">
                                </div>

{{--                                <div class="form-group mt-2">--}}
{{--                                    <label for="slug[{{$locale->locale}}]">Slug {{$locale->name}} :</label>--}}
{{--                                    <input type="text" name="slug[{{$locale->locale}}]" class="form-control" required maxlength="40">--}}
{{--                                </div>--}}
                            </section>
                        @endforeach

                        <section>

                            <h6 class="text-info">Main Info</h6>

                            <div class="form-group mt-2">
                                <label for="parent_id">Parent Category</label>
                                <select name="parent_id" id="parent_id" class="form-control">
                                    <option value="">No parent</option>
                                    @foreach($categories as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mt-2">
                                <label for="return_policy">Return Policy :</label>
                                <input type="text" name="return_policy" class="form-control">
                            </div>
                            <div class="form-group mt-2">
                                <label for="return_policy">Arrange :</label>
                                <input type="number" name="arrange" class="form-control" min="0" value="0">
                            </div>
                            <div class="form-group mt-2">
                                <label for="shipping_type">Shipping Type :</label>
                                <select name="shipping_type" class="form-control">
                                    <option value="0">Piece</option>
                                    <option value="1">Total</option>
                                </select>
                            </div>
                            <div class="form-group mt-2">
                                <label for="shipping_value">Shipping Value :</label>
                                <input type="number" name="shipping_value" class="form-control" min="0" value="0">
                            </div>

                            <div class="form-group mt-2">
                                <label for="logo">Logo</label>
                                <input type="file" accept="image/*" name="icon" id="icon" class="form-control">
                            </div>

                            <div class="form-group mt-2">
                                <label for="banner">Banner</label>
                                <input type="file" accept="image/*" name="banner" id="banner" class="form-control">
                            </div>

                            <div class="btn-group mt-2" data-toggle="buttons">
                                <label class="btn btn-info active">
                                    <div class="custom-control custom-checkbox mr-sm-2">
                                        <input type="checkbox" class="custom-control-input" id="checkbox0" name="active">
                                        <label class="custom-control-label" for="checkbox0">Category Active</label>
                                    </div>
                                </label>
                            </div>

                            <div class="btn-group mt-2" data-toggle="buttons">
                                <label class="btn btn-info active">
                                    <div class="custom-control custom-checkbox mr-sm-2">
                                        <input type="checkbox" class="custom-control-input" id="in_header" name="in_header">
                                        <label class="custom-control-label" for="in_header">Show in header</label>
                                    </div>
                                </label>
                            </div>

                            <hr>

                            @foreach($languages as $locale)
                                <h6 class="text-info">{{$locale->name}} SEO</h6>
                                <section>
                                    <div class="form-group mt-2">
                                        <label for="meta_title[{{$locale->locale}}">Meta Title {{$locale->name}}:</label>
                                        <input type="text" name="meta_title[{{$locale->locale}}]" class="form-control" maxlength="40">
                                    </div>

                                    <div class="form-group mt-2">
                                        <label for="meta_keywords[{{$locale->locale}}]">Meta Keywords {{$locale->name}} :</label>
                                        <input type="text" name="meta_keywords[{{$locale->locale}}]" class="form-control" maxlength="40">
                                    </div>

                                    <div class="form-group mt-2">
                                        <label for="meta_keywords[{{$locale->locale}}]">Meta Description {{$locale->name}} :</label>
                                        <textarea name="meta_keywords[{{$locale->locale}}]" rows="4" class="form-control" maxlength="160"></textarea>
                                    </div>
                                </section>
                            @endforeach

                        </section>

                        <button class="btn btn-primary btn-md mt-2">Submit</button>

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

    <link href="{{asset('admin-asset/assets/node_modules/wizard/steps.css')}}" rel="stylesheet">
    <link href="{{asset('admin-asset/assets/node_modules/sweetalert/sweetalert.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('admin-asset/dist/css/custom.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('admin-asset/assets/node_modules/summernote/dist/summernote-bs4.css')}}">

@endsection
@section('page-script')

    <script src="{{asset('admin-asset/assets/node_modules/wizard/jquery.steps.min.js')}}"></script>
    <script src="{{asset('admin-asset/assets/node_modules/wizard/jquery.validate.min.js')}}"></script>
    <script src="{{asset('admin-asset/assets/node_modules/sweetalert/sweetalert.min.js')}}"></script>
    <script src="{{asset('admin-asset/assets/node_modules/summernote/dist/summernote-bs4.min.js')}}"></script>
    <script type="text/javascript">

        //Custom design form example
        var form = $(".tab-wizard");
        form.validate({
            errorPlacement: function errorPlacement(error, element) { element.before(error); },
        });

        //Custom design form example
        $(".tab-wizard").steps({
            enableAllSteps: true,
            headerTag: "h6",
            bodyTag: "section",
            transitionEffect: "fade",
            titleTemplate: '<span class="step">#index#</span> #title#',
            onStepChanging: function (event, currentIndex, newIndex)
            {
                // Allways allow previous action even if the current form is not valid!
                if (currentIndex > newIndex)
                {
                    return true;
                }
                // Needed in some cases if the user went back (clean up)
                if (currentIndex < newIndex)
                {
                    // To remove error styles
                    form.find(".body:eq(" + newIndex + ") label.error").remove();
                    form.find(".body:eq(" + newIndex + ") .error").removeClass("error");
                }
                form.validate().settings.ignore = ":disabled,:hidden";
                return form.valid();
            },
            labels: {
                finish: "Submit"
            },
            onFinished: function (event, currentIndex) {
                $('#add_category_form').submit();
                // swal("Form Submitted!", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lorem erat eleifend ex semper, lobortis purus sed.");
            }
        });
</script>
@endsection
