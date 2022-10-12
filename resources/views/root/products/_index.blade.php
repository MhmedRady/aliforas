@extends('root.layouts.app')

@section('stylesheet')
@endsection

@section('content')
    <!-- section start -->
    <section class="section-big-py-space ratio_asos b-g-light">
        <div class="collection-wrapper">
            <div class="custom-container">
                <div class="row" id="filterApp">
                    <div class="col-sm-3 collection-filter category-side category-page-side">
                        <div class="collection-filter-block creative-card creative-inner category-side">
                            <!-- brand filter start -->
                            <div class="collection-mobile-back">
                                <span class="filter-back">
                                    <i class="fa fa-angle-left" aria-hidden="true"></i> back
                                </span>
                            </div>
                            <div class="collection-collapse-block open"
                                 v-if="filterOptions.brands && filterOptions.brands.length > 0">
                                <h3 class="collapse-block-title mt-0">brand</h3>
                                <div class="collection-collapse-block-content">
                                    <div class="collection-brand-filter">
                                        <div
                                            class="custom-control custom-checkbox form-check collection-filter-checkbox"
                                            v-for="brand in filterOptions.brands">
                                            <input type="checkbox" class="custom-control-input form-check-input"
                                                   :checked="brand.selected" :id="'BrandFilter_' + brand.id">
                                            <label class="custom-control-label form-check-label"
                                                   :for="'BrandFilter_' + brand.id">@{{ brand.name }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="collection-content col">
                        <div class="page-main-content">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="collection-product-wrapper">
                                        <div class="product-top-filter">
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <div class="filter-main-btn"><span class="filter-btn btn btn-theme"><i
                                                                class="fa fa-filter"
                                                                aria-hidden="true"></i> Filter</span></div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="product-filter-content">
                                                        <div class="search-count">
                                                            <h5>Showing Products 1-24 of 10 Result</h5></div>
                                                        <div class="collection-view">
                                                            <ul>
                                                                <li><i class="fa fa-th grid-layout-view"></i></li>
                                                                <li><i class="fa fa-list-ul list-layout-view"></i></li>
                                                            </ul>
                                                        </div>
                                                        <div class="collection-grid-view">
                                                            <ul>
                                                                <li><img
                                                                        src="{{asset('assets/images/category/icon/2.png')}}"
                                                                        alt="" class="product-2-layout-view"></li>
                                                                <li><img
                                                                        src="{{asset('assets/images/category/icon/3.png')}}"
                                                                        alt="" class="product-3-layout-view"></li>
                                                                <li><img
                                                                        src="{{asset('assets/images/category/icon/4.png')}}"
                                                                        alt="" class="product-4-layout-view"></li>
                                                                <li><img
                                                                        src="{{asset('assets/images/category/icon/6.png')}}"
                                                                        alt="" class="product-6-layout-view"></li>
                                                            </ul>
                                                        </div>
                                                        <div class="product-page-per-view">
                                                            <select>
                                                                <option value="High to low">24 Products Par Page
                                                                </option>
                                                                <option value="Low to High">50 Products Par Page
                                                                </option>
                                                                <option value="Low to High">100 Products Par Page
                                                                </option>
                                                            </select>
                                                        </div>
                                                        <div class="product-page-filter">
                                                            <select>
                                                                <option value="High to low">Sorting items</option>
                                                                <option value="Low to High">50 Products</option>
                                                                <option value="Low to High">100 Products</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-wrapper-grid product-load-more product">
                                            <div class="row">
                                                <div class="col-xl-3 col-md-4 col-6 col-grid-box">
                                                    <div class="product-box">
                                                        <div class="product-imgbox">
                                                            <div class="product-front">
                                                                <a href="{{asset('product-page(left-sidebar).html')}}">
                                                                    <img
                                                                        src="{{asset('assets/images/layout-4/product/1.jpg')}}"
                                                                        class="img-fluid  " alt="product"> </a>
                                                            </div>
                                                            <div class="product-back">
                                                                <a href="{{asset('product-page(left-sidebar).html')}}">
                                                                    <img
                                                                        src="{{asset('assets/images/layout-4/product/a1.jpg')}}"
                                                                        class="img-fluid  " alt="product"> </a>
                                                            </div>


                                                        </div>
                                                        <div class="product-detail detail-center detail-inverse">
                                                            <div class="detail-title">
                                                                <div class="detail-left">
                                                                    <div class="rating-star"><i class="fa fa-star"></i>
                                                                        <i class="fa fa-star"></i> <i
                                                                            class="fa fa-star"></i> <i
                                                                            class="fa fa-star"></i> <i
                                                                            class="fa fa-star"></i></div>
                                                                    <p>Lorem Ipsum is simply dummy text of the printing
                                                                        and typesetting industry. Lorem Ipsum has been
                                                                        the industry's standard dummy text ever since
                                                                        the 1500s, when an unknown printer took a galley
                                                                        of type and scrambled it to make a type specimen
                                                                        book</p>
                                                                    <a href="{{asset('product-page(left-sidebar).html')}}">
                                                                        <h6 class="price-title">
                                                                            realme not 7
                                                                        </h6></a>
                                                                </div>
                                                                <div class="detail-right">
                                                                    <div class="check-price"> $60.21</div>
                                                                    <div class="price">
                                                                        <div class="price"> $50.05</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="icon-detail">
                                                                <button class="tooltip-top add-cartnoty"
                                                                        data-tippy-content="Add to cart"><i
                                                                        data-feather="shopping-cart"></i></button>
                                                                <a href="javascript:void(0)"
                                                                   class="add-to-wish tooltip-top"
                                                                   data-tippy-content="Add to Wishlist"> <i
                                                                        data-feather="heart"></i> </a>
                                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                   data-bs-target="#quick-view" class="tooltip-top"
                                                                   data-tippy-content="Quick View"> <i
                                                                        data-feather="eye"></i> </a>
                                                                <a href="{{asset('compare.html')}}" class="tooltip-top"
                                                                   data-tippy-content="Compare"> <i
                                                                        data-feather="refresh-cw"></i> </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-3 col-md-4 col-6 col-grid-box">
                                                    <div class="product-box">
                                                        <div class="product-imgbox">
                                                            <div class="product-front">
                                                                <a href="{{asset('product-page(left-sidebar).html')}}">
                                                                    <img
                                                                        src="{{asset('assets/images/layout-4/product/2.jpg')}}"
                                                                        class="img-fluid  " alt="product"> </a>
                                                            </div>
                                                            <div class="product-back">
                                                                <a href="{{asset('product-page(left-sidebar).html')}}">
                                                                    <img
                                                                        src="{{asset('assets/images/layout-4/product/a2.jpg')}}"
                                                                        class="img-fluid  " alt="product"> </a>
                                                            </div>


                                                        </div>
                                                        <div class="product-detail detail-center detail-inverse">
                                                            <div class="detail-title">
                                                                <div class="detail-left">
                                                                    <div class="rating-star"><i class="fa fa-star"></i>
                                                                        <i class="fa fa-star"></i> <i
                                                                            class="fa fa-star"></i> <i
                                                                            class="fa fa-star"></i> <i
                                                                            class="fa fa-star"></i></div>
                                                                    <p>Lorem Ipsum is simply dummy text of the printing
                                                                        and typesetting industry. Lorem Ipsum has been
                                                                        the industry's standard dummy text ever since
                                                                        the 1500s, when an unknown printer took a galley
                                                                        of type and scrambled it to make a type specimen
                                                                        book</p>
                                                                    <a href="{{asset('product-page(left-sidebar).html')}}">
                                                                        <h6 class="price-title">
                                                                            wireless speaker
                                                                        </h6></a>
                                                                </div>
                                                                <div class="detail-right">
                                                                    <div class="check-price"> $56.21</div>
                                                                    <div class="price">
                                                                        <div class="price"> $ 24.05</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="icon-detail">
                                                                <button class="tooltip-top add-cartnoty"
                                                                        data-tippy-content="Add to cart"><i
                                                                        data-feather="shopping-cart"></i></button>
                                                                <a href="javascript:void(0)"
                                                                   class="add-to-wish tooltip-top"
                                                                   data-tippy-content="Add to Wishlist"> <i
                                                                        data-feather="heart"></i> </a>
                                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                   data-bs-target="#quick-view" class="tooltip-top"
                                                                   data-tippy-content="Quick View"> <i
                                                                        data-feather="eye"></i> </a>
                                                                <a href="{{asset('compare.html')}}" class="tooltip-top"
                                                                   data-tippy-content="Compare"> <i
                                                                        data-feather="refresh-cw"></i> </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-3 col-md-4 col-6 col-grid-box">
                                                    <div class="product-box">
                                                        <div class="product-imgbox">
                                                            <div class="product-front">
                                                                <a href="{{asset('product-page(left-sidebar).html')}}">
                                                                    <img
                                                                        src="{{asset('assets/images/layout-4/product/3.jpg')}}"
                                                                        class="img-fluid  " alt="product"> </a>
                                                            </div>
                                                            <div class="product-back">
                                                                <a href="{{asset('product-page(left-sidebar).html')}}">
                                                                    <img
                                                                        src="{{asset('assets/images/layout-4/product/a3.jpg')}}"
                                                                        class="img-fluid  " alt="product"> </a>
                                                            </div>
                                                        </div>
                                                        <div class="product-detail detail-center detail-inverse">
                                                            <div class="detail-title">
                                                                <div class="detail-left">
                                                                    <div class="rating-star"><i class="fa fa-star"></i>
                                                                        <i class="fa fa-star"></i> <i
                                                                            class="fa fa-star"></i> <i
                                                                            class="fa fa-star"></i> <i
                                                                            class="fa fa-star"></i></div>
                                                                    <p>Lorem Ipsum is simply dummy text of the printing
                                                                        and typesetting industry. Lorem Ipsum has been
                                                                        the industry's standard dummy text ever since
                                                                        the 1500s, when an unknown printer took a galley
                                                                        of type and scrambled it to make a type specimen
                                                                        book</p>
                                                                    <a href="{{asset('product-page(left-sidebar).html')}}">
                                                                        <h6 class="price-title">
                                                                            Travel Backpack
                                                                        </h6></a>
                                                                </div>
                                                                <div class="detail-right">
                                                                    <div class="check-price"> $90.21</div>
                                                                    <div class="price">
                                                                        <div class="price"> $70.05</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="icon-detail">
                                                                <button class="tooltip-top add-cartnoty"
                                                                        data-tippy-content="Add to cart"><i
                                                                        data-feather="shopping-cart"></i></button>
                                                                <a href="javascript:void(0)"
                                                                   class="add-to-wish tooltip-top"
                                                                   data-tippy-content="Add to Wishlist"> <i
                                                                        data-feather="heart"></i> </a>
                                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                   data-bs-target="#quick-view" class="tooltip-top"
                                                                   data-tippy-content="Quick View"> <i
                                                                        data-feather="eye"></i> </a>
                                                                <a href="{{asset('compare.html')}}" class="tooltip-top"
                                                                   data-tippy-content="Compare"> <i
                                                                        data-feather="refresh-cw"></i> </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-3 col-md-4 col-6 col-grid-box">
                                                    <div class="product-box">
                                                        <div class="product-imgbox">
                                                            <div class="product-front">
                                                                <a href="{{asset('product-page(left-sidebar).html')}}">
                                                                    <img
                                                                        src="{{asset('assets/images/layout-4/product/4.jpg')}}"
                                                                        class="img-fluid  " alt="product"> </a>
                                                            </div>
                                                            <div class="product-back">
                                                                <a href="{{asset('product-page(left-sidebar).html')}}">
                                                                    <img
                                                                        src="{{asset('assets/images/layout-4/product/a4.jpg')}}"
                                                                        class="img-fluid  " alt="product"> </a>
                                                            </div>

                                                        </div>
                                                        <div class="product-detail detail-center detail-inverse">
                                                            <div class="detail-title">
                                                                <div class="detail-left">
                                                                    <div class="rating-star"><i class="fa fa-star"></i>
                                                                        <i class="fa fa-star"></i> <i
                                                                            class="fa fa-star"></i> <i
                                                                            class="fa fa-star"></i> <i
                                                                            class="fa fa-star"></i></div>
                                                                    <p>Lorem Ipsum is simply dummy text of the printing
                                                                        and typesetting industry. Lorem Ipsum has been
                                                                        the industry's standard dummy text ever since
                                                                        the 1500s, when an unknown printer took a galley
                                                                        of type and scrambled it to make a type specimen
                                                                        book</p>
                                                                    <a href="{{asset('product-page(left-sidebar).html')}}">
                                                                        <h6 class="price-title">
                                                                            Modern Shoes
                                                                        </h6></a>
                                                                </div>
                                                                <div class="detail-right">
                                                                    <div class="check-price"> $ 70.21</div>
                                                                    <div class="price">
                                                                        <div class="price"> $ 44.05</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="icon-detail">
                                                                <button class="tooltip-top add-cartnoty"
                                                                        data-tippy-content="Add to cart"><i
                                                                        data-feather="shopping-cart"></i></button>
                                                                <a href="javascript:void(0)"
                                                                   class="add-to-wish tooltip-top"
                                                                   data-tippy-content="Add to Wishlist"> <i
                                                                        data-feather="heart"></i> </a>
                                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                   data-bs-target="#quick-view" class="tooltip-top"
                                                                   data-tippy-content="Quick View"> <i
                                                                        data-feather="eye"></i> </a>
                                                                <a href="{{asset('compare.html')}}" class="tooltip-top"
                                                                   data-tippy-content="Compare"> <i
                                                                        data-feather="refresh-cw"></i> </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-3 col-md-4 col-6 col-grid-box">
                                                    <div class="product-box">
                                                        <div class="product-imgbox">
                                                            <div class="product-front">
                                                                <a href="{{asset('product-page(left-sidebar).html')}}">
                                                                    <img
                                                                        src="{{asset('assets/images/layout-4/product/5.jpg')}}"
                                                                        class="img-fluid  " alt="product"> </a>
                                                            </div>
                                                            <div class="product-back">
                                                                <a href="{{asset('product-page(left-sidebar).html')}}">
                                                                    <img
                                                                        src="{{asset('assets/images/layout-4/product/a5.jpg')}}"
                                                                        class="img-fluid  " alt="product"> </a>
                                                            </div>


                                                        </div>
                                                        <div class="product-detail detail-center detail-inverse">
                                                            <div class="detail-title">
                                                                <div class="detail-left">
                                                                    <div class="rating-star"><i class="fa fa-star"></i>
                                                                        <i class="fa fa-star"></i> <i
                                                                            class="fa fa-star"></i> <i
                                                                            class="fa fa-star"></i> <i
                                                                            class="fa fa-star"></i></div>
                                                                    <p>Lorem Ipsum is simply dummy text of the printing
                                                                        and typesetting industry. Lorem Ipsum has been
                                                                        the industry's standard dummy text ever since
                                                                        the 1500s, when an unknown printer took a galley
                                                                        of type and scrambled it to make a type specimen
                                                                        book</p>
                                                                    <a href="{{asset('product-page(left-sidebar).html')}}">
                                                                        <h6 class="price-title">
                                                                            sleeve fress
                                                                        </h6></a>
                                                                </div>
                                                                <div class="detail-right">
                                                                    <div class="check-price"> $ 56.21</div>
                                                                    <div class="price">
                                                                        <div class="price"> $ 24.05</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="icon-detail">
                                                                <button class="tooltip-top add-cartnoty"
                                                                        data-tippy-content="Add to cart"><i
                                                                        data-feather="shopping-cart"></i></button>
                                                                <a href="javascript:void(0)"
                                                                   class="add-to-wish tooltip-top"
                                                                   data-tippy-content="Add to Wishlist"> <i
                                                                        data-feather="heart"></i> </a>
                                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                   data-bs-target="#quick-view" class="tooltip-top"
                                                                   data-tippy-content="Quick View"> <i
                                                                        data-feather="eye"></i> </a>
                                                                <a href="{{asset('compare.html')}}" class="tooltip-top"
                                                                   data-tippy-content="Compare"> <i
                                                                        data-feather="refresh-cw"></i> </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-3 col-md-4 col-6 col-grid-box">
                                                    <div class="product-box">
                                                        <div class="product-imgbox">
                                                            <div class="product-front">
                                                                <a href="{{asset('product-page(left-sidebar).html')}}">
                                                                    <img
                                                                        src="{{asset('assets/images/layout-4/product/6.jpg')}}"
                                                                        class="img-fluid  " alt="product"> </a>
                                                            </div>
                                                            <div class="product-back">
                                                                <a href="{{asset('product-page(left-sidebar).html')}}">
                                                                    <img
                                                                        src="{{asset('assets/images/layout-4/product/a5.jpg')}}"
                                                                        class="img-fluid  " alt="product"> </a>
                                                            </div>


                                                        </div>
                                                        <div class="product-detail detail-center detail-inverse">
                                                            <div class="detail-title">
                                                                <div class="detail-left">
                                                                    <div class="rating-star"><i class="fa fa-star"></i>
                                                                        <i class="fa fa-star"></i> <i
                                                                            class="fa fa-star"></i> <i
                                                                            class="fa fa-star"></i> <i
                                                                            class="fa fa-star"></i></div>
                                                                    <p>Lorem Ipsum is simply dummy text of the printing
                                                                        and typesetting industry. Lorem Ipsum has been
                                                                        the industry's standard dummy text ever since
                                                                        the 1500s, when an unknown printer took a galley
                                                                        of type and scrambled it to make a type specimen
                                                                        book</p>
                                                                    <a href="{{asset('product-page(left-sidebar).html')}}">
                                                                        <h6 class="price-title">
                                                                            Acer Swift laptop
                                                                        </h6></a>
                                                                </div>
                                                                <div class="detail-right">
                                                                    <div class="check-price"> $ 57.21</div>
                                                                    <div class="price">
                                                                        <div class="price"> $ 30.05</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="icon-detail">
                                                                <button class="tooltip-top add-cartnoty"
                                                                        data-tippy-content="Add to cart"><i
                                                                        data-feather="shopping-cart"></i></button>
                                                                <a href="javascript:void(0)"
                                                                   class="add-to-wish tooltip-top"
                                                                   data-tippy-content="Add to Wishlist"> <i
                                                                        data-feather="heart"></i> </a>
                                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                   data-bs-target="#quick-view" class="tooltip-top"
                                                                   data-tippy-content="Quick View"> <i
                                                                        data-feather="eye"></i> </a>
                                                                <a href="{{asset('compare.html')}}" class="tooltip-top"
                                                                   data-tippy-content="Compare"> <i
                                                                        data-feather="refresh-cw"></i> </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-3 col-md-4 col-6 col-grid-box">
                                                    <div class="product-box">
                                                        <div class="product-imgbox">
                                                            <div class="product-front">
                                                                <a href="{{asset('product-page(left-sidebar).html')}}">
                                                                    <img
                                                                        src="{{asset('assets/images/layout-4/product/7.jpg')}}"
                                                                        class="img-fluid  " alt="product"> </a>
                                                            </div>
                                                            <div class="product-back">
                                                                <a href="{{asset('product-page(left-sidebar).html')}}">
                                                                    <img
                                                                        src="{{asset('assets/images/layout-4/product/a7.jpg')}}"
                                                                        class="img-fluid  " alt="product"> </a>
                                                            </div>


                                                        </div>
                                                        <div class="product-detail detail-center detail-inverse">
                                                            <div class="detail-title">
                                                                <div class="detail-left">
                                                                    <div class="rating-star"><i class="fa fa-star"></i>
                                                                        <i class="fa fa-star"></i> <i
                                                                            class="fa fa-star"></i> <i
                                                                            class="fa fa-star"></i> <i
                                                                            class="fa fa-star"></i></div>
                                                                    <p>Lorem Ipsum is simply dummy text of the printing
                                                                        and typesetting industry. Lorem Ipsum has been
                                                                        the industry's standard dummy text ever since
                                                                        the 1500s, when an unknown printer took a galley
                                                                        of type and scrambled it to make a type specimen
                                                                        book</p>
                                                                    <a href="{{asset('product-page(left-sidebar).html')}}">
                                                                        <h6 class="price-title">
                                                                            fastrack watch
                                                                        </h6></a>
                                                                </div>
                                                                <div class="detail-right">
                                                                    <div class="check-price"> $ 88.21</div>
                                                                    <div class="price">
                                                                        <div class="price"> $65.05</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="icon-detail">
                                                                <button class="tooltip-top add-cartnoty"
                                                                        data-tippy-content="Add to cart"><i
                                                                        data-feather="shopping-cart"></i></button>
                                                                <a href="javascript:void(0)"
                                                                   class="add-to-wish tooltip-top"
                                                                   data-tippy-content="Add to Wishlist"> <i
                                                                        data-feather="heart"></i> </a>
                                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                   data-bs-target="#quick-view" class="tooltip-top"
                                                                   data-tippy-content="Quick View"> <i
                                                                        data-feather="eye"></i> </a>
                                                                <a href="{{asset('compare.html')}}" class="tooltip-top"
                                                                   data-tippy-content="Compare"> <i
                                                                        data-feather="refresh-cw"></i> </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-3 col-md-4 col-6 col-grid-box">
                                                    <div class="product">
                                                        <div class="product-box">
                                                            <div class="product-imgbox">
                                                                <div class="product-front">
                                                                    <img
                                                                        src="{{asset('assets/images/layout-1/product/3.jpg')}}"
                                                                        class="img-fluid  " alt="product">
                                                                </div>
                                                                <div class="product-back">
                                                                    <img
                                                                        src="{{asset('assets/images/layout-1/product/a3.jpg')}}"
                                                                        class="img-fluid  " alt="product">
                                                                </div>
                                                            </div>
                                                            <div class="product-detail detail-center ">
                                                                <div class="detail-title">
                                                                    <div class="detail-left">
                                                                        <div class="rating-star">
                                                                            <i class="fa fa-star"></i>
                                                                            <i class="fa fa-star"></i>
                                                                            <i class="fa fa-star"></i>
                                                                            <i class="fa fa-star"></i>
                                                                            <i class="fa fa-star"></i>
                                                                        </div>
                                                                        <p>Lorem Ipsum is simply dummy text of the
                                                                            printing and typesetting industry. Lorem
                                                                            Ipsum has been the industry's standard dummy
                                                                            text ever since the 1500s, when an unknown
                                                                            printer took a galley of type and scrambled
                                                                            it to make a type specimen book</p>
                                                                        <a href="">
                                                                            <h6 class="price-title">
                                                                                reader will be distracted.
                                                                            </h6>
                                                                        </a>
                                                                    </div>
                                                                    <div class="detail-right">
                                                                        <div class="check-price">
                                                                            $ 56.21
                                                                        </div>
                                                                        <div class="price">
                                                                            <div class="price">
                                                                                $ 24.05
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="icon-detail">
                                                                    <button data-bs-toggle="modal"
                                                                            data-bs-target="#addtocart"
                                                                            onclick="openCart()" class="tooltip-top"
                                                                            data-tippy-content="Add to cart">
                                                                        <i data-feather="shopping-cart"></i>
                                                                    </button>
                                                                    <a href="javascript:void(0)"
                                                                       class="add-to-wish tooltip-top"
                                                                       data-tippy-content="Add to Wishlist">
                                                                        <i data-feather="heart"></i>
                                                                    </a>
                                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                       data-bs-target="#quick-view" class="tooltip-top"
                                                                       data-tippy-content="Quick View">
                                                                        <i data-feather="eye"></i>
                                                                    </a>
                                                                    <a href="{{asset('compare.html')}}"
                                                                       class="tooltip-top" data-tippy-content="Compare">
                                                                        <i data-feather="refresh-cw"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-3 col-md-4 col-6 col-grid-box">
                                                    <div class="product-box">
                                                        <div class="product-imgbox">
                                                            <div class="product-front">
                                                                <a href="{{asset('product-page(left-sidebar).html')}}">
                                                                    <img
                                                                        src="{{asset('assets/images/layout-4/product/8.jpg')}}"
                                                                        class="img-fluid  " alt="product"> </a>
                                                            </div>
                                                            <div class="product-back">
                                                                <a href="{{asset('product-page(left-sidebar).html')}}">
                                                                    <img
                                                                        src="{{asset('assets/images/layout-4/product/a8.jpg')}}"
                                                                        class="img-fluid  " alt="product"> </a>
                                                            </div>


                                                        </div>
                                                        <div class="product-detail detail-center detail-inverse">
                                                            <div class="detail-title">
                                                                <div class="detail-left">
                                                                    <div class="rating-star"><i class="fa fa-star"></i>
                                                                        <i class="fa fa-star"></i> <i
                                                                            class="fa fa-star"></i> <i
                                                                            class="fa fa-star"></i> <i
                                                                            class="fa fa-star"></i></div>
                                                                    <p>Lorem Ipsum is simply dummy text of the printing
                                                                        and typesetting industry. Lorem Ipsum has been
                                                                        the industry's standard dummy text ever since
                                                                        the 1500s, when an unknown printer took a galley
                                                                        of type and scrambled it to make a type specimen
                                                                        book</p>
                                                                    <a href="{{asset('product-page(left-sidebar).html')}}">
                                                                        <h6 class="price-title">
                                                                            dressing mirror
                                                                        </h6></a>
                                                                </div>
                                                                <div class="detail-right">
                                                                    <div class="check-price"> $ 97.21</div>
                                                                    <div class="price">
                                                                        <div class="price"> $ 84.05</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="icon-detail">
                                                                <button class="tooltip-top add-cartnoty"
                                                                        data-tippy-content="Add to cart"><i
                                                                        data-feather="shopping-cart"></i></button>
                                                                <a href="javascript:void(0)"
                                                                   class="add-to-wish tooltip-top"
                                                                   data-tippy-content="Add to Wishlist"> <i
                                                                        data-feather="heart"></i> </a>
                                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                   data-bs-target="#quick-view" class="tooltip-top"
                                                                   data-tippy-content="Quick View"> <i
                                                                        data-feather="eye"></i> </a>
                                                                <a href="{{asset('compare.html')}}" class="tooltip-top"
                                                                   data-tippy-content="Compare"> <i
                                                                        data-feather="refresh-cw"></i> </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-3 col-md-4 col-6 col-grid-box">
                                                    <div class="product-box">
                                                        <div class="product-imgbox">
                                                            <div class="product-front">
                                                                <a href="{{asset('product-page(left-sidebar).html')}}">
                                                                    <img
                                                                        src="{{asset('assets/images/layout-4/product/1.jpg')}}"
                                                                        class="img-fluid  " alt="product"> </a>
                                                            </div>
                                                            <div class="product-back">
                                                                <a href="{{asset('product-page(left-sidebar).html')}}">
                                                                    <img
                                                                        src="{{asset('assets/images/layout-4/product/a1.jpg')}}"
                                                                        class="img-fluid  " alt="product"> </a>
                                                            </div>


                                                        </div>
                                                        <div class="product-detail detail-center detail-inverse">
                                                            <div class="detail-title">
                                                                <div class="detail-left">
                                                                    <div class="rating-star"><i class="fa fa-star"></i>
                                                                        <i class="fa fa-star"></i> <i
                                                                            class="fa fa-star"></i> <i
                                                                            class="fa fa-star"></i> <i
                                                                            class="fa fa-star"></i></div>
                                                                    <p>Lorem Ipsum is simply dummy text of the printing
                                                                        and typesetting industry. Lorem Ipsum has been
                                                                        the industry's standard dummy text ever since
                                                                        the 1500s, when an unknown printer took a galley
                                                                        of type and scrambled it to make a type specimen
                                                                        book</p>
                                                                    <a href="{{asset('product-page(left-sidebar).html')}}">
                                                                        <h6 class="price-title">
                                                                            realme not 7
                                                                        </h6></a>
                                                                </div>
                                                                <div class="detail-right">
                                                                    <div class="check-price"> $60.21</div>
                                                                    <div class="price">
                                                                        <div class="price"> $50.05</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="icon-detail">
                                                                <button class="tooltip-top add-cartnoty"
                                                                        data-tippy-content="Add to cart"><i
                                                                        data-feather="shopping-cart"></i></button>
                                                                <a href="javascript:void(0)"
                                                                   class="add-to-wish tooltip-top"
                                                                   data-tippy-content="Add to Wishlist"> <i
                                                                        data-feather="heart"></i> </a>
                                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                   data-bs-target="#quick-view" class="tooltip-top"
                                                                   data-tippy-content="Quick View"> <i
                                                                        data-feather="eye"></i> </a>
                                                                <a href="{{asset('compare.html')}}" class="tooltip-top"
                                                                   data-tippy-content="Compare"> <i
                                                                        data-feather="refresh-cw"></i> </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-3 col-md-4 col-6 col-grid-box">
                                                    <div class="product-box">
                                                        <div class="product-imgbox">
                                                            <div class="product-front">
                                                                <a href="{{asset('product-page(left-sidebar).html')}}">
                                                                    <img
                                                                        src="{{asset('assets/images/layout-4/product/2.jpg')}}"
                                                                        class="img-fluid  " alt="product"> </a>
                                                            </div>
                                                            <div class="product-back">
                                                                <a href="{{asset('product-page(left-sidebar).html')}}">
                                                                    <img
                                                                        src="{{asset('assets/images/layout-4/product/a2.jpg')}}"
                                                                        class="img-fluid  " alt="product"> </a>
                                                            </div>


                                                        </div>
                                                        <div class="product-detail detail-center detail-inverse">
                                                            <div class="detail-title">
                                                                <div class="detail-left">
                                                                    <div class="rating-star"><i class="fa fa-star"></i>
                                                                        <i class="fa fa-star"></i> <i
                                                                            class="fa fa-star"></i> <i
                                                                            class="fa fa-star"></i> <i
                                                                            class="fa fa-star"></i></div>
                                                                    <p>Lorem Ipsum is simply dummy text of the printing
                                                                        and typesetting industry. Lorem Ipsum has been
                                                                        the industry's standard dummy text ever since
                                                                        the 1500s, when an unknown printer took a galley
                                                                        of type and scrambled it to make a type specimen
                                                                        book</p>
                                                                    <a href="{{asset('product-page(left-sidebar).html')}}">
                                                                        <h6 class="price-title">
                                                                            wireless speaker
                                                                        </h6></a>
                                                                </div>
                                                                <div class="detail-right">
                                                                    <div class="check-price"> $56.21</div>
                                                                    <div class="price">
                                                                        <div class="price"> $ 24.05</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="icon-detail">
                                                                <button class="tooltip-top add-cartnoty"
                                                                        data-tippy-content="Add to cart"><i
                                                                        data-feather="shopping-cart"></i></button>
                                                                <a href="javascript:void(0)"
                                                                   class="add-to-wish tooltip-top"
                                                                   data-tippy-content="Add to Wishlist"> <i
                                                                        data-feather="heart"></i> </a>
                                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                   data-bs-target="#quick-view" class="tooltip-top"
                                                                   data-tippy-content="Quick View"> <i
                                                                        data-feather="eye"></i> </a>
                                                                <a href="{{asset('compare.html')}}" class="tooltip-top"
                                                                   data-tippy-content="Compare"> <i
                                                                        data-feather="refresh-cw"></i> </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-3 col-md-4 col-6 col-grid-box">
                                                    <div class="product-box">
                                                        <div class="product-imgbox">
                                                            <div class="product-front">
                                                                <a href="{{asset('product-page(left-sidebar).html')}}">
                                                                    <img
                                                                        src="{{asset('assets/images/layout-4/product/3.jpg')}}"
                                                                        class="img-fluid  " alt="product"> </a>
                                                            </div>
                                                            <div class="product-back">
                                                                <a href="{{asset('product-page(left-sidebar).html')}}">
                                                                    <img
                                                                        src="{{asset('assets/images/layout-4/product/a3.jpg')}}"
                                                                        class="img-fluid  " alt="product"> </a>
                                                            </div>
                                                        </div>
                                                        <div class="product-detail detail-center detail-inverse">
                                                            <div class="detail-title">
                                                                <div class="detail-left">
                                                                    <div class="rating-star"><i class="fa fa-star"></i>
                                                                        <i class="fa fa-star"></i> <i
                                                                            class="fa fa-star"></i> <i
                                                                            class="fa fa-star"></i> <i
                                                                            class="fa fa-star"></i></div>
                                                                    <p>Lorem Ipsum is simply dummy text of the printing
                                                                        and typesetting industry. Lorem Ipsum has been
                                                                        the industry's standard dummy text ever since
                                                                        the 1500s, when an unknown printer took a galley
                                                                        of type and scrambled it to make a type specimen
                                                                        book</p>
                                                                    <a href="{{asset('product-page(left-sidebar).html')}}">
                                                                        <h6 class="price-title">
                                                                            Travel Backpack
                                                                        </h6></a>
                                                                </div>
                                                                <div class="detail-right">
                                                                    <div class="check-price"> $90.21</div>
                                                                    <div class="price">
                                                                        <div class="price"> $70.05</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="icon-detail">
                                                                <button class="tooltip-top add-cartnoty"
                                                                        data-tippy-content="Add to cart"><i
                                                                        data-feather="shopping-cart"></i></button>
                                                                <a href="javascript:void(0)"
                                                                   class="add-to-wish tooltip-top"
                                                                   data-tippy-content="Add to Wishlist"> <i
                                                                        data-feather="heart"></i> </a>
                                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                   data-bs-target="#quick-view" class="tooltip-top"
                                                                   data-tippy-content="Quick View"> <i
                                                                        data-feather="eye"></i> </a>
                                                                <a href="{{asset('compare.html')}}" class="tooltip-top"
                                                                   data-tippy-content="Compare"> <i
                                                                        data-feather="refresh-cw"></i> </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-3 col-md-4 col-6 col-grid-box">
                                                    <div class="product-box">
                                                        <div class="product-imgbox">
                                                            <div class="product-front">
                                                                <a href="{{asset('product-page(left-sidebar).html')}}">
                                                                    <img
                                                                        src="{{asset('assets/images/layout-4/product/1.jpg')}}"
                                                                        class="img-fluid  " alt="product"> </a>
                                                            </div>
                                                            <div class="product-back">
                                                                <a href="{{asset('product-page(left-sidebar).html')}}">
                                                                    <img
                                                                        src="{{asset('assets/images/layout-4/product/a1.jpg')}}"
                                                                        class="img-fluid  " alt="product"> </a>
                                                            </div>


                                                        </div>
                                                        <div class="product-detail detail-center detail-inverse">
                                                            <div class="detail-title">
                                                                <div class="detail-left">
                                                                    <div class="rating-star"><i class="fa fa-star"></i>
                                                                        <i class="fa fa-star"></i> <i
                                                                            class="fa fa-star"></i> <i
                                                                            class="fa fa-star"></i> <i
                                                                            class="fa fa-star"></i></div>
                                                                    <p>Lorem Ipsum is simply dummy text of the printing
                                                                        and typesetting industry. Lorem Ipsum has been
                                                                        the industry's standard dummy text ever since
                                                                        the 1500s, when an unknown printer took a galley
                                                                        of type and scrambled it to make a type specimen
                                                                        book</p>
                                                                    <a href="{{asset('product-page(left-sidebar).html')}}">
                                                                        <h6 class="price-title">
                                                                            realme not 7
                                                                        </h6></a>
                                                                </div>
                                                                <div class="detail-right">
                                                                    <div class="check-price"> $60.21</div>
                                                                    <div class="price">
                                                                        <div class="price"> $50.05</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="icon-detail">
                                                                <button class="tooltip-top add-cartnoty"
                                                                        data-tippy-content="Add to cart"><i
                                                                        data-feather="shopping-cart"></i></button>
                                                                <a href="javascript:void(0)"
                                                                   class="add-to-wish tooltip-top"
                                                                   data-tippy-content="Add to Wishlist"> <i
                                                                        data-feather="heart"></i> </a>
                                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                   data-bs-target="#quick-view" class="tooltip-top"
                                                                   data-tippy-content="Quick View"> <i
                                                                        data-feather="eye"></i> </a>
                                                                <a href="{{asset('compare.html')}}" class="tooltip-top"
                                                                   data-tippy-content="Compare"> <i
                                                                        data-feather="refresh-cw"></i> </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-3 col-md-4 col-6 col-grid-box">
                                                    <div class="product-box">
                                                        <div class="product-imgbox">
                                                            <div class="product-front">
                                                                <a href="{{asset('product-page(left-sidebar).html')}}">
                                                                    <img
                                                                        src="{{asset('assets/images/layout-4/product/2.jpg')}}"
                                                                        class="img-fluid  " alt="product"> </a>
                                                            </div>
                                                            <div class="product-back">
                                                                <a href="{{asset('product-page(left-sidebar).html')}}">
                                                                    <img
                                                                        src="{{asset('assets/images/layout-4/product/a2.jpg')}}"
                                                                        class="img-fluid  " alt="product"> </a>
                                                            </div>


                                                        </div>
                                                        <div class="product-detail detail-center detail-inverse">
                                                            <div class="detail-title">
                                                                <div class="detail-left">
                                                                    <div class="rating-star"><i class="fa fa-star"></i>
                                                                        <i class="fa fa-star"></i> <i
                                                                            class="fa fa-star"></i> <i
                                                                            class="fa fa-star"></i> <i
                                                                            class="fa fa-star"></i></div>
                                                                    <p>Lorem Ipsum is simply dummy text of the printing
                                                                        and typesetting industry. Lorem Ipsum has been
                                                                        the industry's standard dummy text ever since
                                                                        the 1500s, when an unknown printer took a galley
                                                                        of type and scrambled it to make a type specimen
                                                                        book</p>
                                                                    <a href="{{asset('product-page(left-sidebar).html')}}">
                                                                        <h6 class="price-title">
                                                                            wireless speaker
                                                                        </h6></a>
                                                                </div>
                                                                <div class="detail-right">
                                                                    <div class="check-price"> $56.21</div>
                                                                    <div class="price">
                                                                        <div class="price"> $ 24.05</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="icon-detail">
                                                                <button class="tooltip-top add-cartnoty"
                                                                        data-tippy-content="Add to cart"><i
                                                                        data-feather="shopping-cart"></i></button>
                                                                <a href="javascript:void(0)"
                                                                   class="add-to-wish tooltip-top"
                                                                   data-tippy-content="Add to Wishlist"> <i
                                                                        data-feather="heart"></i> </a>
                                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                   data-bs-target="#quick-view" class="tooltip-top"
                                                                   data-tippy-content="Quick View"> <i
                                                                        data-feather="eye"></i> </a>
                                                                <a href="{{asset('compare.html')}}" class="tooltip-top"
                                                                   data-tippy-content="Compare"> <i
                                                                        data-feather="refresh-cw"></i> </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-3 col-md-4 col-6 col-grid-box">
                                                    <div class="product-box">
                                                        <div class="product-imgbox">
                                                            <div class="product-front">
                                                                <a href="{{asset('product-page(left-sidebar).html')}}">
                                                                    <img
                                                                        src="{{asset('assets/images/layout-4/product/3.jpg')}}"
                                                                        class="img-fluid  " alt="product"> </a>
                                                            </div>
                                                            <div class="product-back">
                                                                <a href="{{asset('product-page(left-sidebar).html')}}">
                                                                    <img
                                                                        src="{{asset('assets/images/layout-4/product/a3.jpg')}}"
                                                                        class="img-fluid  " alt="product"> </a>
                                                            </div>
                                                        </div>
                                                        <div class="product-detail detail-center detail-inverse">
                                                            <div class="detail-title">
                                                                <div class="detail-left">
                                                                    <div class="rating-star"><i class="fa fa-star"></i>
                                                                        <i class="fa fa-star"></i> <i
                                                                            class="fa fa-star"></i> <i
                                                                            class="fa fa-star"></i> <i
                                                                            class="fa fa-star"></i></div>
                                                                    <p>Lorem Ipsum is simply dummy text of the printing
                                                                        and typesetting industry. Lorem Ipsum has been
                                                                        the industry's standard dummy text ever since
                                                                        the 1500s, when an unknown printer took a galley
                                                                        of type and scrambled it to make a type specimen
                                                                        book</p>
                                                                    <a href="{{asset('product-page(left-sidebar).html')}}">
                                                                        <h6 class="price-title">
                                                                            Travel Backpack
                                                                        </h6></a>
                                                                </div>
                                                                <div class="detail-right">
                                                                    <div class="check-price"> $90.21</div>
                                                                    <div class="price">
                                                                        <div class="price"> $70.05</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="icon-detail">
                                                                <button class="tooltip-top add-cartnoty"
                                                                        data-tippy-content="Add to cart"><i
                                                                        data-feather="shopping-cart"></i></button>
                                                                <a href="javascript:void(0)"
                                                                   class="add-to-wish tooltip-top"
                                                                   data-tippy-content="Add to Wishlist"> <i
                                                                        data-feather="heart"></i> </a>
                                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                   data-bs-target="#quick-view" class="tooltip-top"
                                                                   data-tippy-content="Quick View"> <i
                                                                        data-feather="eye"></i> </a>
                                                                <a href="{{asset('compare.html')}}" class="tooltip-top"
                                                                   data-tippy-content="Compare"> <i
                                                                        data-feather="refresh-cw"></i> </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-3 col-md-4 col-6 col-grid-box">
                                                    <div class="product-box">
                                                        <div class="product-imgbox">
                                                            <div class="product-front">
                                                                <a href="{{asset('product-page(left-sidebar).html')}}">
                                                                    <img
                                                                        src="{{asset('assets/images/layout-4/product/4.jpg')}}"
                                                                        class="img-fluid  " alt="product"> </a>
                                                            </div>
                                                            <div class="product-back">
                                                                <a href="{{asset('product-page(left-sidebar).html')}}">
                                                                    <img
                                                                        src="{{asset('assets/images/layout-4/product/a4.jpg')}}"
                                                                        class="img-fluid  " alt="product"> </a>
                                                            </div>

                                                        </div>
                                                        <div class="product-detail detail-center detail-inverse">
                                                            <div class="detail-title">
                                                                <div class="detail-left">
                                                                    <div class="rating-star"><i class="fa fa-star"></i>
                                                                        <i class="fa fa-star"></i> <i
                                                                            class="fa fa-star"></i> <i
                                                                            class="fa fa-star"></i> <i
                                                                            class="fa fa-star"></i></div>
                                                                    <p>Lorem Ipsum is simply dummy text of the printing
                                                                        and typesetting industry. Lorem Ipsum has been
                                                                        the industry's standard dummy text ever since
                                                                        the 1500s, when an unknown printer took a galley
                                                                        of type and scrambled it to make a type specimen
                                                                        book</p>
                                                                    <a href="{{asset('product-page(left-sidebar).html')}}">
                                                                        <h6 class="price-title">
                                                                            Modern Shoes
                                                                        </h6></a>
                                                                </div>
                                                                <div class="detail-right">
                                                                    <div class="check-price"> $ 70.21</div>
                                                                    <div class="price">
                                                                        <div class="price"> $ 44.05</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="icon-detail">
                                                                <button class="tooltip-top add-cartnoty"
                                                                        data-tippy-content="Add to cart"><i
                                                                        data-feather="shopping-cart"></i></button>
                                                                <a href="javascript:void(0)"
                                                                   class="add-to-wish tooltip-top"
                                                                   data-tippy-content="Add to Wishlist"> <i
                                                                        data-feather="heart"></i> </a>
                                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                   data-bs-target="#quick-view" class="tooltip-top"
                                                                   data-tippy-content="Quick View"> <i
                                                                        data-feather="eye"></i> </a>
                                                                <a href="{{asset('compare.html')}}" class="tooltip-top"
                                                                   data-tippy-content="Compare"> <i
                                                                        data-feather="refresh-cw"></i> </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-3 col-md-4 col-6 col-grid-box">
                                                    <div class="product-box">
                                                        <div class="product-imgbox">
                                                            <div class="product-front">
                                                                <a href="{{asset('product-page(left-sidebar).html')}}">
                                                                    <img
                                                                        src="{{asset('assets/images/layout-4/product/5.jpg')}}"
                                                                        class="img-fluid  " alt="product"> </a>
                                                            </div>
                                                            <div class="product-back">
                                                                <a href="{{asset('product-page(left-sidebar).html')}}">
                                                                    <img
                                                                        src="{{asset('assets/images/layout-4/product/a5.jpg')}}"
                                                                        class="img-fluid  " alt="product"> </a>
                                                            </div>


                                                        </div>
                                                        <div class="product-detail detail-center detail-inverse">
                                                            <div class="detail-title">
                                                                <div class="detail-left">
                                                                    <div class="rating-star"><i class="fa fa-star"></i>
                                                                        <i class="fa fa-star"></i> <i
                                                                            class="fa fa-star"></i> <i
                                                                            class="fa fa-star"></i> <i
                                                                            class="fa fa-star"></i></div>
                                                                    <p>Lorem Ipsum is simply dummy text of the printing
                                                                        and typesetting industry. Lorem Ipsum has been
                                                                        the industry's standard dummy text ever since
                                                                        the 1500s, when an unknown printer took a galley
                                                                        of type and scrambled it to make a type specimen
                                                                        book</p>
                                                                    <a href="{{asset('product-page(left-sidebar).html')}}">
                                                                        <h6 class="price-title">
                                                                            sleeve fress
                                                                        </h6></a>
                                                                </div>
                                                                <div class="detail-right">
                                                                    <div class="check-price"> $ 56.21</div>
                                                                    <div class="price">
                                                                        <div class="price"> $ 24.05</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="icon-detail">
                                                                <button class="tooltip-top add-cartnoty"
                                                                        data-tippy-content="Add to cart"><i
                                                                        data-feather="shopping-cart"></i></button>
                                                                <a href="javascript:void(0)"
                                                                   class="add-to-wish tooltip-top"
                                                                   data-tippy-content="Add to Wishlist"> <i
                                                                        data-feather="heart"></i> </a>
                                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                   data-bs-target="#quick-view" class="tooltip-top"
                                                                   data-tippy-content="Quick View"> <i
                                                                        data-feather="eye"></i> </a>
                                                                <a href="{{asset('compare.html')}}" class="tooltip-top"
                                                                   data-tippy-content="Compare"> <i
                                                                        data-feather="refresh-cw"></i> </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-3 col-md-4 col-6 col-grid-box">
                                                    <div class="product-box">
                                                        <div class="product-imgbox">
                                                            <div class="product-front">
                                                                <a href="{{asset('product-page(left-sidebar).html')}}">
                                                                    <img
                                                                        src="{{asset('assets/images/layout-4/product/6.jpg')}}"
                                                                        class="img-fluid  " alt="product"> </a>
                                                            </div>
                                                            <div class="product-back">
                                                                <a href="{{asset('product-page(left-sidebar).html')}}">
                                                                    <img
                                                                        src="{{asset('assets/images/layout-4/product/a5.jpg')}}"
                                                                        class="img-fluid  " alt="product"> </a>
                                                            </div>


                                                        </div>
                                                        <div class="product-detail detail-center detail-inverse">
                                                            <div class="detail-title">
                                                                <div class="detail-left">
                                                                    <div class="rating-star"><i class="fa fa-star"></i>
                                                                        <i class="fa fa-star"></i> <i
                                                                            class="fa fa-star"></i> <i
                                                                            class="fa fa-star"></i> <i
                                                                            class="fa fa-star"></i></div>
                                                                    <p>Lorem Ipsum is simply dummy text of the printing
                                                                        and typesetting industry. Lorem Ipsum has been
                                                                        the industry's standard dummy text ever since
                                                                        the 1500s, when an unknown printer took a galley
                                                                        of type and scrambled it to make a type specimen
                                                                        book</p>
                                                                    <a href="{{asset('product-page(left-sidebar).html')}}">
                                                                        <h6 class="price-title">
                                                                            Acer Swift laptop
                                                                        </h6></a>
                                                                </div>
                                                                <div class="detail-right">
                                                                    <div class="check-price"> $ 57.21</div>
                                                                    <div class="price">
                                                                        <div class="price"> $ 30.05</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="icon-detail">
                                                                <button class="tooltip-top add-cartnoty"
                                                                        data-tippy-content="Add to cart"><i
                                                                        data-feather="shopping-cart"></i></button>
                                                                <a href="javascript:void(0)"
                                                                   class="add-to-wish tooltip-top"
                                                                   data-tippy-content="Add to Wishlist"> <i
                                                                        data-feather="heart"></i> </a>
                                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                   data-bs-target="#quick-view" class="tooltip-top"
                                                                   data-tippy-content="Quick View"> <i
                                                                        data-feather="eye"></i> </a>
                                                                <a href="{{asset('compare.html')}}" class="tooltip-top"
                                                                   data-tippy-content="Compare"> <i
                                                                        data-feather="refresh-cw"></i> </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-3 col-md-4 col-6 col-grid-box">
                                                    <div class="product-box">
                                                        <div class="product-imgbox">
                                                            <div class="product-front">
                                                                <a href="{{asset('product-page(left-sidebar).html')}}">
                                                                    <img
                                                                        src="{{asset('assets/images/layout-4/product/7.jpg')}}"
                                                                        class="img-fluid  " alt="product"> </a>
                                                            </div>
                                                            <div class="product-back">
                                                                <a href="{{asset('product-page(left-sidebar).html')}}">
                                                                    <img
                                                                        src="{{asset('assets/images/layout-4/product/a7.jpg')}}"
                                                                        class="img-fluid  " alt="product"> </a>
                                                            </div>


                                                        </div>
                                                        <div class="product-detail detail-center detail-inverse">
                                                            <div class="detail-title">
                                                                <div class="detail-left">
                                                                    <div class="rating-star"><i class="fa fa-star"></i>
                                                                        <i class="fa fa-star"></i> <i
                                                                            class="fa fa-star"></i> <i
                                                                            class="fa fa-star"></i> <i
                                                                            class="fa fa-star"></i></div>
                                                                    <p>Lorem Ipsum is simply dummy text of the printing
                                                                        and typesetting industry. Lorem Ipsum has been
                                                                        the industry's standard dummy text ever since
                                                                        the 1500s, when an unknown printer took a galley
                                                                        of type and scrambled it to make a type specimen
                                                                        book</p>
                                                                    <a href="{{asset('product-page(left-sidebar).html')}}">
                                                                        <h6 class="price-title">
                                                                            fastrack watch
                                                                        </h6></a>
                                                                </div>
                                                                <div class="detail-right">
                                                                    <div class="check-price"> $ 88.21</div>
                                                                    <div class="price">
                                                                        <div class="price"> $65.05</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="icon-detail">
                                                                <button class="tooltip-top add-cartnoty"
                                                                        data-tippy-content="Add to cart"><i
                                                                        data-feather="shopping-cart"></i></button>
                                                                <a href="javascript:void(0)"
                                                                   class="add-to-wish tooltip-top"
                                                                   data-tippy-content="Add to Wishlist"> <i
                                                                        data-feather="heart"></i> </a>
                                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                   data-bs-target="#quick-view" class="tooltip-top"
                                                                   data-tippy-content="Quick View"> <i
                                                                        data-feather="eye"></i> </a>
                                                                <a href="{{asset('compare.html')}}" class="tooltip-top"
                                                                   data-tippy-content="Compare"> <i
                                                                        data-feather="refresh-cw"></i> </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-3 col-md-4 col-6 col-grid-box">
                                                    <div class="product">
                                                        <div class="product-box">
                                                            <div class="product-imgbox">
                                                                <div class="product-front">
                                                                    <img
                                                                        src="{{asset('assets/images/layout-1/product/3.jpg')}}"
                                                                        class="img-fluid  " alt="product">
                                                                </div>
                                                                <div class="product-back">
                                                                    <img
                                                                        src="{{asset('assets/images/layout-1/product/a3.jpg')}}"
                                                                        class="img-fluid  " alt="product">
                                                                </div>
                                                            </div>
                                                            <div class="product-detail detail-center ">
                                                                <div class="detail-title">
                                                                    <div class="detail-left">
                                                                        <div class="rating-star">
                                                                            <i class="fa fa-star"></i>
                                                                            <i class="fa fa-star"></i>
                                                                            <i class="fa fa-star"></i>
                                                                            <i class="fa fa-star"></i>
                                                                            <i class="fa fa-star"></i>
                                                                        </div>
                                                                        <p>Lorem Ipsum is simply dummy text of the
                                                                            printing and typesetting industry. Lorem
                                                                            Ipsum has been the industry's standard dummy
                                                                            text ever since the 1500s, when an unknown
                                                                            printer took a galley of type and scrambled
                                                                            it to make a type specimen book</p>
                                                                        <a href="">
                                                                            <h6 class="price-title">
                                                                                reader will be distracted.
                                                                            </h6>
                                                                        </a>
                                                                    </div>
                                                                    <div class="detail-right">
                                                                        <div class="check-price">
                                                                            $ 56.21
                                                                        </div>
                                                                        <div class="price">
                                                                            <div class="price">
                                                                                $ 24.05
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="icon-detail">
                                                                    <button data-bs-toggle="modal"
                                                                            data-bs-target="#addtocart"
                                                                            onclick="openCart()" class="tooltip-top"
                                                                            data-tippy-content="Add to cart">
                                                                        <i data-feather="shopping-cart"></i>
                                                                    </button>
                                                                    <a href="javascript:void(0)"
                                                                       class="add-to-wish tooltip-top"
                                                                       data-tippy-content="Add to Wishlist">
                                                                        <i data-feather="heart"></i>
                                                                    </a>
                                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                       data-bs-target="#quick-view" class="tooltip-top"
                                                                       data-tippy-content="Quick View">
                                                                        <i data-feather="eye"></i>
                                                                    </a>
                                                                    <a href="{{asset('compare.html')}}"
                                                                       class="tooltip-top" data-tippy-content="Compare">
                                                                        <i data-feather="refresh-cw"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-3 col-md-4 col-6 col-grid-box">
                                                    <div class="product-box">
                                                        <div class="product-imgbox">
                                                            <div class="product-front">
                                                                <a href="{{asset('product-page(left-sidebar).html')}}">
                                                                    <img
                                                                        src="{{asset('assets/images/layout-4/product/8.jpg')}}"
                                                                        class="img-fluid  " alt="product"> </a>
                                                            </div>
                                                            <div class="product-back">
                                                                <a href="{{asset('product-page(left-sidebar).html')}}">
                                                                    <img
                                                                        src="{{asset('assets/images/layout-4/product/a8.jpg')}}"
                                                                        class="img-fluid  " alt="product"> </a>
                                                            </div>


                                                        </div>
                                                        <div class="product-detail detail-center detail-inverse">
                                                            <div class="detail-title">
                                                                <div class="detail-left">
                                                                    <div class="rating-star"><i class="fa fa-star"></i>
                                                                        <i class="fa fa-star"></i> <i
                                                                            class="fa fa-star"></i> <i
                                                                            class="fa fa-star"></i> <i
                                                                            class="fa fa-star"></i></div>
                                                                    <p>Lorem Ipsum is simply dummy text of the printing
                                                                        and typesetting industry. Lorem Ipsum has been
                                                                        the industry's standard dummy text ever since
                                                                        the 1500s, when an unknown printer took a galley
                                                                        of type and scrambled it to make a type specimen
                                                                        book</p>
                                                                    <a href="{{asset('product-page(left-sidebar).html')}}">
                                                                        <h6 class="price-title">
                                                                            dressing mirror
                                                                        </h6></a>
                                                                </div>
                                                                <div class="detail-right">
                                                                    <div class="check-price"> $ 97.21</div>
                                                                    <div class="price">
                                                                        <div class="price"> $ 84.05</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="icon-detail">
                                                                <button class="tooltip-top add-cartnoty"
                                                                        data-tippy-content="Add to cart"><i
                                                                        data-feather="shopping-cart"></i></button>
                                                                <a href="javascript:void(0)"
                                                                   class="add-to-wish tooltip-top"
                                                                   data-tippy-content="Add to Wishlist"> <i
                                                                        data-feather="heart"></i> </a>
                                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                   data-bs-target="#quick-view" class="tooltip-top"
                                                                   data-tippy-content="Quick View"> <i
                                                                        data-feather="eye"></i> </a>
                                                                <a href="{{asset('compare.html')}}" class="tooltip-top"
                                                                   data-tippy-content="Compare"> <i
                                                                        data-feather="refresh-cw"></i> </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-3 col-md-4 col-6 col-grid-box">
                                                    <div class="product-box">
                                                        <div class="product-imgbox">
                                                            <div class="product-front">
                                                                <a href="{{asset('product-page(left-sidebar).html')}}">
                                                                    <img
                                                                        src="{{asset('assets/images/layout-4/product/1.jpg')}}"
                                                                        class="img-fluid  " alt="product"> </a>
                                                            </div>
                                                            <div class="product-back">
                                                                <a href="{{asset('product-page(left-sidebar).html')}}">
                                                                    <img
                                                                        src="{{asset('assets/images/layout-4/product/a1.jpg')}}"
                                                                        class="img-fluid  " alt="product"> </a>
                                                            </div>


                                                        </div>
                                                        <div class="product-detail detail-center detail-inverse">
                                                            <div class="detail-title">
                                                                <div class="detail-left">
                                                                    <div class="rating-star"><i class="fa fa-star"></i>
                                                                        <i class="fa fa-star"></i> <i
                                                                            class="fa fa-star"></i> <i
                                                                            class="fa fa-star"></i> <i
                                                                            class="fa fa-star"></i></div>
                                                                    <p>Lorem Ipsum is simply dummy text of the printing
                                                                        and typesetting industry. Lorem Ipsum has been
                                                                        the industry's standard dummy text ever since
                                                                        the 1500s, when an unknown printer took a galley
                                                                        of type and scrambled it to make a type specimen
                                                                        book</p>
                                                                    <a href="{{asset('product-page(left-sidebar).html')}}">
                                                                        <h6 class="price-title">
                                                                            realme not 7
                                                                        </h6></a>
                                                                </div>
                                                                <div class="detail-right">
                                                                    <div class="check-price"> $60.21</div>
                                                                    <div class="price">
                                                                        <div class="price"> $50.05</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="icon-detail">
                                                                <button class="tooltip-top add-cartnoty"
                                                                        data-tippy-content="Add to cart"><i
                                                                        data-feather="shopping-cart"></i></button>
                                                                <a href="javascript:void(0)"
                                                                   class="add-to-wish tooltip-top"
                                                                   data-tippy-content="Add to Wishlist"> <i
                                                                        data-feather="heart"></i> </a>
                                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                   data-bs-target="#quick-view" class="tooltip-top"
                                                                   data-tippy-content="Quick View"> <i
                                                                        data-feather="eye"></i> </a>
                                                                <a href="{{asset('compare.html')}}" class="tooltip-top"
                                                                   data-tippy-content="Compare"> <i
                                                                        data-feather="refresh-cw"></i> </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-3 col-md-4 col-6 col-grid-box">
                                                    <div class="product-box">
                                                        <div class="product-imgbox">
                                                            <div class="product-front">
                                                                <a href="{{asset('product-page(left-sidebar).html')}}">
                                                                    <img
                                                                        src="{{asset('assets/images/layout-4/product/2.jpg')}}"
                                                                        class="img-fluid  " alt="product"> </a>
                                                            </div>
                                                            <div class="product-back">
                                                                <a href="{{asset('product-page(left-sidebar).html')}}">
                                                                    <img
                                                                        src="{{asset('assets/images/layout-4/product/a2.jpg')}}"
                                                                        class="img-fluid  " alt="product"> </a>
                                                            </div>


                                                        </div>
                                                        <div class="product-detail detail-center detail-inverse">
                                                            <div class="detail-title">
                                                                <div class="detail-left">
                                                                    <div class="rating-star"><i class="fa fa-star"></i>
                                                                        <i class="fa fa-star"></i> <i
                                                                            class="fa fa-star"></i> <i
                                                                            class="fa fa-star"></i> <i
                                                                            class="fa fa-star"></i></div>
                                                                    <p>Lorem Ipsum is simply dummy text of the printing
                                                                        and typesetting industry. Lorem Ipsum has been
                                                                        the industry's standard dummy text ever since
                                                                        the 1500s, when an unknown printer took a galley
                                                                        of type and scrambled it to make a type specimen
                                                                        book</p>
                                                                    <a href="{{asset('product-page(left-sidebar).html')}}">
                                                                        <h6 class="price-title">
                                                                            wireless speaker
                                                                        </h6></a>
                                                                </div>
                                                                <div class="detail-right">
                                                                    <div class="check-price"> $56.21</div>
                                                                    <div class="price">
                                                                        <div class="price"> $ 24.05</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="icon-detail">
                                                                <button class="tooltip-top add-cartnoty"
                                                                        data-tippy-content="Add to cart"><i
                                                                        data-feather="shopping-cart"></i></button>
                                                                <a href="javascript:void(0)"
                                                                   class="add-to-wish tooltip-top"
                                                                   data-tippy-content="Add to Wishlist"> <i
                                                                        data-feather="heart"></i> </a>
                                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                   data-bs-target="#quick-view" class="tooltip-top"
                                                                   data-tippy-content="Quick View"> <i
                                                                        data-feather="eye"></i> </a>
                                                                <a href="{{asset('compare.html')}}" class="tooltip-top"
                                                                   data-tippy-content="Compare"> <i
                                                                        data-feather="refresh-cw"></i> </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-3 col-md-4 col-6 col-grid-box">
                                                    <div class="product-box">
                                                        <div class="product-imgbox">
                                                            <div class="product-front">
                                                                <a href="{{asset('product-page(left-sidebar).html')}}">
                                                                    <img
                                                                        src="{{asset('assets/images/layout-4/product/3.jpg')}}"
                                                                        class="img-fluid  " alt="product"> </a>
                                                            </div>
                                                            <div class="product-back">
                                                                <a href="{{asset('product-page(left-sidebar).html')}}">
                                                                    <img
                                                                        src="{{asset('assets/images/layout-4/product/a3.jpg')}}"
                                                                        class="img-fluid  " alt="product"> </a>
                                                            </div>
                                                        </div>
                                                        <div class="product-detail detail-center detail-inverse">
                                                            <div class="detail-title">
                                                                <div class="detail-left">
                                                                    <div class="rating-star"><i class="fa fa-star"></i>
                                                                        <i class="fa fa-star"></i> <i
                                                                            class="fa fa-star"></i> <i
                                                                            class="fa fa-star"></i> <i
                                                                            class="fa fa-star"></i></div>
                                                                    <p>Lorem Ipsum is simply dummy text of the printing
                                                                        and typesetting industry. Lorem Ipsum has been
                                                                        the industry's standard dummy text ever since
                                                                        the 1500s, when an unknown printer took a galley
                                                                        of type and scrambled it to make a type specimen
                                                                        book</p>
                                                                    <a href="{{asset('product-page(left-sidebar).html')}}">
                                                                        <h6 class="price-title">
                                                                            Travel Backpack
                                                                        </h6></a>
                                                                </div>
                                                                <div class="detail-right">
                                                                    <div class="check-price"> $90.21</div>
                                                                    <div class="price">
                                                                        <div class="price"> $70.05</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="icon-detail">
                                                                <button class="tooltip-top add-cartnoty"
                                                                        data-tippy-content="Add to cart"><i
                                                                        data-feather="shopping-cart"></i></button>
                                                                <a href="javascript:void(0)"
                                                                   class="add-to-wish tooltip-top"
                                                                   data-tippy-content="Add to Wishlist"> <i
                                                                        data-feather="heart"></i> </a>
                                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                   data-bs-target="#quick-view" class="tooltip-top"
                                                                   data-tippy-content="Quick View"> <i
                                                                        data-feather="eye"></i> </a>
                                                                <a href="{{asset('compare.html')}}" class="tooltip-top"
                                                                   data-tippy-content="Compare"> <i
                                                                        data-feather="refresh-cw"></i> </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="load-more-sec">
                                            <a href="javascript:void(0)" class="loadMore">load more</a>
                                        </div>
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
@endsection

@push('scripts')
    @if(app()->environment('local'))
        <script src="{{asset('assets/js/vue/vue.js')}}"></script>
        <script src="{{asset('assets/js/vue/vue-select2.js')}}"></script>
    @else
        <script src="{{asset('assets/js/vue/vue-production.js')}}"></script>
        <script src="{{asset('assets/js/vue/vue-select2.min.js')}}"></script>
    @endif
    <script src="https://cdn.jsdelivr.net/npm/inputmask@5.0.6/dist/inputmask.min.js"></script>
    <script src="{{asset('assets/js/v-mask/v-mask.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/text-mask-addons@3.8.0/dist/textMaskAddons.min.js"></script>
    <script src="{{asset('assets/js/bootstrap-vue/bootstrap-vue.min.js')}}"></script>
    <script src="{{asset('assets/js/vue/vue-timers.umd.js')}}"></script>
    <script>
        Vue.use(VueMask.VueMaskPlugin);
        Vue.directive('mask', VueMask.VueMaskDirective);
        let vueApp = new Vue({
            el: '#filterApp',
            data: {
                isLoading: false,
                fetchRequestController: null,
                apiUrl: '{{ route('products.api') }}',
                filterOptions: {
                    brands: [
                        {id: 1, name: 'test', selected: false}
                    ],
                },
            },
            created() {
                this.fetchData()
            },
            methods: {
                fetchData: function () {
                    if (this.isLoading && this.fetchRequestController !== null)
                        this.fetchRequestController.abort()
                    this.fetchRequestController = new AbortController();
                    this.isLoading = true;
                    fetch(this.apiUrl, {
                        method: 'POST',
                        signal: this.fetchRequestController.signal,
                        body: JSON.stringify({
                            _token: '{{csrf_token()}}',
                            data: {},
                        }),
                        headers: {'Content-Type': 'application/json', 'Accept': 'application/json'}
                    }).then(response => response.json()).then(data => {
                        console.log(data)
                    }).catch((e) => {
                        console.log(e);
                    }).finally(() => {
                        this.isLoading = false;
                        this.fetchRequestController = null;
                    });
                },
            },
            watch: {}
        });
        window.vueApp = vueApp;
    </script>
@endpush
