<div class="container py-5">
    <div class="row align-items-center">
        <div class="col-md-6 text-center text-md-start">
            <h1 class="display-4 fw-bold" style="font-size: 3rem !important;">
                CRECER <br> CONTIGO
            </h1>
            <p class="lead">Ayudamos a las personas y sus familias a ser felices. ¡Mereces una vida perfecta! ¡Puedo cambiar tu vida ahora mismo!</p>
            <a href="#contact" class="btn btn-new btn-lg px-4">Contáctame</a>
        </div>
        <div class="col-md-6 d-flex flex-column align-items-center">
            <div class="mb-4 text-end">
                <img src="{{asset('crecer-contigo/lina-junta-2.jpg')}}" alt="imagen psicólogo" class="img-fluid rounded" style="max-width: 70%; border-radius: 1.5rem !important;">
            </div>
        </div>
    </div>
</div>
<div id="agro-slider-mobile" class="agro-slider-mobile carousel slide" data-bs-ride="carousel">
    <img src="{{asset('crecer-contigo/lina-junta-2.jpg')}}" class="d-block w-100" alt="...">
</div>
<script>
{{--    Slider 1--}}
    Men= new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.intersectionRatio > 0) {
                entry.target.classList.add('slide-in-fwd-bottom');
                Men.unobserve(entry.target);
            }
        });
    });
    Men.observe(document.querySelector('.men-slider-1'));

    Fruits= new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.intersectionRatio > 0) {
                entry.target.classList.add('bounce-in-left');
                Fruits.unobserve(entry.target);
            }
        });
    });
    Fruits.observe(document.querySelector('.agro-slider .item-1 .fruits-slider-1'));

    Plants= new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.intersectionRatio > 0) {
                entry.target.classList.add('tilt-in-top-2');
                Plants.unobserve(entry.target);
            }
        });
    });
    Plants.observe(document.querySelector('.agro-slider .item-1 .plants-slider-1'));

    Table= new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.intersectionRatio > 0) {
                entry.target.classList.add('slide-in-bottom');
                Table.unobserve(entry.target);
            }
        });
    });
    Table.observe(document.querySelector('.agro-slider .item-1 .mesa-slider-1'));

//     Slider 2

    Suelo= new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.intersectionRatio > 0) {
                entry.target.classList.add('scale-in-right');
                Suelo.unobserve(entry.target);
            }
        });
    });
    Suelo.observe(document.querySelector('.agro-slider .item-2 .suelo-slider-2'));

    Men2= new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.intersectionRatio > 0) {
                entry.target.classList.add('slide-in-bck-bottom');
                Men2.unobserve(entry.target);
            }
        });
    });
    Men2.observe(document.querySelector('.agro-slider .item-2 .men-slider-2'));

    Women= new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.intersectionRatio > 0) {
                entry.target.classList.add('slide-in-bck-bottom-2');
                Women.unobserve(entry.target);
            }
        });
    });
    Women.observe(document.querySelector('.agro-slider .item-2 .women-slider-2'));

    Men22= new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.intersectionRatio > 0) {
                entry.target.classList.add('slide-in-bck-bottom-3');
                Men22.unobserve(entry.target);
            }
        });
    });
    Men22.observe(document.querySelector('.agro-slider .item-2 .men2-slider-2'));

    Phone= new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.intersectionRatio > 0) {
                entry.target.classList.add('slide-in-elliptic-right-fwd');
                Phone.unobserve(entry.target);
            }
        });
    });
    Phone.observe(document.querySelector('.agro-slider .item-2 .phone-slider-2'));

    Nube= new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.intersectionRatio > 0) {
                entry.target.classList.add('fade-in-right');
                Nube.unobserve(entry.target);
            }
        });
    });
    Nube.observe(document.querySelector('.agro-slider .item-2 .nube-slider-2'));
</script>
