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
                                        <div class="profilePicPreview">
                                            @if($image)
                                                <img class="profilePicPreview" src="{{$image->temporaryUrl()}}">
                                            @endif
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
                                    <input type="text" id="name" class="form-control @error ('name') is-invalid @enderror" placeholder="" name="name" aria-label="" wire:model="name" />
                                </div>
                                <div class="col-md-12">
                                    <label for="sections" class="form-label">{{__('Sections')}}:</label>
                                    <input type="text" id="sections" class="form-control @error ('sections') is-invalid @enderror" placeholder="" name="sections" aria-label="" wire:model="sections" />
                                </div>
                                <div class="col-md-12">
                                    <label for="price" class="form-label">{{__('Price')}}:</label>
                                    <input type="number" id="price" class="form-control @error ('price') is-invalid @enderror" placeholder="" name="price" aria-label="" wire:model="price" />
                                    @error('price')
                                        <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label for="is_active" class="form-label">{{__('Status')}}:</label>
                                    <select id="is_active" class="form-control" name="is_active" id="status_id" wire:model="is_active">
                                        <option value=""></option>
                                        <option value="1">{{__('Active')}}</option>
                                        <option value="0">{{__('Inactive')}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="description" class="form-label">{{__('Description')}}:</label>
                            <textarea id="description" class="form-control" placeholder="" name="description" aria-label="" wire:model.defer="description"></textarea>
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
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/select2.min.js')}}" defer></script>
    <script>
        $(function () {
            $('#create').on('shown.bs.modal', function () {
                window.initSelectUser=()=>{
                    // Select2
                    $('#status_id').select2({
                        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                        placeholder: $(this).data('placeholder') ? $(this).data('placeholder') : 'Selecciona uno...',
                        allowClear: Boolean($(this).data('allow-clear')),
                        dropdownParent: $('#status_id').parent()
                    });
                }
                // Escucha el evento 'change' en el selector y emite el evento de Livewire
                $('#status_id').on('change', function (e) {
                    livewire.emit('ServicesCreateChange', $(this).val(), $(this).attr('wire:model.defer'));
                });

                window.livewire.on('ServicesCreateHydrate',()=>{
                    initSelectUser();
                });

                livewire.emit('ServicesCreateChange', '', '');
            });
        });
    </script>
    <script>
        document.addEventListener('livewire:load', function () {
            Livewire.on('setAllowedDays', (workDays) => {
                const allowedDays = workDays;
                const dateInput = document.getElementById('date_psychologist');

                dateInput.addEventListener('input', function () {
                    const selectedDate = new Date(this.value);
                    const dayOfWeek = selectedDate.toLocaleDateString('en-us', { weekday: 'long' }).toLowerCase();

                    // Verifica si el día seleccionado está permitido
                    if (!allowedDays.includes(dayOfWeek)) {
                        alert("Este día no está disponible para el psicólogo seleccionado.");
                        this.value = ''; // Limpia el campo de fecha si el día no es permitido
                    }
                });
            });
        });
    </script>
</div>
