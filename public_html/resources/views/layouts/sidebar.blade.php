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
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">{{__('System')}}</span>
        </li>
        <li class="menu-item {{Route::is('users.*')?'active':''}}">
            <a href="{{route('users.index')}}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-users"></i>
                <div >{{__('Users')}}</div>
            </a>
        </li>
    </ul>
</aside>
