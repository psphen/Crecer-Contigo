<div>
    <div  wire:ignore.self class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-simple modal-lg">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-4">
                        <h3 class="mb-2">{{__('Update city')}}</h3>
                        <p class="text-muted">{{__('Update city information')}}</p>
                    </div>
                    <form class="row g-3" wire:submite.prevent="update">
                        <div class="col-md-12 my-2">
                            <label class="switch">
                                <input type="checkbox" class="switch-input checked-details"
                                       wire:model="city.is_active"
                                >
                                <span class="switch-toggle-slider">
                                          <span class="switch-on"></span>
                                          <span class="switch-off"></span>
                                    </span>
                                <span class="switch-label">{{__('Is active')}}</span>
                            </label>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="name">{{__('Name')}}:</label>
                            <input type="text" id="name" class="form-control" placeholder="" name="name" aria-label="" wire:model.defer="city.name" />
                            @error('name')
                            <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                            @enderror
                        </div>
                        <div class="col-6 select-cities-edit">
                            <label class="form-label" for="state_id_edit">{{__('State')}}</label>
                            <select id="state_id_edit" name="state_id" wire:model.defer="city.state_id" class="select2 form-select single-select" data-placeholder="{{__('Select a state')}}...">
                                <option></option>
                                @foreach($states as $state)
                                    <option value="{{$state->id}}">{{$state->name}}</option>
                                @endforeach
                            </select>
                            @error('state_id')
                            <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label class="form-label" for="description">{{__('Description')}}:</label>
                            <textarea name="description" id="description" class="form-control" wire:model.defer="city.description"></textarea>
                            @error('description')
                            <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label class="form-label" for="introduction">{{__('Introduction')}}:</label>
                            <textarea name="introduction" id="introduction" class="form-control" wire:model.defer="city.introduction"></textarea>
                            @error('introduction')
                            <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="image">{{__('Thumbnail')}}</label>
                            <div class="image-upload">
                                <div class="thumb text-center">
                                    <div class="avatar-preview">
                                        <div class="profilePicPreview"
                                             @if($thumbnail_image)
                                                 style="background: url('{{$thumbnail_image->temporaryUrl()}}')"
                                            @else
                                                @if($thumbnail_image_edit!=null)
                                                    style="background: url('{{asset('uploads/cities/thumbnails/'.$thumbnail_image_edit)}}')"
                                                @endif
                                            @endif>
                                            <button type="button" class="remove-image"><i class="fa fa-times"></i></button>
                                        </div>
                                    </div>
                                    <div class="avatar-edit">
                                        <input type="file" class="profilePicUpload" wire:model="thumbnail_image" id="thumbnail_image_edit" name="" accept=".png, .jpg, .jpeg">
                                        <label for="thumbnail_image_edit" class="bg--primary">{{__('Add thumbnail')}}</label>

                                    </div>
                                    <small class="mt-2 text-center">{{__('Compatibilities')}}: <b>jpeg, jpg, png</b> {{__('Resized to')}}: <b>{{$thumbnail_width}}x{{$thumbnail_height}}</b>px.
                                    </small>
                                </div>
                            </div>
                            @error('thumbnail_image')
                            <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="image">{{__('Banner')}}</label>
                            <div class="image-upload">
                                <div class="thumb text-center">
                                    <div class="avatar-preview">
                                        <div class="profilePicPreview"
                                             @if($banner_image)
                                                 style="background: url('{{$banner_image->temporaryUrl()}}')"
                                             @else
                                                 @if($banner_image_edit!=null)
                                                     style="background: url('{{asset('uploads/cities/banners/'.$banner_image_edit)}}')"
                                                 @endif
                                            @endif>
                                            <button type="button" class="remove-image"><i class="fa fa-times"></i></button>
                                        </div>
                                    </div>
                                    <div class="avatar-edit">
                                        <input type="file" class="profilePicUpload" wire:model="banner_image" id="banner_image_edit" name="" accept=".png, .jpg, .jpeg, .webp">
                                        <label for="banner_image_edit" class="bg--primary">{{__('Add banner')}}</label>
                                    </div>
                                    <small class="mt-2 text-center">{{__('Compatibilities')}}: <b>jpeg, jpg, png</b> {{__('Resized to')}}: <b>{{$banner_width}}x{{$banner_height}}</b>px.
                                    </small>
                                </div>
                            </div>
                            @error('banner_image')
                            <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                            @enderror
                        </div>
                        <div class="col-4 select-cities-edit">
                            <label class="form-label" for="currency_id_edit">{{__('Currency')}}</label>
                            <select id="currency_id_edit" name="currency_id" wire:model.defer="city.currency_id" class="select2 form-select single-select" data-placeholder="{{__('Select a currency')}}...">
                                <option></option>
                                @foreach($currencies as $currency)
                                    <option value="{{$currency->id}}">{{$currency->name}}</option>
                                @endforeach
                            </select>
                            @error('currency_id')
                            <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                            @enderror
                        </div>
                        <div class="col-4 select-cities-edit">
                            <label class="form-label" for="language_id_edit">{{__('Language')}}</label>
                            <select id="language_id_edit" name="language_id" wire:model.defer="city.language_id" class="select2 form-select single-select" data-placeholder="{{__('Select a language')}}...">
                                <option></option>
                                @foreach($languages as $language)
                                    <option value="{{$language->id}}">{{$language->name}}</option>
                                @endforeach
                            </select>
                            @error('language_id')
                            <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                            @enderror
                        </div>
                        <div class="col-4 select-cities-edit">
                            <label class="form-label" for="best_time_buy_edit">{{__('Best time for buy')}}</label>
                            <select id="best_time_buy_edit" name="best_time_buy" wire:model.defer="city.best_time_buy" class="select2 form-select single-select" data-placeholder="{{__('Select a month')}}...">
                                <option></option>
                                @foreach($months as $month)
                                    <option value="{{$month->id}}">{{$month->name}}</option>
                                @endforeach
                            </select>
                            @error('best_time_buy')
                            <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label class="form-label" for="address-edit">{{__('Location')}}:</label>
                            <input type="text" id="address-edit" class="form-control" placeholder="" name="address" aria-label="" wire:model.defer="address_edit" />
                            @error('address')
                            <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12" wire:ignore>
                            <div>
                                <div id="mapa-edit" style="position: relative; width:100%;height:370px; "></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <input type="hidden" name="latitude" id="latitude" wire:model.defer="latitude_edit" class="form-control " value="0">
                            <input type="hidden" name="longitude" id="longitude" wire:model.defer="longitude_edit" class="form-control " value="0">
                        </div>
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
            window.initCitiesUpdate=()=>{
                // Select2
                $('.select-cities-edit .single-select').select2({
                    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                    placeholder: $(this).data('placeholder') ? $(this).data('placeholder') : 'Selecciona ...',
                    allowClear: Boolean($(this).data('allow-clear')),
                    dropdownParent: $('.select-cities-edit')
                });
            }
            $('.select-cities-edit .single-select').on('change', function (e) {
                livewire.emit('CitiesShowChange', $(this).val(), $(this).attr('wire:model.defer'))
            });
            window.livewire.on('CitiesShowHydrate',()=>{
                initCitiesUpdate();
            });

            livewire.emit('CitiesShowChange', '', '');
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
