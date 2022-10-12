@extends('seller.layouts.contentLayoutMaster')

@section('title', __('auth.editProfile'))

@section('vendor-style')

    <!-- BEGIN: Vendor CSS-->
        <link rel="stylesheet" type="text/css" href="{{asset("admin-asset/vendors/css/vendors.min.css")}}">
        <link rel="stylesheet" type="text/css" href="{{asset("admin-asset/vendors/css/forms/select/select2.min.css")}}">
        <link rel="stylesheet" type="text/css" href="{{asset("admin-asset/vendors/css/forms/wizard/bs-stepper.min.css")}}">

    <!-- END: Vendor CSS-->
        <link rel="stylesheet" type="text/css" href="{{asset("admin-asset/css-".getPageDir()."/plugins/forms/form-wizard.css")}}">

@endsection
@section('page-style')
    <style>
        .content .ml-0{
            margin-left: 0 !important;
        }
    </style>

@endsection

@section('content')
    <div class="container">
        <div class="auth-wrapper auth-basic px-2">
            <div class="auth-inner my-2">

                <div class="card mb-0">
                    <div class="card-body">

                        <section class="modern-horizontal-wizard">
                            <div class="bs-stepper wizard-modern modern-wizard-example">
                                <div class="bs-stepper-header">
                                    <div class="step" data-target="#account-details-modern" role="tab" id="account-details-modern-trigger">
                                        <button type="button" class="step-trigger">
                                            <span class="bs-stepper-box">
                                                <i data-feather="file-text" class="font-medium-3"></i>
                                            </span>
                                                    <span class="bs-stepper-label">
                                                <span class="bs-stepper-title">{{__('seller.accDetails')}}</span>
                                                <span class="bs-stepper-subtitle">{{__('seller.setAccDetails')}}</span>
                                            </span>
                                        </button>
                                    </div>
                                    <div class="line">
                                        <i data-feather="chevron-right" class="font-medium-2"></i>
                                    </div>

                                    <div class="step" data-target="#personal-info-modern" role="tab" id="personal-info-modern-trigger">
                                        <button type="button" class="step-trigger">
                                            <span class="bs-stepper-box">
                                                <i data-feather="user" class="font-medium-3"></i>
                                            </span>
                                                    <span class="bs-stepper-label">
                                                <span class="bs-stepper-title">{{__('seller.pInfo')}}</span>
                                                <span class="bs-stepper-subtitle">{{__('seller.setPInfo')}}</span>
                                            </span>
                                        </button>
                                    </div>
                                    <div class="line">
                                        <i data-feather="chevron-right" class="font-medium-2"></i>
                                    </div>
                                    <div class="step" data-target="#address-step-modern" role="tab" id="address-step-modern-trigger">
                                        <button type="button" class="step-trigger">
                                            <span class="bs-stepper-box">
                                                <i data-feather="map-pin" class="font-medium-3"></i>
                                            </span>
                                                    <span class="bs-stepper-label">
                                                <span class="bs-stepper-title">{{__('seller.address')}}</span>
                                                <span class="bs-stepper-subtitle">{{__('seller.address_shipping')}}</span>
                                            </span>
                                        </button>
                                    </div>
{{--                                    <div class="line">--}}
{{--                                        <i data-feather="chevron-right" class="font-medium-2"></i>--}}
{{--                                    </div>--}}
{{--                                    <div class="step" data-target="#social-links-modern" role="tab" id="social-links-modern-trigger">--}}
{{--                                        <button type="button" class="step-trigger">--}}
{{--                                    <span class="bs-stepper-box">--}}
{{--                                        <i data-feather="link" class="font-medium-3"></i>--}}
{{--                                    </span>--}}
{{--                                            <span class="bs-stepper-label">--}}
{{--                                        <span class="bs-stepper-title">{{__('seller.store')}}</span>--}}
{{--                                        <span class="bs-stepper-subtitle">{{__('seller.addStore')}}</span>--}}
{{--                                    </span>--}}
{{--                                        </button>--}}
{{--                                    </div>--}}
                                </div>
                                <hr />
                                <div class="register-stepper-content">

                                    <form action="{{route('seller.profile.update',$user)}}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="id" value="{{$user->id}}">
                                        @include('seller.auth.profileTabs.accountDetails')
                                        @include('seller.auth.profileTabs.personalInfo')
                                        @include('seller.auth.profileTabs.addressDetails')

                                    </form>

                                </div>
                            </div>
                        </section>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('vendor-script')

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{asset('admin-asset/vendors/js/forms/wizard/bs-stepper.min.js')}}"></script>
    <script src="{{asset('admin-asset/vendors/js/forms/select/select2.full.min.js')}}"></script>
    <script src="{{asset('admin-asset/vendors/js/forms/validation/jquery.validate.min.js')}}"></script>
    <!-- END: Page Vendor JS-->
    <script src="{{asset('admin-asset/js/scripts/forms/form-wizard.js')}}"></script>

    <script>
        $('#sub_btn').on('click',function () {
            console.log('form submit');
            $('form').submit();
        })
    </script>

@endsection

@section('page-script')
    <script>
        const stateSelector = $('.state_selector'),
            stateRoute  = '{{route('get-sate-cities-onChange')}}';

        stateSelector.on('change',function () {

            let stateID = $(this).val(),
                cityTag = $(this).data('city-target'),
                citySelector = $(cityTag),
                cities = [];
            console.log(cityTag);
            $.ajax({
                url:stateRoute+stateID,
                method:'GET',
                success:function (data) {
                    data.forEach(city=>{
                        cities.push(`<option value="${city.id}">${city.name}</option>`);
                    });
                    citySelector.html(cities);
                }
            });
        });

    </script>

@endsection
