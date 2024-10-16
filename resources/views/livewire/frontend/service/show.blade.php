<div>
    <div wire:init="loadView" class="container py-5">
        <div class="row px-5">
            @foreach ($services as $service)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-header p-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">{{$service->name}}</h5>
                                <a href="{{ route('frontend.service.details', $service->id) }}" style="width: 2.5rem; height: 2.5rem; background: #b88100; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                    <i class="fa-solid fa-up-right-from-square" style="color: aliceblue;"></i>
                                </a>
                            </div>
                            <p class="mb-0">{{ $service->description }}</p>
                        </div>
                        <div class="card-body">
                            <img src="{{ asset('uploads/services/' . $service->image) }}" alt="{{ $service->name }}" style="width: 100%; height: 400px; object-fit: cover; border-radius: 1rem;">
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>