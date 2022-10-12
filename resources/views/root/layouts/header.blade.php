<!--header start-->
<header id="stickyheader" class="header-ui">
    {{--    <div class="mobile-fix-option"></div>--}}
    <div class="header-top pb-1">
        <div class="row">
            <div class="col-md-3 col-6">
                <div class="dropdown language-menu">
                    <button class="btn btn-light dropdown-toggle text-uppercase" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <span> {{app()->getLocale()}} | </span> <img src="{{asset("assets/images/svg/".app()->getLocale().'.svg')}}" alt="{{app()->getLocale()}}">
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <li class="d-block">
                                <a class="dropdown-item"
                                   href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                    <img src="{{asset("assets/images/svg/".$localeCode.'.svg')}}" alt="{{$localeCode}}">
                                    @lang('layouts.'.$properties['name'])
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-6 nav-pages-links d-none d-md-block">
                <ul class="nav justify-content-center">
                    <li class="nav-item mx-4">
                        <a class="nav-link" href="{{ route('index') }}">{{__('layouts.home')}}</a>
                    </li>
                    <li class="nav-item mx-4">
                        <a class="nav-link" href="{{ route('products.index') }}">{{__('layouts.sopping')}}</a>
                    </li>
                    @if($aboutUs->count())
                    <li class="nav-item mx-4">
                        <a class="nav-link" href="{{ route('aboutUs') }}">{{__('layouts.aboutUs')}}</a>
                    </li>
                    @endif
                    <li class="nav-item mx-4">
                        <a class="nav-link" href="{{ route('contactUs') }}">{{__('layouts.contactUs')}}</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-3 col-6">
                <div class="register text-capitalize float-end pt-2">
                    @if(auth()->guard('web')->check())

                        <a onclick="openAccount()">
                        <span>
                        @lang('auth.myAccount')
                        </span>
                            <i data-feather="user"></i>
                        </a>
                    @else
                        <a href="{{route('login')}}">
                        <span>
                        @lang('layouts.noWebAuth')
                        </span>
                            <i data-feather="user"></i>
                        </a>
                    @endif

                </div>
            </div>
        </div>
    </div>
    <hr class="m-0">
    <div class="header-bottom">
        <div class="row px-3">
            <div class="col-lg-3 col-md-2 list-cart p-0">

                <button class="btn btn-list" data-bs-toggle="collapse">
                    <span class="sm-nav-btn">
                        <i data-feather="menu"></i>
                    </span>
                </button>

                <button class="btn btn-cart" onclick="openCart()">
                    <small class="item-count-contain">0</small>
                    <i data-feather="shopping-cart"></i>
                </button>

            </div>
            <div class="col-lg-6 col-md-8">
                <div id="searchFormEl" class="input-block">
                    <div class="input-box">
                        <form id="searchForm" action="{{ route('header-search') }}" method="POST" class="big-deal-form" >
                            @csrf
                            <div class="input-group">
                                <div class="input-group-text" style=" background-color: #FFF; padding: 0.375rem 0.75rem;">
                                    <button type="submit" class="search btn" style="background-color: transparent">
                                        <i style="color: #939b9e" data-feather="search"></i>
                                    </button>
                                </div>
                                <input value="{{ old('searchName')?? request('searchName') }}" type="text" class="form-control" id="searchInput" name="searchName">
                                <div class="input-group-text custom-select">
                                    <select id="category-input" name="categoryId" class="select2 p-0">
                                        <option value="0" selected>{{ trans('layouts.category') }}</option>
                                        @if($categories->count() > 0)
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}" {{ request('categoryId') == $category->id? 'selected': null}}>{{$category->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <ul id="search-result" class="nav-cat dropdown-menu title-font pb-2 pt-2 w-100">

                                </ul>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-2">
                <div class="brand-logo logo-sm-center float-end">
                    <a href="{{route('index')}}">
                        <img src="{{ env('LOGO_PATH') }}" class="img-fluid" alt="logo" style="max-height: 60px;">
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="header-bottom header-mobile">
        <div class="row">
            <div class="col-3 list-cart">
                <button class="btn btn-list" data-bs-toggle="collapse">
                    <span class="sm-nav-btn">
                        <i data-feather="menu"></i>
                    </span>
                </button>
            </div>
            <div class="col-6">
                <div class="brand-logo logo-sm-center float-end">
                    <a href="{{route('index')}}">
                        <img src="{{ env('LOGO_PATH') }}" class="img-fluid" alt="logo" style="max-height: 60px;">
                    </a>
                </div>
            </div>
            <div class="col-3 list-cart">
                <button class="btn btn-cart" onclick="openCart()">
                    <small class="item-count-contain">0</small>
                    <i data-feather="shopping-cart"></i>
                </button>
            </div>
        </div>
    </div>
    <div class="side-list">
        <div class="sm-nav-block">
            <ul class="nav-slide">
                <li>
                    <div class="nav-sm-back">
                        {{__('layouts.back')}}
                        <i class="fa fa-angle-right ps-2"></i>
                    </div>
                </li>

                <li @class('parent')>
                    <div>
                        <a href="javascript:void(0)" class="d-inline-block w-100" data-bs-toggle="collapse"
                           data-bs-target=".categories" aria-expanded="false"
                           aria-controls="categories">
                            @lang('layouts.all_category')
                            <i class="fa fa-angle-right ps-2 show_cat_parent_list float-end"></i>
                        </a>
                        <ul class="collapse categories py-2">
                            @foreach($categories->whereNull('parent_id')->where('is_active',true) as $category)
                                <li @class('parent')>
                                    <div>
                                        <a href="javascript:void(0)">
                                            {{ $category->name }}
                                            @if($category->activeChildes->count()>0)
                                                <i class="fa fa-angle-right ps-2 show_cat_parent_list float-end" data-bs-toggle="collapse"
                                                   data-bs-target=".{{$category->slug??"cat_$category->id"}}" aria-expanded="false"
                                                   aria-controls="{{$category->slug??"cat_$category->id"}}"></i>
                                            @endif
                                        </a>
                                    </div>
                                    @if($category->activeChildes->count()>0)
                                        <ul class="collapse {{$category->slug??"cat_$category->id"}} py-2">
                                            @foreach($category->activeChildes as $sub_category)
                                                <li>
                                                    <a class="d-block w-100" href="{{ route('products.index', ['categoryId' => $sub_category->id]) }}">
                                                        {{$sub_category->name}}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </li>

                <li @class('parent')>
                    <div>
                        <a href="javascript:void(0)" class="d-inline-block w-100" data-bs-toggle="collapse"
                           data-bs-target=".customPages" aria-expanded="false"
                           aria-controls="customPages">
                            @lang('layouts.sideMap')
                            <i class="fa fa-angle-right ps-2 show_cat_parent_list float-end"></i>
                        </a>
                        <ul class="collapse customPages py-2">

                            <li>
                                <a class="dark-menu-item" href="{{ route('index') }}">{{__('layouts.home')}}</a>
                            </li>

                            <li>
                                <a class="dark-menu-item" href="{{ route('products.index') }}">{{__('layouts.sopping')}}</a>
                            </li>

                            @foreach($customPages as $page)
                                <li>
                                    <a class="dark-menu-item" href="{{ route('openPageContent',$page->slug) }}">{{$page->name}}</a>
                                </li>
                            @endforeach

                            @if($aboutUs->count())
                                <li>
                                    <a class="dark-menu-item" href="{{ route('aboutUs') }}">{{__('layouts.aboutUs')}}</a>
                                </li>
                            @endif

                            <li>
                                <a class="dark-menu-item" href="{{ route('contactUs') }}">{{__('layouts.contactUs')}}</a>
                            </li>
                        </ul>
                    </div>
                </li>

            </ul>
        </div>
    </div>


{{--    <div class="top-header">--}}
{{--        <div class="custom-container">--}}
{{--            <div class="top-header-left ml-3 mr-3">--}}

{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

    <div class="layout-header2">
        <div class="m-1">
            <div class="col-md-12">
                <div class="main-menu-block">
                    <div class="header-left">
                        <div class="sm-nav-block">
                            <span class="sm-nav-btn">
                              <i class="fa fa-bars"></i>
                            </span>
                            <ul class="nav-slide">
                                <li>
                                    <div class="nav-sm-back">
                                        {{__('layouts.back')}} <i class="fa fa-angle-right ps-2"></i>
                                    </div>
                                </li>

                                @foreach($categories->whereNull('parent_id')->where('is_active',true) as $category)
                                    <li>
                                        <a href="{{ route('products.index', ['category_id' => $category->id]) }}">
                                            {{ $category->name }}
                                        </a>
                                    @if($category->activeChildes->count()>0)
                                        <i class="fa fa-angle-right ps-2 show_cat_parent_list" data-bs-toggle="collapse"
                                           data-bs-target=".{{$category->slug??"cat_$category->id"}}" aria-expanded="false"
                                           aria-controls="{{$category->slug??"cat_$category->id"}}"></i>

                                        <ul class="collapse {{$category->slug??"cat_$category->id"}}">
                                            @foreach($category->activeChildes as $sub_category)
                                                <li>
                                                    <a class="d-block w-100" href="{{ route('products.index', ['category_id' => $sub_category->id]) }}">
                                                        {{$sub_category->name}}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                        <div class="brand-logo logo-sm-center">
                            <a href="{{route('index')}}">
                                <img src="{{ env('LOGO_PATH') }}" class="img-fluid" alt="logo" style="max-height: 60px;">
                            </a>
                        </div>
                    </div>
                    <div id="searchFormEl" class="input-block">
                        <div class="input-box">
                            <div class="dropdown">
{{--                                <form id="searchForm" action="{{ route('header-search') }}" method="POST" class="big-deal-form" >--}}
{{--                                    @csrf--}}
{{--                                    <div class="input-group">--}}
{{--                                        <div class="input-group-text" style=" background-color: #FFF; padding: 0.375rem 0.75rem;">--}}
{{--                                        <button type="submit"  class="search btn" style="background-color: transparent">--}}
{{--                                            <i style="color: #939b9e" class="fa fa-search"></i>--}}
{{--                                        </button>--}}
{{--                                        </div>--}}
{{--                                        <input value="{{ request('searchName') }}" type="text" class="form-control" id="searchInput" name="searchName" autocomplete="off">--}}
{{--                                        <div class="input-group-text custom-select">--}}
{{--                                            <select id="category-input" name="categoryId" class="select2">--}}
{{--                                                <option value="0">{{ trans('layouts.all_category') }}</option>--}}
{{--                                                @if($categories->count() > 0)--}}
{{--                                                    @foreach($categories as $category)--}}
{{--                                                        <option value="{{$category->id}}">{{$category->name}}</option>--}}
{{--                                                    @endforeach--}}
{{--                                                @endif--}}
{{--                                            </select>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </form>--}}
{{--                                <ul id="search-result" class="nav-cat dropdown-menu title-font pb-2 pt-2 w-100">--}}

{{--                                </ul>--}}
                            </div>

                        </div>
                    </div>
                    <div class="header-right">
                        <div class="icon-block">
                            <ul>
                                {{--                                <li class="mobile-search">--}}
                                {{--                                    <a href="javascript:void(0)">--}}
                                {{--                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg"--}}
                                {{--                                             xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"--}}
                                {{--                                             viewBox="0 0 612.01 612.01"--}}
                                {{--                                             style="enable-background:new 0 0 612.01 612.01;"--}}
                                {{--                                             xml:space="preserve">--}}
                                {{--                                              <g>--}}
                                {{--                                                  <g>--}}
                                {{--                                                      <g>--}}
                                {{--                                                          <path d="M606.209,578.714L448.198,423.228C489.576,378.272,515,318.817,515,253.393C514.98,113.439,399.704,0,257.493,0--}}
                                {{--                                                      C115.282,0,0.006,113.439,0.006,253.393s115.276,253.393,257.487,253.393c61.445,0,117.801-21.253,162.068-56.586--}}
                                {{--                                                      l158.624,156.099c7.729,7.614,20.277,7.614,28.006,0C613.938,598.686,613.938,586.328,606.209,578.714z M257.493,467.8--}}
                                {{--                                                      c-120.326,0-217.869-95.993-217.869-214.407S137.167,38.986,257.493,38.986c120.327,0,217.869,95.993,217.869,214.407--}}
                                {{--                                                      S377.82,467.8,257.493,467.8z"/>--}}
                                {{--                                                      </g>--}}
                                {{--                                                  </g>--}}
                                {{--                                              </g>--}}
                                {{--                                        </svg>--}}
                                {{--                                    </a>--}}
                                {{--                                </li>--}}
                                {{--                                <li class="mobile-user " onclick="openAccount()">--}}
                                {{--                                    <a href="javascript:void(0)">--}}
                                {{--                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg"--}}
                                {{--                                             xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"--}}
                                {{--                                             viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;"--}}
                                {{--                                             xml:space="preserve">--}}
                                {{--                                            <g>--}}
                                {{--                                                <g>--}}
                                {{--                                                    <path d="M256,0c-74.439,0-135,60.561-135,135s60.561,135,135,135s135-60.561,135-135S330.439,0,256,0z M256,240--}}
                                {{--                                                  c-57.897,0-105-47.103-105-105c0-57.897,47.103-105,105-105c57.897,0,105,47.103,105,105C361,192.897,313.897,240,256,240z"/>--}}
                                {{--                                                </g>--}}
                                {{--                                            </g>--}}
                                {{--                                            <g>--}}
                                {{--                                                <g>--}}
                                {{--                                                    <path d="M297.833,301h-83.667C144.964,301,76.669,332.951,31,401.458V512h450V401.458C435.397,333.05,367.121,301,297.833,301z--}}
                                {{--                                                            M451.001,482H451H61v-71.363C96.031,360.683,152.952,331,214.167,331h83.667c61.215,0,118.135,29.683,153.167,79.637V482z"/>--}}
                                {{--                                                </g>--}}
                                {{--                                            </g>--}}
                                {{--                                        </svg>--}}
                                {{--                                    </a>--}}
                                {{--                                </li>--}}
                                <li class="mobile-cart item-count d-block" onclick="openCart()">
                                    <a href="javascript:void(0)">
                                        <div class="cart-block">
                                            <div class="cart-icon">
                                                <svg enable-background="new 0 0 512 512" viewBox="0 0 512 512"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <g>
                                                        <path
                                                            d="m497 401.667c-415.684 0-397.149.077-397.175-.139-4.556-36.483-4.373-34.149-4.076-34.193 199.47-1.037-277.492.065 368.071.065 26.896 0 47.18-20.377 47.18-47.4v-203.25c0-19.7-16.025-35.755-35.725-35.79l-124.179-.214v-31.746c0-17.645-14.355-32-32-32h-29.972c-17.64 0-31.99 14.351-31.99 31.99v31.594l-133.21-.232-9.985-54.992c-2.667-14.694-15.443-25.36-30.378-25.36h-68.561c-8.284 0-15 6.716-15 15s6.716 15 15 15c72.595 0 69.219-.399 69.422.719 16.275 89.632 5.917 26.988 49.58 306.416l-38.389.2c-18.027.069-32.06 15.893-29.81 33.899l4.252 34.016c1.883 15.06 14.748 26.417 29.925 26.417h26.62c-18.8 36.504 7.827 80.333 49.067 80.333 41.221 0 67.876-43.813 49.067-80.333h142.866c-18.801 36.504 7.827 80.333 49.067 80.333 41.22 0 67.875-43.811 49.066-80.333h31.267c8.284 0 15-6.716 15-15s-6.716-15-15-15zm-209.865-352.677c0-1.097.893-1.99 1.99-1.99h29.972c1.103 0 2 .897 2 2v111c0 8.284 6.716 15 15 15h22.276l-46.75 46.779c-4.149 4.151-10.866 4.151-15.015 0l-46.751-46.779h22.277c8.284 0 15-6.716 15-15v-111.01zm-30 61.594v34.416h-25.039c-20.126 0-30.252 24.394-16.014 38.644l59.308 59.342c15.874 15.883 41.576 15.885 57.452 0l59.307-59.342c14.229-14.237 4.13-38.644-16.013-38.644h-25.039v-34.254l124.127.214c3.186.005 5.776 2.603 5.776 5.79v203.25c0 10.407-6.904 17.4-17.18 17.4h-299.412l-35.477-227.039zm-56.302 346.249c0 13.877-11.29 25.167-25.167 25.167s-25.166-11.29-25.166-25.167 11.29-25.167 25.167-25.167 25.166 11.291 25.166 25.167zm241 0c0 13.877-11.289 25.167-25.166 25.167s-25.167-11.29-25.167-25.167 11.29-25.167 25.167-25.167 25.166 11.291 25.166 25.167z"/>
                                                    </g>
                                                </svg>
                                            </div>
                                            <div class="cart-item">
                                                <h5>{{__('layouts.shoppingCart')}}</h5>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="item-count-contain">0</div>
                                </li>
                            </ul>
                        </div>
                        <div class="menu-nav">
                            <span class="toggle-nav">
                              <i class="fa fa-bars "></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="searchbar-input">
            <div class="input-group">
        <span class="input-group-text">
          <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
               y="0px" width="28.931px" height="28.932px" viewBox="0 0 28.931 28.932"
               style="enable-background:new 0 0 28.931 28.932;" xml:space="preserve"><g><path
                      d="M28.344,25.518l-6.114-6.115c1.486-2.067,2.303-4.537,2.303-7.137c0-3.275-1.275-6.355-3.594-8.672C18.625,1.278,15.543,0,12.266,0C8.99,0,5.909,1.275,3.593,3.594C1.277,5.909,0.001,8.99,0.001,12.266c0,3.276,1.275,6.356,3.592,8.674c2.316,2.316,5.396,3.594,8.673,3.594c2.599,0,5.067-0.813,7.136-2.303l6.114,6.115c0.392,0.391,0.902,0.586,1.414,0.586c0.513,0,1.024-0.195,1.414-0.586C29.125,27.564,29.125,26.299,28.344,25.518z M6.422,18.111c-1.562-1.562-2.421-3.639-2.421-5.846S4.86,7.983,6.422,6.421c1.561-1.562,3.636-2.422,5.844-2.422s4.284,0.86,5.845,2.422c1.562,1.562,2.422,3.638,2.422,5.845s-0.859,4.283-2.422,5.846c-1.562,1.562-3.636,2.42-5.845,2.42S7.981,19.672,6.422,18.111z"/></g></svg>
        </span>
                <input type="text" class="form-control" placeholder="search your product">
                <span class="input-group-text close-searchbar">
          <svg viewBox="0 0 329.26933 329" xmlns="http://www.w3.org/2000/svg"><path
                  d="m194.800781 164.769531 128.210938-128.214843c8.34375-8.339844 8.34375-21.824219 0-30.164063-8.339844-8.339844-21.824219-8.339844-30.164063 0l-128.214844 128.214844-128.210937-128.214844c-8.34375-8.339844-21.824219-8.339844-30.164063 0-8.34375 8.339844-8.34375 21.824219 0 30.164063l128.210938 128.214843-128.210938 128.214844c-8.34375 8.339844-8.34375 21.824219 0 30.164063 4.15625 4.160156 9.621094 6.25 15.082032 6.25 5.460937 0 10.921875-2.089844 15.082031-6.25l128.210937-128.214844 128.214844 128.214844c4.160156 4.160156 9.621094 6.25 15.082032 6.25 5.460937 0 10.921874-2.089844 15.082031-6.25 8.34375-8.339844 8.34375-21.824219 0-30.164063zm0 0"/></svg>
        </span>
            </div>
        </div>
    </div>
    <div class="category-header-2">
        <div class="custom-container">
            <div class="row">
                <div class="col-12">
                    <div class="navbar-menu">
                        <div class="logo-block">
                            <div class="brand-logo logo-sm-center">
                                <a href="{{route('index')}}">
                                    <img src="{{ env('LOGO_PATH') }}" class="img-fluid" alt="logo" style="max-height: 60px;">
                                </a>
                            </div>
                        </div>

                        @if($categories->count() > 0)
                            <div class="nav-block">
                                <div class="nav-left">
                                    <nav class="navbar" data-bs-toggle="collapse">
                                        <button class="navbar-toggler" type="button">
                                            <span class="navbar-icon">
                                                <i class="fa fa-list"></i>
                                            </span>
                                        </button>
                                        <h5 class="mb-0  text-white title-font">{{__('layouts.shopCategory')}}</h5>
                                    </nav>
                                    <div class="collapse nav-desk" id="navbarToggleExternalContent">
                                        <ul class="nav-cat title-font">
                                            @foreach($categories as $category)
                                                <li>
                                                    <a href="{{ route('products.index', ['category_id' => $category->id]) }}">
                                                        @if($category->icon)
                                                            <img src="{{ $category->icon_url(50, 50) }}"
                                                                 alt="{{ $category->name }}">
                                                        @endif
                                                        {{ $category->name }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="menu-block">
                            <nav id="main-nav">
                                <div class="toggle-nav"><i class="fa fa-bars sidebar-bar"></i></div>
                                <ul id="main-menu" class="sm pixelstrap sm-horizontal">
                                    <li>
                                        <div class="mobile-back text-right">
                                            {{__('layouts.close')}}<i class="fa fa-angle-right ps-2" aria-hidden="true"></i>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="dark-menu-item" href="{{ route('index') }}">{{__('layouts.home')}}</a>
                                    </li>
                                    <li>
                                        <a class="dark-menu-item" href="{{ route('products.index') }}">{{__('layouts.sopping')}}</a>
                                    </li>

                                    @foreach($customPages as $page)
                                        <li>
                                            <a class="dark-menu-item" href="{{ route('openPageContent',$page->slug) }}">{{$page->name}}</a>
                                        </li>
                                    @endforeach

                                    @if($aboutUs->count())
                                        <li>
                                            <a class="dark-menu-item" href="{{ route('aboutUs') }}">{{__('layouts.aboutUs')}}</a>
                                        </li>
                                    @endif

                                    <li>
                                        <a class="dark-menu-item" href="{{ route('contactUs') }}">{{__('layouts.contactUs')}}</a>
                                    </li>

                                </ul>
                            </nav>
                        </div>
                        <div class="icon-block">
                            <ul>
                                <li class="mobile-search">
                                    <a href="javascript:void(0)">
                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                             xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                             viewBox="0 0 612.01 612.01"
                                             style="enable-background:new 0 0 612.01 612.01;"
                                             xml:space="preserve">
                                            <g>
                                                <g>
                                                    <g>
                                                        <path d="M606.209,578.714L448.198,423.228C489.576,378.272,515,318.817,515,253.393C514.98,113.439,399.704,0,257.493,0
                                                    C115.282,0,0.006,113.439,0.006,253.393s115.276,253.393,257.487,253.393c61.445,0,117.801-21.253,162.068-56.586
                                                    l158.624,156.099c7.729,7.614,20.277,7.614,28.006,0C613.938,598.686,613.938,586.328,606.209,578.714z M257.493,467.8
                                                    c-120.326,0-217.869-95.993-217.869-214.407S137.167,38.986,257.493,38.986c120.327,0,217.869,95.993,217.869,214.407
                                                    S377.82,467.8,257.493,467.8z"/>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </a>
                                </li>
                                <li class="mobile-user onhover-dropdown"
                                    @auth
                                        onclick="openAccount()"
                                    @endauth>
                                    <a
                                    @auth
                                        href="javascript:void(0)"
                                    @endauth
                                    @guest
                                        href="{{ route('login') }}"
                                    @endguest>
                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                             xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                             viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;"
                                             xml:space="preserve">
                                            <g>
                                                <g>
                                                    <path d="M256,0c-74.439,0-135,60.561-135,135s60.561,135,135,135s135-60.561,135-135S330.439,0,256,0z M256,240
                                                        c-57.897,0-105-47.103-105-105c0-57.897,47.103-105,105-105c57.897,0,105,47.103,105,105C361,192.897,313.897,240,256,240z"/>
                                                </g>
                                            </g>
                                            <g>
                                                <g>
                                                    <path d="M297.833,301h-83.667C144.964,301,76.669,332.951,31,401.458V512h450V401.458C435.397,333.05,367.121,301,297.833,301z
                                                        M451.001,482H451H61v-71.363C96.031,360.683,152.952,331,214.167,331h83.667c61.215,0,118.135,29.683,153.167,79.637V482z"/>
                                                </g>
                                            </g>
                                        </svg>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="searchbar-input">
            <div class="input-group">
        <span class="input-group-text">
          <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
               y="0px" width="28.931px" height="28.932px" viewBox="0 0 28.931 28.932"
               style="enable-background:new 0 0 28.931 28.932;" xml:space="preserve">
              <g>
                  <path
                      d="M28.344,25.518l-6.114-6.115c1.486-2.067,2.303-4.537,2.303-7.137c0-3.275-1.275-6.355-3.594-8.672C18.625,1.278,15.543,0,12.266,0C8.99,0,5.909,1.275,3.593,3.594C1.277,5.909,0.001,8.99,0.001,12.266c0,3.276,1.275,6.356,3.592,8.674c2.316,2.316,5.396,3.594,8.673,3.594c2.599,0,5.067-0.813,7.136-2.303l6.114,6.115c0.392,0.391,0.902,0.586,1.414,0.586c0.513,0,1.024-0.195,1.414-0.586C29.125,27.564,29.125,26.299,28.344,25.518z M6.422,18.111c-1.562-1.562-2.421-3.639-2.421-5.846S4.86,7.983,6.422,6.421c1.561-1.562,3.636-2.422,5.844-2.422s4.284,0.86,5.845,2.422c1.562,1.562,2.422,3.638,2.422,5.845s-0.859,4.283-2.422,5.846c-1.562,1.562-3.636,2.42-5.845,2.42S7.981,19.672,6.422,18.111z"/>
              </g>
          </svg>
        </span>
                <input type="text" class="form-control" placeholder="search your product">
                <span class="input-group-text close-searchbar">
          <svg viewBox="0 0 329.26933 329" xmlns="http://www.w3.org/2000/svg"><path
                  d="m194.800781 164.769531 128.210938-128.214843c8.34375-8.339844 8.34375-21.824219 0-30.164063-8.339844-8.339844-21.824219-8.339844-30.164063 0l-128.214844 128.214844-128.210937-128.214844c-8.34375-8.339844-21.824219-8.339844-30.164063 0-8.34375 8.339844-8.34375 21.824219 0 30.164063l128.210938 128.214843-128.210938 128.214844c-8.34375 8.339844-8.34375 21.824219 0 30.164063 4.15625 4.160156 9.621094 6.25 15.082032 6.25 5.460937 0 10.921875-2.089844 15.082031-6.25l128.210937-128.214844 128.214844 128.214844c4.160156 4.160156 9.621094 6.25 15.082032 6.25 5.460937 0 10.921874-2.089844 15.082031-6.25 8.34375-8.339844 8.34375-21.824219 0-30.164063zm0 0"/></svg>
        </span>
            </div>
        </div>
    </div>
</header>
<!--header end-->
<script>

    // document.getElementById('search').clicl()
    // document.getElementById("searchProds").addEventListener("click", function () {
    //     console.log('fdcx');
    //     // form.submit();
    // });

</script>
