<div>
    <div  wire:ignore.self class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-simple modal-xl">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-4">
                        <h3 class="mb-2">{{__('Update place')}}</h3>
                        <p class="text-muted">{{__('Update place information')}}</p>
                    </div>
                    <form class="row g-3" wire:submit.prevent="update" enctype="multipart/form-data">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="form-label" for="image">{{__('Image')}}</label>
                                    <div class="image-upload">
                                        <div class="thumb text-center">
                                            <div class="avatar-preview">
                                                <div class="profilePicPreview">
                                                    @if($place_image_edit)
                                                        <img src="{{$place_image_edit->temporaryUrl()}}" alt="" class="img-fluid" >
                                                    @else
                                                        @if($place_image_update!=null)
                                                            <img src="{{asset('uploads/places/photo/'.$place_image_update)}}" alt="" class="img-fluid">
                                                        @endif
                                                    @endif
                                                    <button type="button" class="remove-image"><i class="fa fa-times"></i></button>
                                                </div>
                                            </div>
                                            <div class="avatar-edit">
                                                <input type="file" class="profilePicUpload" wire:model="place_image_edit" id="image_edit" name="" accept=".png, .jpg, .jpeg">
                                                <label for="image_edit" class="bg--primary">{{__('Add image')}}</label>

                                            </div>
                                            <small class="mt-2 text-center">{{__('Compatibilities')}}: <b>jpeg, jpg, png</b> {{__('Resized to')}}: <b>{{$image_width}}x{{$image_height}}</b>px.
                                            </small>
                                        </div>
                                    </div>
                                    @error('image')
                                    <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-8">
                                    <label class="form-label" for="image">{{__('Banner')}}</label>
                                    <div class="image-upload">
                                        <div class="thumb text-center">
                                            <div class="avatar-preview">
                                                <div class="profilePicPreview">
                                                    @if($place_banner_edit)
                                                        <img src="{{$place_banner_edit->temporaryUrl()}}" alt="" class="img-fluid" >
                                                    @else
                                                        @if($place_banner_update!=null)
                                                            <img src="{{asset('uploads/places/banner/'.$place_banner_update)}}" alt="" class="img-fluid">
                                                        @endif
                                                    @endif
                                                    <button type="button" class="remove-image"><i class="fa fa-times"></i></button>
                                                </div>
                                            </div>
                                            <div class="avatar-edit">
                                                <input type="file" class="profilePicUpload" wire:model="place_banner_edit" id="banner_edit" name="" accept=".png, .jpg, .jpeg">
                                                <label for="banner_edit" class="bg--primary">{{__('Add banner')}}</label>

                                            </div>
                                            <small class="mt-2 text-center">{{__('Compatibilities')}}: <b>jpeg, jpg, png</b> {{__('Resized to')}}: <b>{{$banner_width}}x{{$banner_height}}</b>px.
                                            </small>
                                        </div>
                                    </div>
                                    @error('place_banner_edit')
                                    <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-12">
                                        <label class="form-label" for="name">{{__('Name')}}:</label>
                                        <input type="text" id="name" class="form-control" placeholder="" name="name" aria-label="" wire:model.defer="place.name" />
                                        @error('name')
                                        <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label" for="description">{{__('Description')}}:</label>
                                        <textarea id="description" class="form-control" name="description" aria-label="" wire:model.defer="place.description"></textarea>
                                        @error('description')
                                        <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label" for="phone">{{__('Phone')}}:</label>
                                        <input type="tel" id="phone" class="form-control" placeholder="" name="phone" aria-label="" wire:model.defer="place.phone" />
                                        @error('phone')
                                        <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label" for="email">{{__('Email')}}:</label>
                                        <input type="email" id="email" class="form-control" placeholder="" name="email" aria-label="" wire:model.defer="place.email" />
                                        @error('email')
                                        <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="row g-3">
                                <div class="col-md-12 select-places-edit">
                                    <label class="form-label" for="user_id-edit">{{__('User')}}</label>
                                    <select id="user_id-edit" name="user_id" wire:model.defer="place.user_id" class="select2 form-select single-select" data-placeholder="{{__('Select a user')}}...">
                                        <option></option>
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                    <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12 select-places-edit">
                                    <label class="form-label" for="type_id-edit">{{__('Type')}}</label>
                                    <select id="type_id-edit" name="type_id" wire:model.defer="place.type_id" class="select2 form-select single-select" data-placeholder="{{__('Select a type')}}...">
                                        <option></option>
                                        @foreach($types as $type)
                                            <option value="{{$type->id}}">{{$type->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('type_id')
                                    <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12 select-places-edit">
                                    <label class="form-label" for="city_id-edit">{{__('City')}}</label>
                                    <select id="city_id-edit" name="city_id" wire:model.defer="place.city_id" class="select2 form-select single-select" data-placeholder="{{__('Select a city')}}...">
                                        <option></option>
                                        @foreach($cities as $city)
                                            <option value="{{$city->id}}">{{$city->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('city_id')
                                    <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label" for="site_web">{{__('Site web')}}:</label>
                                    <input type="text" id="site_web" class="form-control" placeholder="" name="site_web" aria-label="" wire:model.defer="place.site_web" />
                                    @error('site_web')
                                    <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label" for="facebook_url">{{__('Facebook url')}}:</label>
                                    <input type="text" id="facebook_url" class="form-control" placeholder="" name="facebook_url" aria-label="" wire:model.defer="place.facebook_url" />
                                    @error('facebook_url')
                                    <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label" for="instagram_url">{{__('Instagram url')}}:</label>
                                    <input type="text" id="instagram_url" class="form-control" placeholder="" name="site_web" aria-label="" wire:model.defer="place.instagram_url" />
                                    @error('instagram_url')
                                    <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="row g-2">
                                <div class="col-md-12">
                                    <label class="form-label" for="address_edit">{{__('Address')}}:</label>
                                    <input type="text" id="address_edit" class="form-control" name="address" aria-label="" wire:model.defer="address_edit" />
                                    @error('address')
                                    <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12" wire:ignore>
                                    <div id="mapa-edit" style="position: relative; width:100%;height:395px; "></div>
                                </div>
                                <div class="col-md-12">
                                    <input type="hidden" name="latitude_edit" id="latitude_edit" wire:model.defer="latitude_edit" class="form-control " value="0">
                                    <input type="hidden" name="longitude_edit" id="longitude_edit" wire:model.defer="longitude_edit" class="form-control " value="0">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 select-places-edit">
                            <label class="form-label" for="video_type-edit">{{__('Video type')}}</label>
                            <select id="video_type-edit" name="video_type-edit" wire:model="video_type_edit" class="select2 form-select single-select" data-placeholder="{{__('Select a type')}}...">
                                <option></option>
                                @foreach($video_types as $type)
                                    <option value="{{$type['value']}}">{{__($type['name'])}}</option>
                                @endforeach
                            </select>
                            @error('video_type')
                            <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="video">{{__('Video')}}:</label>
                            @if($video_type_edit==1)
                                <input type="text" id="video-youtube-edit" class="form-control" placeholder="" name="video-youtube-edit" aria-label="" wire:model="youtube_edit" />
                            @else
                                <input type="file" id="video-upload-edit" class="form-control" placeholder="" name="video-upload-edit" aria-label="" wire:model="upload_edit"/>
                            @endif
                        </div>
                        <div class="col-md-6 select-places-edit">
                            <label class="form-label" for="categories_edit">{{__('Categories')}}</label>
                            <select id="categories_edit" name="categories_edit" wire:model.defer="place_categories_edit" class="select2 form-select single-select" data-placeholder="{{__('Select a categories')}}..." multiple>
                                <option></option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                            @error('categories')
                            <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 select-places-edit">
                            <label class="form-label" for="services_edit">{{__('Services')}}</label>
                            <select id="services_edit" name="services_edit" wire:model.defer="place_services_edit" class="select2 form-select single-select" data-placeholder="{{__('Select a services')}}..." multiple>
                                <option></option>
                                @foreach($services as $service)
                                    <option value="{{$service->id}}">{{$service->name}}</option>
                                @endforeach
                            </select>
                            @error('services')
                            <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                            @enderror
                        </div>
                        <hr>
                        <div class="col-md-12">
                            <div class="row g-2">
                                <div class="col-md-12 text-center">
                                    <h4>{{__('Schedule')}}</h4>
                                </div>
                                @foreach ($placeSchedules as $index => $placeSchedule)
                                    <div class="col-md-3">
                                        <label class="form-label" for="placeSchedules[{{$index}}][week_day_id]">{{__('Day')}}:</label>
                                        <select name="placeSchedules[{{$index}}][week_day_id]"
                                                wire:model.defer="placeSchedules.{{$index}}.week_day_id"
                                                class="form-control single-select" id="placeSchedules[{{$index}}][week_day_id]" data-placeholder="{{__('Select a day')}}...">
                                            <option value=""></option>
                                            @foreach ($week_days as $day)
                                                <option value="{{ $day->id }}"> {{ $day->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label" for="location">{{__('Start hour')}}:</label>
                                        <input type="time"
                                               name="placeSchedules[{{$index}}][start_hour]"
                                               class="form-control"
                                               wire:model.defer="placeSchedules.{{$index}}.start_hour" />
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label" for="location">{{__('End hour')}}:</label>
                                        <input type="time"
                                               name="placeSchedules[{{$index}}][end_hour]"
                                               class="form-control"
                                               wire:model.defer="placeSchedules.{{$index}}.end_hour" />
                                    </div>
                                    <div class="col-md-3 text-center">
                                        <button class="btn btn-label-danger mt-4 waves-effect" wire:click.prevent="removeSchedules({{$index}})">
                                            <i class="ti ti-x ti-xs me-1"></i>
                                            <span class="align-middle">{{__('Delete')}}</span>
                                        </button>
                                    </div>
                                @endforeach

                                <div class="col-md-12 text-center">
                                    <button class="btn btn-primary waves-effect waves-light" wire:click.prevent="addSchedules">+ {{__('Add')}}</button>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="col-md-12 text-center">
                            <h4>{{__('Gallery of images')}}</h4>
                            <input type="file" id="images-edit" class="form-control" placeholder="" name="images" aria-label="" wire:model.defer="images" multiple/>
                        </div>
                        @foreach ($existingImages as $key => $image)
                            <div class="col-md-3">
                                <div class="image-preview position-relative">
                                    <img src="{{ asset('uploads/places/gallery/' . $folderName . '/' . $image->image_path) }}" alt="Preview" class="img-thumbnail">
                                    <button wire:click.prevent="removeExistingImage({{ $key }})" class="btn btn-danger btn-remove-image">
                                        <span wire:loading wire:target="removeExistingImage({{ $key }})" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                        <i class="ti ti-trash"></i>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                        @foreach ($images as $key => $image)
                            <div class="col-md-3">
                                <div class="image-preview position-relative">
                                    <img src="{{ $image->temporaryUrl() }}" alt="Preview" class="img-thumbnail">
                                    <button wire:click.prevent="removeImage({{ $key }})" class="btn btn-danger btn-remove-image">
                                        <span wire:loading wire:target="removeImage({{ $key }})" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                        <i class="ti ti-trash"></i>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                        <div class="col-md-12 text-center">
                            <button type="button" class="btn btn-primary me-sm-3 me-1" wire:loading.class="disabled" wire:loading.attr="disabled" wire:target="update" wire:click='update'>
                                {{__('Save')}}</button>
                            <button type="reset" class="btn btn-secondary btn-reset" data-bs-dismiss="modal">
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
            window.initPlacesUpdate=()=>{
                // Select2
                $('.select-places-edit .single-select').select2({
                    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                    placeholder: $(this).data('placeholder') ? $(this).data('placeholder') : 'Selecciona ...',
                    dropdownParent: $('.select-places-edit')
                });
            }
            $('.select-places-edit .single-select').on('change', function (e) {
                livewire.emit('PlacesShowChange', $(this).val(), $(this).attr('wire:model.defer'))
            });
            $('#video_type-edit').on('change', function (e) {
                livewire.emit('PlacesShowChange', $(this).val(), $(this).attr('wire:model'))
            });
            window.livewire.on('PlacesShowHydrate',()=>{
                initPlacesUpdate();
            });
            livewire.emit('PlacesShowChange', '', '');
        });
    </script>
    <script>
        function Edit(){
            const map = new google.maps.Map(document.getElementById("mapa-edit"), {
                center: { lat: 4.141533499268974, lng:-73.63446918054353},
                zoom: 13,
                mapTypeId: "roadmap",
            });
            const input = document.getElementById("address-edit");
            const searchBox = new google.maps.places.SearchBox(input);

            map.addListener("bounds_changed", () => {
                searchBox.setBounds(map.getBounds());
            });

            let markers = [];

            searchBox.addListener("places_changed", () => {
                const places = searchBox.getPlaces();
                if (places.length == 0) {
                    return;
                }
                markers.forEach((marker) => {
                    marker.setMap(null);
                });
                markers = [];
                const bounds = new google.maps.LatLngBounds();

                places.forEach((place) => {
                    if (!place.geometry || !place.geometry.location) {
                        console.log("Returned place contains no geometry");
                        return;
                    }
                    markers.push(
                        new google.maps.Marker({
                            map,
                            title: place.name,
                            position: place.geometry.location,
                        })
                    );
                    if (place.geometry.viewport) {
                        bounds.union(place.geometry.viewport);
                    @this.set('address_edit', place.name);
                    @this.set('latitude_edit', place.geometry.location.lat());
                    @this.set('longitude_edit', place.geometry.location.lng());
                    } else {
                        bounds.extend(place.geometry.location);
                        console.log(place.name)
                    @this.set('address_edit', place.name);
                    @this.set('latitude_edit', place.geometry.location.lat());
                    @this.set('longitude_edit', place.geometry.location.lng());
                    }
                });
                map.fitBounds(bounds);
            });
        }
        window.addEventListener('load', Edit)
    </script>
</div>
