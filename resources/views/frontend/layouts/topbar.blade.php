<div class="bg-primary">
    <div class="container-fluid">
        <div class="row py-1 justify-content-end align-items-center">
            <div class="col-md-10 text-end">
{{--                <div class="badge bg-info my-3 fw-light fs-5 rounded">--}}
{{--                    <span>{{$subtitle}}</span>--}}
{{--                </div>--}}
            </div>
            <div class="col-md-2 border-start">
                @guest
{{--                    <div class=""></div>--}}
                    <a class="nav-link dropdown-toggle hide-arrow d-flex justify-content-end align-items-center text-white" href="{{ route('login') }}">
                        <i class="ti ti-login me-0 me-sm-1 ti-xs"></i>
                        {{ __('Login') }}
                    </a>
                @else
                    <div class="nav-item navbar-dropdown dropdown-user dropdown">
                        <a class="nav-link dropdown-toggle hide-arrow d-flex justify-content-end align-items-center" href="" data-bs-toggle="dropdown">
                            @if(Auth::user()->image!=null)
                                <div class="avatar avatar-online mx-2">
                                    <img src="{{asset('uploads/users/'.Auth::user()->image)}}" alt class="h-auto rounded-circle" />
                                </div>
                            @else
                                <div class="avatar avatar-online mx-2">
                                    <span class="avatar-initial rounded-circle bg-label-primary">{{Auth::user()->name[0]}}</span>
                                </div>
                            @endif
                            <span class="fw-semibold d-block text-white">{{ Auth::user()->name }}</span>
                            <i class="ti ti-chevron-down me-2 ti-sm text-white"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            @if(Auth::user()->isAdmin())
                                <li>
                                    <a class="dropdown-item" href="{{route('dashboard')}}">
                                        <i class="ti ti-dashboard me-2 ti-sm"></i>
                                        <span class="align-middle">{{__('Dashboard')}}</span>
                                    </a>
                                </li>
                                <li>
                                    <div class="dropdown-divider"></div>
                                </li>
                            @endif

                            <li>
                                <a class="dropdown-item" href="{{ route('profile', ['profile_slug' => Auth::user()->slug, 'profile_id' => Auth::user()->id]) }}">
                                    <i class="ti ti-user-check me-2 ti-sm"></i>
                                    <span class="align-middle">{{__('My profile')}}</span>
                                </a>
                            </li>
                            <li>
                                <div class="dropdown-divider"></div>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="ti ti-logout me-2 ti-sm"></i>
                                    <span class="align-middle">{{ __('Logout') }}</span>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                @endguest
            </div>
        </div>



    </div>
</div>