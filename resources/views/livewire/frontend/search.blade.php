<div>
    <div class="row justify-content-center align-items-center">
        <div class="col-md-12">
            <div class="card" >
                <div class="card-body">
                    <h6>Encuentra lo que necesitas en {{$app_name}}</h6>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-group">
                                <input type="text" name="query" class="form-control" wire:model="query" placeholder="Buscar">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(!$categories->isEmpty()||!$result_cities->isEmpty()||!$places->isEmpty()||!$posts->isEmpty())
        <div class="my-4">
            @if(!$categories->isEmpty())
                <div wire:ignore.self>
                    <div class="row text-center my-3">
                        <div class="col-md-12">
                            <h3 class="title">{{__('Categories')}}</h3>
                        </div>
                    </div>
                    <div class="row">
                        @forelse($categories as $categoria)
                            <div class="col-md-3 my-2">
                                <div class="card text-center">
                                    <div class="card-img p-5">
                                        <img src="{{asset('uploads/categories/icons/'.$categoria->icon)}}" class="" alt="...">
                                    </div>

                                    <div class="card-body">

                                        <h4 class="card-title"> {{ $categoria->name }}</h4>
                                        <a href="javascript:void(0)" class="btn btn-outline-primary waves-effect"><i class="ti ti-arrow-narrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-md-12">
                                <div class="py-5 text-center">
                                    <h4>{{__('There are no matches for your search query')}}</h4>
                                </div>
                            </div>
                        @endforelse
                    </div>
                    @if($categories->total()!=0)
                        <div class="row mx-2 my-3">
                            <div class="col-md-5">
                                <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">
                                    {{__('Showing')}} {{ $categories->firstItem() }} {{__('to')}} {{ $categories->lastItem() }} {{__('of')}} {{ $categories->total() }} {{__('results')}}
                                </div>
                            </div>
                            <div class="col-md-7 d-flex justify-content-end">
                                @if ($categories->hasPages())
                                    {{$categories->links('vendor.livewire.bootstrap')}}
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            @endif
            @if(!$result_cities->isEmpty())
                <div class="row text-center my-3">
                    <div class="col-md-12">
                        <h3 class="title">{{__('Cities')}}</h3>
                    </div>
                </div>
                <div class="row">
                    @forelse($result_cities as $city)
                        <div class="col-md-3 my-3 ">
                            <div class="card h-100 text-center">
                                @if($city->thumbnail_image!=null)
                                    <img class="card-img-top" src="{{asset('uploads/cities/thumbnails/'.$city->thumbnail_image)}}" alt="Card image cap">
                                @else
                                    <img class="card-img-top" src="{{asset('uploads/settings/'.$watermark)}}" alt="Card image cap">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $city->name }}</h5>
                                    <p class="card-text">
                                        {{ $city->introduction }}
                                    </p>
                                    <a href="{{route('cities.show',$city->slug)}}" class="btn btn-outline-primary waves-effect"><i class="ti ti-arrow-narrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-md-12">
                            <div class="py-5 text-center">
                                <h4>{{__('There are no matches for your search query')}}</h4>
                            </div>
                        </div>
                    @endforelse
                </div>
                @if($result_cities->total()!=0)
                    <div class="row mx-2 my-3">
                        <div class="col-md-5">
                            <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">
                                {{__('Showing')}} {{ $result_cities->firstItem() }} {{__('to')}} {{ $result_cities->lastItem() }} {{__('of')}} {{ $result_cities->total() }} {{__('results')}}
                            </div>
                        </div>
                        <div class="col-md-7 d-flex justify-content-end">
                            @if ($result_cities->hasPages())
                                {{$result_cities->links('vendor.livewire.bootstrap')}}
                            @endif
                        </div>
                    </div>
                @endif
            @endif
            @if(!$places->isEmpty())
                <div class="row text-center my-3">
                    <div class="col-md-12">
                        <h3 class="title">{{__('Places')}}</h3>
                    </div>
                </div>
                <div class="row">
                    @forelse($places as $place)
                        <div class="col-md-3 my-3">
                            <div class="card h-100 text-center">
                                @if($place->image!=null)
                                    <img class="card-img-top" src="{{asset('uploads/places/photo/'.$place->image)}}" alt="Card image cap">
                                @else
                                    <img class="card-img-top" src="{{asset('uploads/settings/'.$watermark)}}" alt="Card image cap">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $place->name }}</h5>
                                    <p class="card-text">
                                        {{ $place->address }}
                                    </p>
                                    <a href="{{route('places.show',$place->slug)}}" class="btn btn-outline-primary waves-effect"><i class="ti ti-arrow-narrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-md-12">
                            <div class="py-5 text-center">
                                <h4>{{__('There are no matches for your search query')}}</h4>
                            </div>
                        </div>
                    @endforelse
                </div>
                @if($places->total()!=0)
                    <div class="row mx-2 my-3">
                        <div class="col-md-5">
                            <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">
                                {{__('Showing')}} {{ $places->firstItem() }} {{__('to')}} {{ $places->lastItem() }} {{__('of')}} {{ $places->total() }} {{__('results')}}
                            </div>
                        </div>
                        <div class="col-md-7 d-flex justify-content-end">
                            @if ($places->hasPages())
                                {{$places->links('vendor.livewire.bootstrap')}}
                            @endif
                        </div>
                    </div>
                @endif
            @endif
            @if(!$posts->isEmpty())
                <div class="row text-center my-3">
                    <div class="col-md-12">
                        <h3 class="title">{{__('Posts')}}</h3>
                    </div>
                </div>
                <div class="row">
                    @forelse($posts as $post)
                        <div class="col-md-3 my-3">
                            <div class="card h-100">
                                @if($post->image!=null)
                                    <img class="card-img-top" src="{{asset('uploads/posts/'.$post->image)}}" alt="Card image cap">
                                @else
                                    <img class="card-img-top" src="{{asset('uploads/settings/'.$watermark)}}" alt="Card image cap">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $post->name }}</h5>
                                    <p class="card-text">
                                        {{ $post->content }}
                                    </p>
                                    {{--                            <a href="javascript:void(0)" class="btn btn-outline-primary waves-effect"><i class="ti ti-arrow-narrow-right"></i></a>--}}
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-md-12">
                            <div class="py-5 text-center">
                                <h4>{{__('There are no matches for your search query')}}</h4>
                            </div>
                        </div>
                    @endforelse
                </div>
                @if($posts->total()!=0)
                    <div class="row mx-2 my-3">
                        <div class="col-md-5">
                            <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">
                                {{__('Showing')}} {{ $posts->firstItem() }} {{__('to')}} {{ $posts->lastItem() }} {{__('of')}} {{ $posts->total() }} {{__('results')}}
                            </div>
                        </div>
                        <div class="col-md-7 d-flex justify-content-end">
                            @if ($posts->hasPages())
                                {{$posts->links('vendor.livewire.bootstrap')}}
                            @endif
                        </div>
                    </div>
                @endif
            @endif
        </div>
    @else
        <div class="row my-5">
            <div class="col-md-12">
                <div class="h-100">
                    <div class="text-center">
                        <h4>No hay resultados de búsqueda</h4>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
