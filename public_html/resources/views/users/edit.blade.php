<div>
    <div wire:ignore.self  class="modal fade" id="edit"  tabindex="-1" aria-labelledby="exampleModalLabel" style="" aria-hidden="true" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-simple">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-4">
                        <h3 class="mb-2">{{__('Update user')}}</h3>
                        <p class="text-muted">{{__('Update user information')}}</p>
                    </div>
                    <form class="row g-3 d-flex align-items-center" wire:submit.prevent="update" id="userUpdate">
                        <div class="col-12">
                            <label class="form-label" for="name">{{__('Name')}}:</label>
                            <input type="text" id="name" class="form-control" placeholder="" name="name" aria-label="" wire:model.defer="user.name" />
                            @error('name')
                            <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="email">{{__('Email')}}:</label>
                            <input type="email" id="email" class="form-control" placeholder="" name="email" aria-label="" wire:model.defer="user.email" autocomplete="off"/>
                            @error('email')
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
                        <div class="col-12 select-user-edit mt-0">
                            <label class="form-label" for="role-edit">{{__('Role')}}</label>
                            <select id="role-edit" name="role" wire:model="selectedRoles" class="select2 form-select single-select" data-placeholder="{{__('Select a role')}}...">
                                <option></option>
                                @foreach($roles as $role)
                                    <option value="{{$role->id}}">{{__($role->name)}}</option>
                                @endforeach
                            </select>
                            @error('role')
                            <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                            @enderror
                        </div>
                        <div class="col-12 text-center">
                            <button type="button" class="btn btn-primary me-sm-3 me-1" wire:loading.class="disabled" wire:loading.attr="disabled" wire:target="update" wire:click='update'>{{__('Save')}}</button>
                            <button type="reset" class="btn btn-label-secondary btn-reset" data-bs-dismiss="modal" aria-label="Close">{{__('Cancel')}}</button>
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
            window.initUsersUpdate=()=>{
                // Select2
                $('.select-user-edit .single-select').select2({
                    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                    dropdownParent: $('.select-user-edit')
                });
            }
            $('.select-user-edit .single-select').on('change', function (e) {
                livewire.emit('UsersShowChange', $(this).val(), $(this).attr('wire:model'));
            });
            window.livewire.on('UsersShowHydrate',()=>{
                initUsersUpdate();
            });
            livewire.emit('UsersShowChange', '', '');

        });
    </script>
</div>
