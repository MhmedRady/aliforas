@extends('admin.layouts.contentLayoutMaster')
@section('title',$seller->name . " Seller")
@section('content')
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Users</h4>
            </div>
            <div class="col-md-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item "><a href="javascript:void(0)">Users</a></li>
                        <li class="breadcrumb-item active">create</li>
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

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body wizard-content seller_profile">

                        <form action="{{route('admin.editSeller',$seller->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{$seller->id}}">
                            <h4>Seller Information</h4>
                            <section>
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6>
                                            <i class="ti-user" aria-hidden="true"></i>
                                            user data
                                        </h6>

                                        <div class="form-row" aria-hidden="true">
                                            <div class="form-group col-md-6">
                                                <label for="username">Seller Name</label>
                                                <input type="text" name="name" class="form-control" id="username" value="{{$seller->name}}">
                                                @error('name')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="username">Email</label>
                                                <input type="email" name="email" class="form-control" id="username" value="{{$seller->email}}">
                                                @error('email')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="verified_at">Verification Date</label>
                                                <input type="text" class="form-control" disabled id="verified_at" value="{{$seller->email_verified_at?? "--/--/-- 00:00:00"}}" readonly>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="verified_at">Last Update</label>
                                                <input type="text" class="form-control" disabled id="verified_at" value="{{$seller->updated_at?? "--/--/-- 00:00:00"}}" readonly>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="contact_number">Contact Number</label>
                                                <input type="text" name="contact_number" class="form-control" id="contact_number" value="{{$seller->contact_number}}">
                                                @error('contact_number')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group col-md-6">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active" {{$seller->is_active == 1 ? "checked" : ""}}>
                                                    <label class="form-check-label" for="is_active">Check Seller Activate</label>
                                                </div>
                                                @error('is_active')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="gender">Gender</label>
                                                <select class="custom-select" id="gender">
                                                    <option selected disabled value="">Choose...</option>
                                                    <option value="m" {{$seller->gender == "Mail"? "selected":""}}>Mail</option>
                                                    <option value="f" {{$seller->gender == "Female"? "selected":""}}>Female</option>
                                                  </select>
                                                @error('gender')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="password">Password</label>
                                                <input type="password" name="password" class="form-control" id="password">
                                                <small>(Leave it Empty To Use The current Password)</small>
                                                @error('password')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group col">
                                                <label for="id_img">National Image</label>
                                                <small>(Leave it Empty To Use The current Password)</small>
                                                <input type="file" name="id_img" class="form-control" id="id_img" value="{{$seller->seller->pickup_building_number}}">
                                                @error('id_img')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                @enderror

                                                <img src="{{url("public/".$seller->sellerFile->path)}}" alt="{{$seller->name}}" class="w-100">
                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-md-6">
                                        <h6>
                                            <i class="ti-tag" aria-hidden="true"></i>
                                            seller data
                                        </h6>
                                        <div class="form-row" aria-hidden="true">
                                            <div class="form-group col-md-6">
                                                <label for="username">Seller Name</label>
                                                <input type="text" name="name" class="form-control" id="username" value="{{$seller->name}}">
                                                @error('name')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="document_first_name">First Name</label>
                                                <input type="text" name="document_first_name" class="form-control" id="document_first_name" value="{{$seller->seller->document_first_name}}">
                                                @error('document_first_name')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="document_last_name">Last Name</label>
                                                <input type="text" name="document_last_name" class="form-control" id="document_last_name" value="{{$seller->seller->document_last_name}}">
                                                @error('document_last_name')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="document_id">National Id</label>
                                                <input type="text" name="document_id" class="form-control" id="document_id" value="{{$seller->seller->document_id}}">
                                                @error('document_id')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="document_last_name">National Expiry Date</label>
                                                <input type="date" name="document_expiry_date" class="form-control" id="document_expiry_date" value="{{$seller->seller->document_expiry_date}}">
                                                @error('document_expiry_date')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="pickup_city">City</label>
                                                <input type="text" name="pickup_city" class="form-control" id="pickup_city" value="{{$seller->seller->pickup_city}}">
                                                @error('pickup_city')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="pickup_street">Street</label>
                                                <input type="text" name="pickup_street" class="form-control" id="pickup_street" value="{{$seller->seller->pickup_street}}">
                                                @error('pickup_street')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="pickup_contact_number">Contact Number</label>
                                                <input type="text" name="pickup_contact_number" class="form-control" id="pickup_contact_number" value="{{$seller->seller->pickup_contact_number}}">
                                                @error('pickup_contact_number')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="pickup_building_number">Build Number</label>
                                                <input type="text" name="pickup_building_number" class="form-control" id="pickup_building_number" value="{{$seller->seller->pickup_building_number}}">
                                                @error('pickup_building_number')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="store_name">Store Name</label>
                                                <input type="text" name="store_name" class="form-control" id="store_name" value="{{$seller->seller->store_name}}">
                                                @error('store_name')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group col">
                                                <p>{{__("seller.AccType")}}</p>
                                                <div id="radio">
                                                    <input class="" type="radio"  id="individual" name="cat" value="individual" {{$seller->seller->account_legal_type !== "Company Registration" ? "checked":""}}>
                                                    <label  for="individual ">{{__("seller.Professional")}}.
                                                    </label><br>
                                                    <input type="radio" id="business" name="cat" value="business" {{$seller->seller->account_legal_type == "Company Registration" ? "checked":""}}>
                                                    <label for="business"> {{__("seller.business")}}.</label>
                                                </div>
                                                <div class="form-group" id="sellerType">

                                                </div>
                                            </div>

                                            <div class="form-group col-12">
                                                <label class="fieldlabels">{{__('seller.address')}}</label>

                                                <input type="text" id="pac-input" name="address"
                                                class="form-control" value="{{$seller->seller->address}}">

                                                <input type="hidden" id="latitude" name="lat" value="{{$seller->seller->lat}}"/>
                                                <input type="hidden" id="longitude" name="lng" value="{{$seller->seller->lng}}"/>
                                                <div class="map" style="width:100%;min-height:250px;"></div>

                                                <button type="button" class="getLocation btn btn-info mb-3 shadow font-weight-bold">{{__("seller.currentLoc")}}</button>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <button type="submit" class="btn btn-info mr-1" style="width:30%;">Save</button>
                                            <a href="{{ URL::previous() }}" class="btn btn-dark" style="width:20%;">Back</a>
                                        </div>
                                    </div>


                                </form>

                                    {{-- <div class="col-md-6">
                                        <h6>
                                            <i class="ti-tag" aria-hidden="true"></i>
                                            Branches data
                                        </h6>

                                        <div class="table-responsive m-t-10">
                                            <table id="myTable" class="table table-bordered table-striped text-center">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>{{__("seller.bName")}}</th>
                                                        <th>{{__("seller.controles")}}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($seller->sellerBranch as $key => $branch)
                                                        <tr>
                                                            <td>{{$key+1}}</td>
                                                            <td>{{$branch->name}}</td>
                                                            <td>
                                                                <a href="{{route('seller.branch.show',$branch->id)}}" type="button" class="btn waves-effect waves-light btn-outline-info"><i class="ti-pencil-alt"></i></a>
                                                                <button type="button" class="btn waves-effect waves-light btn-outline-danger sa-warning" data-toggle="modal" data-target="#delete{{$branch->id}}"><i class=" ti-trash"></i></button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>

                                    <div class="col-md-6">
                                        <h6>
                                            <i class="ti-layout-grid2" aria-hidden="true"></i>
                                            Products data
                                        </h6>
                                    </div> --}}
                                </div>

                            </section>


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

    <link href="{{asset('admin-asset/assets/node_modules/wizard/steps.css')}}" rel="stylesheet">
    <link href="{{asset('admin-asset/assets/node_modules/sweetalert/sweetalert.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('admin-asset/dist/css/custom.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('admin-asset/assets/node_modules/summernote/dist/summernote-bs4.css')}}">

@endsection
@section('page-script')

    <script src="{{asset('admin-asset/assets/node_modules/wizard/jquery.steps.min.js')}}"></script>
    <script src="{{asset('admin-asset/assets/node_modules/wizard/jquery.validate.min.js')}}"></script>
    <script src="{{asset('admin-asset/assets/node_modules/sweetalert/sweetalert.min.js')}}"></script>
    <script src="{{asset('admin-asset/assets/node_modules/summernote/dist/summernote-bs4.min.js')}}"></script>
    <script type="text/javascript">
        var form = $("#add_user_form");
        form.validate({
            errorPlacement: function errorPlacement(error, element) { element.before(error); },
            rules: {
                password_confirmation: {
                    equalTo: "#password"
                }
            }
        });
        form.steps({
            headerTag: "h6",
            bodyTag: "section",
            transitionEffect: "fade",
            titleTemplate: '<span class="step">#index#</span> #title#',
            labels: {
                finish: "Submit"
            },
            onStepChanging: function (event, currentIndex, newIndex)
            {
                form.validate().settings.ignore = ":disabled,:hidden";
                return form.valid();
            },
            onFinishing: function (event, currentIndex)
            {
                form.validate().settings.ignore = ":disabled";
                return form.valid();
            },
            onFinished: function (event, currentIndex) {
                form.submit();
            }
        });
    </script>

<script>

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
            input.innerText = "{{ $seller->seller->address }}";;
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


@endsection
