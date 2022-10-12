<!-- breadcrumb start -->
<div class="breadcrumb-main ">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="breadcrumb-contain">
                    <div>
                        <h2>
                            @yield('title')
                        </h2>
                        <ul>
                            <li><a href="{{ url('/') }}">home</a></li>
                            <li><i class="fa fa-angle-double-right"></i></li>
                            <li>
                                <a href="javascript:void(0)">
                                    @if(isset($slug))
                                        {{$slug}}
                                    @else
                                        @yield('title')
                                    @endif
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb End -->

<!-- section start -->
<section class="section-big-pt-space ratio_asos b-g-light">
    <div class="collection-wrapper">
        <div class="custom-container">
            <form action="{{route('web.products.filterProducts')}}" type="hidden">
                @csrf
                <div class="row">

                    @include("website.components.allProducts.sidebar")

                    <div class="collection-content col">
                        <div class="page-main-content">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="collection-product-wrapper">
                                        <div class="product-top-filter">
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <div class="filter-main-btn"><span class="filter-btn">
                                                        <i class="fa fa-filter" aria-hidden="true"></i> Filter</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="product-filter-content">
                                                        <div class="search-count">
                                                            <h5>Showing Products {{$products->firstItem()}}
                                                                -{{$products->lastItem()}} of
                                                                {{$products->total()}} Result</h5>
                                                        </div>
                                                        <div class="collection-view">
                                                            <ul>
                                                                <li><i class="fa fa-th grid-layout-view"></i></li>
                                                                <li><i class="fa fa-list-ul list-layout-view"></i></li>
                                                            </ul>
                                                        </div>
                                                        <div class="collection-grid-view">
                                                            <ul>
                                                                <li><img
                                                                        src="{{asset('website/images/category/icon/2.png')}}"
                                                                        alt="" class="product-2-layout-view"></li>
                                                                <li><img
                                                                        src="{{asset('website/images/category/icon/3.png')}}"
                                                                        alt="" class="product-3-layout-view"></li>
                                                                <li><img
                                                                        src="{{asset('website/images/category/icon/4.png')}}"
                                                                        alt="" class="product-4-layout-view"></li>
                                                                <li><img
                                                                        src="{{asset('website/images/category/icon/6.png')}}"
                                                                        alt="" class="product-6-layout-view"></li>
                                                            </ul>
                                                        </div>

                                                        <div class="product-page-per-view">
                                                            <select name="paginate" onchange="this.form.submit()">
                                                                    <option value="16" selected>16 Products Par Page</option>
                                                                    <option value="24" {{isset($paginate) && $paginate == 24 ? 'selected':''}}>24 Products Par Page</option>
                                                                    <option value="60" {{isset($paginate) && $paginate == 64 ? 'selected':''}}>64 Products Par Page</option>
                                                                    <option value="100" {{isset($paginate) && $paginate == 100 ? 'selected':''}}>100 Products Par Page</option>
                                                            </select>
                                                        </div>
                                                        <div class="product-page-filter">
                                                            <select name="sort" onchange="this.form.submit()">
                                                                <option value="DESC" selected>Sorting items</option>
                                                                <option value="DESC" {{isset($sort) && $sort == 'DESC' ? 'selected':''}}>New to Old</option>
                                                                <option value="ASC" {{isset($sort) && $sort == 'ASC' ? 'selected':''}}>Old to New</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-wrapper-grid product">
                                            <div class="row">

                                                @foreach($products as $key => $item)
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
{{--                                                                        <a href="">--}}
                                                                            <div class="brand-name d-block"> {{$item->brand->name}} </div>
{{--                                                                        </a>--}}
                                                                    </div>
                                                                    <div class="detail-right">

                                                                        {{--                                                                    <div class="check-price">EGP {{$item->before_price}} </div>--}}
                                                                        {{--                                                                    <div class="price">--}}
                                                                        {{--                                                                        <div class="price"> EGP {{$item->price}} </div>--}}
                                                                        {{--                                                                    </div>--}}

                                                                        <div class="Quantity">
                                                                            Quantity:
                                                                            @if($item->stock >0)
                                                                                <span class="btn badge btn-primary btn-sm out-stock">in stock</span>
                                                                            @else
                                                                                <span class="btn badge btn-danger btn-sm out-stock">out of stock</span>
                                                                            @endif
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

                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="product-pagination">
                    <div class="theme-paggination-block">
                        <div class="row">
                            <div class="col-xl-6 col-md-6 col-sm-12">
                                <nav aria-label="Page navigation">
                                    <ul class="pagination">
                                        <li class="page-item">
                                            <a class="page-link"
                                             href="{{$products->previousPageUrl()??'javascript:void(0)'}}"
                                             aria-label="Previous"><span aria-hidden="true">
                                            <i class="fa fa-chevron-left" aria-hidden="true"></i></span>
                                            </a>
                                        </li>
                                        <ul style="max-width: 70%;display: flex;overflow: hidden">
                                            @for($i = 1;$i<=$products->lastPage();++$i)
                                                <li class="page-item {{$products->currentPage() == $i?"active":""}}">
                                                    <a class="page-link" href="{{$pageUrl.$i}}">{{$i}}</a>
                                                </li>
                                            @endfor
                                        </ul>
                                        <li class="page-item"><a class="page-link"
                                                                 href="{{$products->nextPageUrl()??'javascript:void(0)'}}"
                                                                 aria-label="Next"><span aria-hidden="true"><i
                                                        class="fa fa-chevron-right" aria-hidden="true"></i></span> <span
                                                    class="sr-only">Next</span></a></li>
                                    </ul>
                                </nav>
                            </div>
                            <div class="col-xl-6 col-md-6 col-sm-12">
                                <div class="product-search-count-bottom">
                                    <h5>Showing Products {{$products->firstItem()}}-{{$products->lastItem()}} of
                                        {{$products->total()}} Result</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- section End -->
