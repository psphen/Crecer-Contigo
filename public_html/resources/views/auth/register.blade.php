@extends('auth.app')
@section('title', __('Register'))
@section('content')
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">
                <!-- Register Card -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center mb-4 mt-2">

                            <a class="navbar-brand mx-2" href="{{route('frontend.index')}}">
                                @if($logo!=null)
                                    <img src="{{asset('uploads/settings/'.$logo)}}" alt="" class="img-fluid" style="height: 75px">
                                @else
                                    <span class="app-brand-text demo menu-text fw-bold">{{$app_name}}</span>
                                @endif
                            </a>
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-1 pt-2">{{__('Join the community of')}} {{$app_name}}</h4>
                        <p class="mb-4">{{__('Complete the registration form and become a part of our team.')}}</p>

                        <form id="formAuthentication" class="mb-3 fv-plugins-bootstrap5 fv-plugins-framework" method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="mb-3 fv-plugins-icon-container">
                                <label for="name" class="form-label">{{__('First name')}}</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="" autofocus="" @error('name') is-invalid @enderror>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 fv-plugins-icon-container">
                                <label for="last_name" class="form-label">{{__('Last name')}}</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="" autofocus="" @error('last_name') is-invalid @enderror>
                                @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 fv-plugins-icon-container">
                                <label for="dni" class="form-label">{{__('DNI')}}</label>
                                <input type="number" class="form-control" id="dni" name="dni" placeholder="" autofocus="" @error('dni') is-invalid @enderror>
                                @error('dni')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 fv-plugins-icon-container">
                                <label for="email" class="form-label">{{__('Email')}}</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="" @error('email') is-invalid @enderror>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 fv-plugins-icon-container">
                                <label for="phone" class="form-label">{{__('Phone')}}</label>
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="" autofocus="" @error('phone') is-invalid @enderror>
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 form-password-toggle fv-plugins-icon-container">
                                <label class="form-label" for="password">{{ __('Password') }}</label>
                                <div class="input-group input-group-merge has-validation">
                                    <input type="password" id="password" class="form-control" name="password" placeholder="············" aria-describedby="password">
                                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                </div>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 form-password-toggle fv-plugins-icon-container">
                                <label class="form-label" for="password_confirmation">{{ __('Confirm password') }}</label>
                                <div class="input-group input-group-merge has-validation">
                                    <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" required autocomplete="password_confirm" placeholder="············">
                                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                </div>
                                @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 fv-plugins-icon-container">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms">
                                    <label class="form-check-label" for="terms-conditions">{{__('I agree to')}} <a href="javascript:void(0);">{{__('privacy policy & terms')}}</a></label>
                                </div>
                                @error('terms')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary d-grid w-100 waves-effect waves-light">{{ __('Register') }}</button>
                        </form>
                        <p class="text-center"><span>{{__('Already have an account?')}} </span><a href="{{route('login')}}"><span>{{__('Login')}}</span></a></p>
{{--                        <div class="divider my-4">--}}
{{--                            <div class="divider-text">or</div>--}}
{{--                        </div>--}}
{{--                        <div class="d-flex justify-content-center">--}}
{{--                            <a href="javascript:;" class="btn btn-icon btn-label-facebook me-3 waves-effect">--}}
{{--                                <i class="tf-icons fa-brands fa-facebook-f fs-5"></i>--}}
{{--                            </a>--}}

{{--                            <a href="javascript:;" class="btn btn-icon btn-label-google-plus me-3 waves-effect">--}}
{{--                                <i class="tf-icons fa-brands fa-google fs-5"></i>--}}
{{--                            </a>--}}

{{--                            <a href="javascript:;" class="btn btn-icon btn-label-twitter waves-effect">--}}
{{--                                <i class="tf-icons fa-brands fa-twitter fs-5"></i>--}}
{{--                            </a>--}}
{{--                        </div>--}}
                    </div>
                </div>
                <!-- Register Card -->
            </div>
        </div>
    </div>
@endsection
