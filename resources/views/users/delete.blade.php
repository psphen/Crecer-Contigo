<div>
    <div wire:ignore.self  class="modal fade" id="delete"  tabindex="-1" aria-labelledby="exampleModalLabel" style="" aria-hidden="true" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-simple modal-md">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-4">
                        <h3 class="mb-2">{{__('Delete user')}}</h3>

                    </div>
                    <form class="row g-3 d-flex justify-content-center align-items-center" wire:submit.prevent="destroy">
                        <div class="col-md-12 text-center">
                            <p class="text-muted">{{__('Are you sure you want to delete this user?')}}</p>
                        </div>
                        <div class="col-12 text-center">
                            <button type="button" class="btn btn-primary me-sm-3 me-1" wire:loading.class="disabled" wire:loading.attr="disabled" wire:target="destroy" wire:click='destroy'>
                                {{__('Delete')}}</button>
                            <button type="reset" class="btn btn-label-secondary btn-reset" data-bs-dismiss="modal" aria-label="Close">
                                {{__('Cancel')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
