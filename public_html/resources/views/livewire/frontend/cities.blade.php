<div>
    @include('frontend.layouts.breadcrumb')
    <div class="container-fluid h-100 my-4">
        <div class="row">
            <div class="col-md-2">
                <div class="archive-filter">
                    <form action="" class="filterForm" id="filterForm">
                        <div class="filter-head">
                            <h4>{{__('Filter search')}}</h4>
                        </div>
                        <div class="filter-box my-2">
                            <a class="btn btn-label-success waves-effect w-100 justify-content-between" data-bs-toggle="collapse" href="#types" role="button" aria-expanded="true" aria-controls="collapseExample">
                                {{__('Place type')}}
                                <i class="ti ti-chevron-down me-2 ti-sm"></i>
                            </a>
                            <div class="collapse show" id="types" style="">
                                <div class="filter-list">
                                    <div class="filter-group">
                                        <!--$cities-->
                                        @foreach($types as $type)
                                            <div class="field-check m-2 p-2">
                                                <label class="bc_filter" for="city_22">
                                                    <input class="form-check-input" type="checkbox" value="{{$type->id}}" id="defaultCheck3" wire:model="typeSelected" wire:change="filterPlace">
                                                    {{$type->name}}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="filter-box my-2">
                            <a class="btn btn-label-success waves-effect w-100 justify-content-between" data-bs-toggle="collapse" href="#services" role="button" aria-expanded="true" aria-controls="collapseExample">
                                {{__('Services')}}
                                <i class="ti ti-chevron-down me-2 ti-sm"></i>
                            </a>
                            <div class="collapse show" id="services" style="">
                                <div class="filter-list">
                                    <div class="filter-group">
                                        <!--$cities-->
                                        @foreach($services as $service)
                                            <div class="field-check m-2 p-2">
                                                <label class="bc_filter" for="city_22">
                                                    <input class="form-check-input" type="checkbox" value="{{$service->id}}" id="defaultCheck3" wire:model="serviceSelected" wire:change="filterPlace">
                                                    {{$service->name}}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="filter-box my-2">
                            <a class="btn btn-label-success waves-effect w-100 justify-content-between" data-bs-toggle="collapse" href="#categories" role="button" aria-expanded="true" aria-controls="collapseExample">
                                {{__('Categories')}}
                                <i class="ti ti-chevron-down me-2 ti-sm"></i>
                            </a>
                            <div class="collapse show" id="categories" style="">
                                <div class="filter-list">
                                    <div class="filter-group">
                                        <!--$cities-->
                                        @foreach($categories as $category)
                                            <div class="field-check m-2 p-2">
                                                <label class="bc_filter" for="city_22">
                                                    <input class="form-check-input" type="checkbox" value="{{$category->id}}" id="defaultCheck3" wire:model="categorySelected" wire:change="filterPlace" >
                                                    {{$category->name}}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-7">
                <div class="row">
                    @foreach($results as $place)
                        <div class="col-md-4 my-3">
                                <div class="card h-100">
                                    <a href="{{route('places.show',$place->slug)}}">
                                        @if($place->image!=null)
                                            <img class="card-img-top" src="{{asset('uploads/places/photo/'.$place->image)}}" alt="Card image cap">
                                        @else
                                            <img class="card-img-top" src="{{asset('uploads/settings/'.$watermark)}}" alt="Card image cap">
                                        @endif
                                    </a>

                                    <div class="card-body">
                                        <div class="entry-head">
                                            <div class="place-type list-item">
                                                <span>{{$place->type->name}}</span>
                                            </div>
                                            <div class="place-city">
                                                <a href="{{route('places.show',$place->slug)}}">{{$place->city->name}}</a>
                                            </div>
                                        </div>
                                        <h4 class="card-title text-primary"><a href="{{route('places.show',$place->slug)}}">{{$place->name}}</a></h4>
                                        <p> <i class="ti ti-map-2"></i>
                                            {{$place->address}}</p>
                                        <div class="entry-bottom mt-4">
                                            <div class="place-preview">
                                                <div class="place-rating">
                                                <span>
                                                    @if ($place->reviews->count() > 0)
                                                        {{ number_format( $place->reviews->avg('score'), 2) }}
                                                    @else
                                                        0
                                                    @endif
                                                </span>
                                                    <i class="fas fa-star"></i>
                                                </div>
                                                <span class="count-reviews">({{$place->reviews->count()}} {{__('reviews')}})</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    @endforeach
                </div>
                @if($results->total()!=0)
                    <div class="row mx-2 my-3">
                        <div class="col-md-5">
                            <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">
                                {{__('Showing')}} {{ $results->firstItem() }} {{__('to')}} {{ $results->lastItem() }} {{__('of')}} {{ $results->total() }} {{__('results')}}
                            </div>
                        </div>
                        <div class="col-md-7 d-flex justify-content-end">
                            @if ($results->hasPages())
                                {{$results->links('vendor.livewire.bootstrap')}}
                            @endif
                        </div>
                    </div>
                @endif
            </div>
            <div class="col-md-3">
                <div id="map-container" wire:ignore style="width: 100%; height: 100%; display: block;"></div>
            </div>
        </div>

    </div>
    <script async src="https://maps.googleapis.com/maps/api/js?key={{$api_google_maps}}&libraries=places"></script>
    <script>
        document.addEventListener('livewire:load', function () {
            var map;
            var markers = [];
            var infoWindows = [];

            function initMap() {
                var latlng = new google.maps.LatLng({{$city->latitude}}, {{$city->longitude}});
                var mapOptions = {
                    zoom: 13,
                    center: latlng,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                };
                map = new google.maps.Map(document.getElementById('map-container'), mapOptions);

                var allPlaces = @json($places);
                const iconUrl = '{{asset('frontend/img/location.svg')}}';
                allPlaces.forEach(function (place) {
                    var marker = new google.maps.Marker({
                        position: new google.maps.LatLng(parseFloat(place.latitude), parseFloat(place.longitude)),
                        map: map,
                        title: place.name,
                        icon: {
                            url: iconUrl,
                            scaledSize: new google.maps.Size(55, 55), // Tamaño del icono (ajústalo según tus necesidades)
                        },
                    });
                    markers.push(marker);
                    if (place.image){
                        var imageUrl = '{{ asset('uploads/places/photo') }}' + '/' + place.image;
                    }else{
                        var imageUrl = '{{ asset('uploads/settings/'.$watermark) }}';
                    }

                    var infoWindow = new google.maps.InfoWindow({
                        content: '<div class="custom-info-window">' +
                            '<img class="entry-thumb" src="' + imageUrl + '" alt="' + place.name + '">' +
                            '<h3>' + place.name + '</h3>' +
                            '<p>' + place.description + '</p>' +
                            '</div>'
                    });
                    infoWindows.push(infoWindow);

                    marker.addListener('mouseover', function () {
                        infoWindow.open(map, marker);
                    });

                    marker.addListener('mouseout', function () {
                        infoWindow.close();
                    });
                });
            }

            initMap();

            window.addEventListener('updateMap', function (event) {
                var places = event.detail;

                // Eliminar marcadores existentes
                markers.forEach(function (marker) {
                    marker.setMap(null);
                });
                markers = [];

                infoWindows.forEach(function (infoWindow) {
                    infoWindow.close();
                });
                infoWindows = [];
                const iconUrl = '{{asset('frontend/img/location.svg')}}';
                // Mostrar marcadores de lugares filtrados
                places.forEach(function (place) {
                    var marker = new google.maps.Marker({
                        position: new google.maps.LatLng(parseFloat(place.latitude), parseFloat(place.longitude)),
                        map: map,
                        title: place.name,
                        icon: {
                            url: iconUrl,
                            scaledSize: new google.maps.Size(55, 55), // Tamaño del icono (ajústalo según tus necesidades)
                        },
                    });
                    markers.push(marker);
                    if (place.image){
                        var imageUrl = '{{ asset('uploads/places/photo') }}' + '/' + place.image;
                    }else{
                        var imageUrl = '{{ asset('uploads/settings/'.$watermark) }}';
                    }

                    var infoWindow = new google.maps.InfoWindow({
                        content: '<div class="custom-info-window">' +
                            '<img class="entry-thumb" src="' + imageUrl + '" alt="' + place.name + '">' +
                            '<h3>' + place.name + '</h3>' +
                            '<p>' + place.description + '</p>' +
                            '</div>'
                    });
                    infoWindows.push(infoWindow);

                    marker.addListener('mouseover', function () {
                        infoWindow.open(map, marker);
                    });

                    marker.addListener('mouseout', function () {
                        infoWindow.close();
                    });
                });
            });
        });


    </script>
</div>
