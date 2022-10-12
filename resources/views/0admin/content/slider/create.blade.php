@extends('admin.layouts.contentLayoutMaster')

@section('vendor-style')
    <link rel="stylesheet" type="text/css" href="{{asset('admin-asset/vendors/css/forms/select/select2.min.css')}}">
@endsection

@section('page-style')
    <style>
        label, .invalid-feedback
        {
            text-align: center;
            font-size: 1rem !important;
            font-weight: bold;
        }
        ul.select2-results__options,
        span.select2-selection__rendered{
            text-align: end !important;
        }
        span.select2-selection__arrow{
            display: none !important;
        }
    </style>
@endsection

@section('content')

    <!-- Basic Inputs start -->
        <section id="basic-input">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Slider Inputs</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.slider.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">

                                    <div class="col-md-12" style="overflow: hidden">
                                        <label class="form-label text-center w-100" for="imageInput">Slider Image</label>
                                        <div class="mb-1 justify-content-center d-flex overflow-hidden">
                                            <img id="sliderImage" class="img-thumbnail" src="{{asset('website/images/mega-store/slider/1.jpg  ')}}" style="cursor: pointer;min-width: 1140px; height: 460px;">
                                            <img id="bannerImage" class="img-thumbnail d-none" src="{{asset('website/images/layout-1/collection-banner/2.jpg')}}" style="cursor: pointer;height: 250px;">
                                        </div>
                                        <input type="file" class="form-control d-none" id="imageInput" name="image"/>
                                        @error('image')
                                            <div class="invalid-feedback d-block">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col-md-12">

{{--                                        <div class="row mt-3">--}}
{{--                                            @foreach($languages as $locale)--}}
{{--                                                <div class="col-md-6 col-12">--}}
{{--                                                    <div class="mb-1">--}}
{{--                                                        <label class="form-label" for="titleInput_{{$locale->locale}}">  <span class="badge btn-danger">{{$locale->name}}</span>  Title</label>--}}
{{--                                                        <input type="text" class="form-control" id="titleInput_{{$locale->locale}}" name="title[{{$locale->locale}}]" value="{{old("title.$locale->locale")}}"/>--}}
{{--                                                        @error("title.$locale->locale")--}}
{{--                                                        <div class="invalid-feedback d-block">--}}
{{--                                                            {{$message}}--}}
{{--                                                        </div>--}}
{{--                                                        @enderror--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}

{{--                                                <div class="col-md-6 col-12">--}}
{{--                                                    <div class="mb-1">--}}
{{--                                                        <label class="form-label" for="subTitleInput_{{$locale->locale}}">  <span class="badge btn-danger">{{$locale->name}}</span>  Subtitle</label>--}}
{{--                                                        <input type="text" class="form-control" id="subTitleInput_{{$locale->locale}}" name="sub_title[{{$locale->locale}}]" value="{{old("sub_title.$locale->locale")}}"/>--}}
{{--                                                        @error("sub_title.$locale->locale")--}}
{{--                                                        <div class="invalid-feedback d-block">--}}
{{--                                                            {{$message}}--}}
{{--                                                        </div>--}}
{{--                                                        @enderror--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}

{{--                                                <div class="col-md-6 col-12">--}}
{{--                                                    <div class="mb-1">--}}
{{--                                                        <label class="form-label" for="descriptionInput_{{$locale->locale}}">  <span class="badge btn-danger">{{$locale->name}}</span>  Slider Description</label>--}}
{{--                                                        <input type="text" class="form-control" id="descriptionInput_{{$locale->locale}}" name="description[{{$locale->locale}}]" value="{{old("description.$locale->locale")}}"/>--}}
{{--                                                        @error("description.$locale->locale")--}}
{{--                                                        <div class="invalid-feedback d-block">--}}
{{--                                                            {{$message}}--}}
{{--                                                        </div>--}}
{{--                                                        @enderror--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <hr class="mt-1 mb-1"/>--}}
{{--                                            @endforeach--}}

{{--                                        </div>--}}

                                        <div class="row mt-3">
                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="select2-basic">Product Name <small>(Select From On Sale Or Is Hot Products)</small></label>
                                                    <select class="select2 form-select" id="select2-basic" name="product_id">
                                                        <option value="0" disabled selected>Select Product By Name</option>
                                                        @foreach($products as $item)
                                                            <option value="{{$item->id}}" {{old('product_id')==$item->id?'selected':''}}>{{$item->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('product_id')
                                                    <div class="invalid-feedback d-block">
                                                        {{$message}}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-3">
                                            <div class="col-md-4 col-12">
                                                <div class="mb-1">
                                                    <div class="btn-group" data-toggle="buttons">
                                                        <div class="btn btn-warning">
                                                            <input type="checkbox" class="custom-control-input" id="Activate" name="is_active" checked autocomplete="off">
                                                            <label class="custom-control-label" for="Activate">Slide Tab Activate</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-12">
                                                <div class="mb-1">
                                                    <div class="btn-group" data-toggle="buttons">
                                                        <div class="btn btn-primary">
                                                            <input type="checkbox" class="custom-control-input" id="is_banner" name="is_banner" autocomplete="off">
                                                            <label class="custom-control-label" for="is_banner">Set As Banner</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <button class="btn btn-primary btn-block font-bold w-100">
                                                    Submit
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <!-- Basic Inputs end -->
@endsection

@section('page-script')
    <script src="{{asset('admin-asset/js/scripts/forms/form-select2.js')}}"></script>
    <script>
        let image = document.getElementById('sliderImage');
        let bannerImage = document.getElementById('bannerImage');
        let imageInput = document.getElementsByName('image')[0];
        (image).onclick = function () {

            imageInput.click();
        }
        bannerImage.onclick = function () {

            imageInput.click();
        }

        function readURL(input) {
            if (input.files && input.files[0]) {
                let reader = new FileReader();

                reader.onload = function(e)
                {
                    image.setAttribute('src', e.target.result);
                    bannerImage.setAttribute('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
        imageInput.onchange = (e)=>readURL(e.target);

        let isBanner = document.getElementById('is_banner'),
            sliderDescription = document.querySelectorAll('*[id^="descriptionInput_"]');
            isBanner.onchange = function (){
                image.classList.toggle('d-none');
                bannerImage.classList.toggle('d-none');
                sliderDescription.forEach((el)=>{
                    console.log(el.parentElement.classList.toggle('d-none'));
                });
            }
    </script>

@endsection































































