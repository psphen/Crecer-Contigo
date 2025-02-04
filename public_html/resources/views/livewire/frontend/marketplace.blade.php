<div>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-xl-8 col-lg-7 col-md-7 mx-auto">

                <!-- Activity Timeline -->
                @auth
                    @if (Auth::user()->place)
                        <div class="card card-action mb-4" style="border-radius: 13px;">
                            <div class="card-body">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-auto px-0">
                                            @if (Auth::user()->profile_photo)
                                                <img src="{{ asset('uploads/users/' . Auth::user()->profile_photo) }}" alt="user image" class="rounded-circle mx-3" style="max-width: 80px; max-height: 80px;">
                                            @else
                                                <img src="{{asset('uploads/settings/'.$watermark)}}" alt="user image" class="rounded-circle mx-3" style="max-width: 80px; max-height: 80px;">
                                            @endif
                                        </div>
                                        <div class="col-md-10 px-0">
                                            <div class="cursor-pointer btn-primary p-3 mb-2 my-3 rounded-5"
                                                 data-bs-toggle="modal" data-bs-target="#post">
                                                ¿Qué estás pensando, {{ Auth::user()->name }}?
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endauth
                <div class="card my-2">
                    <div class="card-body">
                        <label for="search-posts" class="mb-2">Búsqueda de publicaciones:</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="ti ti-search"></i>
                            </span>
                            <input type="text" wire:model="query" id="search-posts" placeholder="Buscar.." class="form-control">
                        </div>
                    </div>
                </div>
                    @forelse($posts as $post)
                        <div class="card card-action mb-4" style="--bs-card-spacer-y: -0.5rem; border-radius: 13px;">
                            <div class="card-body">
                                <div class="media mb-4">
                                    <div class="card-header" style="--bs-card-spacer-y: 0.5rem !important; padding-top: 15px; padding-bottom: 0px;">
                                        <div class="media mb-0">
                                            <div class="row d-flex align-items-center">
                                                <div class="col-auto" style="padding-left: 0px; padding-right: 0px;">
                                                    @if ($post->place->image!=null)
                                                        <div class="avatar-wrapper d-flex justify-content-center mx-3">
                                                            <div class="avatar-md avatar-lg">
                                                                <img src="{{ asset('uploads/places/photo/' . $post->place->image) }}" alt="Avatar" class="w-100 h-100 rounded-circle">
                                                            </div>
                                                        </div>
{{--                                                        <img src="{{ asset('uploads/places/photo/' . $post->place->image) }}" alt="user image" class=" mx-3" style="max-width: 55px; max-height: 55px;border-radius: 100%">--}}
                                                    @else
                                                        <div class="avatar-wrapper d-flex justify-content-center mx-3">
                                                            <div class="avatar-md avatar-lg">
                                                                <img src="{{asset('uploads/settings/'.$watermark)}}" alt="Avatar" class="w-100 h-100 rounded-circle">
                                                            </div>
                                                        </div>
{{--                                                        <img src="{{asset('uploads/settings/'.$favicon)}}" alt="user image" class=" mx-3" style="max-width: 50px; max-height: 50px;border-radius: 100%">--}}
                                                    @endif
                                                </div>
                                                <div class="col-auto my-1" style="padding-left: 0px;">
{{--                                                    @if (Auth::check() && Auth::user()->id == $post->place->user->id)--}}
                                                        <a href="{{route('places.show',$post->place->slug)}}" style="font-size: large;">
                                                            {{ $post->place->name }}
                                                        </a>
{{--                                                    @else--}}

{{--                                                        <a href="{{ route('user.profile', ['userProfile_id' => $post->place->user->id]) }}" style="font-size: large;">--}}
{{--                                                            {{ $post->place->user->name }}--}}
{{--                                                        </a>--}}
{{--                                                    @endif--}}
                                                    <p style="padding-left: 0px; font-size: smaller;">
                                                        {{ $post->created_at->diffForHumans() }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body" style="--bs-card-spacer-y: 0.5rem !important; padding-top: 5px; padding-bottom: 0px;">
                                        <div class="media mb-4">
                                            <div class="row">
                                                <div class="col-md-auto">
                                                    @if($post->image)
                                                        <img src="{{ asset('uploads/posts/' . $post->image) }}" alt="Post Image" class="img-fluid mt-3" style="max-width: auto !important; max-height: 240px; border-radius: 13px;">
                                                    @endif
                                                </div>
                                                <div class="col-md" style="padding-left: 0px;">
                                                    <div class="post-content mx-3 my-1">
                                                        <h3 class="mb-2">{{$post->name}}</h3>
                                                        <p>{{$post->content}}</p>
                                                    </div>
                                                    <p class="mx-3">
                                                        $ {{$post->price}}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="row">
{{--                                            @foreach ($posts as $post)--}}
                                                <div class="col-6">
                                                    <i class="fas fa-thumbs-up me-0 me-sm-1 ti-xs text-warning"></i>
                                                    <span>{{ $post->likes->count() }}</span>
                                                </div>
                                                <div class="col-6 text-end">
                                                    <i class="fas fa-comment me-0 me-sm-1 ti-xs text-warning"></i>
                                                    <span>{{$post->comments->count()}}</span>
                                                </div>
{{--                                            @endforeach--}}
                                        </div>
                                        <hr>
                                        <div class="row align-items-center">
                                            <div class="col-4 text-center d-flex align-items-center justify-content-center flex-column flex-lg-row">
                                                <i class="fas fa-thumbs-up me-0 me-sm-1 ti-xs text-warning"
                                                    wire:click="toggleLike({{ $post->id }})"
                                                    style="cursor: pointer">
                                                </i>
                                                <span wire:click="toggleLike({{ $post->id }})"
                                                    style="cursor: pointer">
                                                    Me gusta
                                                </span>
                                            </div>
                                            <div class="col-4 text-center d-flex align-items-center justify-content-center flex-column flex-lg-row">
                                                <i class="fas fa-comment me-0 me-sm-1 ti-xs text-warning"></i>
                                                <span id="commentButton" type="button">Comentar</span>
                                            </div>
                                            <div class="col-4 text-center d-flex align-items-center justify-content-center flex-column flex-lg-row">
                                                <div onclick="compartirPost('{{ $post->id }}')" class="btn  d-flex align-items-center justify-content-center flex-column flex-lg-row" style="background-color: #fff; color: #6F6B7D;">
                                                    <i class="fas fa-share me-0 me-sm-1 ti-xs text-warning"></i>
                                                    <span>Compartir</span>
                                                </div>
                                            </div>
                                        </div>
                                        @auth
                                            <hr>
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-auto" style="padding-left: 0px; padding-right: 0px;">
                                                        @if (Auth::user()->profile_photo)
                                                            <img src="{{ asset('uploads/users/' . $post->place->user->profile_photo) }}" alt="user image" class="rounded-circle mx-3" style="max-width: 50px; max-height: 50px;">
                                                        @else
                                                            <img src="{{ asset('uploads/settings/' . $watermark) }}" alt="user image" class="rounded-circle mx-3" style="max-width: 50px; max-height: 50px;">
                                                        @endif
                                                    </div>
                                                    <div class="col-md-10 my-1">
                                                        <form wire:submit.prevent="addComment({{ $post->id }})" id="commentForm">
                                                            <div class="input-group" style="border: none; border-radius: 30px; padding: 4px; background-color: #dcdfe6db;">
                                                                <input type="text" wire:model="newComment" placeholder="Escribe un comentario" id="commentInput"
                                                                       class="form-control border-0"
                                                                       style="background-color: transparent; color: #4b4b4b;">
                                                                <button class="btn waves-effect" type="submit" style="border: none;"><i class="ti ti-chevrons-right text-warning"></i></button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                @foreach ($post->comments->reverse() as $comment)
                                                    <div class="media mb-0 my-1">
                                                        <div class="row">
                                                            <div class="col-auto" style="padding-left: 0px; padding-right: 0px;">
                                                                @if ($comment->user->profile_photo)
                                                                    <img src="{{ asset('uploads/users/' . $post->place->user->profile_photo) }}" alt="user image" class="rounded-circle mx-3" style="max-width: 50px; max-height: 50px;">
                                                                @else
                                                                    <img src="{{ asset('uploads/settings/' . $watermark) }}" alt="user image" class="rounded-circle mx-3" style="max-width: 50px; max-height: 50px;">
                                                                @endif
                                                            </div>
                                                            <div class="col-auto my-1" style="padding-left: 0px;">
                                                                <div style="font-size: large;">
                                                                    <div style="display: flex; justify-content: space-between;">
                                                                        <div style="color: #2b2b2b; font-size: medium; font-weight: 600;">
                                                                            {{ $comment->user->name }}
                                                                        </div>
                                                                        <div style="font-size: small; color: #a3a3a3;" class="mx-2 my-1">
                                                                            .   {{ $comment->created_at->diffForHumans() }}
                                                                        </div>
                                                                    </div>
                                                                    <div style="color: #2b2b2b; font-size: medium;">
                                                                        {{$comment->comment}}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="card text-center h-100 mb-4" style="--bs-card-spacer-y: -0.5rem; border-radius: 13px;">
                            <div class="card-body d-flex align-items-center justify-content-center">
                                <h4>No hay publicaciones</h4>
                            </div>
                        </div>
                    @endforelse
                @if($showLoadMoreButton)
                    <div class="text-center mb-3">
                        <button wire:click="loadMorePosts" class="btn btn-primary">Cargar más</button>
                    </div>
                @endif


                {{--                    <div class="pagination-links">--}}
                {{--                        {{ $posts->links('vendor.livewire.bootstrap') }}--}}
                {{--                    </div>--}}
            </div>
        </div>
    </div>
    @include('frontend.marketplace.post')
</div>
<script>
    function compartirPost(postId) {
        const postUrl = window.location.origin + "/post/" + postId; // Reemplaza "/post/" con la URL real del post

        // Verifica si el navegador admite la función "navigator.share" (para navegadores modernos)
        if (navigator.share) {
            navigator.share({
                title: "Compartir post",
                url: postUrl
            })
                .then(() => console.log('Post compartido con éxito'))
                .catch((error) => console.error('Error al compartir el post', error));
        } else {
            // Si el navegador no admite "navigator.share", muestra una alerta con el enlace
            alert("¡No se pudo compartir el post! Puedes copiar el enlace y compartirlo manualmente: " + postUrl);
        }
    }
    document.addEventListener("DOMContentLoaded", function() {
        const commentButton = document.getElementById("commentButton");
        const commentInput = document.getElementById("commentInput");

        commentButton.addEventListener("click", function() {
            commentInput.focus(); // Enfoca el campo de entrada
        });
    });
</script>
