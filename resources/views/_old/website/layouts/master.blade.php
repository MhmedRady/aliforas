<!DOCTYPE html>
<html lang="en">

@include('website.includes.head')

  <body class="bg-light {{app()->getLocale() == "ar"?"rtl":''}}">

    <input type="hidden" id="cart_url" value="{{url('cart')}}" />

    <!-- loader start -->

    <div class="loader-wrapper">
        <div class="preloader">
            <div class="loader">
                <div class="loader-outer"></div>
                <div class="loader-inner"></div>

                <div class="indicator">
                    <svg width="16px" height="12px">
                        <polyline id="back" points="1 6 4 6 6 11 10 1 12 6 15 6"></polyline>
                        <polyline id="front" points="1 6 4 6 6 11 10 1 12 6 15 6"></polyline>
                    </svg>
                </div>

            </div>
        </div>
    </div>
{{--        <div class="loader-wrapper">--}}
{{--            <div>--}}
{{--                <img src="{{asset("website/images/loader.gif")}}" alt="loader">--}}
{{--            </div>--}}
{{--        </div>--}}
    <!-- loader end -->

    @include('website.includes.header')

    <section class="b-g">
        @yield('content')
    </section>

    @include('website.includes.footer')

  </body>
</html>
