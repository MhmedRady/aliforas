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
                    <div class="card-body wizard-content ">
                        <!-- ============================================================== -->
                        <!-- Bread crumb and right sidebar toggle -->
                        <!-- ============================================================== -->
                        <div class="row page-titles mb-2">
                            <div class="col-md-5 align-self-center">
                                <h4 class="text-themecolor text-capitalize">{{$row->translate(app()->getLocale())->name ?? 'Edit'}}</h4>
                            </div>
                            <div class="col-md-7 align-self-center text-right">
                                <div class="d-flex justify-content-end align-items-center">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item text-capitalize"><a href="javascript:void(0)">Home</a></li>
                                        <li class="breadcrumb-item text-capitalize"><a href="{{route('admin.attrGroups.index')}}">Attributes Group</a></li>
                                        <li class="breadcrumb-item text-capitalize active">{{$row->translate(app()->getLocale())->name ?? 'Edit'}}</li>
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
                        {!! Form::open(['url' => route('admin.attrGroups.update', $row->id)]) !!}
                            {{method_field('PUT')}}
                            @foreach($languages as $locale)
                                <div class="form-group">
                                    {{ Form::label('name['.$locale->locale . ']', 'Name ' . $locale->name, ['class'=>'form-label mb-1']) }}
                                    {{ Form::text('name['.$locale->locale . ']', $row->translate($locale->locale)->name, ['class' => 'form-control mb-1']) }}
                                    @error('name')
                                        {{$message}}
                                    @enderror
                                </div>
                            @endforeach

                            <div class="form-group">
                                <label for="category_id" class="form-label mb-1">Category</label>
                                <select name="category_id[]" id="category_id" class="form-control" multiple="multiple">
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}" {{in_array($cat->id,$row->getCategoriesId()) ? "selected" : '' }} >{{ $cat->{'name:'.app()->getLocale()} }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                {{ Form::checkbox('is_active', 1, $row->is_active, ['id'=>'is_active']) }}
                                {{ Form::label('is_active', 'Check To Active', ['class'=>'mt-2', 'for'=>'is_active']) }}
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btm btn-primary mt-2">Submit</button>
                            </div>
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
@section('vendor-style')
    <link rel="stylesheet" type="text/css" href="{{asset('admin-asset/vendors/css/forms/select/select2.min.css')}}">
@endsection
@section('page-script')
    <script src="{{asset('admin-asset/js/scripts/forms/form-select2.js')}}"></script>
    <script type="text/javascript">
        $(function() {
            $('#category_id').select2();
        })
    </script>
@endsection
