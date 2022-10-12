@extends('seller.layouts.app')
@section('title')
    {{__("seller.Branch")}}
    @isset($branch)
        {{$branch->getTranslation('name', $branch->lang) ?? "Branch"}}
    @endisset
@endsection
@section('container')
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">

                    @if(isset($branch))
                        {{$branch->getTranslation('name', $branch->lang) ?? "Branch"}}
                    @else
                        {{__("seller.Branch")}}
                    @endif

                </h4>
            </div>
            <div class="col-md-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">{{__("seller.Home")}}</a></li>
                        <li class="breadcrumb-item active">
                            @if(isset($branch))
                                {{$branch->getTranslation('name', $branch->lang)}}
                            @else
                                {{__("seller.branchs")}}
                            @endif
                        </li>
                    </ol>
                    <a href="{{route('seller.new.branch')}}" type="button" class="btn btn-info d-none d-lg-block m-l-15">{{__("seller.new",["var"=>__("seller.Branch")])}}</a>
                </div>
            </div>
        </div>

        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @if (Route::is("seller.branchs"))
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
                                        @forelse($branches as $key => $branch)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{$branch->name}}</td>
                                                <td>
                                                    <a href="{{route('seller.branch.show',$branch->id)}}" type="button" class="btn waves-effect waves-light btn-outline-info"><i class="far fa-edit"></i></a>
                                                    <button type="button" class="btn waves-effect waves-light btn-outline-danger sa-warning" data-toggle="modal" data-target="#delete{{$branch->id}}"><i class="far fa-trash-alt"></i></button>
                                                </td>
                                            </tr>

    <!--============================================Start Delete Branch=====================================================================-->

                                    <div class="modal fade" id="delete{{$branch->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="deleteBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="deleteBackdropLabel">{{__("seller.dBranch")}}</h5>
                                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body row g-3">
                                                    <div class="col-12">
                                                    <p>{{__("seller.arDelete")}}</p>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__("seller.cancle")}}</button>
                                                    <form action="branch/{{$branch->id}}" method="POST" style="display:inline-block">
                                                    @csrf
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button type="submit" class="btn btn-danger">{{__("seller.dBranch")}}</button>
                                                </form>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

    <!--==============================================End Delete Branch=====================================================================-->

                                        @empty
                                            <tr>
                                                <td>
                                                    {{__("seller.noBranch")}}
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-end">
                                        {{$branches->links()}}
                                    </ul>
                                </nav>
                            </div>

                        @elseif(Route::is("seller.branch.show"))

    <!--============================================Start Edit Branch=======================================================================-->
                            <form action="{{route('seller.branch.update', $branch->id)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="modal-body row g-3">

                                    <div class="col-md-6">
                                        <label for="inputPassword4" class="form-label">{{__("seller.a",["var" => __("seller.bName")])}}</label>
                                        <input type="text" name="arName" class="form-control text-right" value="{{$branch->getTranslation('name', 'ar')}}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputEmail4" class="form-label">{{__("seller.e",["var" => __("seller.bName")])}}</label>
                                        <input type="text" name="enName" class="form-control" value="{{$branch->getTranslation('name', 'en')}}">
                                        <input type="hidden" name="id" value="{{$branch->id}}">
                                    </div>
                                    <div class="col-md-6" style="display:none;">
                                        <label for="inputEmail4" class="form-label">Longitude</label>
                                        <input type="text" name="lng" id="longitude" class="form-control" value="{{$branch->lng}}">
                                    </div>
                                    <div class="col-md-6" style="display:none;">
                                        <label for="inputPassword4" class="form-label">Latitude</label>
                                        <input type="text" name="lat" id="latitude" class="form-control" value="{{$branch->lat}}">
                                    </div>
                                    <div class="col-md-12 mt-4">
                                        <label for="inputEmail4" class="form-label">{{__("seller.address")}}</label>
                                        <input type="text" id="pac-input" name="address" class="form-control" value="{{$branch->address}}">
                                    </div>
                                    <div class="col-12">
                                        <div class="map" style="height:300px;width:100%"></div>
                                        <button type="button" class="getLocation btn btn-info mb-3 shadow font-weight-bold">{{__("seller.currentLoc")}}</button>
                                    </div>
                                </div>
                                <div class="card-footer justify-content-between">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__("seller.cancle")}}</button>
                                    <input type="submit" class="btn btn-primary" value="Edit Branch">
                                </div>
                            </form>
    <!--==============================================End Edit Branch=======================================================================-->
                        @elseif(Route::is("seller.new.branch"))
    <!--=============================================Start New Branch=======================================================================-->
                            <form action="{{route('seller.branch.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body row g-3">
                                <div class="col-md-6">
                                    <label for="inputEmail4" class="form-label">{{__("seller.a",["var" => __("seller.bName")])}}</label>
                                    <input type="text" name="arName" class="form-control" >
                                </div>
                                <div class="col-md-6">
                                    <label for="inputEmail4" class="form-label">{{__("seller.e",["var" => __("seller.bName")])}}</label>
                                        <input type="text" name="enName" class="form-control" >
                                </div>
                                <div class="col-md-6" style="display:none">
                                    <label for="inputEmail4" class="form-label">Longitude</label>
                                    <input type="text" id="longitude" name="lng" class="form-control" >
                                </div>
                                <div class="col-md-6" style="display:none">
                                    <label for="inputPassword4" class="form-label">Latitude</label>
                                    <input type="text" id="latitude" name="lat" class="form-control" >
                                </div>
                                <div class="col-md-12">
                                    <label for="inputEmail4" class="form-label">{{__("seller.address")}}</label>
                                    <input type="text" id="pac-input" name="address" class="form-control" >
                                </div>
                                <div class="col-12">
                                    <div class="map" style="height:300px;width:100%"></div>
                                    <button type="button" class="getLocation btn btn-info mb-3 shadow font-weight-bold">{{__("seller.currentLoc")}}</button>
                                </div>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__("seller.cancle")}}</button>
                                    <input type="submit" class="btn btn-primary" value="Add Branch">
                                </div>
                            </form>
    <!--==============================================End New Branch========================================================================-->
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->
    </div>
@endsection

@section('style')
    <link href="{{asset('admin-asset/assets/node_modules/datatables/media/css/dataTables.bootstrap4.css')}}" rel="stylesheet">
@endsection
@section('scripts')
    <script src="{{asset('admin-asset/assets/node_modules/datatables/datatables.min.js')}}"></script>
    <!-- start - This is for export functionality only -->
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
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
                /* $("#pac-input").val("أبحث هنا "); */
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
<!--====================================================================================================================================-->
