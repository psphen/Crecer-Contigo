<div>
    <div  wire:ignore.self class="modal fade" id="create" role="dialog" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content p-5">
                <div class="modal-header">
                    <div class="col-md-12 text-center">
                        <h3 class="mb-2">{{__('Add service')}}</h3>
                        <p class="text-muted">{{__('Complete the information to add a new service')}}</p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="closeAndClean"></button>
                </div>
                <div class="modal-body py-0">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label" for="image">{{__('Thumbnail')}}</label>
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
                                        <label for="image_create" class="bg--primary">{{__('Add thumbnail')}}</label>

                                    </div>
                                    <small class="mt-2 text-center">{{__('Compatibilities')}}: <b>jpeg, jpg, png</b> {{__('Resized to')}}: <b>{{$image_width}}x{{$image_height}}</b>px.
                                    </small>
                                </div>
                            </div>
                            @error('image')
                            <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="form-label" for="name">{{__('Name')}}:</label>
                                    <input type="text" id="name" class="form-control" placeholder="" name="name" aria-label="" wire:model="name" />
                                    @error('name')
                                        <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label for="sections" class="form-label">{{__('Sections')}}:</label>
                                    <input type="text" id="sections" class="form-control" placeholder="" name="sections" aria-label="" wire:model="sections" />
                                    @error('sections')
                                        <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label for="price" class="form-label">{{__('Price')}}:</label>
                                    <input type="text" id="price" class="form-control" placeholder="" name="price" aria-label="" wire:model="price" />
                                    @error('price')
                                        <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label for="is_active" class="form-label">{{__('Status')}}:</label>
                                    <select id="is_active" class="form-control" name="is_active" aria-label="" wire:model="is_active">
                                        <option value=""></option>
                                        <option value="1">{{__('Active')}}</option>
                                        <option value="0">{{__('Inactive')}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="description" class="form-label">{{__('Description')}}:</label>
                            <textarea id="description" class="form-control" placeholder="" name="description" aria-label="" wire:model="description"></textarea>
                            @error('description')
                                <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-md-12 text-center">
                        <button type="button" class="btn btn-primary me-sm-3 me-1" wire:loading.class="disabled" wire:loading.attr="disabled" wire:target="save" wire:click='save'>
                            {{__('Save')}}
                        </button>
                        <button type="reset" class="btn btn-secondary btn-reset" data-bs-dismiss="modal" wire:click="closeAndClean">
                            {{__('Cancel')}}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
