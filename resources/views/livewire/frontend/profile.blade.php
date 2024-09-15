<div>
    <div class="content-wrapper" id="user-profile">
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
                                        @if(Auth::user()->id==$user->id && !$user->isAdmin())
                                            <div class="cursor-pointer btn btn-secondary waves-effect waves-light" style="background-color: #bdc0c7db; color: #4b4b4b;"
                                                 data-bs-toggle="modal" data-bs-target="#edit" wire:click="editUser({{$user->id}})">
                                                <i class="ti ti-pencil me-1"></i>{{__('Edit')}}
                                            </div>
                                        @endif

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
                                    <div class="text-warning">
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
                                        <div class="text-warning">
                                            <i class="ti ti-home-2"></i><span class="mx-2">{{__('Place')}}:</span>
                                        </div>
                                        <div class="text-end">
                                            @if ($user->place)
                                                <span>{{$user->place->name}}</span>
                                            @endif
                                        </div>
                                @endif
                            </ul>
                            <small class="card-text text-uppercase fw-bold">{{__('Contacts')}}</small>
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
                    @if ($user->place)
                        <div class="card mb-4">
                            <div class="card-body">
                                <small class="card-text text-uppercase fw-bold">{{__('Visits')}}</small>
                                <ul class="list-unstyled mb-4 mt-3">
                                    <li class="d-flex justify-content-between mb-3">
                                        <div class="text-warning">
                                            <i class="ti ti-accessible"></i><span class="mx-2">{{__('Total visits')}}:</span>
                                        </div>
                                        <div class="text-end">
                                            <span> {{ $totalVisits }}</span>
                                        </div>
                                    </li>
                                    <li class="d-flex justify-content-between mb-3">
                                        <div class="text-warning">
                                            <i class="ti ti-accessible"></i><span class="mx-2">{{__('Visits today')}}:</span>
                                        </div>
                                        <div class="text-end">
                                            <span> {{ $todayVisits }}</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @endif
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
                            @if(Auth::user()->id==$user->id)
                                <li class="nav-item" role="presentation">
                                    <button type="button" class="nav-link {{$user->isCustomer()?'active':''}}" role="tab" data-bs-toggle="tab" data-bs-target="#profile" aria-controls="navs-pills-justified-profile" aria-selected="false" tabindex="-1">
                                        <i class="tf-icons ti ti-user ti-xs me-1"></i> {{__('Profile')}}
                                    </button>
                                </li>
                            @endif
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
                        <div class="tab-content shadow-none"  wire:ignore.self>
                            <div class="tab-pane fade {{$user->isVendor()?'show active':''}} " id="posts" role="tabpanel">
                                <!-- Activity Timeline -->
                                @if ($user->isVendor())
                                    @if ($user->place!=null)
                                        @if(Auth::user()->id==$user->id)
                                            <div class="card card-action mb-4" style="border-radius: 13px;">
                                                <div class="card-body">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-auto" style="padding-left: 0px; padding-right: 0px;">
                                                                @if ($user->profile_photo)
                                                                    <img src="{{ asset('uploads/users/' . $user->profile_photo) }}" alt="user image" class="rounded-circle mx-3" style="max-width: 80px; max-height: 80px;">
                                                                @else
                                                                    <img src="../../assets/img/avatars/14.png" alt="user image" class="rounded-circle mx-3" style="max-width: 80px; max-height: 80px;">
                                                                @endif
                                                            </div>
                                                            <div class="col-md-10" style="padding-left: 0px; padding-right: 0px;">
                                                                <div class="cursor-pointer btn-primary p-3 mb-2 my-3"
                                                                     style="background-color: #dcdfe6db; color: #4b4b4b;
                                                    border-top-left-radius: 30px;
                                                    border-top-right-radius: 30px;
                                                    border-bottom-left-radius: 30px;
                                                    border-bottom-right-radius: 30px;"
                                                                     data-bs-toggle="modal" data-bs-target="#create">
                                                                    ¿Qué estás pensado, {{$user->name}}?
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
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
                                @else
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <small class="card-text text-uppercase">Visitas a otros usuarios</small>
                                            <ul class="list-unstyled mb-4 mt-3">
                                                @foreach ($visitCounts as $visitCount)
                                                    @php
                                                        $visitedUser = \App\Models\User::find($visitCount->user_id);
                                                    @endphp
                                                    <li class="d-flex align-items-center mb-3">
                                                        <i class="ti ti-user"></i>
                                                        <span class="fw-bold mx-2">
                                                <a href="{{ route('user.profile', ['userProfile_id' => $visitedUser->id]) }}" style="color: #5d596c; cursor: pointer;">
                                                    {{ $visitedUser->name }}
                                                </a>
                                            </span>
                                                        <span>{{ $visitCount->count }} veces</span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
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
                                <div class="tab-pane fade" id="gallery" role="tabpanel"  wire:ignore.self>
                                    <form class="row g-3" wire:submite.prevent="updateGallery">
                                        <div class="row g-3">
                                            <div class="col-md-12 text-center">
                                                <h4>{{__('Gallery of images')}}</h4>
                                                <input type="file" id="images-edit" class="form-control" placeholder="" name="images" aria-label="" wire:model.defer="images" multiple/>
                                            </div>
                                            @foreach ($existingImages as $key => $existingImage)
                                                <div class="col-md-6">
                                                    <div class="image-preview position-relative">
                                                        <img src="{{ asset('uploads/places/gallery/' . $folderName . '/' . $existingImage->image_path) }}" alt="Preview" class="img-fluid rounded my-2">
                                                        <button wire:click.prevent="removeExistingImage({{ $key }})" class="btn btn-danger btn-remove-image">
                                                            <span wire:loading wire:target="removeExistingImage({{ $key }})" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                                            <i class="ti ti-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            @endforeach
                                            @foreach ($images as $key => $image)
                                                <div class="col-md-6">
                                                    <div class="image-preview position-relative">
                                                        <img src="{{ $image->temporaryUrl() }}" alt="Preview" class="img-fluid rounded my-2">
                                                        <button wire:click.prevent="removeImage({{ $key }})" class="btn btn-danger btn-remove-image">
                                                            <span wire:loading wire:target="removeImage({{ $key }})" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                                            <i class="ti ti-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            @endforeach
                                            {{--                                        @foreach($user->place->placeImages as $gallery)--}}
                                            {{--                                            <div class="col-md-6">--}}
                                            {{--                                                <img src="{{asset('uploads/places/gallery/place_' . $user->place->id . '/' .$gallery->image_path)}}" alt="" class="img-fluid rounded my-2" style="min-height: 200px;max-height: 300px;">--}}
                                            {{--                                            </div>--}}
                                            {{--                                        @endforeach--}}
                                            <div class="col-md-12 text-center">
                                                <button type="button" class="btn btn-primary me-sm-3 me-1" wire:loading.class="disabled" wire:loading.attr="disabled" wire:target="updateGallery" wire:click='updateGallery'>
                                                    {{__('Save')}}</button>
                                            </div>
                                        </div>
                                    </form>

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
        <!-- / Content -->
        <div>
            <div  wire:ignore.self class="modal fade" id="create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-simple modal-xl">
                    <div class="modal-content p-3 p-md-5">
                        <div class="modal-body">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="closeAndClean"></button>
                            <div class="text-center mb-4">
                                <h3 class="mb-2">{{__('Add post')}}</h3>
                                <p class="text-muted">{{__('Complete the information to add a new post')}}</p>
                            </div>
                            <form class="row g-3" wire:submite.prevent="save" enctype="multipart/form-data">
                                <div class="col-md-5">
                                    <label class="form-label" for="image">{{__('Image')}}</label>
                                    <div class="image-upload">
                                        <div class="thumb text-center">
                                            <div class="avatar-preview">
                                                <div class="profilePicPreview"
                                                     @if($image)
                                                         style="background: url('{{$image->temporaryUrl()}}')"
                                                    @endif>
                                                    <button type="button" class="remove-image"><i class="fa fa-times"></i></button>
                                                </div>
                                            </div>
                                            <div class="avatar-edit">
                                                <input type="file" class="profilePicUpload" wire:model="image" id="image_create" name="" accept=".png, .jpg, .jpeg, .webp">
                                                <label for="image_create" class="bg--primary">{{__('Add image')}}</label>

                                            </div>
                                            <small class="mt-2 text-center">{{__('Compatibilities')}}: <b>jpeg, jpg, png</b> {{__('Resized to')}}: <b>{{$image_width}}x{{$image_height}}</b>px.
                                            </small>
                                        </div>
                                    </div>
                                    @error('image')
                                    <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-7">
                                    <div class="row">
                                        <div class="col-md-12 select-posts mt-0">
                                            <label class="form-label" for="category_id">{{__('Category')}}</label>
                                            <select id="category_id" name="category_id" wire:model.defer="category_id" class="select2 form-select single-select" data-placeholder="{{__('Select a category')}}...">
                                                <option></option>
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                            <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label" for="name">{{__('Name')}}:</label>
                                            <input type="text" id="name" class="form-control" placeholder="" name="name" aria-label="" wire:model.defer="name" />
                                            @error('name')
                                            <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label" for="price">{{__('Price')}}:</label>
                                            <input type="text" id="price" class="form-control" name="price" aria-label="" wire:model.defer="price" />
                                            @error('price')
                                            <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label" for="content">{{__('Content')}}:</label>
                                            <textarea id="content" class="form-control" name="content" aria-label="" wire:model.defer="content"></textarea>
                                            @error('content')
                                            <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 my-2">
                                            <label class="switch">
                                                <input type="checkbox" class="switch-input checked-details"
                                                       wire:model="is_feature"
                                                >
                                                <span class="switch-toggle-slider">
                                                  <span class="switch-on"></span>
                                                  <span class="switch-off"></span>
                                            </span>
                                                <span class="switch-label">{{__('Is feature')}}</span>
                                            </label>
                                        </div>
                                        <div class="col-md-4 my-2">
                                            <label class="switch">
                                                <input type="checkbox" class="switch-input checked-details"
                                                       wire:model="best_selling"
                                                >
                                                <span class="switch-toggle-slider">
                                                  <span class="switch-on"></span>
                                                  <span class="switch-off"></span>
                                            </span>
                                                <span class="switch-label">{{__('Best selling')}}</span>
                                            </label>
                                        </div>
                                        <div class="col-md-4 my-2">
                                            <label class="switch">
                                                <input type="checkbox" class="switch-input checked-details"
                                                       wire:model="is_active"
                                                >
                                                <span class="switch-toggle-slider">
                                                  <span class="switch-on"></span>
                                                  <span class="switch-off"></span>
                                            </span>
                                                <span class="switch-label">{{__('Is active')}}</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 text-center">
                                    <button type="button" class="btn btn-primary me-sm-3 me-1" wire:loading.class="disabled" wire:loading.attr="disabled" wire:target="save" wire:click='save'>
                                        {{__('Save')}}</button>
                                    <button type="reset" class="btn btn-secondary btn-reset" data-bs-dismiss="modal" wire:click="closeAndClean">
                                        {{__('Cancel')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <script src="{{asset('js/jquery.min.js')}}"></script>
            <script src="{{asset('js/select2.min.js')}}" defer></script>
            <script>
                $(function () {
                    window.initPostsCreate=()=>{
                        // Select2
                        $('.select-posts .single-select').select2({
                            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                            dropdownParent: $('.select-posts')
                        });
                    }
                    $('.select-posts .single-select').on('change', function (e) {
                        livewire.emit('PostsCreateChange', $(this).val(), $(this).attr('wire:model.defer'))
                    });
                    window.livewire.on('PostsCreateHydrate',()=>{
                        initPostsCreate();
                    });
                    livewire.emit('PostsCreateChange', '', '');
                    Livewire.on('postSaved', () => {
                        $('#create').modal('hide'); // Cierra el modal
                    });
                });
            </script>
        </div>
        <div class="content-backdrop fade"></div>
    </div>
    @include('frontend.profile.edit-profile')
</div>
