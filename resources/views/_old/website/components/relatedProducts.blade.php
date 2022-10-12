<!-- related products -->
<section class="section-big-py-space  ratio_asos b-g-light">
    <div class="custom-container">
        <div class="row">
            <div class="col-12 product-related">
                <h2>related products</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-12 product">
                <div class="product-slide-6 product-m no-arrow">
                    @foreach($related as $item)
                        @if($item->id !== $product->id)
                            <div>
                                <div class="product-box">
                                    <div class="product-imgbox">
                                        <div class="product-front">
                                            <a href="{{route("web.products.show",$item->slug)}}">
                                                <img src="{{$item->image_url}}" class="img-fluid"
                                                     alt="{{route("web.products.show",$item->name)}}">
                                            </a>
                                        </div>
                                        <div class="product-icon icon-inline">
                                            <button data-bs-toggle="modal"
                                                    data-url="{{route("web.CartList.addNew",$item->slug)}}"
                                                    class="_add-to-cart tooltip-top" data-tippy-content="Add to cart">
                                                <i class="ti-shopping-cart font-1"></i>
                                            </button>
                                            <a href="javascript:void(0)"
                                               data-url="{{route("web.Wishlist.addNew",$item->slug)}}"
                                               class="add-to-wish tooltip-top {{$item->added_to_wishlist == 1 ? "addedToCart" :""}}"
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
                                            <a href="compare.html" class="tooltip-top" data-tippy-content="Compare">
                                                <i data-feather="refresh-cw"></i>
                                            </a>
                                        </div>

                                    </div>
                                    <div class="product-detail detail-inline ">
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
                                                <div class="Quantity">
                                                    @if($item->stock>0)
                                                        <span class="btn badge btn-primary btn-sm">in stock</span>
                                                    @else
                                                        <span class="btn badge btn-danger btn-sm out-stock">out of stock</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!-- related products -->
