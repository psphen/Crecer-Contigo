<div>
    <div class="container py-3">
{{--        <div class="row">--}}
{{--            @forelse($posts as $post)--}}
{{--                <div class="col-md-3 my-3">--}}
{{--                    <div class="card h-100">--}}
{{--                        @if($post->image!=null)--}}
{{--                            <img class="card-img-top" src="{{asset('uploads/posts/'.$post->image)}}" alt="Card image cap">--}}
{{--                        @else--}}
{{--                            <img class="card-img-top" src="{{asset('uploads/settings/'.$watermark)}}" alt="Card image cap">--}}
{{--                        @endif--}}
{{--                        <div class="card-body">--}}
{{--                            <h5 class="card-title">{{ $post->name }}</h5>--}}
{{--                            <p class="card-text">--}}
{{--                                {{ $post->content }}--}}
{{--                            </p>--}}
{{--                            --}}{{--                            <a href="javascript:void(0)" class="btn btn-outline-primary waves-effect"><i class="ti ti-arrow-narrow-right"></i></a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            @empty--}}
{{--                <div class="col-md-12">--}}
{{--                    <div class="py-5 text-center">--}}
{{--                        <h4>{{__('There are no matches for your search query')}}</h4>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            @endforelse--}}
{{--        </div>--}}
{{--        @if($posts->total()!=0)--}}
{{--            <div class="row mx-2 my-3">--}}
{{--                <div class="col-md-5">--}}
{{--                    <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">--}}
{{--                        {{__('Showing')}} {{ $posts->firstItem() }} {{__('to')}} {{ $posts->lastItem() }} {{__('of')}} {{ $posts->total() }} {{__('results')}}--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-7 d-flex justify-content-end">--}}
{{--                    @if ($posts->hasPages())--}}
{{--                        {{$posts->links('vendor.livewire.bootstrap')}}--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        @endif--}}
        <div class="row">
            @forelse($results as $place)
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
            @empty
                <div class="col-md-12">
                    <div class="py-5 text-center">
                        <h4>{{__('No hay lugares para esta categoría')}}</h4>
                    </div>
                </div>
            @endforelse
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
</div>
