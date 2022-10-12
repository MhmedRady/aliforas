<!-- Add to cart bar -->
<div id="cart_side" class="add_to_cart right ">
  <a href="javascript:void(0)" class="overlay" onclick="closeCart()"></a>
  <div class="cart-inner">
    <div class="cart_top">
      <h3>my Wishlist</h3>
      <div class="close-cart">
        <a href="javascript:void(0)" onclick="closeCart()">
          <i class="fa fa-times" aria-hidden="true"></i>
        </a>
      </div>
    </div>
    <div class="cart_media">
      @if(\Session::has("products.wishlist"))
        <ul class="cart_product out_wish_list">
        </ul>
      @else
        <div class="alert alert-primary text-center rounded" role="alert">
          No products have been added to your wishlist yet!
        </div>
      @endif
        <ul class="cart_total">
{{--          <li>--}}
{{--            <div class="wishSubPrice">--}}
{{--              subtotal : <span>00.00</span> <b> EGP </b>--}}
{{--            </div>--}}
{{--          </li>--}}
          {{--          <li>--}}
          {{--            shopping <span>free</span>--}}
          {{--          </li>--}}
{{--          <li>--}}
{{--            taxes <span>%14.00</span>--}}
{{--          </li>--}}
{{--          <li>--}}
{{--            <div class="total">--}}
{{--                total <span id="_wishTotalSum">00.00</span> <span> EGP </span>--}}
{{--            </div>--}}
{{--          </li>--}}
          <li>
            <div class="buttons">
              <a href="{{route("web.Wishlist.showAll")}}" class="btn btn-solid btn-block btn-md">view wishlist</a>
            </div>
          </li>
        </ul>
    </div>
  </div>
</div>
<!-- Add to cart bar end-->
