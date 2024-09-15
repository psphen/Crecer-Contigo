@extends('frontend.layouts.app')
@section('title', __('Contact'))
@section('content')
    @include('frontend.layouts.breadcrumb')
    <div class="container py-4">
        <div class="row d-flex align-items-center">
            <div class="col-md-6">
                <h2>Nuestras oficinas</h2>
                <p>Cl. 33 #33-34. Villavicencio, Meta</p>
                <p>Celular: +573138687749</p>

                <a href="https://goo.gl/maps/nsHBNQDZyipN9AHH9" target="_blank" class="btn btn-label-primary">

                    <span> <i class="ti ti-map-pin me-0 me-sm-1 ti-xs"></i><span class="d-none d-sm-inline-block">{{__('How to get there')}}</span></span>
                </a>
            </div>
            <div class="col-md-6">
                <div class="card mb-4">
                    <h5 class="card-header">{{__('Contact us')}}</h5>
                    <div class="card-body demo-vertical-spacing demo-only-element">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="{{__('Name')}}" aria-label="{{__('Name')}}" aria-describedby="basic-addon11">
                        </div>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="{{__('Lastname')}}" aria-label="{{__('Lastname')}}" aria-describedby="basic-addon11">
                        </div>
                        <div class="input-group">
                            <input type="email" class="form-control"  placeholder="{{__('Email')}}" aria-describedby="basic-default-password2">
                        </div>
                        <div class="input-group">
                            <input type="tel" class="form-control" placeholder="{{__('Phone')}}" aria-label="{{__('Phone')}}" aria-describedby="basic-addon13">
                        </div>
                        <div class="input-group">
                            <textarea class="form-control" aria-label="{{__('Comment')}}" placeholder="{{__('Comment')}}"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
