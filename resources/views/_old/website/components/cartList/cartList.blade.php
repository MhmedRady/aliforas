<!--section start-->
    <section class="cart-section section-big-py-space b-g-light">

        <div class="custom-container">
            <div class="row">
                <div class="col-sm-12">
                    @if($CartList->count()>0)
                        <form action="{{route('web.post-order-list')}}" method="post">
                            @csrf
                            <table class="table cart-table table-responsive-xs">
                                <thead>
                                <tr class="table-head">
                                    <th scope="col">image</th>
                                    <th scope="col">product name</th>
{{--                                    <th scope="col">price</th>--}}
                                    <th scope="col">quantity</th>
                                    <th scope="col">action</th>
{{--                                    <th scope="col">total</th>--}}
                                </tr>
                                </thead>

                                @foreach($CartList as $key => $item )
                                    <tbody>
                                    <tr>
                                        <td>
                                            <a href="{{route("web.products.show",$item['product']->slug)}}">
                                                <img src="{{$item['product']->image_url}}" alt="{{route("web.products.show",$item['product']->slug)}}">
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{route("web.products.show",$item['product']->slug)}}">{{$item['product']->name}}</a>
                                            <div class="mobile-cart-content">
                                                <div class="col-xs-3">
                                                    <div class="qty-box">
                                                        <div class="input-group">
                                                            <input class="qty-adj form-control" name="products[{{$item['product_id']}}]" type="number" min="1" value="{{$item['quantity']>$item['product']->stock?$item['product']->stock:$item['quantity']}}" max="{{$item['product']->stock}}">
                                                        </div>
                                                    </div>
                                                </div>
{{--                                                <div class="col-xs-3">--}}
{{--                                                    <h2 class="td-color"> EGP {{ $item['product']->price }}</h2>--}}
{{--                                                </div>--}}
                                                <div class="col-xs-3">
                                                    <h2 class="td-color">
                                                        <a href="{{route('web.CartList.removeItem',$item['product']->slug)}}" class="icon"><i class="ti-close"></i></a>
                                                    </h2>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
{{--                                        <td>--}}
{{--                                            <h2>EGP {{$item['product']->price}}</h2></td>--}}
{{--                                        <td>--}}
                                            <div class="qty-box">
                                                <div class="input-group">
                                                    <button type="button" class="qty-minus"></button>
                                                        <input class="qty-adj form-control" name="products[{{$item['product_id']}}]" type="number" min="1" value="{{$item['quantity']>$item['product']->stock?$item['product']->stock:$item['quantity']}}" max="{{$item['product']->stock}}">
                                                    <button type="button" class="qty-plus"></button>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="{{route('web.CartList.removeItem',$item['product']->slug)}}" class="icon">
                                                <i class="ti-close"></i>
                                            </a>
                                        </td>
{{--                                        <td>--}}
{{--                                            <h2 class="td-color">EGP {{$item['product']->price*$item['quantity']}}</h2>--}}
{{--                                        </td>--}}
                                    </tr>
                                    </tbody>
                                @endforeach

                            </table>
{{--                            <table class="table cart-table table-responsive-md">--}}
{{--                                <tfoot>--}}
{{--                                <tr>--}}
{{--                                    <td>total price :</td>--}}
{{--                                    <td>--}}
{{--                                        <h2 style="display: block ruby;">EGP {{$prices}}</h2>--}}
{{--                                    </td>--}}
{{--                                </tr>--}}
{{--                                </tfoot>--}}
{{--                            </table>--}}
                            <div class="row cart-buttons">
                                <div class="col-12">
                                    <a href="{{route('web.shoppingPage')}}" class="btn btn-normal">continue shopping</a>
                                    <button type="submit" class="btn btn-normal ms-3">check out</button>
                                </div>
                            </div>
                        </form>
                    @else
                        <div class="container">
                            <div class="row">
                                <div class="alert alert-primary text-center rounded font-bold font-9" role="alert">
                                    No products have been added to your Cart yet!
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

{{--     /*************************** ****************************/      --}}

</section>
<!--section end-->
