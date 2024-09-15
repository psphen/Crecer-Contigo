<div>
    <div  wire:ignore.self class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-simple">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="closeAndClean"></button>
                    <div class="text-center mb-4">
                        <h3 class="mb-2">{{__('Update vendor')}}</h3>
                        <p class="text-muted">{{__('Update vendor information')}}</p>
                    </div>
                    <form class="row g-3" wire:submite.prevent="update">
                        <div class="col-md-12">
                            <label class="form-label" for="image">{{__('Image')}}</label>
                            <div class="image-upload">
                                <div class="thumb text-center">
                                    <div class="avatar-preview">
                                        <div class="profilePicPreview"

                                             @if($image)
                                                 style="background: url('{{$image->temporaryUrl()}}')"
                                             @else
                                                 @if($image_edit!=null)
                                                     style="background: url('{{asset('uploads/users/'.$image_edit)}}')"
                                            @endif
                                            @endif>
{{--                                        >--}}
{{--                                            @if($image)--}}
{{--                                                <img src="{{$image->temporaryUrl()}}" alt="" class="img-fluid">--}}
{{--                                            @else--}}
{{--                                                @if($image_edit!=null)--}}
{{--                                                    <img src="{{asset('uploads/users/'.$image_edit)}}" alt="" class="img-fluid">--}}
{{--                                                @endif--}}
{{--                                            @endif--}}
                                            <button type="button" class="remove-image"><i class="fa fa-times"></i></button>
                                        </div>
                                    </div>
                                    <div class="avatar-edit">
                                        <input type="file" class="profilePicUpload" wire:model="image" id="image_edit" name="" accept=".png, .jpg, .jpeg">
                                        <label for="image_edit" class="bg--primary">{{__('Add image')}}</label>

                                    </div>
                                    <small class="mt-2 text-center">{{__('Compatibilities')}}: <b>jpeg, jpg, png</b> {{__('Resized to')}}: <b>{{$image_width}}x{{$image_height}}</b>px.
                                    </small>
                                </div>
                            </div>
                            @error('thumbnail_image')
                            <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label class="form-label" for="first_name">{{__('First name')}}:</label>
                            <input type="text" id="first_name" class="form-control" placeholder="" name="first_name" aria-label="" wire:model.defer="vendor.first_name" />
                            @error('first_name')
                            <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label class="form-label" for="last_name">{{__('Last name')}}:</label>
                            <input type="text" id="last_name" class="form-control" placeholder="" name="last_name" aria-label="" wire:model.defer="vendor.last_name" />
                            @error('last_name')
                            <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label class="form-label" for="dni">{{__('Dni')}}:</label>
                            <input type="number" id="dni" class="form-control" placeholder="" name="dni" aria-label="" wire:model.defer="vendor.dni" />
                            @error('dni')
                            <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label class="form-label" for="email">{{__('Email')}}:</label>
                            <input type="email" id="email" class="form-control" placeholder="" name="email" aria-label="" wire:model.defer="email" />
                            @error('email')
                            <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label class="form-label" for="phone">{{__('Phone')}}:</label>
                            <input type="number" id="email" class="form-control" placeholder="" name="phone" aria-label="" wire:model.defer="vendor.phone" />
                            @error('phone')
                            <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12 my-2">
                            <label class="switch">
                                <input type="checkbox" class="switch-input checked-details" value="0" wire:click="$toggle('togglePassword')">
                                <span class="switch-toggle-slider">
                                          <span class="switch-on"></span>
                                          <span class="switch-off"></span>
                                    </span>
                                <span class="switch-label">{{__('Update password')}}</span>
                            </label>
                        </div>
                        @if($togglePassword)
                            <div class="form-password-toggle col-12">
                                <label class="form-label" for="password">{{__('Password')}}:</label>
                                <div class="input-group input-group-merge">
                                    <input id="password" type="password" class="form-control" name="password"
                                           placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                           aria-describedby="password" wire:model.defer="password"
                                           autocomplete="current-password">
                                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                    @error('password')
                                    <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                                    @enderror
                                </div>
                            </div>
                        @endif

                        <div class="col-md-12 text-center">
                            <button type="button" class="btn btn-primary me-sm-3 me-1" wire:loading.class="disabled" wire:loading.attr="disabled" wire:target="update" wire:click='update'>
                                {{__('Save')}}</button>
                            <button type="reset" class="btn btn-secondary btn-reset" data-bs-dismiss="modal" wire:click="closeAndClean">
                                {{__('Cancel')}}</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
