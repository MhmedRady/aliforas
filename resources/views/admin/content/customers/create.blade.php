@extends('admin.layouts.contentLayoutMaster')
@section('content')
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Users</h4>
            </div>
            <div class="col-md-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item "><a href="javascript:void(0)">users</a></li>
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
                    <div class="card-body wizard-content">

                    {!! Form::open(['url' => route('admin.customers.store'), 'class' => 'tab-wizard vertical wizard-circle', 'id' => 'edit_user_form']) !!}

                    <!-- sec section -->
                        <h6>Access Information</h6>
                        <section>


                        <div class="form-group mb-2">

                            <label class="field-label">User Name</label>
                            <input type="text" name="name" class="form-control" value="{{old('name')}}">
                            @error('name')
                            <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>


                            <div class="form-group mb-2">

                                <label class="field-label">Email Address</label>
                                <input type="text" name="email" class="form-control" value="{{old('email')}}">
                                @error('email')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                                @enderror

                            </div>

                            <div class="form-group mb-2">
                                <label for="phone">Phone</label> <br>
                                <input id="phone" type="number" class="form-control" name="phone" value="{{ old('phone')}}">
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group mb-2">
                                {{ Form::label('password', 'Password (Can\'t Be Less Than 8 Characters)') }}
                                {{ Form::password('password', ['class' => 'form-control', 'id' => 'password']) }}
                                <label for="password" generated="true" class="error text-danger"></label>
                                @error('password')
                                <span class="text-danger">
                                            {{$message}}
                                        </span>
                                @enderror
                            </div>

                            <div class="form-group mb-2">
                                {{ Form::label('password_confirmation', 'Confirm Password') }}
                                {{ Form::password('password_confirmation', ['class' => 'form-control']) }}
                                <label for="password_confirmation" generated="true" class="error text-danger"></label>
                                @error('password_confirmation')
                                <span class="text-danger">
                                            {{$message}}
                                        </span>
                                @enderror
                            </div>

                            <div class="form-group mb-2">
                                {{ Form::checkbox('is_active', 1) }}
                                {{ Form::label('is_active', 'Check To Active User Access To Website') }}
                            </div>
                        </section>
                        <h6>User Information</h6>

                        <section>

{{--                            <div class="form-group mb-2">--}}

{{--                                <label>First Name</label>--}}
{{--                                <input type="text" name="first_name" class="form-control" value="{{old('first_name')}}">--}}
{{--                                @error('first_name')--}}
{{--                                <span class="text-danger">--}}
{{--                                            {{ $message }}--}}
{{--                                        </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}


{{--                            <div class="form-group mb-2">--}}

{{--                                <label>Last Name</label>--}}
{{--                                <input type="text" name="last_name" class="form-control" value="{{old('last_name')}}">--}}
{{--                                @error('last_name')--}}
{{--                                <span class="text-danger">--}}
{{--                                            {{ $message }}--}}
{{--                                        </span>--}}
{{--                                @enderror--}}

{{--                            </div>--}}

                            <div class="form-group mb-2">

                                <label for="email" class="float-none">Gender</label> <br>
                                <div class="card" style="border:1px solid #ced4da;border-radius:0;">
                                    <div class="card-body" style="padding:13px 25px;">
                                        <input type="radio" name="gender" value="1" {{ (old('gender') == 1) ? 'checked' : ''}}> Male
                                        <input type="radio" name="gender" value="2" {{ (old('gender') == 2) ? 'checked' : ''}}> Female
                                    </div>
                                </div>
                                @error('gender')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>


                            <div class="form-group mb-2">
                                <label for="dob">Date Of Birth</label> <br>
                                <input id="dob" type="date" class="form-control" name="dob" value="{{ old('dob') }}" autocomplete="dob">
                                @error('dob')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>

                            @if(config('setting.pricing') === false)
                                <div class="form-group mb-2">

                                    <label class="field-label">{{__('auth.workPlace')}}</label>
                                    <input type="text" name="employer" class="form-control" value="{{old('employer')}}">
                                    @error('employer')
                                    <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                </div>

                                <div class="form-group mb-2">

                                    <label class="field-label">{{__('auth.NID')}}</label>
                                    <input type="text" name="national_id" class="form-control" value="{{old('national_id')}}">
                                    @error('national_id')
                                    <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                </div>
                            @endif

                        </section>

                        <button class="btn btn-primary" type="submit">
                            Submit
                        </button>

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
        var form = $("#edit_user_form");
        form.validate({
            errorPlacement: function errorPlacement(error, element) { element.before(error); },
            rules: {
                password_confirmation: {
                    equalTo: "#password"
                }
            }
        });
        form.steps({
            headerTag: "h6",
            bodyTag: "section",
            transitionEffect: "fade",
            titleTemplate: '<span class="step">#index#</span> #title#',
            labels: {
                finish: "Submit"
            },
            onStepChanging: function (event, currentIndex, newIndex)
            {
                form.validate().settings.ignore = ":disabled,:hidden";
                return form.valid();
            },
            onFinishing: function (event, currentIndex)
            {
                form.validate().settings.ignore = ":disabled";
                return form.valid();
            },
            onFinished: function (event, currentIndex) {
                form.submit();
            }
        });
    </script>
@endsection
