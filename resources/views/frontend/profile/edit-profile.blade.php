<div>
    <div wire:ignore.self class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-simple modal-xl">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="closeAndClean"></button>
                    <div class="text-center mb-4">
                        <h3 class="mb-2">{{__('Edit profile')}}</h3>
                        <p class="text-muted">{{__('Edit profile information')}}</p>
                    </div>
                    <form class="row g-3" wire:submite.prevent="update">
                        <div class="col-md-4">
                            <label class="form-label" for="profile_photo">{{__('Profile photo')}}</label>
                            <div class="image-upload">
                                <div class="thumb text-center">
                                    <div class="avatar-preview">
                                        <div class="profilePicPreview"
                                             @if($image)
                                                 style="background: url('{{$image->temporaryUrl()}}')"
                                             @else
                                                 @if($profile_photo)
                                                     style="background: url('{{asset('uploads/users/'.$profile_photo)}}');"
                                                 @endif
                                             @endif
                                        >
                                            <button type="button" class="remove-image" wire:click="removeImage"><i class="fa fa-times"></i></button>
                                        </div>
                                    </div>
                                    <div class="avatar-edit">
                                        <input type="file" class="profilePicUpload" wire:model="image" id="profile_photo" name="profile_photo" accept=".png, .jpg, .jpeg">
                                        <label for="profile_photo" class="rounded"> <i class="ti ti-upload mx-2"></i>{{__('Upload Image')}}</label>
                                    </div>
                                    <small class="mt-2 text-center">{{__('Compatibilities')}}: <b>jpeg, jpg, png</b> {{__('Resized to')}}: <b>{{$image_width}}x{{$image_height}}</b>px.</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <label class="form-label" for="banner_photo">{{__('Cover photo')}}</label>
                            <div class="image-upload">
                                <div class="thumb text-center">
                                    <div class="avatar-preview">
                                        <div class="profilePicPreview"
                                             @if($image_banner)
                                                 style="background: url('{{$image_banner->temporaryUrl()}}')"
                                             @else
                                                 @if($banner_photo)
                                                     style="background: url('{{asset('uploads/users/'.$banner_photo)}}');"
                                                 @endif
                                             @endif
                                        >

                                            <button type="button" class="remove-image" wire:click="removeImageBanner"><i class="fa fa-times"></i></button>
                                        </div>
                                    </div>
                                    <div class="avatar-edit">
                                        <input type="file" class="profilePicUpload" wire:model="image_banner" id="banner_photo" name="banner_photo" accept=".png, .jpg, .jpeg">
                                        <label for="banner_photo" class="rounded"> <i class="ti ti-upload mx-2"></i>{{__('Upload Image')}}</label>
                                    </div>
                                    <small class="mt-2 text-center">{{__('Compatibilities')}}: <b>jpeg, jpg, png</b> {{__('Resized to')}}: <b>{{$banner_width}}x{{$banner_height}}</b>px.</small>
                                </div>
                            </div>
                        </div>
{{--                        <div class="col-6">--}}
{{--                            <label class="form-label" for="first_name">{{__('First Name')}}:</label>--}}
{{--                            <input type="text" id="first_name" class="form-control" placeholder="{{__('Enter First Name')}}" name="first_name" wire:model.defer="first_name" />--}}
{{--                        </div>--}}
{{--                        <div class="col-6">--}}
{{--                            <label class="form-label" for="last_name">{{__('Last Name')}}:</label>--}}
{{--                            <input type="text" id="last_name" class="form-control" placeholder="{{__('Enter Last Name')}}" name="last_name" wire:model.defer="last_name" />--}}
{{--                        </div>--}}
{{--                        <div class="col-6">--}}
{{--                            <label class="form-label" for="phone">{{__('Phone')}}:</label>--}}
{{--                            <input type="text" id="phone" class="form-control" placeholder="{{__('Enter Last Name')}}" name="phone" wire:model.defer="phone" />--}}
{{--                        </div>--}}
{{--                        <div class="col-6">--}}
{{--                            <label class="form-label" for="email">{{__('Email')}}:</label>--}}
{{--                            <input type="text" id="email" class="form-control" placeholder="{{__('Enter Last Name')}}" name="email" wire:model.defer="email" />--}}
{{--                        </div>--}}
                        <div class="col-md-12 text-center">
                            <button type="button" class="btn btn-primary me-sm-3 me-1" wire:loading.class="disabled" wire:loading.attr="disabled" wire:target="update" wire:click='update'>
                                {{__('Save')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
