@extends('root.layouts.app')
@section('title',__('userProfile'))

@section('content')

    <section style="background-color: #eee;">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item active"><a href="#">{{__('layouts.home')}}</a></li>
                            <li class="breadcrumb-item" aria-current="page">{{__('auth.profile')}}</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div id="user-profile-tabs" class="row user-profile-tabs">
                    <div class="col-lg-4 user-profile-list d-block">
                    <div class="card mb-4">
                        <div class="card-body p-0">
                            <ul class="list-group list-group-flush rounded-3 ps-0">
                                <a href="{{route('user-profile-show')}}" class="list-group-item d-flex justify-content-between align-items-center p-3 {{checkCurrentRoute('user-profile-show')?'active':''}}" data-target="._profileContent">
                                    <i data-feather="user"></i>
                                    <p class="mb-0">{{__('auth.myAccount')}}</p>
                                </a>
                                <a href="{{route('view-update-profile')}}" class="list-group-item d-flex justify-content-between align-items-center p-3 {{checkCurrentRoute('view-update-profile')?'active':''}}" data-target="#_editProfile">
                                    <i data-feather="edit" style="color: #333333;"></i>
                                    <p class="mb-0">{{__('auth.editProfile')}}</p>
                                </a>
                                <a href="{{route('view-change-password')}}" class="list-group-item d-flex justify-content-between align-items-center p-3 {{checkCurrentRoute('view-change-password')?'active':''}}" data-target="#_changePassword">
                                    <i data-feather="key" style="color: #ac2bac;"></i>
                                    <p class="mb-0">{{__('auth.changePass')}}</p>
                                </a>
                                <a href="{{route('show.related.orders')}}" class="list-group-item d-flex justify-content-between align-items-center p-3 {{checkCurrentRoute('show.related.orders')?'active':''}}" data-target="#_myOrders">
                                    <i data-feather="archive" style="color: #55acee;"></i>
                                    <p class="mb-0">{{__('auth.myOrders')}}</p>
                                </a>
                                <a href="{{route('view-addresses')}}" class="list-group-item d-flex justify-content-between align-items-center p-3 {{checkCurrentRoute('view-addresses')?'active':''}}" data-target="._addNewUserAddress">
                                    <i data-feather="map-pin" style="color: #ff6000;"></i>
                                    <p class="mb-0">{{__('auth.SHIPPING ADDRESS')}}</p>
                                </a>
                            </ul>
                        </div>
                    </div>

{{--                    @if(checkCurrentRoute('user-profile-show'))--}}
                        <div id="profileContentImg" class="card mb-4 mb-lg-0 _profileContent active">
                            <div class="card-body text-center">
                                <img src="{{$user->profile_image_url}}" alt="avatar" class="profile_image rounded-circle img-fluid img-thumbnail" style="width: 150px;height: 150px;box-shadow: 1px 5px 10px -5px #aaa;">
                                <h5 class="my-3 text-center">{{$user->name}}</h5>
                                <p class="text-muted mb-1 text-center">{{config('setting.pricing') === true?$user->phone:$user->employer}}</p>
    {{--                            <div class="d-flex justify-content-center mb-2">--}}
    {{--                                <button type="button" class="btn btn-primary">Follow</button>--}}
    {{--                                <button type="button" class="btn btn-outline-primary ms-1">Message</button>--}}
    {{--                            </div>--}}
                            </div>
                        </div>
{{--                    @endif--}}

                </div>

                    @yield('tabItem')

            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
        @if (session('success'))
            Swal.fire(
                'Success!',
                'Saved Successfully!',
                'success'
            );
        @endif

        let _IMG       = $("#profile_image");
        let _label       = $(".profile_image");
        let _IMG_Err   = $("#profile_image_error");
        let _IMG_ch    = true;

        let profile_updated_msg = $('#profile_updated_msg');
        let imgEX = [ `jpg`,`png`,`jpeg` ];

        _label.click(function () {
            _IMG.click();
        })

        const _chEX = function (inputFile) {
            return inputFile.val().split('.').pop().toLowerCase();
        }

        function loadImg(){

            $(`input[id=profile_image][type=file]`).on('change',function () {

                let file = $(this).get(0).files[0];
                if(imgEX.includes(_chEX(_IMG)))
                {
                    _IMG_ch = false;
                    _IMG_Err.text('');
                    if (file){
                        let reader = new FileReader();

                        reader.onloadstart = function () {
                            // imgLoader.show();
                        }
                        reader.onload = function () {
                            $(".profile_image").attr("src",reader.result);
                        }
                        reader.onloadend = function () {
                            // imgLoader.fadeOut(1000);
                        }
                        reader.readAsDataURL(file);
                    }
                }else{
                    _IMG_ch = true;
                    _IMG_Err.text('{{__('auth.imgErrorType')}}');
                }
            });
        }
        loadImg();

        let tabLinks = document.querySelectorAll('.user-profile-list a'),
            tabs     = document.querySelectorAll('#user-profile-tabs > div'),
            profileContentImg = document.getElementById('profileContentImg'),
            addNewUserAddress = document.getElementById('addNewUserAddress');

        // tabLinks.forEach(tabLink=>{
        //     tabLink.onclick = function () {
        //         let targetTabs = document.querySelectorAll(this.dataset.target);
        //         if (!this.classList.contains('active')){
        //
        //                 let items = [].slice.call(this.parentElement.children);
        //                 items.forEach(ele=>{
        //                     ele.classList.remove('active');
        //                 })
        //                 profileContentImg.classList.remove('active');
        //                 addNewUserAddress.classList.remove('active');
        //                 this.classList.add('active');
        //                 targetTabs.forEach(tabContent=>{
        //                     let items = [].slice.call(tabContent.parentElement.children);
        //                     items.forEach(ele=>{
        //                         ele.classList.remove('active');
        //                     })
        //                     tabContent.classList.add('active')
        //                 })
        //         }
        //     }
        // })

        /**** UPDATE USER PROFILE *****/
        let profileForm = $('#update-profile');

        function formSubmit(tag,res_msg) {
            $(`${tag}`).submit(function (e) {

                e.preventDefault();

                let formData = new FormData(this),
                    alertTag = $(`${res_msg}`),
                    feedback = $(`${tag} .invalid-feedback`),
                    route = $(this).attr('action');

                alertTag.removeClass('btn-success').removeClass('btn-danger').hide();

                $.ajax({
                    url:route,
                    method:'POST',
                    data:formData,
                    processData: false,
                    contentType: false,
                    success:function (data) {
                        feedback.html('');
                        if (data.tag){
                            alertTag.addClass('btn-success').show().text(data.msg)
                        }else {
                            alertTag.addClass('btn-danger').show().text(data.msg)
                        }
                    },
                    error:function (error) {
                        if (error.status===422){
                            let validation = error.responseJSON.errors;
                            feedback.html('');
                            $.each(validation, function(key,err){
                                $(`#${key}_error`).html(err);
                            });
                        }
                    }
                })
            })
        }

        // formSubmit('#update-profile','#profile_updated_msg');
        // formSubmit('#change_password_form','#changePW_msg');
        // formSubmit('#newUserAddress','#newAddress_msg');

    </script>

@endpush
