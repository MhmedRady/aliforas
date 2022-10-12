@extends('admin.layouts.contentLayoutMaster')
@section('content')
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Settings</h4>
            </div>
            <div class="col-md-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item "><a href="javascript:void(0)">Settings</a></li>
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
                    <div class="card-body">
                        <form action="{{ route('admin.setting.store') }}" method="post">
                            {{csrf_field()}}

                        @foreach($len as $locale)
                                <div class="form-group">
                                    <h4 for="location1">Name {{$locale->name}} :</h4>
                                    <input type="text" name="name_{{$locale->locale}}" class="form-control" required>
                                    <label for="name_{{$locale->locale}}" generated="true" class="error text-danger"></label>
                                    @error('title_{{$locale->locale}}')
                                    <span class="text-danger">
                                        {{$message}}
                                         </span>
                                    @enderror

                                </div>
                                <div class="form-group">
                                    <h4 for="location1">Description {{$locale->name}} :</h4>
                                    <textarea name="description_{{$locale->locale}}" class="form-control" required></textarea>
                                    <label for="description_{{$locale->locale}}" generated="true" class="error text-danger"></label>
                                    @error('description_{{$locale->locale}}')
                                    <span class="text-danger">
                                        {{$message}}
                                         </span>
                                    @enderror

                                </div>
                                <br>
                                <hr>
                                <br>
                            @endforeach
                                <div class="form-group text-right">
                                    <button type="submit" class="btn btn-dark">Save</button>
                                </div>

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
@section('page-style')
    <link href="{{asset('admin-asset/dist/css/custom.css')}}" rel="stylesheet">
@endsection
