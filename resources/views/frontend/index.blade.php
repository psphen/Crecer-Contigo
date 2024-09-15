@extends('frontend.layouts.app')
@section('title', __('Home'))
@section('content')
    @include('frontend.partials.slider')
    @include('frontend.partials.service')
    @include('frontend.partials.profile')
    @include('frontend.partials.about-me')
    {{--@include('frontend.partials.line')--}}
@endsection
