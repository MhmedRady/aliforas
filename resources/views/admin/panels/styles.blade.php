
@yield('vendor-style')
<!-- END: Vendor CSS-->

<!-- BEGIN: Theme CSS-->
<link rel="stylesheet" type="text/css" href="{{asset("admin-asset/css-".getPageDir()."/bootstrap.css")}}">
<link rel="stylesheet" type="text/css" href="{{asset("admin-asset/css-".getPageDir()."/bootstrap-extended.css")}}">
<link rel="stylesheet" type="text/css" href="{{asset("admin-asset/css-".getPageDir()."/colors.css")}}">
<link rel="stylesheet" type="text/css" href="{{asset("admin-asset/css-".getPageDir()."/components.css")}}">
<link rel="stylesheet" type="text/css" href="{{asset("admin-asset/css-".getPageDir()."/themes/dark-layout.css")}}">
<link rel="stylesheet" type="text/css" href="{{asset("admin-asset/css-".getPageDir()."/themes/bordered-layout.css")}}">
<link rel="stylesheet" type="text/css" href="{{asset("admin-asset/css-".getPageDir()."/themes/semi-dark-layout.css")}}">

<!-- BEGIN: Page CSS-->

<link rel="stylesheet" type="text/css" href="{{asset("admin-asset/css-".getPageDir()."/core/menu/menu-types/vertical-menu.css")}}">
<link rel="stylesheet" type="text/css" href="{{asset("admin-asset/css-".getPageDir()."/plugins/forms/form-validation.css")}}">

<!-- END: Page CSS-->

<!-- BEGIN: Custom CSS-->
@if(getPageDir() == 'rtl')
    <link rel="stylesheet" type="text/css" href="{{asset("admin-asset/css-rtl/custom.css")}}">
@endif
<link rel="stylesheet" type="text/css" href="{{asset("admin-asset/css-".getPageDir()."/style.css")}}">
<link rel="stylesheet" href="{{asset('admin-asset/style.css')}}">
<!-- END: Custom CSS-->

@yield('page-style')
