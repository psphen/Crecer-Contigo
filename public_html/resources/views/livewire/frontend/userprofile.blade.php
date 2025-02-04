<div>
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="user-profile-header-banner">
                            @if ($user->banner_photo)
                                <img src="{{ asset('uploads/users/' . $user->banner_photo) }}" alt="Banner image" class="rounded-top">
                            @else
                                <img src="{{asset('assets/img/pages/profile-banner.png')}}" alt="Banner image" class="rounded-top">
                            @endif
                        </div>
                        <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
                            <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                                @if ($user->profile_photo)
                                    <img src="{{ asset('uploads/users/' . $user->profile_photo) }}" alt="user image" class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img">
                                @else
                                    <img src="{{asset('assets/img/avatars/14.png')}}" alt="user image" class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img">
                                @endif
                            </div>
                            <div class="flex-grow-1 mt-3 mt-sm-5">
                                <div class="d-flex align-items-center justify-content-between mx-4 flex-md-row flex-column gap-4">
                                    <div class="user-profile-info">
                                        <div class="d-flex align-items-center">
                                            <h4>{{$user->name}}</h4>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <a href="javascript:void(0)" class="btn btn-primary waves-effect waves-light mx-2">
                                            <i class="ti ti-user-check me-1"></i>{{__('Connected')}}
                                        </a>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Header -->

            <!-- Navbar pills -->
            <div class="row">
                <div class="col-md-4">
                    <!-- About User -->
                    <div class="card mb-4">
                        <div class="card-body">
                            {{--                            <small class="card-text text-uppercase">About</small>--}}
                            <ul class="list-unstyled mb-4 mt-3">
                                <li class="d-flex justify-content-between mb-3">
                                    <div class=" text-warning">
                                        <i class="ti ti-user"></i><span class=" mx-2">{{__('Full name')}}:</span>
                                    </div>
                                    <div class="text-end">
                                        @if ($user->isCustomer())
                                            <span>{{$user->customer->full_name}}</span>
                                        @elseif($user->isVendor())
                                            <span>{{$user->vendor->full_name}}</span>
                                        @else
                                            <span>{{$user->name}}</span>
                                        @endif
                                    </div>


                                </li>
                                <li class="d-flex justify-content-between mb-3">
                                    <div class=" text-warning">
                                        <i class="ti ti-crown"></i><span class="mx-2">{{__('Role')}}:</span>
                                    </div>
                                    <div class="text-end">
                                        @foreach($user->roles as $role)
                                            <span>{{ __($role->name) }}</span>
                                        @endforeach
                                    </div>


                                </li>
                                @if($user->isVendor())
                                    <li class="d-flex justify-content-between mb-3">
                                        <div class=" text-warning">
                                            <i class="ti ti-home-2"></i><span class="mx-2">{{__('Place')}}:</span>
                                        </div>
                                        <div class="text-end">
                                            @if ($user->place)
                                                <span>{{$user->place->name}}</span>
                                            @endif
                                        </div>
                                @endif
                            </ul>
                            <small class="card-text text-uppercase fw-bold ">{{__('Contacts')}}</small>
                            <ul class="list-unstyled mb-4 mt-3">
                                <li class="d-flex justify-content-between mb-3">
                                    <div class=" text-warning">
                                        <i class="ti ti-phone-call"></i><span class="mx-2">{{__('Phone')}}:</span>
                                    </div>
                                    <div class="text-end">
                                        @if ($user->isCustomer())
                                            <span>{{$user->customer->phone}}</span>
                                        @endif
                                        @if ($user->isVendor())
                                            <span>{{$user->vendor->phone}}</span>
                                        @endif
                                    </div>
                                </li>
                                <li class="d-flex justify-content-between mb-3">
                                    <div class=" text-warning">
                                        <i class="ti ti-mail"></i><span class="mx-2">{{__('Correo')}}:</span>
                                    </div>
                                    <div class="text-end">
                                        <span>{{$user->email}}</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--/ About User -->
                </div>
                <div class="col-md-8">
                    <div class="nav-align-top mb-4">
                        <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button type="button" class="nav-link {{$user->isVendor()?'active':''}}" role="tab" data-bs-toggle="tab" data-bs-target="#posts" aria-controls="navs-pills-justified-home" aria-selected="true">
                                    <i class="tf-icons ti ti-building-store ti-xs me-1"></i> {{__('Posts')}}
                                    <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-danger ms-1">{{$posts->count()}}</span>
                                </button>
                            </li>

                            @if($user->isVendor())
                                @if(!$user->place->placeImages->isEmpty())
                                    <li class="nav-item" role="presentation">
                                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#gallery" aria-controls="navs-pills-justified-messages" aria-selected="false" tabindex="-1">
                                            <i class="tf-icons ti ti-album ti-xs me-1"></i> {{__('Gallery')}}
                                        </button>
                                    </li>
                                @endif
                                <li class="nav-item" role="presentation">
                                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#schedule" aria-controls="navs-pills-justified-messages" aria-selected="false" tabindex="-1">
                                        <i class="tf-icons ti ti-calendar-event ti-xs me-1"></i> {{__('Schedule')}}
                                    </button>
                                </li>
                            @endif

                        </ul>
                        <div class="tab-content shadow-none">
                            <div class="tab-pane fade {{$user->isVendor()?'show active':''}} " id="posts" role="tabpanel">
                                <!-- Activity Timeline -->
                                @if ($user->isVendor())
                                    @if ($user->place!=null)
                                        @foreach($posts->reverse() as $post)
                                            <div class="card card-action mb-4" style="--bs-card-spacer-y: -0.5rem; border-radius: 13px;">
                                                <div class="card-body">
                                                    <div class="media mb-4">

                                                        <div class="card-header" style="--bs-card-spacer-y: 0.5rem !important; padding-top: 15px; padding-bottom: 0px;">
                                                            <div class="media mb-0">
                                                                <div class="row">
                                                                    <div class="col-md-auto" style="padding-left: 0px; padding-right: 0px;">
                                                                        @if ($user->profile_photo)
                                                                            <img src="{{ asset('uploads/users/' . $user->profile_photo) }}" alt="user image" class="rounded-circle mx-3" style="max-width: 580px; max-height: 50px;">
                                                                        @else
                                                                            <img src="../../assets/img/avatars/14.png" alt="user image" class="rounded-circle mx-3" style="max-width: 50px; max-height: 50px;">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-auto" style="padding-left: 0px;">
                                                                        {{$user->name}}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card-body" style="--bs-card-spacer-y: 0.5rem !important; padding-top: 5px; padding-bottom: 0px;">
                                                            <div class="media mb-4">
                                                                <div class="row">
                                                                    <div class="col-md-auto">
                                                                        @if($post->image)
                                                                            <img src="{{ asset('uploads/posts/' . $post->image) }}" alt="Post Image" class="img-fluid mt-3" style="max-width: auto !important; max-height: 240px; border-radius: 13px;">
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md" style="padding-left: 0px;">
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
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="mt-4">
                                            {{ $posts->links('vendor.livewire.bootstrap') }}
                                        </div>
                                    @endif
                                @endif
                            </div>
                            <div class="tab-pane fade {{$user->isCustomer()?'show active':''}}" id="profile" role="tabpanel">
                                <form class="row g-3" wire:submite.prevent="updateProfile">
                                    <div class="col-6">
                                        <label class="form-label" for="first_name">{{__('First Name')}}:</label>
                                        <input type="text" id="first_name" class="form-control" placeholder="{{__('Enter First Name')}}" name="first_name" wire:model.defer="first_name" />
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label" for="last_name">{{__('Last Name')}}:</label>
                                        <input type="text" id="last_name" class="form-control" placeholder="{{__('Enter Last Name')}}" name="last_name" wire:model.defer="last_name" />
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label" for="phone">{{__('Phone')}}:</label>
                                        <input type="text" id="phone" class="form-control" placeholder="{{__('Enter Last Name')}}" name="phone" wire:model.defer="phone" />
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label" for="email">{{__('Email')}}:</label>
                                        <input type="text" id="email" class="form-control" placeholder="{{__('Enter Last Name')}}" name="email" wire:model.defer="email" />
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <button type="button" class="btn btn-primary me-sm-3 me-1" wire:loading.class="disabled" wire:loading.attr="disabled" wire:target="updateProfile" wire:click='updateProfile'>
                                            {{__('Save')}}</button>
                                    </div>
                                </form>
                            </div>
                            @if($user->isVendor())
                                @if(!$user->place->placeImages->isEmpty())
                                    <div class="tab-pane fade" id="gallery" role="tabpanel">
                                        <div class="row g-3">
                                            @foreach($user->place->placeImages as $gallery)
                                                <div class="col-md-4">
                                                    <img src="{{asset('uploads/places/gallery/place_' . $user->place->id . '/' .$gallery->image_path)}}" alt="" class="img-fluid">
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            @endif
                            <div class="tab-pane fade" id="schedule" role="tabpanel">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
