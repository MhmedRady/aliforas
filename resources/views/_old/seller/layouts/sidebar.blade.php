<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- User Profile-->
        <div class="user-profile">
            <div class="user-pro-body">
                <div><img src="{{asset('admin-asset/assets/images/users/2.jpg')}}" alt="user-img" class="img-circle"></div>
                <div class="dropdown">
                    <a href="javascript:void(0)" class="dropdown-toggle u-dropdown link hide-menu" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    <span class="caret">{{Auth::user()->name}}</span></a>
                    <div class="dropdown-menu animated flipInY">
                        <!-- text-->
                        <a href="{{route('seller.user.profile')}}" class="dropdown-item"><i class="ti-user"></i> {{__("seller.Profile")}} </a>
                        <!-- text-->
                        <div class="dropdown-divider"></div>
                        <!-- text-->
                        <div class="dropdown-divider"></div>
                        <!-- text-->
                        <a href="{{route('seller.logout')}}" class="dropdown-item"><i class="fa fa-power-off"></i> {{__("seller.logout")}}</a>
                        <!-- text-->
                    </div>
                </div>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">

            <ul id="sidebarnav">
                <li> <a class="waves-effect waves-dark" href="{{ route('seller.home')  }}" aria-expanded="false"><i class="icon-speedometer"></i><span class="hide-menu">{{__("seller.Dashboard")}}</span></a></li>
                <li> <a class="waves-effect waves-dark" href="{{route('seller.branchs')}}" aria-expanded="false"><i class="ti-layout"></i><span class="hide-menu">{{__("seller.branchs")}}</span></a></li>
                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-layout-grid2"></i><span class="hide-menu">{{__("seller.productList")}}</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li> <a class="waves-effect waves-dark" href="/seller/products" aria-expanded="false"></i><span class="hide-menu">{{__("seller.Products")}}</span></a></li>
                        <li><a href="/seller/products/onsale">{{__("seller.pOnSale")}}</a></li>
                        <li><a href="/seller/products/hot">{{__("seller.hotProducts")}}</a></li>
                    </ul>
                </li>
                <li> <a class="waves-effect waves-dark" href="/seller/orders" aria-expanded="false"><i class="ti-shopping-cart"></i><span class="hide-menu">{{__("seller.orders")}}</span></a></li>
                <!--------------------------contactuser------------------->
                <div class="inner-cl ml-auto" style="font-size: 1.1rem;">
                    <div class="block block-language form-language">
                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        @if (\Lang::getLocale() == $localeCode)
                            <span>
                                <img class="m-1" src="{{ asset( "website/images/panel/{$localeCode}.png") }}" srcset="">
                                {{ $properties['native'] }}
                            </span>
                        @else
                            <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                <img class="m-1" src="{{ asset( "website/images/panel/{$localeCode}.png") }}" srcset="">
                                {{ $properties['native'] }}
                            </a>
                        @endif
                    @endforeach
                    </div>
                </div>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
