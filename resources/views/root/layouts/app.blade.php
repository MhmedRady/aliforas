<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="@lang('layouts.dir')" style="overflow: hidden auto">
<head>
    <title>
        @yield('title',env('APP_NAME'))
    </title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="big-deal">
    <meta name="keywords" content="big-deal">
    <meta name="author" content="big-deal">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ env('FAVICON_PATH') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ env('FAVICON_PATH') }}" type="image/x-icon">
    <!--Google font-->
    <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Aclonica&display=swap" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link
        href="/sweetalert.min.css"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <!--icon css-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/font-awesome.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/themify.css')}}">
    <!--Slick slider css-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/slick.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/slick-theme.css')}}">
    <!--Animate css-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/animate.css')}}">
    <!-- Bootstrap css -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset("admin-asset/vendors/css/forms/select/select2.min.css")}}">

    @yield('stylesheet')
    <!-- Theme css -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/color11.css')}}" media="screen" id="color">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}" media="screen" id="color">
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/placeholder-loading@0.5.0/dist/css/placeholder-loading.min.css">
</head>
<body @class(['bg-light', 'rtl' => trans('layouts.dir') === 'rtl']) style="overflow: hidden auto">

<!-- loader start -->
<div class="loader-wrapper">
    <div>
        <img src="{{ env('LOADER_PATH') }}" alt="loader">
    </div>
</div>
<!-- loader end -->

@include('root.layouts.header')

@include('root.layouts.slider')

@yield('content')

@include('root.layouts.footer')

<!-- Quick-view modal popup start-->
<div class="modal fade bd-example-modal-lg theme-modal" id="QuickView" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content quick-view-modal">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="row mt-4" id="QuickViewBody"></div>
            </div>
        </div>
    </div>
</div>
<!-- Quick-view modal popup end-->

<!-- edit product modal start-->
<div class="modal fade bd-example-modal-lg theme-modal pro-edit-modal" id="edit-product" tabindex="-1" role="dialog"
     aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content ">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="pro-group">
                    <div class="product-img">
                        <div class="media">
                            <div class="img-wraper">
                                <a href="javascript:void(0)">
                                    <img src="{{asset('assets/images/products/1.jpg')}}" alt="">
                                </a>
                            </div>
                            <div class="media-body">
                                <a href="javascript:void(0)">
                                    <h3>redmi not 3</h3>
                                </a>
                                <h6>$80<span>$120</span></h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pro-group">
                    <h6 class="product-title">Select Size</h6>
                    <div class="size-box">
                        <ul>
                            <li><a href="javascript:void(0)">s</a></li>
                            <li><a href="javascript:void(0)">m</a></li>
                            <li><a href="javascript:void(0)">l</a></li>
                            <li><a href="javascript:void(0)">xl</a></li>
                            <li><a href="javascript:void(0)">2xl</a></li>
                        </ul>
                    </div>
                </div>
                <div class="pro-group">
                    <h6 class="product-title">Select color</h6>
                    <div class="color-selector inline">
                        <ul>
                            <li>
                                <div class="color-1 active"></div>
                            </li>
                            <li>
                                <div class="color-2"></div>
                            </li>
                            <li>
                                <div class="color-3"></div>
                            </li>
                            <li>
                                <div class="color-4"></div>
                            </li>
                            <li>
                                <div class="color-5"></div>
                            </li>
                            <li>
                                <div class="color-6"></div>
                            </li>
                            <li>
                                <div class="color-7"></div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="pro-group">
                    <h6 class="product-title">Quantity</h6>
                    <div class="qty-box">
                        <div class="input-group">
                            <button class="qty-minus"></button>
                            <input class="qty-adj form-control" type="number" value="1"/>
                            <button class="qty-plus"></button>
                        </div>
                    </div>
                </div>
                <div class="pro-group mb-0">
                    <div class="modal-btn">
                        <a href="{{asset('cart.html')}}" class="btn btn-solid btn-sm">
                            add to cart
                        </a>
                        <a href="javascript:void(0)" class="btn btn-solid btn-sm">
                            more detail
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- edit product modal end-->

<!-- Add to cart bar -->
<div id="cartSide" class="add_to_cart right">
    <a href="javascript:void(0)" class="overlay" onclick="closeCart()"></a>
    <div class="cart-inner">
        <div class="cart_top">
            <h3>{{__('layouts.shoppingCart')}}</h3>
            <div class="close-cart">
                <a href="javascript:void(0)" onclick="closeCart()">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </a>
            </div>
        </div>
        <div class="cart_media">
            <ul class="cart_product" style="height: calc(100vh - 200px);">
                <li v-for="item in items">
                    <div class="media">
                        <a :href="item.product.url" :key="item.id">
                            <template v-if="item.product.images && item.product.images.length > 0">
                                @include('root.components.lazy-image', [
                                   'default' => 'storage/uploads/312x340/default.png',
                                   'url' => 'item.product.images[0]',
                                   'class' => 'img-fluid m-3', 'vue' => true,
                               ])
                            </template>
                            <template v-else>
                                @include('root.components.lazy-image', [
                                    'default' => 'storage/uploads/312x340/default.png',
                                    'class' => 'img-fluid m-3', 'vue' => true,
                               ])
                            </template>
                        </a>
                        <div class="media-body">
                            <a :href="item.product.url">
                                <h4>@{{ item.name }}</h4>
                            </a>
                            @if(config('setting.pricing'))
                                <h6>
                                    @{{ item.price }} EGP <span v-if="item.product.before_price > 0 && item.attributes>0">@{{ item.product.before_price }} EGP</span>
                                </h6>
                            @endif
                            <div class="addit-box">
                                <div class="qty-box">
                                    <div class="input-group">
                                        {{--<button class="qty-minus"></button>--}}
                                        <input class="qty-adj form-control" type="number" :value="item.quantity" disabled/>
                                        {{--<button class="qty-plus"></button>--}}
                                    </div>
                                </div>

                                <div class="pro-add">

                                    {{--<a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#edit-product">
                                        <i data-feather="edit"></i>
                                    </a>--}}
{{--                                    <a href="javascript:void(0)" @click="deleteItem(item.product.id)">--}}
{{--                                        <i data-feather="trash-2"></i>--}}
{{--                                    </a>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
            <ul id="cartTotalPrices" class="cart_total">
                @if(config('setting.pricing'))
{{--                    <li id="subTotal">--}}
{{--                        {{__('layouts.subTotal')}} : <span>0</span>--}}
{{--                    </li>--}}
                    {{--                <li>--}}
                    {{--                    shpping <span>free</span>--}}
                    {{--                </li>--}}
{{--                    <li id="taxes">--}}
{{--                        {{__('layouts.taxes')}} : <span>0</span>--}}
{{--                    </li>--}}
                    <li>
                        <div id="cartTotal" class="total">
                            {{__('layouts.total')}} <span>0</span>
                        </div>
                    </li>
                @endif
                <li>
                    <div class="buttons">
                        <a href="{{ route('cart.view') }}" class="btn btn-solid btn-sm" style="font-size: 14px;">{{__('layouts.viewCart')}}</a>
                        <a href="{{ route('cart.checkout') }}" class="btn btn-solid btn-sm" style="font-size: 14px;">{{config('setting.pricing') ? __('layouts.checkout') : __('layouts.priceRequest')}}</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- Add to cart  end-->

<!-- wishlist bar -->
<div id="wishlist_side" class="add_to_cart right">
    <a href="javascript:void(0)" class="overlay" onclick="closeWishlist()"></a>
    <div class="cart-inner">
        <div class="cart_top">
            <h3>my wishlist</h3>
            <div class="close-cart">
                <a href="javascript:void(0)" onclick="closeWishlist()">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </a>
            </div>
        </div>
        <div class="cart_media">
            <ul class="cart_product">
                <li>
                    <div class="media">
                        <a href="javascript:void(0)">
                            <img alt="megastore1" class="me-3" src="{{asset('assets/images/products/1.jpg')}}">
                        </a>
                        <div class="media-body">
                            <a href="javascript:void(0)">
                                <h4>redmi not 3</h4>
                            </a>
                            <h6>
                                $80.00 <span>$120.00</span>
                            </h6>
                            <div class="addit-box">
                                <div class="qty-box">
                                    <div class="input-group">
                                        <button class="qty-minus"></button>
                                        <input class="qty-adj form-control" type="number" value="1"/>
                                        <button class="qty-plus"></button>
                                    </div>
                                </div>
                                <div class="pro-add">
                                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#edit-product">
                                        <i data-feather="edit"></i>
                                    </a>
                                    <a href="javascript:void(0)">
                                        <i data-feather="trash-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="media">
                        <a href="javascript:void(0)">
                            <img alt="megastore1" class="me-3" src="{{asset('assets/images/products/2.jpg')}}">
                        </a>
                        <div class="media-body">
                            <a href="javascript:void(0)">
                                <h4>Double Door Refrigerator</h4>
                            </a>
                            <h6>
                                $80.00 <span>$120.00</span>
                            </h6>
                            <div class="addit-box">
                                <div class="qty-box">
                                    <div class="input-group">
                                        <button class="qty-minus"></button>
                                        <input class="qty-adj form-control" type="number" value="1"/>
                                        <button class="qty-plus"></button>
                                    </div>
                                </div>
                                <div class="pro-add">
                                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#edit-product">
                                        <i data-feather="edit"></i>
                                    </a>
                                    <a href="javascript:void(0)">
                                        <i data-feather="trash-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="media">
                        <a href="javascript:void(0)">
                            <img alt="megastore1" class="me-3" src="{{asset('assets/images/products/3.jpg')}}">
                        </a>
                        <div class="media-body">
                            <a href="javascript:void(0)">
                                <h4>woman hande bag</h4>
                            </a>
                            <h6>
                                $80.00 <span>$120.00</span>
                            </h6>
                            <div class="addit-box">
                                <div class="qty-box">
                                    <div class="input-group">
                                        <button class="qty-minus"></button>
                                        <input class="qty-adj form-control" type="number" value="1"/>
                                        <button class="qty-plus"></button>
                                    </div>
                                </div>
                                <div class="pro-add">
                                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#edit-product">
                                        <i data-feather="edit"></i>
                                    </a>
                                    <a href="javascript:void(0)">
                                        <i data-feather="trash-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
            <ul class="cart_total">
                <li>
                    subtotal : <span>$1050.00</span>
                </li>
                <li>
                    shpping <span>free</span>
                </li>
                <li>
                    taxes <span>$0.00</span>
                </li>
                <li>
                    <div class="total">
                        total<span>$1050.00</span>
                    </div>
                </li>
                <li>
                    <div class="buttons">
                        <a href="{{asset('wishlist.html')}}" class="btn btn-solid btn-block btn-md">view wislist</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- wishlist bar end-->

<!-- My account start -->
<div id="myAccount" class="add_to_cart right account-bar">
    <a href="javascript:void(0)" class="overlay" onclick="closeAccount()"></a>
    <div class="cart-inner">
        <div class="cart_top">
            <h3>{{__('auth.myAccount')}}</h3>
            <div class="close-cart">
                <a href="javascript:void(0)" onclick="closeAccount()">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </a>
            </div>
        </div>
        @if(!Auth::guard('web')->check())
            <form class="theme-form" action="{{route("login")}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="email">{{__("Email")}}</label>
                    <input type="text" class="form-control" id="email" name="email" required value="{{old("email")}}">
                    @error('email')
                    <div class="invalid-feedback font-85 d-block">
                        <strong>{{$message}}</strong>
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">{{__("Password")}}</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                    @error('password')
                    <div class="invalid-feedback font-85 d-block">
                        <strong>{{$message}}</strong>
                    </div>
                    @enderror
                </div>
                <a href="{{route("password.request")}}" class="d-block mb-3">
                    <h5>{{__("Forgot Your Password?")}}</h5>
                </a>
                <div class="form-group">
                    <button type="submit" class="btn btn-info btn-md btn-block">
                        <i class="fa fa-key" aria-hidden="true"></i>
                        {{__("Login")}}
                    </button>
                </div>
                {{--<div class="form-group">
                    <a href="{{route('web.login.facebook')}}" class="btn btn-primary btn-md btn-block ">
                        <i class="fa fa-facebook-square" aria-hidden="true"></i>
                        {{__("Login.Login With Facebook")}}
                    </a>
                </div>--}}
                <div class="account-fwd">
                    <a href="{{route("register")}}" class="d-block">
                        <h6>{{__("Create Account")}}</h6>
                    </a>
                </div>
            </form>
        @else
            <div class="user-account-details container">
                <div class="row">

                    <div class="col-12 font-1 text-center username-text mt-3 mb-3">
                        <a href="{{route('user-profile-show')}}">
                            <img src="{{Auth::User()->profile_image_url}}" class="profile_image img-thumbnail rounded-circle d-block mb-3 m-auto" width="100" height="100" alt="profile_image" style="cursor: pointer;box-shadow: 1px 5px 10px -5px #aaa;" >
                        </a>
                        <h4 class="text-center font-bold">
                            <strong>{{Auth::User()->name}}</strong>
                        </h4>
                    </div>

                    <div class="form-group">
                        <a href="{{route('user-profile-show')}}" class="btn btn-info btn-md btn-block">
                            <svg style="width: calc(10px + (28 - 20) * ((100vw - 320px) / (1920 - 320)));" enable-background="new 0 0 512 512"  viewBox="0 0 512 512"  xmlns="http://www.w3.org/2000/svg">--}}
                                <path d="m272.066 512h-32.133c-25.989 0-47.134-21.144-47.134-47.133v-10.871c-11.049-3.53-21.784-7.986-32.097-13.323l-7.704 7.704c-18.659 18.682-48.548 18.134-66.665-.007l-22.711-22.71c-18.149-18.129-18.671-48.008.006-66.665l7.698-7.698c-5.337-10.313-9.792-21.046-13.323-32.097h-10.87c-25.988 0-47.133-21.144-47.133-47.133v-32.134c0-25.989 21.145-47.133 47.134-47.133h10.87c3.531-11.05 7.986-21.784 13.323-32.097l-7.704-7.703c-18.666-18.646-18.151-48.528.006-66.665l22.713-22.712c18.159-18.184 48.041-18.638 66.664.006l7.697 7.697c10.313-5.336 21.048-9.792 32.097-13.323v-10.87c0-25.989 21.144-47.133 47.134-47.133h32.133c25.989 0 47.133 21.144 47.133 47.133v10.871c11.049 3.53 21.784 7.986 32.097 13.323l7.704-7.704c18.659-18.682 48.548-18.134 66.665.007l22.711 22.71c18.149 18.129 18.671 48.008-.006 66.665l-7.698 7.698c5.337 10.313 9.792 21.046 13.323 32.097h10.87c25.989 0 47.134 21.144 47.134 47.133v32.134c0 25.989-21.145 47.133-47.134 47.133h-10.87c-3.531 11.05-7.986 21.784-13.323 32.097l7.704 7.704c18.666 18.646 18.151 48.528-.006 66.665l-22.713 22.712c-18.159 18.184-48.041 18.638-66.664-.006l-7.697-7.697c-10.313 5.336-21.048 9.792-32.097 13.323v10.871c0 25.987-21.144 47.131-47.134 47.131zm-106.349-102.83c14.327 8.473 29.747 14.874 45.831 19.025 6.624 1.709 11.252 7.683 11.252 14.524v22.148c0 9.447 7.687 17.133 17.134 17.133h32.133c9.447 0 17.134-7.686 17.134-17.133v-22.148c0-6.841 4.628-12.815 11.252-14.524 16.084-4.151 31.504-10.552 45.831-19.025 5.895-3.486 13.4-2.538 18.243 2.305l15.688 15.689c6.764 6.772 17.626 6.615 24.224.007l22.727-22.726c6.582-6.574 6.802-17.438.006-24.225l-15.695-15.695c-4.842-4.842-5.79-12.348-2.305-18.242 8.473-14.326 14.873-29.746 19.024-45.831 1.71-6.624 7.684-11.251 14.524-11.251h22.147c9.447 0 17.134-7.686 17.134-17.133v-32.134c0-9.447-7.687-17.133-17.134-17.133h-22.147c-6.841 0-12.814-4.628-14.524-11.251-4.151-16.085-10.552-31.505-19.024-45.831-3.485-5.894-2.537-13.4 2.305-18.242l15.689-15.689c6.782-6.774 6.605-17.634.006-24.225l-22.725-22.725c-6.587-6.596-17.451-6.789-24.225-.006l-15.694 15.695c-4.842 4.843-12.35 5.791-18.243 2.305-14.327-8.473-29.747-14.874-45.831-19.025-6.624-1.709-11.252-7.683-11.252-14.524v-22.15c0-9.447-7.687-17.133-17.134-17.133h-32.133c-9.447 0-17.134 7.686-17.134 17.133v22.148c0 6.841-4.628 12.815-11.252 14.524-16.084 4.151-31.504 10.552-45.831 19.025-5.896 3.485-13.401 2.537-18.243-2.305l-15.688-15.689c-6.764-6.772-17.627-6.615-24.224-.007l-22.727 22.726c-6.582 6.574-6.802 17.437-.006 24.225l15.695 15.695c4.842 4.842 5.79 12.348 2.305 18.242-8.473 14.326-14.873 29.746-19.024 45.831-1.71 6.624-7.684 11.251-14.524 11.251h-22.148c-9.447.001-17.134 7.687-17.134 17.134v32.134c0 9.447 7.687 17.133 17.134 17.133h22.147c6.841 0 12.814 4.628 14.524 11.251 4.151 16.085 10.552 31.505 19.024 45.831 3.485 5.894 2.537 13.4-2.305 18.242l-15.689 15.689c-6.782 6.774-6.605 17.634-.006 24.225l22.725 22.725c6.587 6.596 17.451 6.789 24.225.006l15.694-15.695c3.568-3.567 10.991-6.594 18.244-2.304z"/>
                                <path d="m256 367.4c-61.427 0-111.4-49.974-111.4-111.4s49.973-111.4 111.4-111.4 111.4 49.974 111.4 111.4-49.973 111.4-111.4 111.4zm0-192.8c-44.885 0-81.4 36.516-81.4 81.4s36.516 81.4 81.4 81.4 81.4-36.516 81.4-81.4-36.515-81.4-81.4-81.4z"/>
                            </svg>
                            {{__("auth.profile")}}
                        </a>
                    </div>

{{--                    <div class="form-group">--}}
{{--                        <a href="{{route("view-change-password")}}" class="btn btn-warning btn-md btn-block">--}}
{{--                            <i class="fa fa-key" aria-hidden="true"></i>--}}
{{--                            {{__("auth.changePass")}}--}}
{{--                        </a>--}}
{{--                    </div>--}}

                    {{--<div class="form-group">
                        <a href="{{route('profile')}}" class="btn btn-info btn-md btn-block">
                            <svg style="width: calc(10px + (28 - 20) * ((100vw - 320px) / (1920 - 320)));"
                                 enable-background="new 0 0 512 512" viewBox="0 0 512 512"
                                 xmlns="http://www.w3.org/2000/svg">--}}{{--
                                <path
                                    d="m272.066 512h-32.133c-25.989 0-47.134-21.144-47.134-47.133v-10.871c-11.049-3.53-21.784-7.986-32.097-13.323l-7.704 7.704c-18.659 18.682-48.548 18.134-66.665-.007l-22.711-22.71c-18.149-18.129-18.671-48.008.006-66.665l7.698-7.698c-5.337-10.313-9.792-21.046-13.323-32.097h-10.87c-25.988 0-47.133-21.144-47.133-47.133v-32.134c0-25.989 21.145-47.133 47.134-47.133h10.87c3.531-11.05 7.986-21.784 13.323-32.097l-7.704-7.703c-18.666-18.646-18.151-48.528.006-66.665l22.713-22.712c18.159-18.184 48.041-18.638 66.664.006l7.697 7.697c10.313-5.336 21.048-9.792 32.097-13.323v-10.87c0-25.989 21.144-47.133 47.134-47.133h32.133c25.989 0 47.133 21.144 47.133 47.133v10.871c11.049 3.53 21.784 7.986 32.097 13.323l7.704-7.704c18.659-18.682 48.548-18.134 66.665.007l22.711 22.71c18.149 18.129 18.671 48.008-.006 66.665l-7.698 7.698c5.337 10.313 9.792 21.046 13.323 32.097h10.87c25.989 0 47.134 21.144 47.134 47.133v32.134c0 25.989-21.145 47.133-47.134 47.133h-10.87c-3.531 11.05-7.986 21.784-13.323 32.097l7.704 7.704c18.666 18.646 18.151 48.528-.006 66.665l-22.713 22.712c-18.159 18.184-48.041 18.638-66.664-.006l-7.697-7.697c-10.313 5.336-21.048 9.792-32.097 13.323v10.871c0 25.987-21.144 47.131-47.134 47.131zm-106.349-102.83c14.327 8.473 29.747 14.874 45.831 19.025 6.624 1.709 11.252 7.683 11.252 14.524v22.148c0 9.447 7.687 17.133 17.134 17.133h32.133c9.447 0 17.134-7.686 17.134-17.133v-22.148c0-6.841 4.628-12.815 11.252-14.524 16.084-4.151 31.504-10.552 45.831-19.025 5.895-3.486 13.4-2.538 18.243 2.305l15.688 15.689c6.764 6.772 17.626 6.615 24.224.007l22.727-22.726c6.582-6.574 6.802-17.438.006-24.225l-15.695-15.695c-4.842-4.842-5.79-12.348-2.305-18.242 8.473-14.326 14.873-29.746 19.024-45.831 1.71-6.624 7.684-11.251 14.524-11.251h22.147c9.447 0 17.134-7.686 17.134-17.133v-32.134c0-9.447-7.687-17.133-17.134-17.133h-22.147c-6.841 0-12.814-4.628-14.524-11.251-4.151-16.085-10.552-31.505-19.024-45.831-3.485-5.894-2.537-13.4 2.305-18.242l15.689-15.689c6.782-6.774 6.605-17.634.006-24.225l-22.725-22.725c-6.587-6.596-17.451-6.789-24.225-.006l-15.694 15.695c-4.842 4.843-12.35 5.791-18.243 2.305-14.327-8.473-29.747-14.874-45.831-19.025-6.624-1.709-11.252-7.683-11.252-14.524v-22.15c0-9.447-7.687-17.133-17.134-17.133h-32.133c-9.447 0-17.134 7.686-17.134 17.133v22.148c0 6.841-4.628 12.815-11.252 14.524-16.084 4.151-31.504 10.552-45.831 19.025-5.896 3.485-13.401 2.537-18.243-2.305l-15.688-15.689c-6.764-6.772-17.627-6.615-24.224-.007l-22.727 22.726c-6.582 6.574-6.802 17.437-.006 24.225l15.695 15.695c4.842 4.842 5.79 12.348 2.305 18.242-8.473 14.326-14.873 29.746-19.024 45.831-1.71 6.624-7.684 11.251-14.524 11.251h-22.148c-9.447.001-17.134 7.687-17.134 17.134v32.134c0 9.447 7.687 17.133 17.134 17.133h22.147c6.841 0 12.814 4.628 14.524 11.251 4.151 16.085 10.552 31.505 19.024 45.831 3.485 5.894 2.537 13.4-2.305 18.242l-15.689 15.689c-6.782 6.774-6.605 17.634-.006 24.225l22.725 22.725c6.587 6.596 17.451 6.789 24.225.006l15.694-15.695c3.568-3.567 10.991-6.594 18.244-2.304z"/>
                                <path
                                    d="m256 367.4c-61.427 0-111.4-49.974-111.4-111.4s49.973-111.4 111.4-111.4 111.4 49.974 111.4 111.4-49.973 111.4-111.4 111.4zm0-192.8c-44.885 0-81.4 36.516-81.4 81.4s36.516 81.4 81.4 81.4 81.4-36.516 81.4-81.4-36.515-81.4-81.4-81.4z"/>
                            </svg>
                            {{__("User.setting")}}
                        </a>
                    </div>--}}
                    {{--<div class="form-group">
                        <a href="{{route('')}}" class="btn btn-warning btn-md btn-block">
                            <i class="fa fa-key" aria-hidden="true"></i>
                            {{__('auth.changePass')}}
                        </a>
                    </div>--}}
                    <div class="form-group">
                        <form action="{{route('logout')}}" method="post">@csrf</form>
                        <a href="javascript:void(0)" onclick="this.previousElementSibling.submit()"
                           class="btn btn-primary btn-md btn-block ">
                            <i class="fa fa-sign-out" aria-hidden="true"></i>
                            {{__("Logout")}}
                        </a>
                    </div>
                </div>
            </div>
        @endif
        {{--<form class="theme-form">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email" placeholder="Email" required="">
            </div>
            <div class="form-group">
                <label for="review">Password</label>
                <input type="password" class="form-control" id="review" placeholder="Enter your password" required="">
            </div>
            <div class="form-group">
                <a href="javascript:void(0)" class="btn btn-solid btn-md btn-block ">Login</a>
            </div>
            <div class="account-fwd">
                <a href="{{asset('forget-pwd.html')}}" class="d-block"><h5>forget password?</h5></a>
                <a href="{{asset('register.html')}}" class="d-block"><h6>you have no account ?<span>signup now</span>
                    </h6></a>
            </div>
        </form>--}}
    </div>
</div>
<!-- My Account end-->

@stack('pre-scripts')

{{--@include('root.components.notification-product')--}}

<!-- latest jquery-->
<script src="{{asset('assets/js/jquery-3.3.1.min.js')}}"></script>

<!-- father icon -->
<script src="{{asset('assets/js/feather.min.js')}}"></script>
<script src="{{asset('assets/js/feather-icon.js')}}"></script>

@if(app()->environment('local'))
    <script src="{{asset('assets/js/vue/vue.js')}}"></script>
    <script src="{{asset('assets/js/vue/vue-select2.js')}}"></script>
@else
    <script src="{{asset('assets/js/vue/vue-production.js')}}"></script>
    <script src="{{asset('assets/js/vue/vue-select2.min.js')}}"></script>
@endif
<script src="/sweetalert.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/inputmask@5.0.6/dist/inputmask.min.js"></script>
<script src="{{asset('assets/js/v-mask/v-mask.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/text-mask-addons@3.8.0/dist/textMaskAddons.min.js"></script>
<script src="{{asset('assets/js/bootstrap-vue/bootstrap-vue.min.js')}}"></script>
<script src="{{asset('assets/js/vue/vue-timers.umd.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/yall-js@3.2.0/dist/yall.min.js"></script>
<script>
    // category_list.onclick = function () {
    //     document.querySelector('.sm-nav-btn').click();
    // };
    let show_cat_parent_list = document.querySelectorAll('.show_cat_parent_list');
    show_cat_parent_list.forEach((el)=>{
       el.onclick = function () {
           el.parentElement.classList.toggle('open');
       }
    });
    document.addEventListener("DOMContentLoaded", yall);
    window.cartItem = '{{ route('cart.item', '') }}';
    window.cartApp = new Vue({
        el: '#cartSide',
        data: {
            items: [],
            count: 0
        },
        created() {
            this.updateCart({
                items: JSON.parse('@json(\App\Http\Resources\CartItemResource::collection(userCart()->getContent()))'),
                count: {{ userCart()->getTotalQuantity() }},
            });
        },
        methods: {
            getTotal: function () {
                $.ajax({
                    url: '{{route('getCartPrices')}}',
                    success: function (data)
                    {
                        // subTotal.html((data.sub_total).toFixed(2) + ' EGP');
                        // taxes.text((data.taxes).toFixed(2) + ' EGP');
                        // cartTotal.text((data.total).toFixed(2) + ' EGP');
                        cartTotal.text((data.sub_total).toFixed(2) + ' EGP');
                    }
                });
            },
            deleteItem: function (productId) {
                $.ajax({
                    url: `${window.cartItem}/${productId}`,
                    type: 'DELETE',
                    success: function (res) {
                        window.cartApp.updateCart(res.cart)
                        openCart();
                    }
                });
            },
            updateCart: function (cartData) {
                this.items = []
                this.count = cartData.count
                this.items = cartData.items
                this.$nextTick().then(() => {
                    yall()
                    feather.replace()
                });
                //this.$forceUpdate();
                this.getTotal();
            },
        },
        watch: {
            count: function (newVal, oldVal) {
                $('.item-count-contain').html(newVal);
            }
        }
    })

    let qtyDecs = $('.qty-minus');

    $(document).on('click', '.qty-minus', function() {
        let val = $(this).next().val();
        if (val > 1)
        {
            $(this).next().val((i, val) => val*1-1 );
        }
    });

    $(document).on('click', '.qty-plus', function() {
        let max = $(this).prev().attr('max');
        let val = $(this).prev().val();
        if (parseInt(val) < parseInt(max))
        {
            $(this).prev().val((i, val) => val*1+1 );
        }
    });

    $(document).on('click','#addToCartQuickView',function () {
        let quantity = $('.quick-view-quantity').val(),
            productID = $(this).data('product');
        addToCart(productID,quantity);
    })
</script>

<script>
    const stateSelector = $('.state_selector'),
            stateRoute  = stateSelector.data('state-route');

    stateSelector.on('change',function () {
        let stateID = $(this).val(),
            cityTag = $(this).data('city-target'),
            citySelector = $(cityTag),
            cities = [];
        $.ajax({
            url:stateRoute+stateID,
            method:'GET',
            success:function (data) {
                data.forEach(city=>{
                    cities.push(`<option value="${city.id}">${city.name}</option>`);
                });
                citySelector.html(cities);
            }
        });
    });

</script>

<script>
    let searchForm = $('#searchForm');
    let searchInput = $('#searchInput');
    let searchCategory = $('#categoryId');
    let searchList = $('#search-result');
    let productRoute = '{{route('products.show','')}}';
    let productImgRoute = '{{asset('/storage/uploads/70x70/products')}}';
    searchForm.submit(function (e) {
        if (!searchInput.val().length)
            e.preventDefault();
    })
    searchInput.val({{request('searchInput')}});
    searchInput.on('keyup',function (){
        let name = $(this).val();
        let category = searchCategory.val();
        let formVal = searchForm.serializeArray();
        let items = [];
        $.ajax({
            url: '{{route('header-search')}}',
            method:'POST',
            data: formVal,
            success:  function (data) {
                if (data.length > 0){
                    searchList.addClass('show');
                    data.forEach((el)=>{
                        items.push(`<li><a href="${productRoute+'/'+el.slug}"><img src="${productImgRoute+'/'+el.image.image}" alt=""><span>${el.name}</span></a></li>`);
                    });
                    searchList.html(items);
                }else {
                    searchList.removeClass('show');
                }
            }
        })
    });

</script>

<script async>

    const cartItemUpdate = document.querySelectorAll('.cart-item-update');
    const xhttp = new XMLHttpRequest();
    const cartAlert = document.querySelector('.cart-alert');
    const cartCount = document.querySelectorAll('.item-count-contain');
    cartItemUpdate.forEach(cartItem =>{
        cartItem.addEventListener('click',function () {
            cartAlert.style.display = 'none';
            let cartInput = this.previousElementSibling,
                cartValue = cartInput.valueAsNumber,
                cartRoute = cartInput.dataset.cartRoute+cartValue;

                @if(config('setting.pricing'))
                   let  itemPrice = cartInput.dataset.itemPrice,
                        itemTotal = document.querySelector(`${this.dataset.totalItem}`),
                        cartTotal = document.querySelector('#subTotal'),
                        prices = [];
                @endif

            xhttp.open("GET", cartRoute,false);
            xhttp.send();

            if(xhttp.status === 200){
                let res = JSON.parse(xhttp.response);
                @if(config('setting.pricing'))
                    itemTotal.firstElementChild.innerText = `${itemPrice*cartValue}`;
                    let itemsTotal = document.querySelectorAll('.item-total');
                @endif

                if(res.tag){

                    cartCount.forEach(cartCounter=>{
                        cartCounter.innerText = res.cartCount;
                    });

                    @if(config('setting.pricing'))
                        itemsTotal.forEach((el)=>{
                            prices.push(el.firstElementChild.innerText);
                        });
                        cartTotal.firstElementChild.innerText = parseInt(res.sub_prices||0).toFixed(2) + ' EGP';
                    @endif

                    cartAlert.classList.add('alert-success');
                    cartAlert.classList.remove('alert-danger');
                    cartAlert.style.display = 'block';
                    cartAlert.innerText = res.msg;
                }else {
                    cartAlert.classList.remove('alert-success');
                    cartAlert.classList.add('alert-danger');
                    cartAlert.style.display = 'block';
                    cartAlert.innerText = res.msg;
                }
            }
        })
    });

    // cartItemUpdate.on('click',function () {
    //     let cartInput = $(this).prev(),
    //         cartValue = cartInput.val(),
    //         cartRoute = cartInput.data('cart-route');
    //     // let route = $(this).data();
    // });

    // const cartMinus = $('.qty-minus');
    // const cartPlus = $('.qty-plus');

    // cartPlus.click(function (){
    //     let cartInput = $(this).prev();
    //     let maxVal = cartInput.attr('maxlength');
    //     let inputVal = cartInput.val();
    //     let route = cartInput.data('cart-route')+inputVal;
    //     if(inputVal<maxVal &&inputVal>0){
    //         $.ajax({
    //             url:route,
    //             method:'GET',
    //             success:function (data) {
    //             },
    //         });
    //     }
    // });
    //
    // cartMinus.click(function (){
    //     let cartInput = $(this).next();
    //     let maxVal = cartInput.attr('maxlength');
    //     let inputVal = cartInput.val();
    //     let route = cartInput.data('cart-route')+inputVal;
    //     if(inputVal<maxVal &&inputVal>0){
    //         $.ajax({
    //             url:route,
    //             method:'GET',
    //             success:function (data) {
    //             },
    //         });
    //     }
    // });

</script>

<script>
    let subTotal = $('#subTotal span'),
    taxes = $('#taxes span'),
    cartTotal = $('#cartTotal span'),
    cartOpen = $('.mobile-cart');
     window.getTotalFun = function () {
        $.ajax({
            url: '{{route('getCartPrices')}}',
            success: function (data)
            {
                subTotal.html((data.sub_total).toFixed(2) + ' EGP');
                taxes.text((data.taxes).toFixed(2) + ' EGP');
                cartTotal.text((data.total).toFixed(2) + ' EGP');
            }
        });
    }
    cartOpen.click(function(){
        window.getTotalFun();
    });


</script>

{{--<script>--}}
{{--    $('#searchProds').click(function (){--}}
{{--        $('#searchForm').submit();--}}
{{--    })--}}
{{--    $('.select2').select2();--}}
{{--</script>--}}

<!-- slick js-->
<script src="{{asset('assets/js/slick.js')}}"></script>
<!-- tool tip js -->
<script src="{{asset('assets/js/tippy-popper.min.js')}}"></script>
<script src="{{asset('assets/js/tippy-bundle.iife.min.js')}}"></script>
<!-- popper js-->
<script src="{{asset('assets/js/popper.min.js')}}"></script>
<!-- menu js-->


<script src="{{asset('assets/js/menu.js')}}"></script>
<!-- ajax search js -->
<script src="{{asset('assets/js/typeahead.bundle.min.js')}}"></script>
<script src="{{asset('assets/js/typeahead.jquery.min.js')}}"></script>
<script src="{{asset('assets/js/ajax-custom.js')}}"></script>
<!-- Bootstrap js-->
<script src="{{asset('assets/js/bootstrap.js')}}"></script>
<!-- Bootstrap js-->
<script src="{{asset('assets/js/bootstrap-notify.min.js')}}"></script>

<!-- Theme js-->
<script src="{{asset('assets/js/script.js')}}"></script>
<script src="{{asset('assets/js/modal.js')}}"></script>

<script>
    var x, i, j, l, ll, selElmnt, a, b, c;
    /*look for any elements with the class "custom-select":*/
    x = document.getElementsByClassName("custom-select");
    l = x.length;
    for (i = 0; i < l; i++) {
        selElmnt = x[i].getElementsByTagName("select")[0];
        ll = selElmnt.length;
        /*for each element, create a new DIV that will act as the selected item:*/
        a = document.createElement("DIV");
        a.setAttribute("class", "select-selected");
        a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
        x[i].appendChild(a);
        /*for each element, create a new DIV that will contain the option list:*/
        b = document.createElement("DIV");
        b.setAttribute("class", "select-items select-hide");
        for (j = 1; j < ll; j++) {
            /*for each option in the original select element,
            create a new DIV that will act as an option item:*/
            c = document.createElement("DIV");
            c.innerHTML = selElmnt.options[j].innerHTML;
            c.addEventListener("click", function(e) {
                /*when an item is clicked, update the original select box,
                and the selected item:*/
                var y, i, k, s, h, sl, yl;
                s = this.parentNode.parentNode.getElementsByTagName("select")[0];
                sl = s.length;
                h = this.parentNode.previousSibling;
                for (i = 0; i < sl; i++) {
                    if (s.options[i].innerHTML == this.innerHTML) {
                        s.selectedIndex = i;
                        h.innerHTML = this.innerHTML;
                        y = this.parentNode.getElementsByClassName("same-as-selected");
                        yl = y.length;
                        for (k = 0; k < yl; k++) {
                            y[k].removeAttribute("class");
                        }
                        this.setAttribute("class", "same-as-selected");
                        break;
                    }
                }
                h.click();
            });
            b.appendChild(c);
        }
        x[i].appendChild(b);
        a.addEventListener("click", function(e) {
            /*when the select box is clicked, close any other select boxes,
            and open/close the current select box:*/
            e.stopPropagation();
            closeAllSelect(this);
            this.nextSibling.classList.toggle("select-hide");
            this.classList.toggle("select-arrow-active");
        });
    }
    function closeAllSelect(elmnt) {
        /*a function that will close all select boxes in the document,
        except the current select box:*/
        var x, y, i, xl, yl, arrNo = [];
        x = document.getElementsByClassName("select-items");
        y = document.getElementsByClassName("select-selected");
        xl = x.length;
        yl = y.length;
        for (i = 0; i < yl; i++) {
            if (elmnt == y[i]) {
                arrNo.push(i)
            } else {
                y[i].classList.remove("select-arrow-active");
            }
        }
        for (i = 0; i < xl; i++) {
            if (arrNo.indexOf(i)) {
                x[i].classList.add("select-hide");
            }
        }
    }
    /*if the user clicks anywhere outside the select box,
    then close all select boxes:*/
    document.addEventListener("click", closeAllSelect);
</script>
@stack('scripts')
</body>
</html>
