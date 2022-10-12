<!-- BEGIN: Vendor JS-->
<script src="{{ asset('admin-asset/vendors/js/vendors.min.js') }}"></script>
<!-- BEGIN Vendor JS-->
<!-- BEGIN: Page Vendor JS-->
<script src="{{asset('admin-asset/vendors/js/ui/jquery.sticky.js')}}"></script>
@yield('vendor-script')
<!-- END: Page Vendor JS-->
<!-- BEGIN: Theme JS-->
<script src="{{ asset('admin-asset/js/core/app-menu.js') }}"></script>
<script src="{{ asset('admin-asset/js/core/app.js') }}"></script>

<!-- custom scripts file for user -->
<script src="{{ asset('admin-asset/js/core/script.js') }}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('admin-asset/vendors/js/forms/select/select2.full.min.js') }}"></script>

@if($configData['blankPage'] === false)
    <script src="{{ asset('admin-asset/js/scripts/customizer.js') }}"></script>
@endif
<!-- END: Theme JS-->

<!-- START: Theme JS-->
    <script src="{{asset('admin-asset/js/core/toastr.js')}}"></script>
<!-- END: Theme JS-->

@if(Session::has('success') || Session::has('error'))
    <script>
        var toaster = document.querySelector('#toaster');
        setTimeout(function () {
            if(toaster != null){
                toaster.remove();
            }
        },5000);


    </script>
@endif

<!-- BEGIN: Page JS-->
@yield('page-script')
<!-- END: Page JS-->
