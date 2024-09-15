<div>
    <div  wire:ignore.self class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-simple modal-xl">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-4">
                        <h3 class="mb-2">{{__('Update post')}}</h3>
                        <p class="text-muted">{{__('Update post information')}}</p>
                    </div>
                    <form class="row g-3" wire:submite.prevent="update" enctype="multipart/form-data">
                        <div class="col-md-5">
                            <label class="form-label" for="image">{{__('Image')}}</label>
                            <div class="image-upload">
                                <div class="thumb text-center">
                                    <div class="avatar-preview">
                                        <div class="profilePicPreview"
                                             @if($image)
                                                 style="background: url('{{$image->temporaryUrl()}}')"
                                             @else
                                                 @if($post_image!=null)
                                                     style="background: url('{{asset('uploads/posts/'.$post_image)}}')"
                                                 @endif
                                            @endif>
                                            <button type="button" class="remove-image"><i class="fa fa-times"></i></button>
                                        </div>
                                    </div>
                                    <div class="avatar-edit">
                                        <input type="file" class="profilePicUpload" wire:model="image" id="image_edit" name="" accept=".png, .jpg, .jpeg, .webp">
                                        <label for="image_edit" class="bg--primary">{{__('Add image')}}</label>

                                    </div>
                                    <small class="mt-2 text-center">{{__('Compatibilities')}}: <b>jpeg, jpg, png</b> {{__('Resized to')}}: <b>{{$image_width}}x{{$image_height}}</b>px.
                                    </small>
                                </div>
                            </div>
                            @error('image')
                            <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                            @enderror
                        </div>
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-md-12 select-posts-edit">
                                    <label class="form-label" for="place_id-edit">{{__('Place')}}</label>
                                    <select id="place_id-edit" name="place_id" wire:model.defer="post.place_id" class="select2 form-select single-select" data-placeholder="{{__('Select a place')}}...">
                                        <option></option>
                                        @foreach($places as $place)
                                            <option value="{{$place->id}}">{{$place->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('place_id')
                                    <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12 select-posts-edit">
                                    <label class="form-label" for="category_id-edit">{{__('Category')}}</label>
                                    <select id="category_id-edit" name="category_id" wire:model.defer="post.category_id" class="select2 form-select single-select" data-placeholder="{{__('Select a category')}}...">
                                        <option></option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label" for="name">{{__('Name')}}:</label>
                                    <input type="text" id="name" class="form-control" placeholder="" name="name" aria-label="" wire:model.defer="post.name" />
                                    @error('name')
                                    <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label" for="price">{{__('Price')}}:</label>
                                    <input type="text" id="price" class="form-control" name="price" aria-label="" wire:model.defer="post.price" />
                                    @error('price')
                                    <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label" for="content">{{__('Content')}}:</label>
                                    <textarea id="content" class="form-control" name="content" aria-label="" wire:model.defer="post.content"></textarea>
                                    @error('content')
                                    <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 my-2">
                                    <label class="switch">
                                        <input type="checkbox" class="switch-input checked-details"
                                               wire:model="post.is_feature"
                                        >
                                        <span class="switch-toggle-slider">
                                          <span class="switch-on"></span>
                                          <span class="switch-off"></span>
                                    </span>
                                        <span class="switch-label">{{__('Is feature')}}</span>
                                    </label>
                                </div>
                                <div class="col-md-4 my-2">
                                    <label class="switch">
                                        <input type="checkbox" class="switch-input checked-details"
                                               wire:model="post.best_selling"
                                        >
                                        <span class="switch-toggle-slider">
                                          <span class="switch-on"></span>
                                          <span class="switch-off"></span>
                                    </span>
                                        <span class="switch-label">{{__('Best selling')}}</span>
                                    </label>
                                </div>
                                <div class="col-md-4 my-2">
                                    <label class="switch">
                                        <input type="checkbox" class="switch-input checked-details"
                                               wire:model="post.is_active"
                                        >
                                        <span class="switch-toggle-slider">
                                          <span class="switch-on"></span>
                                          <span class="switch-off"></span>
                                    </span>
                                        <span class="switch-label">{{__('Is active')}}</span>
                                    </label>
                                </div>
                            </div>
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
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/select2.min.js')}}" defer></script>
    <script>
        $(function () {
            window.initPostsUpdate=()=>{
                // Select2
                $('.select-posts-edit .single-select').select2({
                    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                    placeholder: $(this).data('placeholder') ? $(this).data('placeholder') : 'Selecciona ...',
                    dropdownParent: $('.select-posts-edit')
                });
            }
            $('.select-posts-edit .single-select').on('change', function (e) {
                livewire.emit('PostsShowChange', $(this).val(), $(this).attr('wire:model.defer'))
            });
            window.livewire.on('PostsShowHydrate',()=>{
                initPostsUpdate();
            });
            livewire.emit('PostsShowChange', '', '');
        });
    </script>
</div>
