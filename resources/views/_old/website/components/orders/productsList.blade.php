<!-- Products Orders List -->
        <fieldset>
            <div class="container p-0">
                <div class="row shpping-block">
                    <div class="col-lg-8">
                        <div class="order-tracking-contain order-tracking-box">
                            <div class="tracking-group">
                                <div class="delevery-code">
                                    <h4>Deliver to:{{$orderCode}}</h4>
    {{--                                <a href="#" class="btn btn-solid btn-outline btn-md">change Address</a>--}}
                                </div>
                            </div>
    {{--                        <div class="tracking-group">--}}
    {{--                            <div class="product-offer">--}}
    {{--                                <h6 class="product-title"><i class="fa fa-tags"></i>5 offers Available </h6>--}}
    {{--                                <div class="offer-contain">--}}
    {{--                                    <ul>--}}
    {{--                                        <li>--}}
    {{--                                            <div>--}}
    {{--                                                <h5>Get extra $40 off on first Orders</h5>--}}
    {{--                                                <p>Use code "OFFER40" Min. Cart Value $99 | Max. Discount $40</p>--}}
    {{--                                            </div>--}}
    {{--                                        </li>--}}
    {{--                                    </ul>--}}
    {{--                                    <ul class="offer-sider">--}}
    {{--                                        <li>--}}
    {{--                                            <div>--}}
    {{--                                                <h5>Get extra $25 off on second Orders</h5>--}}
    {{--                                                <p>Use code "OFFER25" Min. Cart Value $99 | Max. Discount $25</p>--}}
    {{--                                            </div>--}}
    {{--                                        </li>--}}
    {{--                                        <li>--}}
    {{--                                            <div>--}}
    {{--                                                <h5>Bank Offer40% Unlimited Cashback on bideal Axis Bank Credit Card</h5>--}}
    {{--                                                <p>Use code "OFFER40" Min. Cart Value $99 | Max. Discount $40</p>--}}
    {{--                                            </div>--}}
    {{--                                        </li>--}}
    {{--                                        <li>--}}
    {{--                                            <div>--}}
    {{--                                                <h5>Bank Offer10% off* with Axis Bank Buzz Credit Card</h5>--}}
    {{--                                                <p>Use code "OFFER10" Min. Cart Value $99 | Max. Discount $10</p>--}}
    {{--                                            </div>--}}
    {{--                                        </li>--}}
    {{--                                        <li>--}}
    {{--                                            <div>--}}
    {{--                                                <h5>Bank Offer5% Unlimited Cashback on bideal sbi banck Credit Card</h5>--}}
    {{--                                                <p>Use code "OFFER5" Min. Cart Value $99 | Max. Discount $5</p>--}}
    {{--                                            </div>--}}
    {{--                                        </li>--}}
    {{--                                    </ul>--}}
    {{--                                    <h5 class="show-offer"><span class="more-offer">show more offer</span><span class="less-offer">less offer</span></h5>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
                        <div class="tracking-group pb-0">
                            <h4 class="tracking-title">my shopping product</h4>
                            <ul class="may-product">

                                @foreach($CartList as $item)
                                    <li>
                                        <div class="media">
                                            @if(!$item['product']->image)
                                                <img src="{{asset('website/images/cart-shop.png')}}" class="img-fluid" alt="">
                                            @else
                                                <img src="{{$item['product']->image_url}}" class="img-fluid" alt="">
                                            @endif

                                            <div class="media-body">
                                                <h3>{{$item['product']->name}}</h3>
{{--                                                <h4>EGP {{$item['product']->price}} {!! $item['product']->before_price?"<span>EGP {$item['product']->before_price}</span>" : ''!!} </h4>--}}
                                                @include('website.components.rating',["rate"=>$item['product']->reward_points])
                                                @if($item['product']->stock>0)
                                                    <h6>Quantity <span class="btn badge btn-primary btn-sm">in stock</span> </h6>
                                                    <div class="qty-box">
                                                        <div class="input-group">
                                                            <button type="button" class="qty-minus order-quantity-minus" data-item=".item_{{$item['product_id']}}"></button>
                                                                <input class="qty-adj form-control" type="number" name="products[][{{$item['product']->id}}]" max="{{$item['product']->stock}}" value="{{$item['quantity']}}" min="1">
                                                            <button type="button" class="qty-plus order-quantity-plus" data-item=".item_{{$item['product_id']}}"></button>
                                                        </div>
                                                    </div>
                                                @else
                                                    <span class="btn btn-danger btn-sm">Out Of Stock</span>
                                                @endif

{{--                                                    <h6>size</h6>--}}

{{--                                                    <div class="size-box">--}}
{{--                                                        <ul >--}}
{{--                                                            <li><a href="javascript:void(0)">s</a></li>--}}
{{--                                                            <li><a href="javascript:void(0)">m</a></li>--}}
{{--                                                            <li><a href="javascript:void(0)">l</a></li>--}}
{{--                                                            <li><a href="javascript:void(0)">xl</a></li>--}}
{{--                                                            <li><a href="javascript:void(0)">2xl</a></li>--}}
{{--                                                        </ul>--}}
{{--                                                    </div>--}}

                                                </div>
                                                <div class="pro-add">
                                                    @if($item['product']->added_to_wishlist == 0)
                                                        <a href="javascript:void(0)" data-url="{{route("web.Wishlist.addNew",$item['product']->slug)}}"
                                                           class="add-to-wish tooltip-top {{$item['product']->added_to_wishlist == 1 ? "addedToCart" :""}}"
                                                           data-tippy-content="Add to Wishlist">
                                                            <i  data-feather="heart"></i>
                                                        </a>
                                                    @else
                                                        <span class="tooltip-top addedToWish">
                                                            <i  data-feather="heart"></i>
                                                        </span>
                                                    @endif
                                                    <a href="{{route('web.CartList.removeItem',$item['product']->slug)}}" class="tooltip-top" data-tippy-content="Remove roduct">
                                                        <i data-feather="trash-2"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="order-tracking-sidebar order-tracking-box">
                        <div class="coupan-block">
                            <h5><i data-feather="tag"></i>Apply Coupons</h5>
{{--                            <a href="#" class="btn btn-solid btn-outline btn-sm">apply</a>--}}
                        </div>
                        <ul class="cart_total">
                            @foreach($CartList as $item)
                                <li>
                                    {{$item['product']->name}} : <span class="item_{{$item['product_id']}}">X {{$item['quantity']}}</span>
                                </li>
                            @endforeach
{{--                            <li>--}}
{{--                                discount <span>&80</span>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                Delivery <span>free</span>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                coupon discount<span>apply coupon</span>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                taxes <span>14%</span>--}}
{{--                            </li>--}}
                            <li>
                                <div id="_quantities" class="total">
                                    Quantities : <span> {{$quantities}}</span>
                                </div>
                            </li>
                            <li class="pt-0">
                                <div class="buttons">
                                    <a href="javascript:void(0)" class="next-click btn btn-primary btn-sm btn-block font-bold">Complete The Order</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <a href="javascript:void(0)" class="next action-button btn btn-info btn-lg d-none opacity-0" ></a>
    </fieldset>
<!-- End Products Orders List -->
