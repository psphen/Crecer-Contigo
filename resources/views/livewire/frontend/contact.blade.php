<div>
    <div class="container-contact">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <img src="{{ asset('crecer-contigo/lina-junta.jpg') }}" alt="Crecer Contigo" class="img-fluid" style="border-radius: 1.5rem; box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.1); max-width: 90%;">
                </div>
                <div class="col-md-6">
                    <div class="contact-form p-5">
                        <h2 class="text-white text-center">Contactos</h2>
                        <div class="mb-4">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" wire:model="name" placeholder="Tu nombre" style="border: 2px solid #b2958c;">
                        </div>
                        <div class="mb-4">
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" wire:model="phone" placeholder="+57..." style="border: 2px solid #b2958c;">
                        </div>
                        <div class="mb-4">
                            <textarea class="form-control" wire:model="comment" placeholder="Tu comentario" rows="4" style="border: 2px solid #b2958c;"></textarea>
                        </div>
                        <button type="submit" class="btn w-100 btn-new btn-lg px-4" wire:click="save">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
