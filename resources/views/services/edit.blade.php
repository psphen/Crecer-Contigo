<div>
    <div  wire:ignore.self class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-simple">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
                    <div class="modal-header">
                        <div class="text-center mb-4">
                            <h3 class="mb-2">{{__('Update service')}}</h3>
                            <p class="text-muted">{{__('Update service information')}}</p>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <label class="form-label" for="name">{{__('Name')}}:</label>
                                <input type="text" id="name" class="form-control" placeholder="" name="name" aria-label="" wire:model="name" />
                                @error('name')
                                    <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="costo" class="form-label">{{__('Costo')}}:</label>
                                <input type="text" id="costo" class="form-control" placeholder="" name="costo" aria-label="" wire:model="costo" />
                                @error('costo')
                                    <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="sections" class="form-label">{{__('Sections')}}:</label>
                                <input type="text" id="sections" class="form-control" placeholder="" name="sections" aria-label="" wire:model="sections" />
                                @error('sections')
                                    <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                                @enderror
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
                            <button type="button" class="btn btn-primary me-sm-3 me-1" wire:loading.class="disabled" wire:loading.attr="disabled" wire:target="update" wire:click='update'>
                                {{__('Save')}}
                            </button>
                            <button type="reset" class="btn btn-secondary btn-reset" data-bs-dismiss="modal">
                                {{__('Cancel')}}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
