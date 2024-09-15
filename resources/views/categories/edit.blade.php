<div>
    <div  wire:ignore.self class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-simple">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
                    <div class="text-center mb-4">
                        <h3 class="mb-2">{{__('Update category')}}</h3>
                        <p class="text-muted">{{__('Update category information')}}</p>
                    </div>
                    <form class="row g-3" wire:submite.prevent="update">
                        <div class="col-md-12">
                            <label class="form-label" for="image">{{__('Icon')}}</label>
                            <div class="image-upload">
                                <div class="thumb text-center">
                                    <div class="avatar-preview">
                                        <div class="profilePicPreview"
                                             @if($icon)
                                                 style="background: url('{{$icon->temporaryUrl()}}')"
                                            @else
                                                @if($icon_edit!=null)
                                                    style="background: url('{{asset('uploads/categories/icons/'.$icon_edit)}}')"
                                                @endif
                                            @endif>
                                            <button type="button" class="remove-image"><i class="fa fa-times"></i></button>
                                        </div>
                                    </div>
                                    <div class="avatar-edit">
                                        <input type="file" class="profilePicUpload" wire:model="icon" id="icon_edit" name="" accept=".png, .jpg, .jpeg, .svg">
                                        <label for="icon_edit" class="bg--primary">{{__('Add icon')}}</label>

                                    </div>
                                    <small class="mt-2 text-center">{{__('Compatibilities')}}: <b>jpeg, jpg, png</b> {{__('Resized to')}}: <b>{{$icon_width}}x{{$icon_height}}</b>px.
                                    </small>
                                </div>
                            </div>
                            @error('icon')
                            <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label class="form-label" for="name">{{__('Name')}}:</label>
                            <input type="text" id="name" class="form-control" placeholder="" name="name" aria-label="" wire:model.defer="category.name" />
                            @error('name')
                            <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label class="form-label" for="priority">{{__('Priority')}}:</label>
                            <input type="text" id="priority" class="form-control" placeholder="" name="priority" aria-label="" wire:model.defer="category.priority" />
                            @error('priority')
                            <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                            @enderror
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
</div>
