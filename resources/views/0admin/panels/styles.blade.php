<!-- BEGIN: Vendor CSS-->
@if ($configData['direction'] === 'rtl' && isset($configData['direction']))
  <link rel="stylesheet" href="{{ asset('admin-asset/vendors/css/vendors-rtl.min.css') }}" />
@else
  <link rel="stylesheet" href="{{ asset('admin-asset/vendors/css/vendors.min.css') }}" />
@endif

@yield('vendor-style')
<!-- END: Vendor CSS-->

<!-- BEGIN: Theme CSS-->
<link rel="stylesheet" href="{{ asset('admin-asset/css/core.css') }}" />
<link rel="stylesheet" href="{{ asset('admin-asset/css/base/themes/dark-layout.css') }}" />
<link rel="stylesheet" href="{{ asset('admin-asset/css/base/themes/bordered-layout.css') }}" />
<link rel="stylesheet" href="{{ asset('admin-asset/css/base/themes/semi-dark-layout.css') }}" />

@php $configData = Helper::applyClasses(); @endphp

<!-- BEGIN: Page CSS-->
@if ($configData['mainLayoutType'] === 'horizontal')
  <link rel="stylesheet" href="{{ asset('admin-asset/css/base/core/menu/menu-types/horizontal-menu.css') }}" />
@else
  <link rel="stylesheet" href="{{ asset('admin-asset/css/base/core/menu/menu-types/vertical-menu.css') }}" />
@endif

{{-- Page Styles --}}
@yield('page-style')

<!-- laravel style -->
<link rel="stylesheet" href="{{ asset('admin-asset/css/overrides.css') }}" />
<link rel="stylesheet" type="text/css" href="{{asset('admin-asset/vendors/css/forms/wizard/bs-stepper.min.css')}}">
<link rel="stylesheet" href="{{ asset('admin-asset/vendors/css/forms/select/select2.min.css') }}" />
{{--<link rel="stylesheet" href="{{ asset('admin-asset/css-rtl/bootstrap.min.css') }}" />--}}
<link rel="stylesheet" href="{{ asset('admin-asset/vendors/css/forms/select/select2-bootstrap-5-theme.rtl.min.css') }}" />


<!-- BEGIN: Custom CSS-->
<link rel="stylesheet" href="{{ asset('admin-asset/css/toastr.css') }}" />

@if ($configData['direction'] === 'rtl' && isset($configData['direction']))
  <link rel="stylesheet" href="{{ asset('admin-asset/css-rtl/custom-rtl.css') }}" />
  <link rel="stylesheet" href="{{ asset('admin-asset/css-rtl/style-rtl.css') }}" />
@else
  {{-- user custom styles --}}
  <link rel="stylesheet" href="{{ asset('admin-asset/css/style.css') }}" />
@endif

