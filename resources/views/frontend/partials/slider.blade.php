<div id="agro-slider" class="agro-slider carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-caption d-none d-md-block zindex-1">
            <div class="row justify-content-center align-items-center">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <h1>PSICOLOGÍA & BIENESTAR</h1>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
        <div class="carousel-item active item-1">
            <img src="{{asset('crecer-contigo/banner-arboles.jpg')}}" alt="slider-1" class="d-block w-100" style="object-fit: cover; height: 439px;">
        </div>
    </div>
</div>
<div id="agro-slider-mobile" class="agro-slider-mobile carousel slide" data-bs-ride="carousel">
    <img src="{{asset('crecer-contigo/banner-arboles.jpg')}}" class="d-block w-100" alt="...">
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
