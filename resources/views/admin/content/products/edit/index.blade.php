@extends('admin.layouts.contentLayoutMaster')

@section('vendor-style')

    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css" rel="stylesheet" />
{{--    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">--}}
{{--    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet">--}}
{{--    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.7.0/summernote.css" rel="stylesheet">--}}

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset("admin-asset/vendors/css/vendors.min.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("admin-asset/vendors/css/forms/select/select2.min.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("admin-asset/vendors/css/forms/wizard/bs-stepper.min.css")}}">

    <!-- END: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset("admin-asset/css-ltr/plugins/forms/form-wizard.css")}}">

@endsection
@section('page-style')
    {{--    <style>--}}
    {{--        .select2-container--focus{--}}
    {{--            display: none !important;--}}
    {{--        }--}}
    {{--        [class*='feather-arrow-'],--}}
    {{--        .line{--}}
    {{--            transform: rotateZ(.5turn) !important;--}}
    {{--        }--}}
    {{--    </style>--}}
@endsection

@section('content')

    <section class="modern-horizontal-wizard">
        <div class="bs-stepper wizard-modern modern-wizard-example">
            @include('admin.content.products.edit.links')
            <div class="row">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
             </div>
            <div class="bs-stepper-content">



                @if(Session::has('success'))
                    <button class="btn btn-block btn-success mb-3 font-85" style="font-weight: bold;">
                        {{Session::get('success')}}
                    </button>
                @endif

                <form id="productForm" action="{{route('admin.products.update',$row)}}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    @method('PUT')

                    {{-- PRODUCT DETALIS --}}
                    @include('admin.content.products.edit.info')

                    {{-- PRODUCT STOCK DETALIS --}}
                    @include('admin.content.products.edit.stock')

                    {{-- PRODUCT IMAGES --}}
                    @include('admin.content.products.edit.images')
                    @if(config('setting.pricing'))
                        {{-- PRODUCT ATTRIBUTES --}}
                        @include('admin.content.products.edit.attributes')
                    @endif
                    {{-- PRODUCT MAIN INFO --}}
                    @include('admin.content.products.edit.main-info')
                    @include('admin.content.products.edit.main-info2')

                    <div class="mt-3 row text-right">
                        <div class="col-xs-3">
                            <input id="sub_btn" type="submit" class="btn btn-success waves-effect waves-float waves-light" value="Submit"/>
                        </div>
                    </div>
{{--                    <input type="submit" id="_form_submit" value="_form_submit">--}}
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

{{--    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.js"></script>--}}
{{--    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script>--}}
    @if(config('setting.pricing'))
        <script src="{{asset('admin-asset/vendors/js/forms/repeater/jquery.repeater.min.js')}}"></script>
        <script src="{{asset('admin-asset/js/scripts/forms/form-repeater.js')}}"></script>
    @endif

    <!-- include summernote css/js-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>
{{--    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.7.0/summernote.js"></script>--}}


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
        // $('#try_submit').click(function () {

        // })
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
        // $('#sub_btn').on('click',function () {
        //     console.log('form submit');
        //     $('form').submit();
        // })
    </script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 250, // set editor height
                minHeight: null, // set minimum height of editor
                maxHeight: null, // set maximum height of editor
                focus: false // set focus to editable area after initializing summernote
            });
        });

        @if(config('setting.pricing'))
            $('.delete-attribute').on('click',function (){
               let itemClass = $(`.${$(this).data('repeater-delete-item')}`);
               let attrConfirm = confirm('Are you sure you want to delete this element?');
               if (attrConfirm)
               {
                   let route = `{{route('admin.att-product-before-delete')}}${$(this).data('attr-id')}` ;
                   $.ajax({
                       url: route,
                       success: function (data) {
                           if (data.test){
                               itemClass.slideUp(500, function () {
                                   itemClass.remove();
                               });
                           }else {
                               alert(data.msg);
                           }
                       }
                   })
                   // itemClass.slideUp();
               }
            });
        @endif
    </script>
@endsection
