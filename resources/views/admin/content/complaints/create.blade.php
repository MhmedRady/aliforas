@extends('admin.layouts.contentLayoutMaster')
@section('content')
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Complaints</h4>
            </div>
            <div class="col-md-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item "><a href="javascript:void(0)">Complaints</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body wizard-content">

                        {!! Form::open([
                            "enctype" => "multipart/form-data",
                            'url' => route('admin.complaints.postNew'), 'class' => 'tab-wizard vertical wizard-circle', 'id' => 'add_brand_form']) !!}

                            <section>
                                <div class="form-group col-md-6">
                                    <label for="toUser">To:</label>
                                    <input id="toUser" class="form-control" type="text" name="toUser" value="{{old("toUser")}}">

                                    <ul id="list-user" class="list-suer w-100">

                                    </ul>

                                </div>
                            </section>
                            <section>
                                <div class="form-group">
                                    <label for="title">Title:</label>
                                    <input type="text" name="title" class="form-control" value="{{old("title")}}">
                                </div>
                            </section>
                            <section>
                                <div class="form-group">
                                    <label for="body">Body:</label>
                                    <textarea name="body" class="form-control">{{old("body")}}</textarea>
                                </div>
                            </section>

                        <button type="submit" class="btn btn-success">Submit</button>

                        {!! Form::close() !!}

                    </div>

                </div>
            </div>
        </div>

        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->
    </div>
@endsection
@section('page-style')

    <link href="{{asset('admin-asset/assets/node_modules/wizard/steps.css')}}" rel="stylesheet">
    <link href="{{asset('admin-asset/assets/node_modules/sweetalert/sweetalert.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('admin-asset/dist/css/custom.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('admin-asset/assets/node_modules/summernote/dist/summernote-bs4.css')}}">

@endsection
@section('page-script')

    <script src="{{asset('admin-asset/assets/node_modules/wizard/jquery.steps.min.js')}}"></script>
    <script src="{{asset('admin-asset/assets/node_modules/wizard/jquery.validate.min.js')}}"></script>
    <script src="{{asset('admin-asset/assets/node_modules/sweetalert/sweetalert.min.js')}}"></script>
    <script src="{{asset('admin-asset/assets/node_modules/summernote/dist/summernote-bs4.min.js')}}"></script>

    <script type="text/javascript">

        /* let li = document.querySelectorAll(".user-li");
            li.forEach(el=>{
                el.
            }); */
            function user_li(e) {
                $("#list-user").hide(1);
                $("#toUser").val(e.target.innerText);
                /* console.log($(this).val()); */
            }
        $("#toUser").on("keyup",function () {
            let user = $(this).val(),
                ul = $("#list-user");

            if ($(this).val().length > 0) {
                $.ajax({
                    url: "{{route('admin.complaints.getSeller')}}",
                    data: {"_token": '{{csrf_token()}}',"user": user.trim()},
                    type: "GET",
                    success:function(data){
                        // console.log(data);
                        let users = '';
                        if (data.length>0) {
                            ul.show(1);
                            data.forEach((el,i) => {
                                users += `<li id="user-${i}"  onclick="user_li(event)" class="user-li">${el.name}</li>`;
                            });
                        }else{
                            users = `<li>no results matched</li>`;
                        }
                        ul.html(users);
                    },
                    error:function (){}
                });
            }else{
                ul.fadeOut(1);
            }
        });



 /*        $("input[type=search]").on("keyup",function () {
            let user = $(this).val();
            $.ajax({
                url: "{{route('admin.complaints.getSeller')}}",
                data: {"_token": '{{csrf_token()}}',"user": user},
                type: "GET",
                success:function(data){
                    // console.log(data);
                    let users = '';
                    let Option = '';
                    data.forEach((el,i) => {
                        users += `<li><a id="bs-seler-1-${i}" class="dropdown-item" tabindex="0" aria-setsize="4" aria-posinset="${i+1}">${el.name}</a></li>`;
                        Option += `<option id="${el.id}">${el.name}</option>`;
                        $(`bs-seler-1-${i}`).on("click",function(){
                            console.log($("#sellerID").val());
                        });
                    });

                    $("#bs-select-1 ul").html(users);
                    $("#sellerID").html(Option);
                },
                error:function (){}
            });
        });
         */

</script>
@endsection
