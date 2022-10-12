@if(!empty($isHot))
    <!--hot deal start-->
    <section class="hot-deal hotdeal-first b-g-white section-big-pb-space space-abjust">
        <div class="custom-container">
            <div class="row hot-2 ">
                <div class="col-12">
                    <!--title start-->
                    <div class="title3 b-g-white text-left">
                        <h4>today's hot deal</h4>
                    </div>
                    <!--titel end-->
                </div>

                <div class="col-lg-9">
                    <div class="slide-1 no-arrow">
                        @if(is_array($isHot) && count($isHot) > 0 &&  $isHot[0])
                            <div>
                                <div class="hot-deal-contain ">
                                    <div class="row hot-deal-subcontain hotdeal-block1">
                                        <div class="col-lg-4 col-md-4  ">
                                            <div class="hotdeal-right-slick border-0">

                                                @foreach($isHot as $key => $item)
                                                    <a href="{{route("web.products.show",$item->Translate->slug)}}">
                                                        <div class="img-wraper">
                                                            <div>
                                                                <img
                                                                    src="{{$item->image_url}}"
                                                                    alt="{{$item->Translate->slug}}"
                                                                    class="img-fluid  bg-img">
                                                            </div>
                                                        </div>
                                                    </a>
                                                @endforeach

                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 deal-order-3">
                                            <div class="hotdeal-right-slick border-0">
                                                @foreach($isHot as $key => $item)
                                                    <div>
                                                        <div>
                                                            <a href="{{route("web.products.show",$item->Translate->slug)}}">
                                                                <h5> {{$item->Translate->name}} </h5>
                                                            </a>
                                                            @include("website.components.rating",["rate"=>$item->reward_points])

                                                            <div class="intro_Desc">
                                                                {{$item->Translate->description}}
                                                            </div>

                                                            <h6>{{$item->price}}<span>{{$item->hot_price}}</span></h6>
                                                            <div class="timer">
                                                                <p id="demo">
                                                                </p>
                                                            </div>
                                                            <a href="{{route("web.products.show",$item->Translate->slug)}}"
                                                               class="btn btn-normal btn-md ">shop now</a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-md-2 ">
                                            <div class="hotdeal-right-nav">
                                                @foreach($isHot as $item)
                                                    <div><img src="{{$item->image_url}}"
                                                              alt="{{$item->Translate->slug}}" class="img-fluid  ">
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="slide-1-section no-arrow">
                        <div>
                            <div class="media-banner border-0">
                                <div class="media-banner-box">
                                    <div class="media-heading">
                                        <h5>New Products</h5>
                                    </div>
                                </div>
                                @if($latest->count()>0)
                                    @foreach($latest as $item)
                                        <div class="media-banner-box">
                                            <div class="media">
                                                <a href="{{route("web.products.show",$item->slug)}}">
                                                    <img src="{{$item->image_url}}"
                                                         class="img-fluid " alt="banner">
                                                </a>
                                                <div class="media-body">
                                                    <div class="media-contant">
                                                        <div>
                                                            <div class="product-detail">
                                                                @include("website.components.rating",["rate"=>$item->reward_points])
                                                                <a href="{{route("web.products.show",$item->slug)}}">
                                                                    <p>{{$item->name}}</p></a>
{{--                                                                <h6>EGP {{$item->price}} @if($item->before_price>0)<span>{{$item->before_price}}</span>@endif</h6>--}}
                                                                <div class="Quantity">
                                                                    @if($item->stock>0)
                                                                        <span class="btn badge btn-primary btn-sm">in stock</span>
                                                                    @else
                                                                        <span class="btn badge btn-danger btn-sm out-stock">out of stock</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="cart-info">
                                                                <button data-bs-toggle="modal"
                                                                        data-url="{{route("web.CartList.addNew",$item->slug)}}"
                                                                        class="_add-to-cart tooltip-top" data-tippy-content="Add to cart" >
                                                                    <i  data-feather="shopping-cart"></i>
                                                                </button>
                                                                <a href="javascript:void(0)" data-url="{{route("web.Wishlist.addNew",$item->slug)}}"
                                                                   class="add-to-wish tooltip-top {{$item->added_to_wishlist == 1 ? "addedToCart" :""}}"
                                                                   data-tippy-content="Add to Wishlist">
                                                                    <i  data-feather="heart"></i>
                                                                </a>
                                                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#quick-view"
                                                                   class="tooltip-top _quick-view"
                                                                   data-tippy-content="Quick View" data-details="{{route("web.products.show",$item->slug)}}"
                                                                   data-cart-url="{{route('web.CartList.addNew',$item->slug)}}" data-urlImg="{{url("storage/image/product/")}}"
                                                                   data-url="{{route("web.product.quick",$item->id)}}" >
                                                                    <i  data-feather="eye"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                <div class="media-banner-box">
                                    <div class="media-view">
                                        <h5>View More</h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--hot deal start-->
@endif
