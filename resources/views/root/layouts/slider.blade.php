


@if(isset($slider))
    @if($slider->where('is_banner','0')->count()>0)
    <!--slider start-->
        <section class="theme-slider layout-5 home-slide">
            <div class="container-fluid py-3 px-3">
                <div class="row">
                    <div class="col-12 p-0">
                        <div class="slide-1">
                            @foreach($slider->where('is_banner','0') as $k => $tab)
                                <div>
                                    <div class="slider-banner slide-banner-4">
                                        <div class="slider-img" style="background-image: url({{$tab->image_url(1410,490)}}); background-repeat: no-repeat; background-size: 100% 100%">
                                            <ul class="layout5-slide-1">
{{--                                                <li id="img-1">--}}
{{--                                                    <img src="https://www.unitedinfocus.com/static/uploads/14/2022/03/GettyImages-1239220648-scaled.jpg" class="img-fluid" alt="slider">--}}
{{--                                                </li>--}}
                                            </ul>
                                        </div>
                                        @if(!is_null($tab->title))
                                        <div class="slider-banner-contain">
                                            <div>
                                                <h1>{{$tab->title}}</h1>
                                                <h3>{{$tab->sub_title}}</h3>
                                                <h2>{{$tab->description}}</h2>
                                                <a href="{{ $tab->product_id?route('products.show', $tab->product->slug):'javascript:void(0)' }}" class="btn btn-light btn-btn">
                                                    {{__('layouts.shopNow')}}
                                                </a>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <!--slider end-->

    @if($slider->where('is_banner','1')->count()>0)
        <section class="collection-banner mt-3">
            <div class="custom-container">
                <div class="row layout-6-collection">
                    @foreach($slider->where('is_banner','1') as $banner)
                        <div class="col-md-6 d-block mb-3">
                            <div class="collection-banner-main p-left  height-equal">
                                <div class="collection-img">
                                    <img src="{{$banner->image_url(400,250)}}" class="img-fluid bg-img" alt="{{$banner->name}}">
                                </div>
{{--                                <div class="collection-banner-contain">--}}
{{--                                    <div>--}}
{{--                                        <h3>{{$banner->sub_title}}</h3>--}}
{{--                                        <h4>{{$banner->title}}</h4>--}}
{{--                                        <div class="shop">--}}
{{--                                            <a href="{{ $banner->product_id?route('products.show', $banner->product->slug):'javascript:void(0)' }}">--}}
{{--                                                {{__('layouts.shopNow')}}--}}
{{--                                                <i class="fa fa-arrow-circle-right"></i>--}}
{{--                                            </a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @endif
@endif
