<div>
    <div  wire:ignore.self class="modal fade" id="create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-simple">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="closeAndClean"></button>
                    <div class="text-center mb-4">
                        <h3 class="mb-2">{{__('Add subcategory')}}</h3>
                        <p class="text-muted">{{__('Complete the information to add a new subcategory')}}</p>
                    </div>
                    <form class="row g-3" wire:submite.prevent="save">
                        <div class="col-md-12">
                            <label class="form-label" for="name">{{__('Name')}}:</label>
                            <input type="text" id="name" class="form-control" placeholder="" name="name" aria-label="" wire:model.defer="name" />
                            @error('name')
                            <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12 select-subcategories">
                            <label class="form-label" for="category_id">{{__('Parent category')}}</label>
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
            window.initSubcategoriesCreate=()=>{
                // Select2
                $('.select-subcategories .single-select').select2({
                    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                    placeholder: $(this).data('placeholder') ? $(this).data('placeholder') : 'Selecciona ...',
                    dropdownParent: $('.select-subcategories')
                });
            }
            $('.select-subcategories .single-select').on('change', function (e) {
                livewire.emit('SubcategoriesCreateChange', $(this).val(), $(this).attr('wire:model.defer'))
            });
            window.livewire.on('SubcategoriesCreateHydrate',()=>{
                initSubcategoriesCreate();
            });
            livewire.emit('SubcategoriesCreateChange', '', '');
        });
    </script>
</div>
