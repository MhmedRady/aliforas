@extends('seller.layouts.apper')
@section('container')
    <div class="container">
        <div class="row">
            <div class="col-12 text-center p-0 mt-3 mb-2">
                <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                    
                    <div class="inner-cl ml-auto" style="font-size: 1.1rem;">
                        <div class="block block-language form-language mr-2 ml-2" style="background-color: #006099;color: #eee;padding: 5px;">
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            @if (\Lang::getLocale() == $localeCode)
                                <span>
                                    <img class="m-1" src="{{ asset( "website/images/{$localeCode}.png") }}" srcset="">
                                    {{ $properties['native'] }}
                                </span>    
                            @else
                                <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                    <img class="m-1" src="{{ asset( "website/images/{$localeCode}.png") }}" srcset="">
                                    {{ $properties['native'] }}
                                </a>
                            @endif
                        @endforeach
                        </div>
                    </div>
                    
                    <h2 id="heading"> {{__("seller.New_Seller")}} </h2>
                    
                    <p class=role style="font-weight: bold;color: #ff6161;">
                        {{__("seller.astRoles")}}</p>
                    
                    <form id="msform" action="{{route('storeSeller')}}" method="post" enctype="multipart/form-data">
                        @csrf
                    
                        <!-- progressbar -->
                        <ul id="progressbar">
                            <li class="active" id="account"><strong>{{__("seller.ContactInf")}}</strong></li>
                            <li id="personal"><strong>{{__("seller.AccountVer")}}</strong></li>
                            <li id="order"><strong>{{__("seller.OrderLocat")}}</strong></li>
                            <li id="overview"><strong>{{__("seller.StoreName")}}</strong></li>
                            <li id="store"><strong>{{__("seller.Finish")}}</strong></li>
                        </ul>
                        
                        
                        
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                        </div> 
                        
                        <br> <!-- fieldsets -->
                        
                        <div class="form-card {{\Lang::getLocale() == "en" ? "text-left": "text-right"}}">
                            @include('seller.form.account')
                            @include('seller.form.verification')
                            
                            @include('seller.form.pickup')
                            
                            @include('seller.form.store_name')
                            @include('seller.form.finish')
                        </div>
                            
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('style')
    <link rel="stylesheet" href="{{asset('assets/css/seller.css')}}" type="text/css">

@endsection
@section('scripts')

    

    <script>
        let fieldItem_1 = document.querySelector("#append_first_name"),
        fieldText_1 = fieldItem_1.getAttribute("data-cont"),
        usernameVal_1 = null
        $("#document_first_name").on("input", function(){
            usernameVal_1 = $(this).val();
            $("#append_first_name").html(fieldText_1 + ' : ' + usernameVal_1)
        });

        let fieldItem_2 = document.querySelector("#append_contact_number"),
        fieldText_2 = fieldItem_2.getAttribute("data-cont"),
        usernameVal_2 = null
        $("#document_contact_number").on("input", function(){
            usernameVal_2 ? $(this).val() : "not available"
            $("#append_contact_number").html(fieldText_2 + ' : ' + usernameVal_2)
        });

        let fieldItem_3 = document.querySelector("#append_store_name"),
        fieldText_3 = fieldItem_3.getAttribute("data-cont"),
        usernameVal_3 = null
        $("#documnet_store_name").on("input", function(){
            usernameVal_3 = $(this).val();
            $("#append_store_name").html(fieldText_3 + ' : ' + usernameVal_3)
        });

        let fieldItem_4 = document.querySelector("#append_document_id"),
        fieldText_4 = fieldItem_4.getAttribute("data-cont"),
        usernameVal_4 = null
        $("#document_id").on("input", function(){
            usernameVal_4 = $(this).val();
            $("#append_document_id").html(fieldText_4 + ' : ' + usernameVal_4)
        });

        let fieldItem_5 = document.querySelector("#append_pickup_street"),
        fieldText_5 = fieldItem_5.getAttribute("data-cont"),
        usernameVal_5 = null
        $("#document_pick_street").on("input", function(){
            usernameVal_5 = $(this).val();
            $("#append_pickup_street").html(fieldText_5 + ' : ' + usernameVal_5)
        });

        $("#pac-input").focusin(function() {
            $(this).val('');
        });
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
                    center: {lat: 30.033333, lng: 31.233334},
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
                $("#pac-input").val("");
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
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDIFAyuWCZJGUcMRot40ntC691r2LmlBVM&libraries=places&callback=initAutocomplete&language=ar&region=EG
    async defer"></script>
    
    <script src="{{asset('assets/js/seller.js')}}"></script>

    <script>
        const accountErr = false;
        const getInputVal = function (name, msg) {

            const error = document.querySelector(`#error-${name}`),
                  input = $(`#${name}`);
      
            if ($(`#${name}`).val() == "" || $(`#${name}`).val() == 0) {

                error.style.display = "block";
                input.addClass("invalid-input");
                error.innerText = msg;
                  
                return false;

            }else if(name == "password" || name == "confirm_password"){
                
                if($(`#${name}`).val().length < 8){
                    error.style.display = "block";
                    input.addClass("invalid-input");
                    error.innerText = "{{ __('seller.pass8') }}";
                    return false;
                }else if(name == "confirm_password"){
                        if($(`#${name}`).val() !== $(`#password`).val()){
                            
                            error.style.display = "block";
                            input.addClass("invalid-input");
                            error.innerText = msg;
                            return false;
                        }
                    }
                
            } 
            error.style.display = "none";
            input.removeClass("invalid-input");
            error.innerText = "";
            return true;
        }

/*
else if(name == "confirm_password"){
                    
    if($(`#${name}`).val() !== $(`#password`).val()){
        
        error.style.display = "block";
        input.addClass("invalid-input");
        error.innerText = msg;
    }
}
*/

        let form = $("#msform"),
            sAccount = $("#step_account"),
            sPickup = $("#step_pickup"),
            sStore = $("#step_store"),
            sVerification = $("#step_verification"),

            _sAccount = $("#_step_account"),
            _sVerif   = $("#_step_verification")
            _sPickup  = $("#_step_pickup"),
            _sStore   = $("#_step_store");

        sAccount.on("click", function() {
            var fName = getInputVal("document_user_name","{{ __('seller.userNameEmp') }}");
            var cNumber = getInputVal("document_contact_number","{{ __('seller.contactNumberEmp') }}");
            var pass = getInputVal("password","{{ __('seller.passEmp') }}");
            var cPass = getInputVal("confirm_password","{{ __('seller.confirmPassEmp') }}");
            
            if (fName && cNumber && pass && cPass){
                _sAccount.click();
            }
        });

        sVerification.on("click", function() {
            var sfName = getInputVal("document_first_name","{{ __('seller.fNameEmp') }}");
            var slName = getInputVal("document_last_name","{{ __('seller.lNameEmp') }}");
            
            if (sfName && slName){
                _sVerif.click();
            }
        });

        sPickup.on("click", function() {
            /* var pCity  = getInputVal("pickup_city","{{ __('seller.pCity') }}");
            var pStr   = getInputVal("document_pick_street","{{ __('seller.pStr') }}"); */
            var pNumer = getInputVal("pickup_contact_number","{{ __('seller.pNumer') }}");
            var padrss = getInputVal("pac-input","{{ __('seller.padrss') }}");
            
            if (pNumer && padrss){
                _sPickup.click();
            }
        });

        sStore.on("click", function() {
            var STORE  = getInputVal("documnet_store_name","{{ __('seller.storeErr') }}");
            
            if (STORE){
                _sStore.click();
            }
        });

    </script>
 @endsection
