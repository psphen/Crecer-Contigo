<nav class="navbar navbar-expand-lg bg-navbar-theme main-menu-nav">
    <div class="container-fluid">
{{--        <button class="btn btn-primary waves-effect waves-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop" aria-controls="staticBackdrop">--}}
{{--            <i class="ti ti-menu-2 ti-sm"></i>--}}
{{--        </button>--}}
        <a class="navbar-brand mx-2" href="{{route('frontend.index')}}">
            <img src="{{asset('crecer-contigo/Logo png.png')}}" alt="" class="img-fluid" style="height: 75px">
        </a>
        <div class="collapse navbar-collapse justify-content-center align-items-center" id="navbar-ex-5">
            <ul class="navbar-nav d-flex align-items-center">
                {{--<li class="nav-item {{Route::is('frontend.index')?'active':''}}">
                    <a href="{{route('frontend.index')}}" class="nav-link">
                        Servicios
                    </a>
                </li>--}}
                <li class="nav-item {{Route::is('marketplace.index')?'active':''}}">
                    <a href="{{route('frontend.index')}}" class="nav-link">
                        Crecer Contigo
                    </a>
                </li>
                <li class="nav-item {{Route::is('about.index')?'active':''}}">
                    <a href="{{route('about.index')}}" class="nav-link">
                        Nosotros
                    </a>
                </li>
                <li class="nav-item {{Route::is('contact.index')?'active':''}}">
                    <a href="#" class="nav-link">
                        Blog
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link">
                        Contacto
                    </a>
                </li>

            </ul>
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
