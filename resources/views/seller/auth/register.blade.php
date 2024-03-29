@extends('seller.layouts.fullLayoutMaster')

@section('title', __('seller.register'))

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
        .content-header{
            margin-bottom: 1.5rem !important;
            margin-top: 1.5rem !important;
        }
    </style>

@endsection

@section('content')
    <div class="container">
        <div class="auth-wrapper auth-basic px-2">
            <div class="auth-inner my-2">
                <div class="text-center mt-5 mb-4 w-100">
                    <a href="#" class="brand-logo">
                        <img src="{{ env('LOGO_MINI_PATH') }}" width="64px" alt="{{ env('APP_NAME') }}">
                        <h2 class="brand-text text-primary ms-1" style="align-self: center;">{{ env('APP_NAME') }}</h2>
                    </a>
                </div>
                <div class="card mb-0">
                    <div class="card-body">
                        <div class="lang-change">
                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <a rel="alternate" class="{{$localeCode !== app()->getLocale() ? 'active':''}}" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                    {{ $properties['native'] }}
                                </a>
                            @endforeach
                        </div>
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

                                    <form action="{{route('seller.storeRegister')}}" method="post">
                                        @csrf

                                        @include('seller.auth.registerTabs.accountDetails')
                                        @include('seller.auth.registerTabs.personalInfo')
                                        @include('seller.auth.registerTabs.addressDetails')

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
