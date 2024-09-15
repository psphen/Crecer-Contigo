<div>
    <div  wire:ignore.self class="modal fade" id="create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-simple">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="closeAndClean"></button>
                    <div class="text-center mb-4">
                        <h3 class="mb-2">{{__('Add vendor')}}</h3>
                        <p class="text-muted">{{__('Complete the information to add a new vendor')}}</p>
                    </div>
                    <form class="row g-3" wire:submite.prevent="save">
                        <div class="col-md-12">
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
                                        <input type="file" class="profilePicUpload" wire:model="image" id="image_create" name="" accept=".png, .jpg, .jpeg">
                                        <label for="image_create" class="bg--primary">{{__('Add image')}}</label>

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
                            <input type="text" id="first_name" class="form-control" placeholder="" name="first_name" aria-label="" wire:model.defer="first_name" />
                            @error('first_name')
                            <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label class="form-label" for="last_name">{{__('Last name')}}:</label>
                            <input type="text" id="last_name" class="form-control" placeholder="" name="last_name" aria-label="" wire:model.defer="last_name" />
                            @error('last_name')
                            <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label class="form-label" for="dni">{{__('Dni')}}:</label>
                            <input type="number" id="dni" class="form-control" placeholder="" name="dni" aria-label="" wire:model.defer="dni" />
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
                            <input type="number" id="email" class="form-control" placeholder="" name="phone" aria-label="" wire:model.defer="phone" />
                            @error('phone')
                            <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                            @enderror
                        </div>
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
</div>
