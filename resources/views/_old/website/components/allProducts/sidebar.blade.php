<!-- start side-bar -->
<div class="col-sm-3 collection-filter category-page-side">
    <!-- side-bar colleps block stat -->
    <div class="collection-filter-block creative-card creative-inner category-side">
{{--        <form action="{{route('web.products.filterProducts')}}">--}}
{{--            @csrf--}}
            <div class="collection-mobile-back">
                <span class="filter-back"><i class="fa fa-angle-left" aria-hidden="true"></i> back</span>
            </div>

            {{-- <!-- Categories filter start --> --}}
            {{--            @if($mainCategories && $mainCategories->count() >0)--}}
            {{--                <div class="collection-collapse-block open mt-5">--}}
            {{--                    <h3 class="collapse-block-title mt-0">Categories</h3>--}}
            {{--                    <div class="collection-collapse-block-content" >--}}
            {{--                        <div id="_mainCategories" class="collection-brand-filter">--}}

            {{--                            @foreach($mainCategories as $category)--}}
            {{--                                <div class="custom-control custom-checkbox  form-check collection-filter-checkbox">--}}
            {{--                                    <input type="checkbox" class="custom-control-input form-check-input" id="{{$category->name}}" name="categories[]" value="{{$category->id}}">--}}
            {{--                                    <label class="custom-control-label form-check-label" for="{{$category->name}}">{{$category->name}} ({{$category->products->count()}})</label>--}}
            {{--                                </div>--}}
            {{--                            @endforeach--}}

            {{--                        </div>--}}
            {{--                        <button class="btn btn-primary btn-lg btn-sm mt-3 show-all-btn" type="button" data-toggle="collapse" data-target="#_mainCategories" aria-expanded="false" aria-controls="_mainCategories">Show all</button>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            @endif--}}

            {{-- <!-- Brands filter start --> --}}
            @if($brands && $brands->count() >0)
                <div class="collection-collapse-block open mt-5">
                    <h3 class="collapse-block-title mt-0">brand </h3>
                    <div class="collection-collapse-block-content">
                        <div id="_brands" class="collection-brand-filter mt-3">

                            <select class="form-control" name="brand">
                                <option selected value="0">Choose Brand ...</option>
{{--                                @if($brands->count()>0)--}}
                                @foreach($brands as $brand)
                                    @if(isset($brand_id))
                                        <option value="{{$brand->id}}" {{$brand_id == $brand->id?'selected':''}}>{{$brand->name}}</option>
                                    @else
                                        <option value="{{$brand->id}}">{{$brand->name}}</option>
                                    @endif
                                @endforeach
                            </select>

                            {{--                            @foreach($brands as $brand)--}}
                            {{--                                <div class="custom-control custom-checkbox  form-check collection-filter-checkbox">--}}
                            {{--                                    <input type="checkbox" class="custom-control-input form-check-input" id="{{$brand->name}}" name="brands[]" value="{{$brand->id}}">--}}
                            {{--                                    <label class="custom-control-label form-check-label" for="{{$brand->name}}">{{$brand->name}} ({{$brand->products->count()}})</label>--}}
                            {{--                                </div>--}}
                            {{--                            @endforeach--}}

                        </div>
                        {{--                        <button class="btn btn-primary btn-lg btn-sm mt-3 show-all-btn" type="button" data-toggle="collapse" data-target="#_brands" aria-expanded="false" aria-controls="_brands">Show all</button>--}}
                    </div>
                </div>
            @endif

            {{-- <!-- Manufacturers filter start --> --}}
            @if($manufacturers->count() >0)
                <div class="collection-collapse-block open mt-5">
                    <h3 class="collapse-block-title mt-0">Company</h3>

                    <div class="collection-collapse-block-content">
                        <div id="_manufacturers" class="collection-brand-filter mt-3">

                            <select id="inputState" class="form-control" name="manufacturer">
                                <option selected value="0">Choose Company...</option>
                                @foreach($manufacturers as $manufacturer)
                                    @if(isset($manufacturer_id))
                                        <option value="{{$manufacturer->id}}" {{$manufacturer_id == $manufacturer->id?'selected':''}}>{{$manufacturer->name}}</option>
                                    @else
                                        <option value="{{$manufacturer->id}}">{{$manufacturer->name}}</option>
                                    @endif
                                @endforeach
                            </select>

                            {{--                            @foreach($manufacturers as $manufacturer)--}}
                            {{--                                <div class="custom-control custom-checkbox  form-check collection-filter-checkbox">--}}
                            {{--                                    <input type="checkbox" class="custom-control-input form-check-input" id="{{$manufacturer->name}}" name="manufacturers[]" value="{{$manufacturer->id}}">--}}
                            {{--                                    <label class="custom-control-label form-check-label" for="{{$manufacturer->name}}">{{$manufacturer->name}} ({{$manufacturer->products->count()}})</label>--}}
                            {{--                                </div>--}}
                            {{--                            @endforeach--}}

                        </div>
                        {{--                        <button class="btn btn-primary btn-lg btn-sm mt-3 show-all-btn" type="button" data-toggle="collapse" data-target="#_manufacturers" aria-expanded="false" aria-controls="_manufacturers">Show all</button>--}}
                    </div>

                </div>
        @endif

        {{--    <!-- color filter start here -->--}}
        {{--        <div class="collection-collapse-block open">--}}
        {{--            <h3 class="collapse-block-title">colors</h3>--}}
        {{--            <div class="collection-collapse-block-content">--}}
        {{--                <div class="color-selector">--}}
        {{--                    <ul>--}}
        {{--                        <li >--}}
        {{--                            <div class="color-1 active" ></div> white (14)--}}
        {{--                        </li>--}}
        {{--                        <li >--}}
        {{--                            <div class="color-2"></div> brown(24)--}}
        {{--                        </li>--}}
        {{--                        <li >--}}
        {{--                            <div class="color-3"></div> red(18)--}}
        {{--                        </li>--}}
        {{--                        <li >--}}
        {{--                            <div class="color-4"></div> purple(10)--}}
        {{--                        </li>--}}
        {{--                        <li >--}}
        {{--                            <div class="color-5"></div> teal(9)--}}
        {{--                        </li>--}}
        {{--                        <li >--}}
        {{--                            <div class="color-6"></div> pink(11)--}}
        {{--                        </li>--}}
        {{--                        <li >--}}
        {{--                            <div class="color-7"></div> coral(15)--}}
        {{--                        </li>--}}
        {{--                    </ul>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </div>--}}

        {{--        <!-- size filter start here -->--}}
        {{--        <div class="collection-collapse-block open">--}}
        {{--            <h3 class="collapse-block-title">size</h3>--}}
        {{--            <div class="collection-collapse-block-content">--}}
        {{--                <div class="size-selector">--}}
        {{--                    <div class="collection-brand-filter">--}}
        {{--                        <div class="custom-control custom-checkbox  form-check collection-filter-checkbox">--}}
        {{--                            <input type="checkbox" class="custom-control-input form-check-input" id="small">--}}
        {{--                            <label class="custom-control-label form-check-label" for="small">s</label>--}}
        {{--                        </div>--}}
        {{--                        <div class="custom-control custom-checkbox  form-check collection-filter-checkbox">--}}
        {{--                            <input type="checkbox" class="custom-control-input form-check-input" id="mediam">--}}
        {{--                            <label class="custom-control-label form-check-label" for="mediam">m</label>--}}
        {{--                        </div>--}}
        {{--                        <div class="custom-control custom-checkbox  form-check collection-filter-checkbox">--}}
        {{--                            <input type="checkbox" class="custom-control-input form-check-input" id="large">--}}
        {{--                            <label class="custom-control-label form-check-label" for="large">l</label>--}}
        {{--                        </div>--}}
        {{--                        <div class="custom-control custom-checkbox  form-check collection-filter-checkbox">--}}
        {{--                            <input type="checkbox" class="custom-control-input form-check-input" id="extralarge">--}}
        {{--                            <label class="custom-control-label form-check-label" for="extralarge">xl</label>--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </div>--}}

        <!-- price filter start here -->

{{--            <div class="collection-collapse-block border-0 open">--}}
{{--                <h3 class="collapse-block-title">price</h3>--}}
{{--                <div class="qty-box d-block">--}}
{{--                    <div class="input-group mt-2">--}}
{{--                        <button type="button" class="qty-minus"></button>--}}
{{--                        <input class="qty-adj form-control" name="min-price" type="number" min="0" value="{{old('min-price')??"0"}}" max="100000" style="min-width: 70%;margin: auto;">--}}
{{--                        <button type="button" class="qty-plus"></button>--}}
{{--                    </div>--}}
{{--                    <div class="input-group mt-2">--}}
{{--                        <button type="button" class="qty-minus"></button>--}}
{{--                        <input class="qty-adj form-control" name="max-price" type="number" min="0" value="{{old('min-price')??"100000"}}" max="100000" style="min-width: 70%;margin: auto;">--}}
{{--                        <button type="button" class="qty-plus"></button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="input-group mt-5">
                <button class="btn btn-primary btn-block btn-sm-font-bold m-auto" style="max-width: 80%;">Apply</button>
            </div>
{{--        </form>--}}
    </div>
    <!-- silde-bar colleps block end here -->
    <!-- side-bar single product slider start -->

{{--        <div class="theme-card creative-card creative-inner">--}}
{{--        <h5 class="title-border">new product</h5>--}}
{{--        <div class="slide-1">--}}
{{--            @foreach($latest as $key => $page)--}}
{{--                <div>--}}
{{--                    <div class="media-banner plrb-0 b-g-white1 border-0">--}}
{{--                        @foreach($page as $key => $item)--}}
{{--                            <div class="media-banner-box">--}}
{{--                                <div class="media">--}}
{{--                                    <a href="{{route("web.products.show",$item->Translate[0]->slug)}}" tabindex="0">--}}
{{--                                        <img src="{{$item->viewImage->image_url}}" class="img-fluid " alt="{{route("web.products.show",$item->Translate[0]->slug)}}">--}}
{{--                                    </a>--}}
{{--                                    <div class="media-body">--}}
{{--                                        <div class="media-contant">--}}
{{--                                            <div>--}}
{{--                                                <div class="product-detail">--}}

{{--                                                    @include("website.components.rating",["rate"=>$item->reward_points])--}}

{{--                                                    <a href="{{route("web.products.show",$item->Translate[0]->slug)}}" tabindex="0"><p>{{route("web.products.show",$item->Translate[0]->name)}}</p></a>--}}
{{--                                                    <h6>{{$item->price}} {!! $item->before_price? "<span>{$item->before_price} </span>":"" !!} } </h6>--}}
{{--                                                </div>--}}
{{--                                                <div class="cart-info">--}}
{{--                                                    <button class="tooltip-top add-cartnoty" data-tippy-content="Add to cart">--}}
{{--                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"--}}
{{--                                                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart">--}}
{{--                                                            <circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle>--}}
{{--                                                            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>--}}
{{--                                                        </svg>--}}
{{--                                                    </button>--}}
{{--                                                    <a href="javascript:void(0)"  class="add-to-wish tooltip-top"  data-tippy-content="Add to Wishlist" ><i  data-feather="heart" class="add-to-wish"></i></a>--}}
{{--                                                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#quick-view" class="tooltip-top _quick-view"--}}
{{--                                                       data-tippy-content="Quick View" data-details="{{route("web.products.show",$item->Translate[0]->slug)}}"--}}
{{--                                                       data-url="{{route("web.product.quick",$item->id)}}" data-urlImg="{{url("storage/image/product/")}}">--}}
{{--                                                        <i  data-feather="eye"></i>--}}
{{--                                                    </a>--}}
{{--                                                    <a href="compare.html"  class="tooltip-top" data-tippy-content="Compare"><i  data-feather="refresh-cw"></i></a>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        @endforeach--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            @endforeach--}}
{{--        </div>--}}
{{--    </div>--}}

<!-- side-bar single product slider end -->
    <!-- side-bar banner start here -->

    <div class="collection-sidebar-banner">
        <a href="javascript:void(0)">
            <img src="../assets/images/category/side-banner.png" class="img-fluid " alt="">
        </a>
    </div>
    <!-- side-bar banner end here -->

</div>
<!-- end side-bar -->
