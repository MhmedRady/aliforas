

<!-- media banner tab start-->
<section class=" ratio_square section-big-mt-space">
    <div class="custom-container b-g-white section-pb-space">
        <div class="row">
            <div class="col p-0">
                <div class="theme-tab product">
                    <ul class="tabs tab-title media-tab">
                        <li class="current"><a href="tab-7">new product</a></li>
                        {{--                  <li class=""><a href="tab-8">Feature Products</a></li>--}}
                        <li class=""><a href="tab-9">best Sellers</a></li>
                        <li class=""><a href="tab-10">On Sale</a></li>
                    </ul>
                    <div class="tab-content-cls">
                        <div id="tab-7" class="tab-content active default">
                            <div class="media-slide-5 product-m no-arrow">

                                @foreach($new as $mainItem)
                                    <div>
                                        <div class="media-banner media-banner-1 border-0">
                                            @foreach($mainItem as $key => $item)

                                                <div class="media-banner-box">
                                                    <div class="media">
                                                        <a href="{{route("web.products.show",$item->slug)}}">
                                                            <img src="{{$item->image->image_url}}" class="img-fluid " alt="{{$item->name}}" style="max-width: 70px;height: 100px;">
                                                        </a>
                                                        <div class="media-body">
                                                            <div class="media-contant">
                                                                <div>
                                                                    <div class="product-detail">
                                                                        <ul class="rating">
                                                                            @include("website.components.rating",["rate"=>$item->reward_points])
                                                                        </ul>
                                                                        <a href="{{route("web.products.show",$item->slug)}}"><p>{{$item->name}}</p></a>
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

                                                                        <a href="javascript:void(0)" data-url="{{route("web.Wishlist.addNew",$item->slug)}}" class="add-to-wish tooltip-top"  data-tippy-content="Add to Wishlist">
                                                                            <i  data-feather="heart"></i>
                                                                        </a>

                                                                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#quick-view"
                                                                           class="tooltip-top _quick-view"
                                                                           data-tippy-content="Quick View"
                                                                           data-cart-url="{{route('web.CartList.addNew',$item->slug)}}"
                                                                           data-details="{{route("web.products.show",$item->slug)}}"
                                                                           data-url="{{route("web.product.quick",$item->id)}}"
                                                                           data-urlImg="{{url("storage/image/product/")}}">
                                                                            <i  data-feather="eye"></i>
                                                                        </a>

                                                                        {{--                                                                        <a href="compare.html"  class="tooltip-top" data-tippy-content="Compare"><i  data-feather="refresh-cw"></i></a>--}}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>

                        {{--                  <div id="tab-8" class="tab-content ">--}}
                        {{--                    <div class="media-slide-5 product-m no-arrow">--}}
                        {{--                      <div>--}}

                        {{--                        <div class="media-banner media-banner-1 border-0">--}}
                        {{--                          <div class="media-banner-box">--}}
                        {{--                            <div class="media">--}}
                        {{--                              <a href="product-page(left-sidebar).html">--}}
                        {{--                                <img src="../assets/images/layout-2/media-banner/2.jpg" class="img-fluid " alt="banner">--}}
                        {{--                              </a>--}}
                        {{--                              <div class="media-body">--}}
                        {{--                                <div class="media-contant">--}}
                        {{--                                  <div>--}}
                        {{--                                    <div class="product-detail">--}}
                        {{--                                      <ul class="rating">--}}
                        {{--                                      <li><i class="fa fa-star" ></i></li>--}}
                        {{--                                      <li><i class="fa fa-star" ></i></li>--}}
                        {{--                                      <li><i class="fa fa-star" ></i></li>--}}
                        {{--                                      <li><i class="fa fa-star" ></i></li>--}}
                        {{--                                      <li><i class="fa fa-star-o" ></i></li>--}}
                        {{--                                    </ul>--}}
                        {{--                                    <a href="product-page(left-sidebar).html"><p>usha table fan</p></a>--}}
                        {{--                                    <h6>$52.05 <span>$60.21</span></h6>--}}
                        {{--                                    </div>--}}
                        {{--                                    <div class="cart-info">--}}
                        {{--                                          <button data-bs-toggle="modal" data-bs-target="#addtocart" class="tooltip-top" data-tippy-content="Add to cart" ><i  data-feather="shopping-cart"></i></button>--}}
                        {{--                                          <a href="javascript:void(0)"  class="add-to-wish tooltip-top"  data-tippy-content="Add to Wishlist" ><i  data-feather="heart" class="add-to-wish"></i></a>--}}
                        {{--                                          <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#quick-view" class="tooltip-top"  data-tippy-content="Quick View"><i  data-feather="eye"></i></a>--}}
                        {{--                        --}}{{--                                          <a href="compare.html"  class="tooltip-top" data-tippy-content="Compare"><i  data-feather="refresh-cw"></i></a>--}}
                        {{--                                      </div>--}}
                        {{--                                  </div>--}}
                        {{--                                </div>--}}
                        {{--                              </div>--}}
                        {{--                            </div>--}}
                        {{--                          </div>--}}

                        {{--                        </div>--}}
                        {{--                      </div>--}}

                        {{--                    </div>--}}
                        {{--                  </div>--}}
                        <div id="tab-9" class="tab-content ">
                            <div class="media-slide-5 product-m no-arrow">

                                @foreach($bestSeller as $mainItem)
                                    <div>
                                        <div class="media-banner media-banner-1 border-0">
                                            @foreach($mainItem as $key => $item)

                                                <div class="media-banner-box">
                                                    <div class="media">
                                                        <a href="{{route("web.products.show",$item->slug)}}">
                                                            <img src="{{$item->image_url}}" class="img-fluid" alt="{{$item->name}}" style="max-width: 70px;height: 100px;">
                                                        </a>
                                                        <div class="media-body">
                                                            <div class="media-contant">
                                                                <div>
                                                                    <div class="product-detail">
                                                                        <ul class="rating">
                                                                            @include("website.components.rating",["rate"=>$item->reward_points])
                                                                        </ul>
                                                                        <a href="{{route("web.products.show",$item->slug)}}"><p>{{$item->name}}</p></a>
                                                                        <div class="Quantity">
                                                                            @if($item->stock>0)
                                                                                <span class="btn badge btn-primary btn-sm">in stock</span>
                                                                            @else
                                                                                <span class="btn badge btn-danger btn-sm out-stock">out of stock</span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="cart-info">
                                                                        <button data-bs-toggle="modal" data-bs-target="#addtocart" class="tooltip-top" data-tippy-content="Add to cart" ><i  data-feather="shopping-cart"></i></button>
                                                                        <a href="javascript:void(0)"  class="add-to-wish tooltip-top"  data-tippy-content="Add to Wishlist" ><i  data-feather="heart" class="add-to-wish"></i></a>

                                                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                           data-bs-target="#quick-view"
                                                                           class="tooltip-top _quick-view"
                                                                           data-tippy-content="Quick View"
                                                                           data-cart-url="{{route('web.CartList.addNew',$item->slug)}}"
                                                                           data-url="{{route("web.product.quick",$item->id)}}"
                                                                           data-urlImg="{{url("storage/image/product/")}}">
                                                                            <i  data-feather="eye"></i>
                                                                        </a>

                                                                        {{--                                                                        <a href="compare.html"  class="tooltip-top" data-tippy-content="Compare"><i  data-feather="refresh-cw"></i></a>--}}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                        <div id="tab-10" class="tab-content ">
                            <div class="media-slide-5 product-m no-arrow">
                                @foreach($onSale as $mainItem)
                                    <div>
                                        <div class="media-banner media-banner-1 border-0">
                                            @foreach($mainItem as $key => $item)

                                                <div class="media-banner-box">
                                                    <div class="media">
                                                        <a href="{{route("web.products.show",$item->slug)}}">
                                                            <img src="{{$item->image_url}}" class="img-fluid " alt="{{$item->name}}" style="max-width: 70px;height: 100px;">

                                                        </a>
                                                        <div class="media-body">
                                                            <div class="media-contant">
                                                                <div>
                                                                    <div class="product-detail">
                                                                        <ul class="rating">
                                                                            @include("website.components.rating",["rate"=>$item->reward_points])
                                                                        </ul>
                                                                        <a href="{{route("web.products.show",$item->slug)}}"><p>{{$item->name}}</p></a>
                                                                        <div class="Quantity">
                                                                            @if($item->stock>0)
                                                                                <span class="btn badge btn-primary btn-sm">in stock</span>
                                                                            @else
                                                                                <span class="btn badge btn-danger btn-sm out-stock">out of stock</span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="cart-info">
                                                                        <button data-bs-toggle="modal" data-bs-target="#addtocart" class="tooltip-top" data-tippy-content="Add to cart" ><i  data-feather="shopping-cart"></i></button>
                                                                        <a href="javascript:void(0)"  class="add-to-wish tooltip-top"  data-tippy-content="Add to Wishlist" ><i  data-feather="heart" class="add-to-wish"></i></a>

                                                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                           data-bs-target="#quick-view" class="tooltip-top _quick-view"
                                                                           data-tippy-content="Quick View" data-url="{{route("web.product.quick",$item->id)}}"
                                                                           data-cart-url="{{route('web.CartList.addNew',$item->slug)}}" data-urlImg="{{url("storage/image/product/")}}">
                                                                            <i  data-feather="eye"></i>
                                                                        </a>

                                                                        {{--                                                                        <a href="compare.html"  class="tooltip-top" data-tippy-content="Compare"><i  data-feather="refresh-cw"></i></a>--}}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- media banner tab end -->
