@extends('frontend.layouts.app')
@section('title',__('About us'))
@section('content')
    @include('frontend.layouts.breadcrumb')
    <div class="container py-5">
        <div class="vision row d-flex justify-content-center align-items-center">
            <div class="col-md-7 d-flex justify-content-center align-items-center position-relative">
                <img src="{{ asset('crecer-contigo/lina-junta.jpg') }}" alt="Crecer Contigo" class="img-fluid" style="max-width: 60% !important; border-radius: 1.5rem;">
                {{--<img src="{{asset('frontend/img/about-us/vision/form.webp')}}" class="d-block form" alt="...">
                <img src="{{asset('frontend/img/about-us/vision/person.webp')}}" class="person" alt="...">--}}
            </div>
            <div class="col-md-5">
                <h3 class="text-black">Visión</h3>
                <p>En nuestro centro terapéutico en psicología, nos visualizamos como un referente de excelencia en la atención psicológica, brindando un espacio seguro y acogedor donde cada individuo pueda encontrar apoyo y herramientas para su bienestar emocional y mental. Nos esforzamos por ser líderes en la implementación de terapias basadas en la evidencia, ofreciendo tratamientos efectivos y personalizados que promuevan la salud mental y el crecimiento personal de nuestros consultantes.</p>
            </div>
        </div>
        <div class="mision row d-flex justify-content-center align-items-center">
            <div class="col-md-6">
                <h3 class="text-black">Misión</h3>
                <p>Nuestra misión es proporcionar servicios terapéuticos de calidad, centrados en las necesidades únicas de cada persona que busca nuestra ayuda. Nos comprometemos a trabajar de manera colaborativa y empática, brindando un ambiente de confianza y respeto donde se fomente la autoexploración y el cambio positivo. A través de una atención ética, profesional y basada en la evidencia, nos esforzamos por acompañar a nuestros clientes en su proceso de transformación hacia una vida más equilibrada y satisfactoria.</p>
            </div>
            <div class="col-md-6 d-flex justify-content-center align-items-center position-relative">
                <img src="{{asset('crecer-contigo/mision.jpg')}}" alt="..." style="width: 76%; border-radius: 1.5rem;">
                {{--<img src="{{asset('frontend/img/about-us/mision/market.webp')}}" class="market" alt="...">
                <img src="{{asset('frontend/img/about-us/mision/Product-CACAO.webp')}}" class="product-1" alt="...">
                <img src="{{asset('frontend/img/about-us/mision/Product-MANGO.webp')}}" class="product-2" alt="...">
                <img src="{{asset('frontend/img/about-us/mision/Product-YUCA.webp')}}" class="product-3" alt="...">
                <img src="{{asset('frontend/img/about-us/mision/Product-LIMON.webp')}}" class="product-4" alt="...">
                <img src="{{asset('frontend/img/about-us/mision/Product-maiz.webp')}}" class="product-5" alt="...">
                <img src="{{asset('frontend/img/about-us/mision/Product-naranja.webp')}}" class="product-6" alt="...">--}}
            </div>
        </div>
        <div class="vision row d-flex justify-content-center align-items-center">
            <div class="col-md-7 d-flex justify-content-center align-items-center position-relative">
            <img src="{{ asset('crecer-contigo/lina-junta-2.jpg') }}" alt="Crecer Contigo" class="img-fluid" style="max-width: 60% !important; border-radius: 1.5rem;">
            {{--<img src="{{asset('frontend/img/about-us/vision/form.webp')}}" class="d-block form" alt="...">
                <img src="{{asset('frontend/img/about-us/vision/person.webp')}}" class="person" alt="...">--}}
            </div>
            <div class="col-md-5">
                <h3 class="text-black">¿Quiénes somos?</h3>
                <p>CRECERCONTIGO es una organización liderada por profesionales de la salud mental, con la  experiencia clínica, educativa y humana, para acompañar a sus usuarios en un proceso de cambio desde intervenciones individuales y colectivas, más que un simple acompañamiento psicológico, se brinda una experiencia, un método y, sobre todo, una forma de ver el mundo y los desafíos a los que se enfrentan los niños en esta época; para nosotros es fundamental poder apoyar procesos desde las familias y los colegios, garantizando un acompañamiento integral y alineado con las necesidades     reales de los estudiantes.</p>
            </div>
        </div>
    </div>
    <script>
        Phone= new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.intersectionRatio > 0) {
                    entry.target.classList.add('about-content-phone');
                    Phone.unobserve(entry.target);
                }
            });
        });
        Phone.observe(document.querySelector('.about-content .phone'));
        Person= new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.intersectionRatio > 0) {
                    entry.target.classList.add('about-content-person');
                    Person.unobserve(entry.target);
                }
            });
        });
        Person.observe(document.querySelector('.about-content .person'));
        Market= new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.intersectionRatio > 0) {
                    entry.target.classList.add('about-content-market');
                    Market.unobserve(entry.target);
                }
            });
        });
        Market.observe(document.querySelector('.about-content .market'));
    </script>
@endsection
