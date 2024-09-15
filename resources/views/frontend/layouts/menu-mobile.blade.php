<div class="d-block d-lg-none" style="margin-top: 120px">
    <div id="menu-float" class="menu-float d-flex align-items-center justify-content-center text-nowrap">
        <a class="item-mobile btn  d-flex flex-column rounded mx-1 {{Route::is('frontend.index')?'btn-primary':'btn-outline-primary'}}" title="Home demo" href="{{route('frontend.index')}}">
            <i class="ti ti-home"></i>
{{--           <span> Inicio</span>--}}
        </a>
        <a class="item-mobile btn d-flex flex-column rounded mx-1 {{Route::is('about.index')?'btn-primary':'btn-outline-primary'}}" href="{{route('about.index')}}">
            <i class="ti ti-users"></i>
{{--            <span>Nosotros</span>--}}
        </a>
    </div>
</div>
