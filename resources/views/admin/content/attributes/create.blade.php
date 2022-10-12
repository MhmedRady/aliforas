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
                                <h4 class="text-themecolor">Create Attributes</h4>
                            </div>
                            <div class="col-md-7 align-self-center text-right">
                                <div class="d-flex justify-content-end align-items-center">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
                                        <li class="breadcrumb-item "><a href="{{route('admin.attributes.index')}}">Attributes</a></li>
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
                    {!! Form::open(['url' => route('admin.attributes.store')]) !!}

                            @foreach($languages as $locale)
                                <div class="form-group mb-2">
                                    {{ Form::label('name['.$locale->locale . ']', 'Name ' . $locale->name) }}
                                    {{ Form::text('name['.$locale->locale . ']', null, ['class' => 'form-control']) }}
                                    @error('name')
                                        {{$message}}
                                    @enderror
                                </div>
                            @endforeach

                            <div class="form-group mb-2">
                                {{ Form::label('group_id', 'Group') }}
                                {{ Form::select('group_id', $groups, null, ['placeholder'=>'--please select--', 'class' => 'form-control'] ) }}
                                @error('group_id')
                                    {{$message}}
                                @enderror
                            </div>

                            <div class="form-group mb-2">
                            {{ Form::checkbox('is_active', 1) }}
                                {{ Form::label('is_active', 'Check To Active') }}
                            </div>
                            <div class="form-group mb-2">
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

