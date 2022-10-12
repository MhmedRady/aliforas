@extends('admin.layouts.contentLayoutMaster')
@section('content')
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->


        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
{{--                <h2>{{currentRoute()}} {{auth()->guard('admin')->user()->roles->first()->id}}</h2>--}}

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body wizard-content">
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

                        <hr />

                        {!! Form::open(['url' => checkCurrentRoute('admin.profile')? route('admin.update.profile') : route('admin.users.update', $row->id),
                                        'class' => 'tab-wizard vertical wizard-circle',
                                         'id' => 'edit_user_form', 'method'=>'post']) !!}
                            {{ method_field('PUT') }}
                            @if(checkCurrentRoute('admin.profile'))
                                {{ Form::hidden('id',auth()->guard('admin')->id()) }}
                            @else
                                {{ Form::hidden('id',$row->id) }}
                            @endif
                            <h6>User Information</h6>
                            <section>
                            <div class="form-group mb-2">
                                {{ Form::label('name', 'Name') }}
                                {{ Form::text('name', $row->name, ['class' => 'form-control required']) }}
                                <label for="name" generated="true" class="error text-danger"></label>
                                @error('name')
                                    <span class="text-danger">
                                        {{$message}}
                                    </span>
                                @enderror
                                </div>
                                <div class="form-group mb-2">
                                    {{ Form::label('email', 'Email') }}
                                    {{ Form::text('email', $row->email, ['class' => 'form-control email required']) }}
                                    <label for="email" generated="true" class="error text-danger"></label>
                                    @error('email')
                                        <span class="text-danger">
                                            {{$message}}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-2">
                                    {{ Form::label('password', 'Password (Leave Empty If You Want To Keep Current)') }}
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
                                    {{ Form::checkbox('is_active', 1, $row->is_active) }}
                                    {{ Form::label('is_active', 'Check To Active User') }}
                                </div>
                                @if(!checkCurrentRoute('admin.profile'))
                                    <div class="form-group mb-2">
                                        {{ Form::label('role', 'roles',['class'=>'text-capitalize']) }}
                                        {{ Form::select('role', $roles, $row->role_id, ['placeholder'=>'Choose Role', 'class' => 'form-control'] ) }}
                                    </div>

                                    <div class="form-group mb-2">
                                        <label for="order_status_permissions">Order Status Permssions</label>
                                        @if(count($orderstatus) > 0)
                                        @php
                                            $status_array = explode(',',$row->order_status_permissions);
                                        @endphp
                                            @foreach($orderstatus as $status)
    {{--                                            <div class="mb-2 d-flex">--}}
                                                        <label class="mr-2 ml-2" for="{{$status->name}}">{{$status->name}}
                                                            <input id="{{$status->name}}" type="checkbox" name="order_status_permissions[]" value="{{$status->id}}" @if(in_array($status->id,$status_array)) checked @endif>
                                                        </label>
    {{--                                            </div>--}}
                                            @endforeach
                                        @endif
                                    </div>
                                @endif
                            </section>

                        <button class="btn btn-primary mt-2 mb-2">Submit</button>
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
