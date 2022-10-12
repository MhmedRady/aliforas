@extends('admin.layouts.contentLayoutMaster')

@section('vendor-style')

    <!-- BEGIN: Vendor CSS-->
        <link rel="stylesheet" type="text/css" href="{{asset('admin-asset/vendors/css/vendors-rtl.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('admin-asset/vendors/css/forms/wizard/bs-stepper.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('admin-asset/vendors/css/forms/select/select2.min.css')}}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Page CSS-->
        <link rel="stylesheet" type="text/css" href="{{asset('admin-asset/css-rtl/core/menu/menu-types/vertical-menu.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('admin-asset/css-rtl/plugins/forms/form-validation.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('admin-asset/css-rtl/plugins/forms/form-wizard.css')}}">
    <!-- END: Page CSS-->

    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css" rel="stylesheet" />
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet">
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.7.0/summernote.css" rel="stylesheet">

@endsection
@section('page-style')
    <style>
        .select2-container--focus{
            display: none !important;
        }
        [class*='feather-arrow-'],
        .line{
            transform: rotateZ(.5turn) !important;
        }
    </style>
@endsection



@section('content')

    <section class="modern-horizontal-wizard">
        <div class="bs-stepper wizard-modern modern-wizard-example">
            @include('admin.content.products.create.links')
            <div class="bs-stepper-content">

                @if(Session::has('success'))
                    <button class="btn btn-block btn-success mb-3 font-85" style="font-weight: bold;">
                        {{Session::get('success')}}
                    </button>
                @endif

                <form id="productForm" action="{{route('admin.products.store')}}" method="post" enctype="multipart/form-data">
                    @csrf

                    {{-- PRODUCT DETALIS --}}
                    @include('admin.content.products.create.info')

                    {{-- PRODUCT STOCK DETALIS --}}
                    @include('admin.content.products.create.stock')

                    {{-- PRODUCT IMAGES --}}
                    @include('admin.content.products.create.images')

                    {{-- PRODUCT MAIN INFO --}}
                    @include('admin.content.products.create.main-info')

                </form>
            </div>
        </div>
    </section>

@endsection

@section('page-script')

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{asset('admin-asset/vendors/js/forms/wizard/bs-stepper.min.js')}}"></script>
{{--    <script src="{{asset('admin-asset/vendors/js/forms/select/select2.full.min.js')}}"></script>--}}
    <script src="{{asset('admin-asset/vendors/js/forms/validation/jquery.validate.min.js')}}"></script>
    <!-- END: Page Vendor JS-->
    <script src="{{asset('admin-asset/js/scripts/forms/form-wizard.js')}}"></script>

    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script>

    <!-- include summernote css/js-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.7.0/summernote.js"></script>
    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 250, // set editor height
                minHeight: null, // set minimum height of editor
                maxHeight: null, // set maximum height of editor
                focus: false // set focus to editable area after initializing summernote
            });
        });
    </script>

    <script>
        $(function() {
            jQuery('#hot_starts_at').datetimepicker({
                minDate: 'today',
            });
            jQuery('#hot_ends_at').datetimepicker({
                minDate: 'today',
            });
            jQuery('#sale_ends_at').datetimepicker({
                minDate: 'today',
            });

            $('#stock').change(function () {
                $('#minimum_stock').prop('max', $(this).val())
            })

            $('#price').change(function () {
                $('#before_price').prop('max', $(this).val())
            })

            $('#return_allowed').change(function () {
                if($(this).is(':checked')) {
                    $('[data-show="return_allowed"]').slideDown();
                } else {
                    $('[data-show="return_allowed"]').slideUp();
                }
            });

            $('#on_sale').change(function () {
                if($(this).is(':checked')) {
                    $('#is_hot').prop('checked', false).trigger('change');
                    $('#is_combo').prop('checked', false).trigger('change');
                    $('[data-show="on_sale"]').slideDown();
                } else {
                    $('[data-show="on_sale"]').slideUp();
                }
            });

            $('#is_hot').change(function () {
                if($(this).is(':checked')) {
                    $('#on_sale').prop('checked', false).trigger('change');
                    $('#is_combo').prop('checked', false).trigger('change');
                    $('[data-show="is_hot"]').slideDown();
                } else {
                    $('[data-show="is_hot"]').slideUp();
                }
            });

            $('#is_combo').change(function () {
                if($(this).is(':checked')) {
                    $('#on_sale').prop('checked', false).trigger('change');
                    $('#is_hot').prop('checked', false).trigger('change');
                    $('[data-show="is_combo"]').slideDown();
                } else {
                    $('[data-show="is_combo"]').slideUp();
                }
            });

            $('.summernote').summernote({
                height: 350, // set editor height
                minHeight: null, // set minimum height of editor
                maxHeight: null, // set maximum height of editor
                focus: false // set focus to editable area after initializing summernote
            });

            $('.inline-editor').summernote({
                airMode: true
            });

        });

        window.edit = function() {
            $(".click2edit").summernote()
        },

            window.save = function() {
                $(".click2edit").summernote('destroy');
            }

    </script>


    <script>
        $('#try_submit').click(function () {

        })
        $('#return_allowed').change(function () {

            if ($(this).prop('checked')){
                console.log('return_allowed')
                $('#before_price,#sale_ends_at,#hot_starts_at,#hot_ends_at,#hot_price').val('');
                $('#on_sale,#is_hot').prop('checked',false);
                $('#on_sale,#is_hot').trigger('change');
            }
        });
        $('#on_sale').change(function () {
            if ($(this).prop('checked')){
                $('#return_duration,#hot_starts_at,#hot_ends_at,#hot_price').val('');
                $('#return_allowed,#is_hot').prop('checked',false);
                $('#return_allowed,#is_hot').trigger('change');
            }
        });
        $('#is_hot').change(function () {
            if ($(this).prop('checked')){
                $('#return_duration,#before_price,#sale_ends_at').val('');
                $('#return_allowed,#on_sale').prop('checked',false);
                $('#return_allowed,#on_sale').trigger('change');
            }
        });
    </script>
    <script defer>
        @if (isset($issale) && $issale)
        $('div[data-show="on_sale"]').show();
        @endif
        @if (isset($ishot) && $ishot)
        $('div[data-show="is_hot"]').show();
        @endif
    </script>
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $(input).parent().find('img').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
        $(document).on('change', '.file', function () {
            readURL(this);
        })
    </script>

    <script>
        $(document).on('click', '.set-thumbnail', function () {
            $('.gallery li').removeClass('selected');
            $('.gallery .thumb-input').val(0);
            $('.gallery .set-thumbnail').find('i').removeClass('mdi-check-circle-outline')
                .addClass('mdi-checkbox-blank-circle-outline')
            $(this).parent().parent().addClass('selected');
            $(this).find('i').removeClass('mdi-checkbox-blank-circle-outline')
                .addClass('mdi-check-circle-outline')
            $(this).parent().parent().find('.thumb-input').val(1);
            return false;
        });
        $(document).on('click', '.delete-gallery', function () {
            $(this).parent().parent().remove();
            return false;
        })
        $(document).on('click', '.add-new', function () {
            var html = $('#gallery-item').html();
            $('.gallery ul li:last').before(html)
            return false;
        });
        $('#sub_btn').on('click',function () {
            console.log('form submit');
            $('form').submit();
        })
    </script>
@endsection
