<div>
    <div wire:ignore.self  class="modal fade" id="types"  tabindex="-1" aria-labelledby="exampleModalLabel" style="" aria-hidden="true" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog  modal-simple">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-4">
                        <h3 class="mb-2">{{__('Place types')}}</h3>
                        <p class="text-muted">{{__('Here you will find a list of place types for the places and you can add others')}}</p>
                    </div>
                    <form class="row g-1" wire:submit.prevent="updateTypes" id="formAuthentication">
                        <div class="col-md-12">
                            <div class="row my-2">
                                @foreach ($addTypes as $index => $addType)
                                    <div class="col-md-8 my-1">
                                        <label class="form-label" for="addRoles[{{$index}}][name]">{{__('Name')}}:</label>
                                        <input type="text"
                                               name="addTypes[{{$index}}][name]"
                                               class="form-control"
                                               wire:model="addTypes.{{$index}}.name" />
                                    </div>
                                    <div class="col-md-2 my-1 text-center">
                                        <button class="btn btn-label-danger mt-4 waves-effect" wire:click.prevent="removeTypes({{$index}})">
                                            <i class="ti ti-x ti-xs me-1"></i>
                                            <span class="align-middle">{{__('Delete')}}</span>
                                        </button>
                                    </div>
                                @endforeach
                                <div class="col-md-12 text-center">
                                    <button class="btn btn-primary waves-effect waves-light" wire:click.prevent="addTypes">+ {{__('Add')}}</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 text-center">
                            <button type="button" class="btn btn-primary me-sm-3 me-1" wire:loading.class="disabled" wire:loading.attr="disabled" wire:target="updateTypes" wire:click='updateTypes'>
                                {{__('Save')}}</button>
                            <button type="reset" class="btn btn-label-secondary btn-reset" data-bs-dismiss="modal" aria-label="Close">
                                {{__('Cancel')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
