@extends('root.layouts.app')
@section('title',__('Login'))
@section('content')
    <!--section start-->
    <section class="login-page section-big-py-space b-g-light">
        <div class="custom-container">
            <div class="row">
                <div class="col-lg-4 col-md-8 offset-xl-2 offset-lg-1 m-auto">
                    <div class="theme-card">
                        @include('root.message.message')
                        @include('root.auth.loginForm')

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Section ends-->
@endsection
@push('scripts')
    <script>
        let checkOutLoginForm = $('#loginForm');

        checkOutLoginForm.submit(function () {
            $(this).unbind('submit').submit();
        })

        // $('#loginSubmit').on('click',function () {
        //     console.log($('#loginForm').serializeArray());
        // });
    </script>
@endpush
