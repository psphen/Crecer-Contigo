<footer class="footer bg-light position-relative d-none d-lg-block" style="background-color: #c798df !important; background-size: cover;">
{{--    <img src="{{asset('frontend/img/footer/footer.webp')}}" alt="" class="d-block w-100">--}}
{{--    <div class="position-absolute top-0 h-100">--}}
        <div class="container pt-3 pb-3">
            <div class="row d-flex align-items-center justify-content-center text-center">
                <div class="col-md-2 mb-4 mb-sm-0">
                    <h4 class="fw-bolder mb-3">
                        <a class="" href="{{route('frontend.index')}}">
                            @if($logo!=null)
                                <img src="{{asset('uploads/settings/'.$logo)}}" alt="" class="img-fluid" style="">
                            @else
                                <span class="app-brand-text demo menu-text fw-bold text-white">{{$app_name}}</span>
                            @endif
                        </a>
                    </h4>

                </div>
                <div class="col-md-2 mb-4 mb-md-0 d-none d-lg-block">
                    <h5 class="text-white">Más Información</h5>
                    <ul class="list-unstyled">
                        <li>
                            <a href="{{route('about.index')}}" class="footer-link d-block pb-2 text-black">{{__('About us')}}</a>
                        </li>
                        <li>
                            <a href="#" class="footer-link d-block pb-2 text-black">{{__('Blog')}}</a>
                        </li>
                        <li>
                            <a href="#" class="footer-link d-block pb-2 text-black">{{__('Contacto')}}</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-2 mb-4 mb-md-0 d-none d-lg-block">
                </div>
                <div class="col-md-4 mb-4 mb-sm-0">
                    <div class="d-inline-flex">
                        <a class="mx-2 px-2" href="{{route('frontend.index')}}">
                            @if($logo_third!=null)
                                <img src="{{asset('uploads/settings/'.$logo_third)}}" alt="" class="img-fluid" style="min-height: 60px">
                            @else
                                <span class="app-brand-text demo menu-text fw-bold text-white">{{$app_name}}</span>
                            @endif
                        </a>
                        <a class="mx-2 px-2 border-start" href="{{route('frontend.index')}}">
                            @if($logo_secondary!=null)
                                <img src="{{asset('uploads/settings/'.$logo_secondary)}}" alt="" class="img-fluid" style="min-height: 60px">
                            @else
                                <span class="app-brand-text demo menu-text fw-bold text-white">{{$app_name}}</span>
                            @endif
                        </a>
                    </div>
                </div>
                <div class="col-md-2 d-flex align-items-center">

                </div>
            </div>
        </div>
        <hr>
        <div class="row d-flex align-items-center text-center">
            <div class="col-md-12">
                <p class="footer-bottom">
                    © {{__('All rights reserved to')}} {{$app_name}}
                </p>
            </div>
        </div>
</footer>
