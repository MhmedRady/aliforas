@extends('admin.layouts.contentLayoutMaster')
@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12 col-12">
                <div class="card">
                    <div class="card-body">

                        <!-- ============================================================== -->
                        <!-- Bread crumb and right sidebar toggle -->
                        <!-- ============================================================== -->

                        <div class="row page-titles mb-2">
                            <div class="col-md-5 align-self-center">
                                <h4 class="text-themecolor">Settings</h4>
                            </div>
                            <div class="col-md-7 align-self-center text-right">
                                <div class="d-flex justify-content-end align-items-center">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                        <li class="breadcrumb-item "><a href="javascript:void(0)">Settings</a></li>
                                        <li class="breadcrumb-item active">Main Setting</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        <!-- ============================================================== -->
                        <!-- End Bread crumb and right sidebar toggle -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- Start Page Content -->
                        <!-- ============================================================== -->

                        <h5 class="card-title text-center">Main Setting</h5>
                        <hr class="mb-2"/>

                        <form action="{{ route('admin.setting.main_setting_post') }}" method="post">
                            @csrf
                            <div class="row mb-2">
                                <div class="col-md-12 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="pac-input">
                                            <i data-feather="map-pin"></i> Address
                                            @error("address")
                                            <span class="invalid-feedback d-block">
                                                {{$message}}
                                            </span>
                                            @enderror
                                        </label>

                                        <div class="input-group input-group-merge">
                                            <input type="text" class="col-md-6 form-control" id="pac-input" name="address" value="{{old("address")??main_setting_key_value($setting,"address")}}" autocomplete="off"/>
                                        </div>
                                        <input type="hidden" id="latitude" name="lat" class="form-control" value="{{old("lat")??main_setting_key_value($setting,"lat")}}">

                                        <input type="hidden" id="longitude" name="lng" class="form-control" value="{{old("lng")??main_setting_key_value($setting,"lng")}}">

{{--                                    <input type="text" id="pac-input" name="address" class="form-control" >--}}
                                    </div>
                                </div>
                                <div class="col-12 mb-2">
                                    <div class="map" style="height:300px;width:100%"></div>
                                    <button type="button" class="getLocation btn btn-waring mb-3 shadow font-weight-bold">
                                        <i data-feather="map-pin" height="20" width="20"></i>
                                        {{--                                    {{__('auth.currentLocation')}}--}}
                                    </button>
                                </div>

{{--                                @foreach($lang as $locale)--}}
{{--                                    <div class="col-md-6 col-12">--}}
{{--                                        <div class="mb-1">--}}
{{--                                            <label class="form-label" for="address-{{$locale->locale}}">--}}
{{--                                                <span class="badge btn-danger">{{$locale->name}}</span> Address--}}
{{--                                            </label>--}}
{{--                                            <div class="input-group input-group-merge">--}}
{{--                                            <span class="input-group-text">--}}
{{--                                                <i data-feather="map-pin"></i>--}}
{{--                                            </span>--}}
{{--                                                <input type="text" id="address-{{$locale->locale}}" class="form-control" name="address_{{$locale->locale}}"--}}
{{--                                                       value="{{old("address_$locale->locale")??main_setting_key_value($setting,"address_$locale->locale")}}"/>--}}

{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                @endforeach--}}
                                    <div class="col-md-6 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="taxes">Order Taxes <small>(Must Be Number Like 14)</small></label>
                                            <div class="input-group input-group-merge">
                                        <span class="input-group-text">
                                            <i data-feather="percent"></i>
                                        </span>
                                                <input type="text" id="taxes" class="form-control" name="taxes"
                                                       value="{{old('taxes')??main_setting_key_value($setting,'taxes')}}" />
                                                @error('taxes')
                                                <div class="invalid-feedback d-block">
                                                    <strong>
                                                        {{$message}}
                                                    </strong>
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="phone">Contact Mobile</label>
                                        <div class="input-group input-group-merge">
                                        <span class="input-group-text">
                                            <i data-feather="smartphone"></i>
                                        </span>
                                            <input type="number" id="phone" class="form-control" name="phone"
                                                   value="{{old('phone')??main_setting_key_value($setting,'phone')}}"/>
                                            @error('phone')
                                                <div class="invalid-feedback d-block">
                                                    <strong>
                                                        {{$message}}
                                                    </strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="whatsapp">Whatsapp Number</label>
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text">
                                                <i data-feather="smartphone"></i>
                                            </span>
                                            <input type="number" id="whatsapp" class="form-control" name="whatsapp"
                                                   value="{{old('whatsapp')??main_setting_key_value($setting,'whatsapp')}}"/>
                                            @error('whatsapp')
                                                <div class="invalid-feedback d-block">
                                                    <strong>
                                                        {{$message}}
                                                    </strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="email-id-icon">Contact Email</label>
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text">
                                                <i data-feather="mail"></i>
                                            </span>
                                            <input type="email" id="email-id-icon" class="form-control" name="email" placeholder="Email"
                                                   value="{{old('email')??main_setting_key_value($setting,'email')}}"/>
                                            @error('email')
                                                <div class="invalid-feedback d-block">
                                                    <strong>
                                                        {{$message}}
                                                    </strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="whatsapp">Fax Number</label>
                                        <div class="input-group input-group-merge">
                                        <span class="input-group-text">
                                            <i data-feather="smartphone"></i>
                                        </span>
                                            <input type="number" id="fax" class="form-control" name="fax"
                                                   value="{{old('fax')??main_setting_key_value($setting,'fax')}}"/>
                                            @error('fax')
                                            <div class="invalid-feedback d-block">
                                                <strong>
                                                    {{$message}}
                                                </strong>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <h5 class="card-title text-center">Social Media  Setting</h5>
                                <hr class="mb-2" style="height: 2px;"/>

                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="facebook">Facebook Link</label>
                                        <div class="input-group input-group-merge">
                                        <span class="input-group-text">
                                            <i data-feather="facebook"></i>
                                        </span>
                                            <input type="text" id="facebook" class="form-control" name="facebook"
                                                   value="{{old('facebook')??main_setting_key_value($setting,'facebook')}}" />
                                            @error('facebook')
                                                <div class="invalid-feedback d-block">
                                                    <strong>
                                                        {{$message}}
                                                    </strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="twitter">Twitter Link</label>
                                        <div class="input-group input-group-merge">
                                        <span class="input-group-text">
                                            <i data-feather="twitter"></i>
                                        </span>
                                            <input type="text" id="twitter" class="form-control" name="twitter"
                                                   value="{{old('twitter')??main_setting_key_value($setting,'twitter')}}"/>
                                            @error('twitter')
                                                <div class="invalid-feedback d-block">
                                                    <strong>
                                                        {{$message}}
                                                    </strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="instagram">Instagram Link</label>
                                        <div class="input-group input-group-merge">
                                        <span class="input-group-text">
                                            <i data-feather="instagram"></i>
                                        </span>
                                            <input type="text" id="instagram" class="form-control" name="instagram"
                                                   value="{{old('instagram')??main_setting_key_value($setting,'instagram')}}"/>
                                            @error('instagram')
                                                <div class="invalid-feedback d-block">
                                                    <strong>
                                                        {{$message}}
                                                    </strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 col-12">
                                    <button type="submit" class="btn btn-primary me-1">Submit</button>
                                    <button type="reset" class="btn btn-outline-secondary">Reset</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->
    </div>
@endsection
@section('page-style')
    <style>
        label{
            font-size: 1rem !important;
        }
    </style>
@endsection
@section('page-script')

    <script>

        $('#latitude').focusin(function() {
            $(this).val('');
        });
        $('#longitude').focusin(function() {
            $(this).val('');
        });
        // parameter when you first load the API. For example:
        function initAutocomplete() {
            $index = 0;
            $('.map').each(function(){

                var map = new google.maps.Map($('.map')[$index], {
                    center: {lat: {{old("lat", 30.033333)??main_setting_key_value($setting,"lat")}}, lng: {{old("lng", 31.233334)??main_setting_key_value($setting,"lng")}}},
                    zoom: 13,
                    mapTypeId: 'roadmap'
                });

                $index++;
                // move pin and current location
                infoWindow = new google.maps.InfoWindow;

                geocoder = new google.maps.Geocoder();

                const locationButton = document.querySelector(".getLocation");

                map.controls[google.maps.ControlPosition.BOTTOM_CENTER].push(locationButton);

                locationButton.addEventListener("click", (e) => {

                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(function(position) {
                            var pos = {
                                lat: position.coords.latitude,
                                lng: position.coords.longitude
                            };
                            map.setCenter(pos);
                            var marker = new google.maps.Marker({
                                position: new google.maps.LatLng(pos),
                                map: map,
                                title: $("#pac-input").attr("placeholder")
                            });
                            markers.push(marker);
                            marker.addListener('click', function() {
                                geocodeLatLng(geocoder, map, infoWindow,marker);
                            });
                            // to get current position address on load
                            google.maps.event.trigger(marker, 'click');
                        }, function() {
                            handleLocationError(true, infoWindow, map.getCenter());
                        });
                    } else {
                        // Browser doesn't support Geolocation
                        handleLocationError(false, infoWindow, map.getCenter());
                    }
                });

                var geocoder = new google.maps.Geocoder();
                google.maps.event.addListener(map, 'click', function(event) {
                    SelectedLatLng = event.latLng;
                    geocoder.geocode({
                        'latLng': event.latLng
                    }, function(results, status) {
                        if (status == google.maps.GeocoderStatus.OK) {
                            if (results[0]) {
                                deleteMarkers();
                                addMarkerRunTime(event.latLng);
                                SelectedLocation = results[0].formatted_address;
                                splitLatLng(String(event.latLng));
                                $("#latitude").val(results[0].geometry.location.lat());
                                $("#longitude").val(results[0].geometry.location.lng());
                                $("#pac-input").val(results[0].formatted_address);
                            }
                        }
                    });
                });
                function geocodeLatLng(geocoder, map, infowindow,markerCurrent) {
                    var latlng = {lat: markerCurrent.position.lat(), lng: markerCurrent.position.lng()};
                    $('#branch-latLng').val("("+markerCurrent.position.lat() +","+markerCurrent.position.lng()+")");
                    $('#latitude').val(markerCurrent.position.lat());
                    $('#longitude').val(markerCurrent.position.lng());
                    geocoder.geocode({'location': latlng}, function(results, status) {
                        if (status === 'OK') {
                            if (results[0]) {
                                map.setZoom(8);
                                var marker = new google.maps.Marker({
                                    position: latlng,
                                    map: map
                                });
                                markers.push(marker);
                                infowindow.setContent(results[0].formatted_address);
                                SelectedLocation = results[0].formatted_address;
                                $("#pac-input").val(results[0].formatted_address);
                                infowindow.open(map, marker);
                            } else {
                                window.alert('No results found');
                            }
                        } else {
                            window.alert('Geocoder failed due to: ' + status);
                        }
                    });
                    SelectedLatLng =(markerCurrent.position.lat(),markerCurrent.position.lng());
                }
                function addMarkerRunTime(location) {
                    var marker = new google.maps.Marker({
                        position: location,
                        map: map
                    });
                    markers.push(marker);
                }
                function setMapOnAll(map) {
                    for (var i = 0; i < markers.length; i++) {
                        markers[i].setMap(map);
                    }
                }
                function clearMarkers() {
                    setMapOnAll(null);
                }
                function deleteMarkers() {
                    clearMarkers();
                    markers = [];
                }
                // Create the search box and link it to the UI element.
                var input = document.getElementById('pac-input');
                {{--$("#pac-input").val({{__('auth.mapPlaceHolder')}});--}}
                input.setAttribute('placeholder','{{__('auth.mapPlaceHolder')}}');
                var searchBox = new google.maps.places.SearchBox(input);
                map.controls[google.maps.ControlPosition.TOP_RIGHT].push(input);
                // Bias the SearchBox results towards current map's viewport.
                map.addListener('bounds_changed', function() {
                    searchBox.setBounds(map.getBounds());
                });
                var markers = [];
                // Listen for the event fired when the user selects a prediction and retrieve
                // more details for that place.
                searchBox.addListener('places_changed', function() {
                    var places = searchBox.getPlaces();
                    if (places.length == 0) {
                        return;
                    }
                    // Clear out the old markers.
                    markers.forEach(function(marker) {
                        marker.setMap(null);
                    });
                    markers = [];
                    // For each place, get the icon, name and location.
                    var bounds = new google.maps.LatLngBounds();
                    places.forEach(function(place) {
                        if (!place.geometry) {
                            console.log("Returned place contains no geometry");
                            return;
                        }
                        var icon = {
                            url: place.icon,
                            size: new google.maps.Size(100, 100),
                            origin: new google.maps.Point(0, 0),
                            anchor: new google.maps.Point(17, 34),
                            scaledSize: new google.maps.Size(25, 25)
                        };
                        // Create a marker for each place.
                        markers.push(new google.maps.Marker({
                            map: map,
                            icon: icon,
                            title: place.name,
                            position: place.geometry.location
                        }));
                        $('#latitude').val(place.geometry.location.lat());
                        $('#longitude').val(place.geometry.location.lng());
                        if (place.geometry.viewport) {
                            // Only geocodes have viewport.
                            bounds.union(place.geometry.viewport);
                        } else {
                            bounds.extend(place.geometry.location);
                        }
                    });
                    map.fitBounds(bounds);
                });
            });
        }
        function handleLocationError(browserHasGeolocation, infoWindow, pos) {
            infoWindow.setPosition(pos);
            infoWindow.setContent(browserHasGeolocation ?
                'Error: The Geolocation service failed.' :
                'Error: Your browser doesn\'t support geolocation.');
            infoWindow.open(map);
        }
        function splitLatLng(latLng){
            var newString = latLng.substring(0, latLng.length-1);
            var newString2 = newString.substring(1);
            var trainindIdArray = newString2.split(',');
            var lat = trainindIdArray[0];
            var Lng  = trainindIdArray[1];
        }
        $('.getLocation').fadeIn(1000);
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDIFAyuWCZJGUcMRot40ntC691r2LmlBVM&libraries=places&callback=initAutocomplete&language={{app()->getLocale()}}&region=EG
    async defer"></script>
@endsection
