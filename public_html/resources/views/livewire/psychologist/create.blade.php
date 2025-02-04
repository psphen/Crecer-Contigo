<div>
    <div wire:ignore.self class="modal fade" id="create" role="dialog" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content p-5">
                <div class="modal-header">
                    <div class="col-md-12 text-center">
                        <h3 class="mb-2">{{__('Add psychologist')}}</h3>
                        <p class="text-muted">{{__('Complete the information to add a new psychologist')}}</p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="closeAndClean"></button>
                </div>
                <div class="modal-body py-0">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="first_name required" class="form-label">{{__('First name')}}: </label>
                            <input type="text" id="first_name" class="form-control" placeholder="" name="first_name" wire:model="first_name" />
                            @error('first_name')
                                <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="second_name" class="form-label">{{__('Second name')}}: </label>
                            <input type="text" id="second_name" class="form-control" placeholder="" name="second_name" wire:model="second_name" />
                            @error('second_name')
                                <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="last_name" class="form-label">{{__('Last name')}}: </label>
                            <input type="text" id="last_name" class="form-control" placeholder="" name="last_name" wire:model="last_name" />
                            @error('last_name')
                                <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="second_last_name" class="form-label">{{__('Second last name')}}: </label>
                            <input type="text" id="second_last_name" class="form-control" placeholder="" name="second_last_name" wire:model="second_last_name" />
                            @error('second_last_name')
                                <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="phone" class="form-label">{{__('Phone')}}: </label>
                            <input type="number" id="phone" class="form-control" placeholder="" name="phone" wire:model="phone" />
                            @error('phone')
                                <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="dob" class="form-label">{{__('Date of birth')}}: </label>
                            <input type="date" id="dob" class="form-control" placeholder="" name="dob" wire:model="dob" />
                            @error('dob')
                                <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="dni" class="form-label">{{__('DNI')}}: </label>
                            <input type="number" id="dni" class="form-control" placeholder="" name="dni" wire:model="dni" />
                            @error('dni')
                                <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="gender_id" class="form-label">{{__('Gender')}}: </label>
                            <select id="gender_id" name="gender_id" wire:model="gender_id" class="select2 form-select single-select" data-placeholder="{{__('Select a gender')}}...">
                                <option></option>
                                @foreach($genders as $gender)
                                    <option value="{{$gender->id}}">{{$gender->name}}</option>
                                @endforeach
                            </select>
                            @error('gender_id')
                                <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="state_id" class="form-label">{{__('State')}}: </label>
                            <select id="state_id" name="state_id" wire:model="state_id" class="select2 form-select single-select" data-placeholder="{{__('Select a state')}}...">
                                <option></option>
                                @foreach($states as $state)
                                    <option value="{{$state->id}}">{{$state->name}}</option>
                                @endforeach
                            </select>
                            @error('state_id')
                                <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="city_id" class="form-label">{{__('City')}}: </label>
                            <select id="city_id" name="city_id" wire:model="city_id" class="select2 form-select single-select" data-placeholder="{{__('Select a city')}}...">
                                <option></option>
                                @foreach($cities as $city)
                                    <option value="{{$city->id}}">{{$city->name}}</option>
                                @endforeach
                            </select>
                            @error('city_id')
                                <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label>
                                <input type="checkbox" wire:model="workDays" value="monday"> Monday
                            </label>
                            <label>
                                <input type="checkbox" wire:model="workDays" value="tuesday"> Tuesday
                            </label>
                            <label>
                                <input type="checkbox" wire:model="workDays" value="wednesday"> Wednesday
                            </label>
                            <label>
                                <input type="checkbox" wire:model="workDays" value="thursday"> Thursday
                            </label>
                            <label>
                                <input type="checkbox" wire:model="workDays" value="friday"> Friday
                            </label>
                            <label>
                                <input type="checkbox" wire:model="workDays" value="saturday"> Saturday
                            </label>
                            <label>
                                <input type="checkbox" wire:model="workDays" value="sunday"> Sunday
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label for="specialty" class="form-label">{{__('Specialty')}}: </label>
                            <input type="text" id="specialty" class="form-control" placeholder="" name="specialty" wire:model="specialty" />
                            @error('specialty')
                                <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="email" class="form-label">{{__('Email')}}: </label>
                            <input type="email" id="email" class="form-control" placeholder="" name="email" wire:model="email" />
                            @error('email')
                                <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="password" class="form-label">{{__('Password')}}: </label>
                            <input type="password" id="password" class="form-control" placeholder="" name="password" wire:model="password" />
                            @error('password')
                                <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="password_confirmation" class="form-label">{{__('Confirm password')}}: </label>
                            <input type="password" id="password_confirmation" class="form-control" placeholder="" name="password_confirmation" wire:model="password_confirmation" />
                            @error('password_confirmation')
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
