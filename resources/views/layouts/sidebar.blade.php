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
            <span class="menu-header-text">{{__('Members')}}</span>
        </li>
        <li class="menu-item {{Route::is('vendors.*')?'active':''}}">
            <a href="{{route('vendors.index')}}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-users"></i>
                <div >{{__('Vendors')}}</div>
            </a>
        </li>
        <li class="menu-item {{Route::is('customers.*')?'active':''}}">
            <a href="{{route('customers.index')}}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-users"></i>
                <div >{{__('Customers')}}</div>
            </a>
        </li>
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">{{__('Places')}}</span>
        </li>
        <li class="menu-item {{Route::is('categories.*')?'active open':''}} {{Route::is('subcategories.*')?'active open':''}}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-category-2"></i>
                <div>{{ __("Manage categories") }}</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{Route::is('categories.*')?'active':''}}">
                    <a href="{{route('categories.index')}}" class="menu-link">
                        <div >{{__('Categories')}}</div>
                    </a>
                </li>
                <li class="menu-item {{Route::is('subcategories.*')?'active':''}}">
                    <a href="{{route('subcategories.index')}}" class="menu-link">
                        <div >{{__('Subcategories')}}</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item {{Route::is('places.*')?'active open':''}} {{Route::is('posts.*')?'active open':''}} {{Route::is('services.*')?'active open':''}}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-directions"></i>
                <div>{{ __("Manage places") }}</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{Route::is('services.*')?'active':''}}">
                    <a href="{{route('services.index')}}" class="menu-link">
                        <div >{{__('Services')}}</div>
                    </a>
                </li>
                <li class="menu-item {{Route::is('places.*')?'active':''}}">
                    <a href="{{route('places.index')}}" class="menu-link">
                        <div >{{__('Places')}}</div>
                    </a>
                </li>
                <li class="menu-item {{Route::is('posts.*')?'active':''}}">
                    <a href="{{route('posts.index')}}" class="menu-link">
                        <div >{{__('Posts')}}</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">{{__('Content')}}</span>
        </li>
        <li class="menu-item {{Route::is('blogs.index')?'active':''}}">
            <a href="{{route('blogs.index')}}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-article"></i>
                <div >{{__('Blogs')}}</div>
            </a>
        </li>
        <li class="menu-item {{Route::is('testimonials.*')?'active':''}}">
            <a href="{{route('testimonials.index')}}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-user-check"></i>
                <div >{{__('Testimonials')}}</div>
            </a>
        </li>
        <li class="menu-item {{Route::is('reviews.*')?'active':''}}">
            <a href="{{route('reviews.index')}}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-message"></i>
                <div >{{__('Reviews')}}</div>
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
        <li class="menu-item {{Route::is('settings.index')?'active':''}}">
            <a href="{{route('settings.index')}}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-user-check"></i>
                <div >{{__('Settings')}}</div>
            </a>
        </li>
    </ul>
</aside>
