<nav class="navbar navbar-expand-lg bg-navbar-theme main-menu-nav py-1">
    <div class="container-fluid">
        <div class="col-2 d-flex justify-content-center align-items-center">
            <a class="navbar-brand mx-2 py-0" href="{{route('frontend.index')}}">
                <img src="{{asset('crecer-contigo/Logo png.png')}}" alt="Logo" class="img-fluid" style="height: 75px">
            </a>
        </div>
        <div class="col-8 d-flex justify-content-center">
            <ul class="navbar-nav">
                <li class="nav-item {{Route::is('frontend.index') ? 'active' : ''}}">
                    <a href="{{route('frontend.index')}}" class="nav-link">Inicio</a>
                </li>
                <li class="nav-item {{Route::is('frontend.service') ? 'active' : ''}} mx-5">
                    <a href="{{route('frontend.service')}}" class="nav-link">Servicios</a>
                </li>
                <li class="nav-item {{Route::is('about.index') ? 'active' : ''}}">
                    <a href="{{route('about.index')}}" class="nav-link">Nosotros</a>
                </li>
            </ul>
        </div>
        <div class="col-2 d-flex justify-content-evenly align-items-center">
            <a href="https://www.facebook.com" class="nav-link">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="https://www.instagram.com/psiccrecercontigo/" class="nav-link" target="_blank" rel="noopener noreferrer">
                <i class="fab fa-instagram"></i>
            </a>
        </div>
    </div>
</div>
<script src="{{asset('js/jquery.min.js')}}"></script>
<script>
    $(window).scroll(function() {
        var scroll = $(window).scrollTop();

        if (scroll >= 100) {
            $(".main-menu-nav").addClass("fixed-navigation");



        } else {
            $(".main-menu-nav").removeClass("fixed-navigation");

        }

    });
</script>
