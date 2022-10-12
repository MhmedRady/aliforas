@extends('root.layouts.app')
@section('title',__('layouts.contactUs'))
@section('stylesheet')

@endsection

@section('content')

{{--    <!-- breadcrumb start -->--}}
{{--    <div class="breadcrumb-main">--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="col">--}}
{{--                    <div class="breadcrumb-contain">--}}
{{--                        <div>--}}
{{--                            <h2>{{__('layouts.contactUs')}}</h2>--}}
{{--                            <ul>--}}
{{--                                <li><a href="{{route('index')}}">{{__('layouts.home')}}</a></li>--}}
{{--                                <li><i class="fa fa-angle-double-right"></i></li>--}}
{{--                                <li><a href="javascript:void(0)">{{__('layouts.contactUs')}}</a></li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <!-- breadcrumb End -->--}}

    <!--section start-->
    <section class="contact-page section-big-py-space b-g-light">
        <div class="custom-container">
            <div class="row justify-content-center section-big-pb-space">
                @include('root.message.message')
                <h3 class="text-center fw-normal mb-4">{{__('layouts.yourMessage')}}</h3>
                <div class="col-md-5">
                    <div class="row">
                        <form class="theme-form" action="{{route('sendContactMessage')}}" method="post">
                            @csrf
                            <div class="col-md-12">
                                <h3 class="f-4 fw-normal mb-5">@lang('layouts.usMessage')</h3>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name" requ> {{__('auth.fullName')}}</label>
                                    <input id="name" type="text" class="form-control rounded" name="name"
                                           value="{{old('name')}}">
                                    @error('name')
                                    <span class="invalid-feedback d-block" role="alert">
                                                <strong style="color: red;font-size: 15px;">{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="email" requ> {{__('auth.Email')}}</label>
                                    <input id="email" type="email" class="form-control rounded" name="email"
                                           value="{{old('email')}}">
                                    @error('email')
                                    <span class="invalid-feedback d-block" role="alert">
                                                <strong style="color: red;font-size: 15px;">{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="phone" requ> {{__('auth.phoneNumber')}}</label>
                                    <input id="phone" type="text" class="form-control rounded" name="phone" autocomplete="off" aria-autocomplete="false"
                                           value="{{old('phone')}}" placeholder="{{__('auth.phoneNumber')}}">
                                    @error('phone')
                                    <span class="invalid-feedback d-block" role="alert">
                                                <strong style="color: red;font-size: 15px;">{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div>
                                    <label for="message" requ> {{__('layouts.yourMessage')}}</label>
                                    <textarea id="message" class="form-control rounded m-0" placeholder="{{__('layouts.yourMessage')}}" name="message" rows="2"></textarea>
                                    @error('message')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong style="color: red;font-size: 15px;">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <button class="btn btn-primary btn-black text-center w-100 mt-3" type="submit">
                                    @lang('Send')
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="row theme-form location-details mt-md-5">
{{--                        <div class="">--}}
                        <div class="col-md-12 _br"></div>
                        @if($mainSetting['address'])
                            <div class="col-md-12 mb-5">
                                <i data-feather="map-pin"></i>
                                <span>
                                    {{$mainSetting['address']}}.
                                </span>
                            </div>
                        @endif
                        @if($mainSetting['phone'])
                            <div class="col-md-12 mb-5">
                                <i data-feather="phone-call"></i>
                                <a class="text-decoration-underline">
                                    {{$mainSetting['phone']}}
                                </a>
                            </div>
                        @endif
                        @if($mainSetting['whatsapp'])
                            <div class="col-md-12 whatsApp mb-5">
                                <i class="fa fa-whatsapp"></i>
                                <a href="https://wa.me/{{$mainSetting['whatsapp']}}" class="text-decoration-underline">
                                    <u>{{$mainSetting['whatsapp']}}</u>
                                </a>
                            </div>
                        @endif
                        @if($mainSetting['email'])
                            <div class="col-md-12 whatsApp mb-5">
                                <i data-feather="mail"></i>
                                <a href="mailto:{{$mainSetting['email']}}" class="text-decoration-underline">
                                    <u>{{$mainSetting['email']}}</u>
                                </a>
                            </div>
                        @endif
                        @if($mainSetting['fax'])
                            <div class="col-md-12 whatsApp mb-5">
                                <i data-feather="printer"></i>
                                <span>
                                    {{$mainSetting['fax']}}
                                </span>
                            </div>
                        @endif
                        @if($mainSetting['address'] && $mainSetting['lat'] && $mainSetting['lng'])
                            <div class="col-md-12">
                                <div id="map" class="bg-white googel-map img-thumbnail"></div>
                            </div>
                        @endif
                        </div>
                    </div>
                </div>

        </div>
    </section>
    <!--Section ends-->


@endsection

@push('scripts')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDIFAyuWCZJGUcMRot40ntC691r2LmlBVM&sensor=false&language={{app()->getLocale()}}"></script>

    <script>
        let reqLabels = document.querySelectorAll("[requ='']");


        function addAsst(){
            if (reqLabels.length>0)
            {
                reqLabels.forEach((el) => {
                    let asst= document.createElement(`small`);
                    asst.setAttribute('class','asst');
                    asst.innerText = '*';
                    el.insertBefore(asst,el.firstChild);
                });
            }
        }
        addAsst();

    </script>

    <script>

        var google;

        function init() {
            // Basic options for a simple Google Map
            // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
            // var myLatlng = new google.maps.LatLng(40.71751, -73.990922);
            var myLatlng = new google.maps.LatLng({{$mainSetting['lat']}}, {{$mainSetting['lng']}});
            // 39.399872
            // -8.224454

            var mapOptions = {
                // How zoomed in you want the map to start at (always required)
                zoom: 7,

                // The latitude and longitude to center the map (always required)
                center: myLatlng,

                // How you would like to style the map.
                scrollwheel: false,
                styles: [
                    {
                        "featureType": "administrative.country",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "visibility": "simplified"
                            },
                            {
                                "hue": "#ff0000"
                            }
                        ]
                    }
                ]
            };

            // Get the HTML DOM element that will contain your map
            // We are using a div with id="map" seen below in the <body>
            var mapElement = document.getElementById('map');

            // Create the Google Map using out element and options defined above
            var map = new google.maps.Map(mapElement, mapOptions);

            var addresses = ['{{$mainSetting['address']}}'??'Egypt'];

            for (let x = 0; x < addresses.length; x++) {
                $.getJSON('http://maps.googleapis.com/maps/api/geocode/json?address='+"{{$mainSetting['address']}}"+'&sensor=false', null, function (data) {
                    let p = data.results[0].geometry.location
                    let latlng = new google.maps.LatLng(p.lat, p.lng);
                    new google.maps.Marker({
                        position: latlng,
                        map: map,
                        icon: 'images/loc.png'
                    });

                });
            }
        }
        google.maps.event.addDomListener(window, 'load', init);
    </script>

@endpush
