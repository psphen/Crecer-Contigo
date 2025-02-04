<div>
    <div wire:init="loadView" class="container py-5">
        <!-- Sección de navegación de pasos -->
        <div class="row mb-4 px-5">
            <div class="col-12 d-flex justify-content-between align-items-center">
                <a href="#" class="text-decoration-none">&larr; VOLVER AL INICIO</a>
            </div>
        </div>
    
        <div class="row">
            <!-- Columna izquierda (Formulario de inicio de sesión) -->
            <div class="col-md-6">
                <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">1 Información</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">2 Método de envío</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">3 Pago</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                        <div class="login-box mt-3 p-4">
                            <div class="tabs">
                                <button class="tab active">YA ESTOY REGISTRADO</button>
                                <button class="tab">SOY NUEVO</button>
                            </div>
                            <form class="mt-3">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email*</label>
                                    <input type="email" class="form-control" id="email">
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Contraseña*</label>
                                    <input type="password" class="form-control" id="password">
                                </div>
                                <a href="#" class="text-decoration-none">¿Olvidó su contraseña?</a>
                                <button type="submit" class="btn btn-primary w-100 mt-3">Entrar</button>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                        <div class="login-box mt-3 p-4">
                            <form class="mt-3">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Nombre para futuras consultas *</label>
                                    <input type="email" class="form-control" id="email">
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Teléfono o celular</label>
                                    <input type="password" class="form-control" id="password">
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Dirección de entrega *</label>
                                    <input type="password" class="form-control" id="password">
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Complemento de la dirección</label>
                                    <input type="password" class="form-control" id="password">
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">País *</label>
                                    <input type="password" class="form-control" id="password">
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Departamento *</label>
                                    <input type="password" class="form-control" id="password">
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Ciudad *</label>
                                    <input type="password" class="form-control" id="password">
                                </div>
                                <button type="submit" class="btn btn-primary w-100 mt-3">Guardar</button>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">...</div>
                </div>
            </div>
    
            <!-- Columna derecha (Resumen de compra) -->
            <div class="col-md-6">
                <div class="cart-summary p-4">
                    <h5 class="mb-3">RESUMEN DE COMPRA</h5>
                    <p class="text-muted">3 Productos</p>
    
                    @foreach ($services as $service)
                        <div class="product-item d-flex align-items-start mb-3">
                            <img src="{{ asset('uploads/services/'.$service->image) }}" class="img-fluid me-3" alt="Producto">
                            <div class="product-info">
                                <h6>{{ $service->name }}</h6>
                                <p class="text-muted">Ref.: 10C105739239-912</p>
                                <div class="d-flex align-items-center">
                                    <button class="btn btn-link p-0">Cambiar</button>
                                </div>
                                <div class="d-flex align-items-center mt-2">
                                    <button class="btn btn-light btn-sm">-</button>
                                    <span class="mx-2">1</span>
                                    <button class="btn btn-light btn-sm">+</button>
                                </div>
                                <p class="mt-2">$ {{ $service->price }}</p>
                            </div>
                        </div>
                    @endforeach
    
                    <!-- Resumen final -->
                    <div class="summary mt-4">
                        <div class="d-flex justify-content-between">
                            <span>Subtotal</span>
                            <span>$259,700</span>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <span>Envío</span>
                            <span>-</span>
                        </div>
                        <div class="mt-3">
                            <button class="btn btn-link">¿Tienes un cupón de descuento?</button>
                        </div>
                        <div class="d-flex justify-content-between mt-3 fw-bold">
                            <span>Total</span>
                            <span>$259,700</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <style>
        /* Estilos básicos */
        .steps {
            display: flex;
            justify-content: space-around;
            margin-bottom: 20px;
        }
        .step {
            font-weight: bold;
            color: gray;
        }
        .step.active {
            color: black;
        }
    
        .login-box {
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    
        .tabs {
            display: flex;
        }
        .tab {
            flex: 1;
            padding: 10px;
            text-align: center;
            font-weight: bold;
            border: 1px solid black;
        }
        .tab.active {
            background-color: black;
            color: white;
        }
    
        .cart-summary {
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    
        .product-item {
            display: flex;
            align-items: start;
        }
    
        .product-info h6 {
            font-size: 1rem;
            margin: 0;
        }
    
        .product-info p {
            margin: 0;
            font-size: 0.9rem;
        }
    
        .summary {
            background-color: #f1f1f1;
            padding: 15px;
            border-radius: 8px;
        }
    </style>
</div>
