<!--section start-->
    <section class="wishlist-section section-big-py-space b-g-light">
        <div class="custom-container">
            <div class="row">
                <div class="col-sm-12">

                    @if($WishList->count()>0)
                        <table class="table cart-table table-responsive-xs">
                            <thead>
                            <tr class="table-head">
                                <th scope="col">image</th>
                                <th scope="col">product name</th>
{{--                                <th scope="col">price</th>--}}
                                <th scope="col">availability</th>
                                <th scope="col">action</th>
                            </tr>
                            </thead>
                            @foreach($WishList as $key => $item)
                                <tbody id="wishItem_{{$key+1}}">
                                    <tr>
                                    <td>
                                        <a href="{{route("web.products.show",$item['product']->slug)}}">
                                            <img src="{{$item['product']->image_url}}" alt="{{$item['product']->slug}}" class="img-fluid">
                                        </a>
                                    </td>

                                        <td><a href="{{route("web.products.show",$item['product']->slug)}}">{{$item['product']->name}}</a>
                                            <div class="mobile-cart-content">
                                                <div class="col-xs-3">
                                                    <div class="qty-box">
                                                        <div class="input-group">
                                                            <input class="qty-adj form-control" name="products[{{$item['product_id']}}]" type="number" min="1" value="{{$item['quantity']>$item['product']->stock?$item['product']->stock:$item['quantity']}}" max="{{$item['product']->stock}}">
                                                        </div>
                                                    </div>
                                                </div>
{{--                                                <div class="col-xs-3">--}}
{{--                                                    <h2 class="td-color"> EGP {{ $item['product']->stock }}</h2>--}}
{{--                                                </div>--}}
                                                <div class="col-xs-3">
                                                    <h2 class="td-color d-flex">
                                                        @if(!$item['product']->added_to_cart)
                                                            <a href="javascript:void(0)" data-url="{{route("web.CartList.addNew",$item['product']->slug)}}" class="cart _add-to-cart">
                                                                <i class="ti-shopping-cart"></i>
                                                            </a>
                                                        @else
                                                            <a href="javascript:void(0)" class="cart">
                                                                <i class="ti-shopping-cart"></i>
                                                                <i class="fa fa-check-circle inCartIcon" aria-hidden="true"></i>
                                                            </a>
                                                        @endif
                                                        <a href="{{route('web.Wishlist.removeItem',$item['product']->slug)}}" data-removeWish="#wishItem_{{$key+1}}" class="icon me-3 removeWishItem"
                                                            style="margin-left: 5px;margin-right: 5px">
                                                                <i class="ti-close"></i>
                                                            </a>
                                                    </h2>
                                                </div>
                                            </div>
                                        </td>
{{--                                    <td>--}}
{{--                                        <h2>EGP {{$item['product']->price}}</h2></td>--}}
                                    <td>
                                        <p class="{{$item['product']->stock==0 ? "text-danger":""}}">
                                            {{$item['product']->stock>0 ? "in stock" : "out of stock"}}
                                        </p>
                                    </td>
                                    <td>
                                        @if(!$item['product']->added_to_cart)
                                            <a href="javascript:void(0)" data-url="{{route("web.CartList.addNew",$item['product']->slug)}}" class="cart _add-to-cart">
                                                <i class="ti-shopping-cart"></i>
                                            </a>
                                        @else
                                            <a href="javascript:void(0)" class="cart">
                                                <i class="ti-shopping-cart"></i>
                                                <i class="fa fa-check-circle inCartIcon" aria-hidden="true"></i>
                                            </a>
                                        @endif
                                        <a href="{{route('web.Wishlist.removeItem',$item['product']->slug)}}" data-removeWish="#wishItem_{{$key+1}}" class="icon me-3 removeWishItem"
                                            style="margin-left: 5px;margin-right: 5px">
                                            <i class="ti-close"></i>
                                        </a>
                                    </td>
                                </tr>
                                </tbody>
                            @endforeach
                        </table>
{{--                        <table class="table cart-table table-responsive-md">--}}
{{--                            <tfoot>--}}
{{--                            <tr>--}}
{{--                                <td>total price :</td>--}}
{{--                                <td>--}}
{{--                                    <h2 style="display: block ruby;">EGP {{$prices}}</h2>--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                            </tfoot>--}}
{{--                        </table>--}}
                        <div class="row wishlist-buttons">
                            <div class="col-12">
                                <a href="{{url()->previous() ?? route("web.webHome")}}" class="btn btn-normal">continue shopping</a>
{{--                                <a href="javascript:void(0)" class="btn btn-normal">add all To Cart</a>--}}
                            </div>
                        </div>
                    @else
                        <div class="container">
                            <div class="row">
                                <div class="alert alert-primary text-center rounded font-bold font-9" role="alert">
                                    No products have been added to your Wishlist yet!
                                </div>
                                <div class="col-md-4 m-auto">
                                    <a href="{{route("web.shoppingPage")}}" class="btn btn-primary btn-md btn-block font-bold">continue shopping</a>
                                </div>
                                <div class="col-md-4 m-auto">
                                    <a href="{{route("web.webHome")}}" class="btn btn-primary btn-md btn-block font-bold">back to home</a>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>


        </div>
    </section>
<!--section end-->
