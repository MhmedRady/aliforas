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
                        <li class="breadcrumb-item active">Main Setting</li>
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
            <div class="col-md-12 col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center">Main Setting</h5>
                        <hr class="mb-2"/>

                        <form action="{{ route('admin.setting.main_setting_post') }}" method="post">
                            @csrf
                            <div class="row mb-2">

                                @foreach($lang as $locale)
                                    <div class="col-md-6 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="address-{{$locale->locale}}">
                                                <span class="badge btn-danger">{{$locale->name}}</span> Address
                                            </label>
                                            <div class="input-group input-group-merge">
                                            <span class="input-group-text">
                                                <i data-feather="map-pin"></i>
                                            </span>
                                                <input type="text" id="address-{{$locale->locale}}" class="form-control" name="address_{{$locale->locale}}"
                                                       value="{{old("address_$locale->locale")??main_setting_key_value($setting,"address_$locale->locale")}}"/>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="phone">Contact Mobile</label>
                                        <div class="input-group input-group-merge">
                                        <span class="input-group-text">
                                            <i data-feather="smartphone"></i>
                                        </span>
                                            <input type="number" id="phone" class="form-control" name="phone"
                                                   value="{{old('phone')??main_setting_key_value($setting,'phone')}}"/>
                                            @error('phone')
                                                <div class="invalid-feedback d-block">
                                                    <strong>
                                                        {{$message}}
                                                    </strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="whatsapp">Whatsapp Number</label>
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text">
                                                <i data-feather="smartphone"></i>
                                            </span>
                                            <input type="number" id="whatsapp" class="form-control" name="whatsapp"
                                                   value="{{old('whatsapp')??main_setting_key_value($setting,'whatsapp')}}"/>
                                            @error('whatsapp')
                                                <div class="invalid-feedback d-block">
                                                    <strong>
                                                        {{$message}}
                                                    </strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="email-id-icon">Contact Email</label>
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text">
                                                <i data-feather="mail"></i>
                                            </span>
                                            <input type="email" id="email-id-icon" class="form-control" name="email" placeholder="Email"
                                                   value="{{old('email')??main_setting_key_value($setting,'email')}}"/>
                                            @error('email')
                                                <div class="invalid-feedback d-block">
                                                    <strong>
                                                        {{$message}}
                                                    </strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="whatsapp">Fax Number</label>
                                        <div class="input-group input-group-merge">
                                        <span class="input-group-text">
                                            <i data-feather="smartphone"></i>
                                        </span>
                                            <input type="number" id="fax" class="form-control" name="fax"
                                                   value="{{old('fax')??main_setting_key_value($setting,'fax')}}"/>
                                            @error('fax')
                                            <div class="invalid-feedback d-block">
                                                <strong>
                                                    {{$message}}
                                                </strong>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <h5 class="card-title text-center">Social Media  Setting</h5>
                                <hr class="mb-2" style="height: 2px;"/>

                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="facebook">Facebook Link</label>
                                        <div class="input-group input-group-merge">
                                        <span class="input-group-text">
                                            <i data-feather="facebook"></i>
                                        </span>
                                            <input type="text" id="facebook" class="form-control" name="facebook"
                                                   value="{{old('facebook')??main_setting_key_value($setting,'facebook')}}" />
                                            @error('facebook')
                                                <div class="invalid-feedback d-block">
                                                    <strong>
                                                        {{$message}}
                                                    </strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="twitter">Twitter Link</label>
                                        <div class="input-group input-group-merge">
                                        <span class="input-group-text">
                                            <i data-feather="twitter"></i>
                                        </span>
                                            <input type="text" id="twitter" class="form-control" name="twitter"
                                                   value="{{old('twitter')??main_setting_key_value($setting,'twitter')}}"/>
                                            @error('twitter')
                                                <div class="invalid-feedback d-block">
                                                    <strong>
                                                        {{$message}}
                                                    </strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="instagram">Instagram Link</label>
                                        <div class="input-group input-group-merge">
                                        <span class="input-group-text">
                                            <i data-feather="instagram"></i>
                                        </span>
                                            <input type="text" id="instagram" class="form-control" name="instagram"
                                                   value="{{old('instagram')??main_setting_key_value($setting,'instagram')}}"/>
                                            @error('instagram')
                                                <div class="invalid-feedback d-block">
                                                    <strong>
                                                        {{$message}}
                                                    </strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 col-12">
                                    <button type="submit" class="btn btn-primary me-1">Submit</button>
                                    <button type="reset" class="btn btn-outline-secondary">Reset</button>
                                </div>
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
    <style>
        label{
            font-size: 1rem !important;
        }
    </style>
@endsection
