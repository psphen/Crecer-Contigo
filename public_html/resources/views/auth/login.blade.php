@extends('auth.app')
@section('title',__('Login'))
@section('content')
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">
                <!-- Login -->
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
                        <h4 class="mb-1 pt-2 text-center">{{__('Welcome to')}}  {{$app_name}} 👋</h4>
                        <p class="mb-4 text-center">{{__('Enter your details to login to the dashboard')}}</p>
                        <form id="formAuthentication" class="mb-3" method="POST" action="{{ route('login') }}">
                            @csrf
                            <input type="hidden" name="previous_url" value="{{ URL::previous() }}">
                            <div class="mb-3">
                                <label for="email" class="form-label">{{__('Email')}}</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus id="email" placeholder="{{__('Enter your email')}}"/>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="password">{{__('Password')}}</label>
                                </div>
                                <div class="input-group input-group-merge">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                           aria-describedby="password">
                                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100" type="submit">{{__('Login')}}</button>
                            </div>
                        </form>
                        <p class="text-center">
                            <span>{{__('New on our platform?')}}</span>
                            <a href="{{route('register')}}">
                                <span>{{__('Create an account')}}</span>
                            </a>
                        </p>
                    </div>
                </div>
                <!-- /Register -->
            </div>
        </div>
    </div>
@endsection
