<!-- Add to cart bar -->
    <div id="cart_side" class="add_to_cart right">
        <a href="javascript:void(0)" class="overlay" onclick="closeCart()"></a>
        <div class="cart-inner">
            <div class="cart_top">
                <h3>my cart</h3>
                <div class="close-cart">
                    <a href="javascript:void(0)" onclick="closeCart()">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
            <div class="cart_media">

                    <ul class="cart_product _out_cart_list">
                        @if(!\Session::has("products.wishlist"))
                            <div class="alert alert-primary text-center rounded" role="alert">
                                No products have been added to your Sopping Cart yet!
                            </div>
                        @endif
                    </ul>

                <ul class="cart_total">
{{--                    <li>--}}
{{--                        <div class="cartSubPrice">--}}
{{--                            subtotal :  <span>00.00</span>--}}
{{--                        </div>--}}
{{--                    </li>--}}
                    {{--          <li>--}}
                    {{--            shopping <span>free</span>--}}
                    {{--          </li>--}}
{{--                    <li>--}}
{{--                        taxes <span>%14.00</span>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <div class="total">--}}
{{--                            total <span id="_cartTotalSub">00.00</span> <span> EGP </span>--}}
{{--                        </div>--}}
{{--                    </li>--}}
                    <li>
                        <div class="buttons">
                            <a href="{{route("web.CartList.showAll")}}" class="btn btn-solid btn-sm" style="padding: .8rem;">view cart</a>
                            <a href="{{route('web.view-order-list')}}" class="btn btn-normal btn-sm" style="padding: .8rem;">check out</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
<!-- Add to cart bar end-->
