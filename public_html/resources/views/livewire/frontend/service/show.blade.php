<div>
    <div wire:init="loadView" class="container py-5">
        <div class="row mb-4 px-5">
            <div class="col-12">
                <h2 class="category-title">Serivicios → Libros</h2>
            </div>
        </div>
        <div class="row px-5">
            @foreach ($services as $service)
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="product-card p-3">
                        <div class="product-image mb-2">
                            <img src="{{ asset('uploads/services/'.$service->image) }}" alt="Producto" class="img-fluid">
                        </div>
                        <h5 class="product-name">{{ $service->name }}</h5>
                        <p class="product-price">COP {{ $service->price }}</p>
                        <div class="product-icons d-flex justify-content-between align-items-center">
                            <span class="heart-icon">♡</span>
                            <span class="cart-icon" wire:click="addToCart({{ $service->id }})">🛒</span>
                        </div>
                        <div class="product-rating">
                            <span>⭐</span>
                            <span>⭐</span>
                            <span>⭐</span>
                            <span>⭐</span>
                            <span>⭐</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>