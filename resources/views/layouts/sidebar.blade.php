<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo" style="height: 115px;">
        <a href="{{route('dashboard')}}" class="app-brand-link">
            @if($logo!=null)
                <img src="{{asset('uploads/settings/'.$logo)}}" alt="" class="img-fluid" style="height: 75px">
            @else
                <span class="app-brand-text demo menu-text fw-bold">{{$app_name}}</span>
            @endif
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
            <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
        </a>
    </div>
{{--    <div class="menu-inner-shadow"></div>--}}
    <ul class="menu-inner py-1">
        <li class="menu-item {{Route::is('dashboard')?'active':''}}">
            <a href="{{route('dashboard')}}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-smart-home"></i>
                <div >{{__('Home')}}</div>
            </a>
        </li>
        <li class="menu-item {{Route::is('contact.index')?'active':''}}">
            <a href="{{route('contact.index')}}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-article"></i>
                <div >{{__('Contacts')}}</div>
            </a>
        </li>
        <li class="menu-item {{Route::is('psychologist.index')?'active':''}}">
            <a href="{{route('psychologist.index')}}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-article"></i>
                <div >{{__('Psychologists')}}</div>
            </a>
        </li>
        <li class="menu-item {{Route::is('services.*')?'active':''}}">
            <a href="{{route('services.index')}}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-article"></i>
                <div >{{__('Services')}}</div>
            </a>
        </li>
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">{{__('Location')}}</span>
        </li>
        <li class="menu-item {{Route::is('states.*')?'active':''}}">
            <a href="{{route('states.index')}}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-flag-2"></i>
                <div >{{__('States')}}</div>
            </a>
        </li>
        <li class="menu-item {{Route::is('cities.*')?'active':''}}">
            <a href="{{route('cities.index')}}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-flag-2"></i>
                <div >{{__('Cities')}}</div>
            </a>
        </li>
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">{{__('Content')}}</span>
        </li>
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">{{__('System')}}</span>
        </li>
        <li class="menu-item {{Route::is('users.*')?'active':''}}">
            <a href="{{route('users.index')}}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-users"></i>
                <div >{{__('Users')}}</div>
            </a>
        </li>
        <li class="menu-item {{Route::is('settings.index')?'active':''}}">
            <a href="{{route('settings.index')}}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-user-check"></i>
                <div >{{__('Settings')}}</div>
            </a>
        </li>
    </ul>
</aside>
