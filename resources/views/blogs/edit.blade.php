<div>
    <div  wire:ignore.self class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-simple">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-4">
                        <h3 class="mb-2">{{__('Update blog')}}</h3>
                        <p class="text-muted">{{__('Update blog information')}}</p>
                    </div>
                    <form class="row g-3" wire:submit.prevent="update">
                        <div class="col-md-12">
                            <label class="form-label" for="image">{{__('Image')}}</label>
                            <div class="image-upload">
                                <div class="thumb text-center">
                                    <div class="avatar-preview">
                                        <div class="profilePicPreview"
                                             @if($image)
                                                 style="background: url('{{$image->temporaryUrl()}}')"
                                             @else
                                                 @if($blog_image!=null)
                                                     style="background: url('{{asset('uploads/blogs/'.$blog_image)}}')"
                                            @endif
                                            @endif>
                                            <button type="button" class="remove-image"><i class="fa fa-times"></i></button>
                                        </div>
                                    </div>
                                    <div class="avatar-edit">
                                        <input type="file" class="profilePicUpload" wire:model="image" id="image_edit" name="" accept=".png, .jpg, .jpeg">
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
                        <div class="col-12 select-blogs-edit">
                            <label class="form-label" for="category_id-edit">{{__('Category')}}</label>
                            <select id="category_id-edit" name="category_id-edit" wire:model.defer="blog.category_id" class="select2 form-select single-select" data-placeholder="{{__('Select a category')}}...">
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
                            <label class="form-label" for="title">{{__('Title')}}:</label>
                            <input type="text" id="title" class="form-control" placeholder="" name="title" aria-label="" wire:model.defer="blog.title" />
                            @error('title')
                            <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label class="form-label" for="description">{{__('Description')}}:</label>
                            <textarea name="description" id="description" class="form-control" wire:model.defer="blog.description"></textarea>
                            @error('description')
                            <div class="badge bg-label-danger mt-2 w-100">{{ __($message) }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label class="form-label" for="meta_keywords">{{__('Keywords')}}:</label>
                            <textarea name="meta_keywords" id="meta_keywords" class="form-control" wire:model.defer="blog.meta_keywords"></textarea>
                            @error('meta_keywords')
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
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/select2.min.js')}}" defer></script>
    <script>
        $(function () {
            window.initBlogsUpdate=()=>{
                // Select2
                $('.select-blogs-edit .single-select').select2({
                    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                    placeholder: $(this).data('placeholder') ? $(this).data('placeholder') : 'Selecciona ...',
                    allowClear: Boolean($(this).data('allow-clear')),
                    dropdownParent: $('.select-blogs-edit')
                });
            }
            $('.select-blogs-edit .single-select').on('change', function (e) {
                livewire.emit('BlogsShowChange', $(this).val(), $(this).attr('wire:model.defer'))
            });
            window.livewire.on('BlogsShowHydrate',()=>{
                initBlogsUpdate();
            });

            livewire.emit('BlogsShowChange', '', '');
        });
    </script>
</div>
