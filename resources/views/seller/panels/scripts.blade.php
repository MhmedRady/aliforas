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
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- custom scripts file for user -->
{{--<script src="{{ asset('admin-asset/js/core/scripts.js')) }}"></script>--}}
<script src="{{ asset('admin-asset/vendors/js/forms/select/select2.full.min.js') }}"></script>

@if($configData['blankPage'] === false)
    <script src="{{ asset('admin-asset/js/scripts/customizer.js') }}"></script>
@endif
<!-- END: Theme JS-->
<script>

    $('#asRead').on('click', function () {
        $('#nBranchesCount').fadeOut();
        $.ajax({
            url: "{{route('seller.branch.makeAsRead')}}",
            method: 'GET',
        })
    });

    var toaster = document.querySelector('#toaster');

    setTimeout(function () {
        if(toaster != null){
            toaster.remove();
        }
    },5000);
</script>
<!-- BEGIN: Page JS-->
@yield('page-script')
<!-- END: Page JS-->

