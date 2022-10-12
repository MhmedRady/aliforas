@if($HotCategories && $HotCategories->count() > 0)
    <!--tab product-->
    <section class="section-pt-space">
        <div class="tab-product-main">
            <div class="tab-product-contain">
                <ul class="tabs tab-title">
                    @foreach($HotCategories as $key => $item)
                        @if(count($item->products) > 0)
                            <li class="{{$key == 0 ?"current":""}}">
                                <a href="tab-{{$item->slug}}">{{$item->Translate->name}}</a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </section>
    <!--tab product-->
    <!-- slider tab  -->
    <section class="section-py-space ratio_square product">
        <div class="custom-container">
            <div class="row">
                <div class="col pr-0">
                    <div class="theme-tab product">
                        <div class="tab-content-cls">
                            @foreach($HotCategories as $key => $item)
                                @if(count($item->products) > 0)
                                    <div id="tab-{{$item->slug}}" class="tab-content {{$key == 0 ? "active default":""}}">
                                        <div class="product-slide-6  product-m  no-arrow">
                                            @foreach($item->products as $ket=> $product)
                                                <div>
                                                    <div class="product-box">
                                                        <div class="product-imgbox">
                                                            <div class="product-front">
                                                                @if($product->image_url && $product->image->image_url)
                                                                    <a href="{{route('web.products.show', $product->slug)}}">
                                                                        <img class="img-fluid" alt="product"
                                                                             src="{{$product->image->image_url}}">
                                                                    </a>
                                                                @endif
                                                            </div>
                                                            <div class="product-icon icon-inline">
                                                                <button data-bs-toggle="modal"
                                                                        data-url="{{route("web.CartList.addNew",$product->slug)}}"
                                                                        class="_add-to-cart tooltip-top"
                                                                        data-tippy-content="Add to cart">
                                                                    <i data-feather="shopping-cart"></i>
                                                                </button>
                                                                <a href="javascript:void(0)"
                                                                   data-url="{{route("web.Wishlist.addNew",$product->slug)}}"
                                                                   class="add-to-wish tooltip-top"
                                                                   data-tippy-content="Add to Wishlist">
                                                                    <i data-feather="heart"></i>
                                                                </a>
                                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                   data-bs-target="#quick-view"
                                                                   class="tooltip-top _quick-view"
                                                                   data-tippy-content="Quick View"
                                                                   data-cart-url="{{route('web.CartList.addNew',$item->slug)}}"
                                                                   data-details="{{route('web.products.show',$product->slug)}}"
                                                                   data-url="{{route('web.product.quick',$item->id)}}"
                                                                   data-urlImg="{{url('storage/image/product/')}}">
                                                                    <i data-feather="eye"></i>
                                                                </a>
                                                                {{--<a href="compare.html" class="tooltip-top"
                                                                   data-tippy-content="Compare">
                                                                    <i data-feather="refresh-cw"></i>
                                                                </a>--}}
                                                            </div>
                                                        </div>
                                                        <div class="product-detail detail-inline">
                                                            <div class="detail-title">
                                                                <div class="detail-left">
                                                                    @include('website.components.rating',['rate'=>$product->reward_points])
                                                                    <a href="{{route('web.products.show',$product->slug)}}">
                                                                        <h6 class="price-title">
                                                                            {{$product->name}}
                                                                        </h6>
                                                                    </a>
                                                                </div>
                                                                <div class="detail-right">
                                                                    <div class="Quantity">
                                                                        @if($product->stock>0)
                                                                            <span class="btn badge btn-primary btn-sm">in stock</span>
                                                                        @else
                                                                            <span class="btn badge btn-danger btn-sm out-stock">out of stock</span>
                                                                        @endif
                                                                    </div>
{{--                                                                    @if($product->before_price>0)--}}
{{--                                                                        <div class="check-price">--}}
{{--                                                                            EGP {{$product->before_price}}--}}
{{--                                                                        </div>--}}
{{--                                                                    @endif--}}
{{--                                                                    <div class="price">--}}
{{--                                                                        <div class="price">--}}
{{--                                                                            EGP {{$product->price}}--}}
{{--                                                                        </div>--}}
{{--                                                                    </div>--}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- slider tab end -->
@endif
