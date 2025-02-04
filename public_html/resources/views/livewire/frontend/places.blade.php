<div>
    <div>

        <div id="carouselExampleControls" class="carousel slide mb-3 d-none d-lg-block" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active" style="height: 500px;background-image: url({{ $place->banner!=null?asset('uploads/places/banner/' . $place->banner):asset('uploads/settings/' . $banner_default) }});background-size: cover;background-position: center">
{{--                    <img src="{{ $place->banner!=null?asset('uploads/places/banner/' . $place->banner):asset('uploads/settings/' . $banner_default) }}" class="d-block w-100" alt="...">--}}
                </div>

            </div>
        </div>
        <div id="carouselExampleControls" class="carousel slide mb-3 d-block d-lg-none" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active" style="height: 230px;background-image: url({{ $place->banner!=null?asset('uploads/places/banner/' . $place->banner):asset('uploads/settings/' . $banner_default) }});background-size: cover;background-position: center">
                    {{--                    <img src="{{ $place->banner!=null?asset('uploads/places/banner/' . $place->banner):asset('uploads/settings/' . $banner_default) }}" class="d-block w-100" alt="...">--}}
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="nav-align-top mb-4">
                        <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#details" aria-controls="navs-pills-justified-home" aria-selected="true">
                                    <i class="tf-icons ti ti-home ti-xs me-1"></i> {{__('Details')}}
                                </button>
                            </li>
                            @if(!$place->placeImages->isEmpty())
                                <li class="nav-item" role="presentation">
                                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#gallery" aria-controls="navs-pills-justified-profile" aria-selected="false" tabindex="-1">
                                        <i class="tf-icons ti ti-user ti-xs me-1"></i> {{__('Gallery')}}
                                    </button>
                                </li>
                            @endif
                            @if(!$place->posts->isEmpty())
                                <li class="nav-item" role="presentation">
                                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#posts" aria-controls="navs-pills-justified-messages" aria-selected="false" tabindex="-1">
                                        <i class="tf-icons ti ti-message-dots ti-xs me-1"></i> {{__('Posts')}}
                                        <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-warning ms-1">{{$place->posts->count()}}</span>
                                    </button>
                                </li>
                            @endif
                        </ul>
                        <div class="tab-content shadow-none">
                            <div class="tab-pane fade show active shadow-none" id="details" role="tabpanel">
                                <ul class="place__breadcrumbs breadcrumbs mb-1">
                                    <li><a title="{{$place->city->name}}" href="{{route('cities.show',$place->city->slug)}}">{{$place->city->name}}</a></li>
                                </ul>
                                <div class="place__box place__box--npd">
                                    <h1 class="mb-1">{{$place->name}}</h1>
                                    <div class="demo-inline-spacing mb-2">
                                        @foreach($place->categories as $category)
                                            <span class="badge bg-label-primary mt-0">{{$category->name}}</span>
                                        @endforeach
                                    </div>
                                    <div class="place__meta">
                                        <div class="place__reviews reviews">
                                <span class="place__reviews__number reviews__number">
                                    <span>
                                        @if ($place->reviews->count() > 0)
                                            {{ number_format( $place->reviews->avg('score'), 2) }}
                                        @else
                                            0
                                        @endif
                                    </span>
                                    <i class="fas fa-star"></i></span>
                                            <span class="place__places-item__count reviews_count">({{$place->reviews->count()}} {{__('reviews')}})</span>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                @if($place->description)
                                    <div class="place__box place__box-overview">
                                        <h4>{{__('Description')}}</h4>
                                        <div class="place__desc">
                                            <p>{{$place->description}}</p>
                                        </div>
                                        <a href="#" class="btn-show showmore" title="Mostrar más">Ver más <i class="fas fa-chevron-down"></i></a>
                                        <a href="javascript:void(0)" class="btn-show show-less">Ver menos <i class="fas fa-chevron-up"></i></a>
                                    </div>
                                    <hr>
                                @endif

                                @if(!$place->services->isEmpty())
                                    <div class="row service-section">
                                        <div class="col-md-12">
                                            <h4>{{__('Services')}}</h4>
                                        </div>
                                        @foreach($place->services as $service)
                                            <div class="col-md-3 text-center">
                                                <img src="{{asset('uploads/services/icons/'.$service->icon)}}" alt="" class="img-fluid service-icon">
                                                <p>{{$service->name}}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                    <hr>
                                @endif

                                @if($place->video)
                                    @if($place->video_type==1)
                                        <iframe width="90%" height="500" src="{{$embedUrl}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                                    @else
                                        <video
                                            id="my-video"
                                            class="video-js"
                                            controls
                                            preload="auto"
                                            width="90%"
                                            height="500"
                                            data-setup="{}"
                                            style="width: 100%"
                                        >
                                            <source src="{{asset('uploads/places/video/'.$place->video)}}" type="video/mp4" />
                                        </video>
                                    @endif
                                @endif

                                @if(!$place->placeSchedules->isEmpty())
                                    <div class="my-3">
                                        <h4>{{__('Schedule')}}</h4>
                                        <table class="table">
                                            <thead class="border-top">
                                            <tr>
                                                <th class="text-center">{{__('Day')}}</th>
                                                <th class="text-center">{{__('Start hour')}}</th>
                                                <th class="text-center">{{__('End hour')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @forelse($place->placeSchedules as $schedule)
                                                <tr>
                                                    <td class="text-center">{{__($schedule->weekDay->name)}}</td>
                                                    <td class="text-center">{{$schedule->start_hour}}</td>
                                                    <td class="text-center">{{$schedule->end_hour}}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td></td>
                                                </tr>
                                            @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            </div>
                            @if(!$place->placeImages->isEmpty())
                                <div class="tab-pane fade shadow-none" id="gallery" role="tabpanel">
                                    <div class="row">
                                        @foreach($place->placeImages as $gallery)
                                            <div class="col-md-6 text-center">
                                                <img src="{{asset('uploads/places/gallery/place_' . $place->id . '/' .$gallery->image_path)}}" alt="" class="img-fluid rounded my-2" style="min-height: 200px;max-height: 300px;">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            @if(!$place->posts->isEmpty())
                                <div class="tab-pane fade shadow-none" id="posts" role="tabpanel">
                                    @foreach($place->posts as $post)
                                        <div class="card card-action mb-4">
                                            <div class="card-body">
                                                <div class="media mb-4">
                                                    <div class="row d-flex align-items-center">
                                                        <div class="col-md-auto">
                                                            @if($post->image)
                                                                <img src="{{ asset('uploads/posts/' . $post->image) }}" alt="{{$post->name}}" class="img-fluid mt-3 rounded" style="max-height: 240px">
                                                                @else
                                                                <img src="{{ asset('uploads/settings/' . $watermark) }}" alt="{{$post->name}}" class="img-fluid mt-3 rounded" style="max-height: 240px">
                                                            @endif
                                                        </div>
                                                        <div class="col-md">
                                                            <div class="post-content mx-3 my-1">
                                                                <h3 class="mb-2">{{$post->name ?? '-'}}</h3>
                                                                <p>{{$post->content ?? '-'}}</p>
                                                            </div>
                                                            <p class="mx-3">
                                                                $ {{$post->price ?? '-'}}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <i class="fas fa-thumbs-up me-0 me-sm-1 ti-xs text-warning"></i>
                                                        <span>2</span>
                                                    </div>
                                                    <div class="col-6 text-end">
                                                        <i class="fas fa-comment me-0 me-sm-1 ti-xs text-warning"></i>
                                                        <span>0</span>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row align-items-center">
                                                    <div class="col-4 text-center d-flex align-items-center justify-content-center flex-column flex-lg-row">
                                                        <i class="fas fa-thumbs-up me-0 me-sm-1 ti-xs text-warning"></i>
                                                        <span>Me gusta</span>
                                                    </div>
                                                    <div class="col-4 text-center d-flex align-items-center justify-content-center flex-column flex-lg-row">
                                                        <i class="fas fa-comment me-0 me-sm-1 ti-xs text-warning"></i>
                                                        <span>Comentar</span>
                                                    </div>
                                                    <div class="col-4 text-center d-flex align-items-center justify-content-center flex-column flex-lg-row">
                                                        <i class="fas fa-share me-0 me-sm-1 ti-xs text-warning"></i>
                                                        <div onclick="compartirPost('{{ $post->id }}')" class="cursor-pointer btn" style="background-color: #fff; color: #4b4b4b;">
                                                            <span class="mx-1">Compartir</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    {{--                                <div class="mt-4">--}}
                                    {{--                                    {{ $posts->links('vendor.livewire.bootstrap') }}--}}
                                    {{--                                </div>--}}
                                </div>
                            @endif

                        </div>
                    </div>
                    <div class="my-3">
                        <h4>{{__('Reviews')}}</h4>
                        <div class="review-section">
                            @foreach ($reviews as $review)
                                <div class="d-flex align-items-center">
                                    @if($review->user->image!=null)
                                        <div class="avatar avatar-online mx-2">
                                            <img src="{{asset('uploads/users/'.$review->user->image)}}" alt class="h-auto rounded-circle" />
                                        </div>
                                    @else
                                        <div class="avatar avatar-online mx-2">
                                            <span class="avatar-initial rounded-circle bg-label-primary">{{$review->user->name[0]}}</span>
                                        </div>
                                    @endif
                                    <div class="review-user-info">
                                        <div class="d-flex align-items-center">
                                            <span class="fw-semibold d-block">{{ $review->user->name }}</span>
                                            <span class="star-review">{{ $this->renderStars($review->score) }}</span>
                                        </div>
                                        <p>{{$review->created_at->diffForHumans()}}</p>
                                    </div>
                                </div>
                            <div class="comment-box">
                                <p class="comment-text m-3">{{ $review->comment }}</p>
                            </div>

                                <hr>
                            @endforeach
                        </div>
{{--                        <h4>{{__('Leave a comment')}}</h4>--}}
                        @guest
                                <a class="btn btn-primary waves-effect waves-light" href="{{ route('login') }}">{{ __('Add comment') }}</a>
                        @else
                            <form wire:submit.prevent="saveReview">
                                <div class="row g-2">
                                    <div class="col-md-12">
                                        <label class="form-label" for="comment">{{__('Comment')}}:</label>
                                        <textarea name="comment" id="description" class="form-control" wire:model.defer="comment"></textarea>
                                        @error('comment')
                                        <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <span wire:click="setReview({{ $i }})"  wire:key="star-{{ $i }}" style="cursor: pointer;" class="star-review">
                                         @if ($score >= $i) ★ @else ☆ @endif
                                        </span>
                                        @endfor
                                        <div>
                                            <label>{{__('Your score')}}: {{ $score }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-start">
                                        <button type="button" class="btn btn-primary me-sm-3 me-1" wire:loading.class="disabled" wire:loading.attr="disabled" wire:target="saveReview" wire:click='saveReview'>
                                            {{__('Save')}}</button>
                                    </div>
                                </div>
                            </form>
                        @endguest

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="colum-fixed card p-3 w-100">
                        <h5>{{__('Contact info')}}</h5>
                        <div wire:ignore id="map" style="height: 250px; width: 100%"></div>
                        <ul class="navbar-nav mt-3">
                            <li class="nav-item py-1">
                                <i class="ti ti-map-2"></i>
                                {{$place->address}}
                            </li>
                            <li class="nav-item py-1">
                                <a href="tel:+57{{$place->user->vendor->phone}}" class="nav-link">
                                    <i class="ti ti-phone-call"></i>
                                    {{$place->user->vendor->phone}}
                                </a>
                            </li>
                        </ul>
                        <div class="row position-relative">
                            <div class="col-md-12">
                                <div class="social-container">
                                    @if($place->facebook_url)
                                        <a class="social social-button social-button-facebook" href="{{$place->facebook_url}}" target="_blank">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                    @endif
                                    @if($place->instagram_url)
                                        <a class="social social-button social-button-instagram" href="{{$place->instagram_url}}" target="_blank">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                    @endif
                                    @if($place->site_web)
                                        <a class="social social-button social-button-youtube" href="{{$place->site_web}}" target="_blank">
                                            <i class="ti ti-brand-chrome"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a class="whatsapp-button btn-primary" href="https://api.whatsapp.com/send?phone=57{{$place->user->vendor->phone}}" target="_blank">
            <i class="ti ti-brand-whatsapp"></i>
        </a>
        <script src="{{asset('js/jquery.min.js')}}"></script>
        <script>
            $(window).scroll(function() {
                var scroll = $(window).scrollTop();
                if (scroll >= 150) {
                    $(".colum-fixed").addClass("fixed_navigation");
                } else {
                    $(".colum-fixed").removeClass("fixed_navigation");
                }
            });
            $( ".showmore" ).on('click', function (e) {
                e.preventDefault();
                $(this).parents('.place__box').find('.place__desc').addClass('active');
                $(this).parents('.address-details').find('.place__desc').addClass('active');
                $(this).parents('.review-user').find('.author-designation-comment').addClass('active');
                $(this).fadeOut(0);

                if( $(this).parents('.place__box').find('.place__desc').hasClass('active')){
                    $(this).parents('.place__box').find('.show-less').addClass('active');
                }
                if( $(this).parents('.address-details').find('.place__desc').hasClass('active')){
                    $(this).parents('.address-details').find('.show-less').addClass('active');
                }
                if( $(this).parents('.review-user').find('.author-designation-comment').hasClass('active')){
                    $(this).parents('.review-user').find('.show-less').addClass('active');
                }
                $(this).parents('.place__box').find('.show-less').fadeIn();
                $(this).parents('.address-details').find('.show-less').fadeIn();
                $(this).parents('.review-user').find('.show-less').fadeIn();

            });
            // Boton de Ver menos
            $( ".show-less" ).on('click', function (e) {
                e.preventDefault();
                $(this).parents('.place__box').find('.place__desc').removeClass('active');
                $(this).parents('.address-details').find('.place__desc').removeClass('active');
                $(this).parents('.review-user').find('.author-designation-comment').removeClass('active');
                $(this).fadeOut(0);
                $(this).parents('.place__box').find('.showmore').fadeIn();
                $(this).parents('.address-details').find('.showmore').fadeIn();
                $(this).parents('.review-user').find('.showmore').fadeIn();

            });
        </script>
        <script async src="https://maps.googleapis.com/maps/api/js?key={{$api_google_maps}}&libraries=places"></script>
        <script>
            function initMap() {
                const lat = {{$latitude}};
                const lng = {{$longitude}};
                const map = new google.maps.Map(document.getElementById('map'), {
                    center: { lat: lat, lng: lng },
                    zoom: 15,
                });
                const iconUrl = '{{asset('frontend/img/location.svg')}}';
                const marker = new google.maps.Marker({
                    position: { lat: lat, lng: lng },
                    map: map,
                    title: '{{$place->name}}',
                    icon: {
                        url: iconUrl,
                        scaledSize: new google.maps.Size(55, 55), // Tamaño del icono (ajústalo según tus necesidades)
                    },
                });
            }
            document.addEventListener('DOMContentLoaded', function() {
                initMap();
            });
        </script>
    </div>
</div>
