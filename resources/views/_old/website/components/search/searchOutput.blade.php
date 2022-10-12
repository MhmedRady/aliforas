<!-- Products out search start -->

<section class="section-big-py-space ratio_asos b-g-light">
    <div class="custom-container">
        <div class="row search-product related-pro1">
{{--            {{print_r($products)}}--}}
            @isset($products)
                @foreach($products as $item)
                    <div class="col-xl-3 col-md-4 col-6  col-grid-box">
                        <div class="product-box">
                            <div class="product-imgbox">

                                @if($item->image)
                                    <div class="product-front">
                                        <a href="{{route("web.products.show",$item->slug)}}">
                                            <img src="{{$item->image_url}}"
                                                 class="img-fluid"
                                                 alt="{{$item->Translate->name}}">
                                        </a>
                                    </div>
                                @endif
                                {{--                                                            <div class="product-back">--}}
                                {{--                                                                <a href="product-page(left-sidebar).html"> <img src="../assets/images/layout-4/product/a2.jpg" class="img-fluid  " alt="product"> </a>--}}
                                {{--                                                            </div>--}}

                            </div>
                            <div class="product-detail detail-center detail-inverse">
                                <div class="detail-title">
                                    <div class="detail-left">

                                        @include("website.components.rating",["rate"=>$item->reward_points])

                                        <a href="{{route("web.products.show",$item->slug)}}">
                                            <h6 class="price-title">
                                                {{$item->name}}
                                            </h6>
                                        </a>
                                    </div>
                                    <div class="detail-right">
                                        <div
                                            class="check-price">EGP {{$item->before_price}} </div>
                                        <div class="price">
                                            <div class="price"> EGP {{$item->price}} </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="icon-detail">
                                    <button data-bs-toggle="modal"
                                            data-url="{{route("web.CartList.addNew",$item->slug)}}"
                                            class="_add-to-cart tooltip-top"
                                            data-tippy-content="Add to cart">
                                        <i data-feather="shopping-cart"></i>
                                    </button>

                                    <a href="javascript:void(0)"
                                       data-url="{{route("web.Wishlist.addNew",$item->slug)}}"
                                       class="add-to-wish tooltip-top"
                                       data-tippy-content="Add to Wishlist">
                                        <i data-feather="heart"></i>
                                    </a>

                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                       data-bs-target="#quick-view"
                                       class="tooltip-top _quick-view"
                                       data-tippy-content="Quick View"
                                       data-cart-url="{{route('web.CartList.addNew',$item->slug)}}"
                                       data-details="{{route("web.products.show",$item->slug)}}"
                                       data-url="{{route("web.product.quick",$item->id)}}"
                                       data-urlImg="{{url("storage/image/product/")}}">
                                        <i data-feather="eye"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endisset
        </div>
    </div>
</section>

<!-- Products out search end -->

