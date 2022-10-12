
<!-- footer start -->
<footer>
    <a class="mobile-cart-open" href="javascript:void(0)" onclick="openCart()">
        <div class="cart-block">
            <div class="cart-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart3" viewBox="0 0 16 16">
                    <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                </svg>
            </div>
            <span class="item-count-contain btn badge btn-danger">0</span>
        </div>
    </a>

    @if($mainSetting->where('key','whatsapp')->first()->value && $mainSetting->where('key','whatsapp')->count())
        <a href="https://wa.me/{{$mainSetting->where('key','whatsapp')->first()->value}}" class="whatsApp link">
            <i class="fa fa-whatsapp"></i>
        </a>
    @endif
    <div class="footer1">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="footer-main">
                        <div class="footer-box">
                            <div class="footer-title">
                                <h5>{{__('auth.myAccount')}}</h5>
                            </div>
                            <div class="footer-contant">
                                <ul>
                                    <li>
                                        <a class="dark-menu-item" href="{{ route('user-profile-show') }}">{{__('auth.PERSONAL DETAIL')}}</a>
                                    </li>
                                    <li>
                                        <a class="dark-menu-item" href="{{ route('view-update-profile') }}">{{__('auth.editProfile')}}</a>
                                    </li>

                                    <li>
                                        <a class="dark-menu-item" href="{{ route('show.related.orders') }}">{{__('auth.myOrders')}}</a>
                                    </li>

                                    <li>
                                        <a class="dark-menu-item" href="{{ route('view-addresses') }}">{{__('auth.SHIPPING ADDRESS')}}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>


                            <div class="footer-box">
                                <div class="footer-title">
                                    <h5>{{__('layouts.quickLink')}}</h5>
                                </div>
                                <div class="footer-contant">
                                    <ul>
                                        <li>
                                            <a class="dark-menu-item" href="{{ route('index') }}">{{__('layouts.home')}}</a>
                                        </li>
                                        <li>
                                            <a class="dark-menu-item" href="{{ route('products.index') }}">{{__('layouts.sopping')}}</a>
                                        </li>
                                        @if($aboutUs->count())
                                            <li>
                                                <a class="dark-menu-item" href="{{ route('aboutUs') }}">{{__('layouts.aboutUs')}}</a>
                                            </li>
                                        @endif

                                        <li>
                                            <a class="dark-menu-item" href="{{ route('contactUs') }}">{{__('layouts.contactUs')}}</a>
                                        </li>
                                        @if($customPages->count())
                                            @foreach($customPages as $page)
                                                <li>
                                                    <a class="dark-menu-item" href="{{ route('openPageContent',$page->slug) }}">{{$page->name}}</a>
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        @if($mainSetting->where('key','address_'.app()->getLocale())->count())
                        <div class="footer-box">
                            <div class="footer-title">
                                <h5>{{__('layouts.contactUs')}}</h5>
                            </div>
                            <div class="footer-contant">
                                <ul class="contact-list">
                                    @if($mainSetting->where('key','address_'.app()->getLocale())->count())
                                    <li>
                                        <i class="fa fa-map-marker"></i>
                                        <span>
                                            {{$mainSetting->where('key','address_'.app()->getLocale())->first()->value}}
                                        </span>
                                    </li>
                                    @endif
                                    @if($mainSetting->where('key','phone')->count())
                                        <li><i class="fa fa-phone"></i>{{__('layouts.contactUs')}}:

                                            <span>
                                                <a href="tel:{{$mainSetting->where('key','phone')->first()->value}}">
                                                    {{$mainSetting->where('key','phone')->first()->value}}
                                                </a>

                                            </span>
                                        </li>
                                    @endif
                                    @if($mainSetting->where('key','email')->count())
                                        <li><i class="fa fa-phone"></i>{{__('auth.Email')}}:
                                        <span>
                                            <a href="mailto:{{$mainSetting->where('key','email')->first()->value}}">
                                                {{$mainSetting->where('key','email')->first()->value}}
                                            </a>
                                        </span>
                                        </li>
                                    @endif
                                    @if($mainSetting->where('key','fax')->count())
                                        <li><i class="fa fa-phone"></i>{{__('auth.fax')}}:
                                        <span>
                                            {{$mainSetting->where('key','fax')->first()->value}}
                                        </span>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                        @endif
                        <div class="footer-box">
                            <div class="footer-title ">
                                <h5>{{__('layouts.newsletter')}}</h5>
                            </div>
                            <div class="footer-contant">
                                <p>It is a long established fact that a reader will be distracted by the readable
                                    content.</p>
                                <div class="news-letter">
                                    <div class="input-group">
                                        <input id="SubscribeInput2" type="text" class="form-control" placeholder="email address">
                                        <button id="sendSubscribe2" disabled class="input-group-text">go</button>
                                    </div>
                                    <span id="alertSubscribe2" class="text-danger"></span>
                                </div>
                                <ul class="sosiyal">
                                    @if($mainSetting->where('key','facebook')->first()->value)
                                        <li>
                                            <a href="{{$mainSetting->where('key','facebook')->first()->value}}">
                                                <i class="fa fa-facebook"></i>
                                            </a>
                                        </li>
                                    @endif
                                    @if($mainSetting->where('key','twitter')->first()->value)
                                        <li>
                                            <a href="{{$mainSetting->where('key','twitter')->first()->value}}">
                                                <i class="fa fa-twitter"></i>
                                            </a>
                                        </li>
                                    @endif
                                    @if($mainSetting->where('key','instagram')->first()->value)
                                        <li>
                                            <a href="{{$mainSetting->where('key','instagram')->first()->value}}">
                                                <i class="fa fa-instagram"></i>
                                            </a>
                                        </li>
                                    @endif

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="subfooter dark-footer ">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="footer-left">
                        <p>&copy; {{ now()->year }} Copyright</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="footer-right">
                        <ul class="payment">
                            <li>
                                <a href="javascript:void(0)">
                                    <img src="{{asset('assets/images/pay/1.png')}}" class="img-fluid"
                                         alt="pay">
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <img src="{{asset('assets/images/pay/2.png')}}" class="img-fluid"
                                         alt="pay">
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <img src="{{asset('assets/images/pay/3.png')}}" class="img-fluid"
                                         alt="pay">
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <img src="{{asset('assets/images/pay/4.png')}}" class="img-fluid"
                                         alt="pay">
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <img src="{{asset('assets/images/pay/5.png')}}" class="img-fluid"
                                         alt="pay">
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- footer end -->

