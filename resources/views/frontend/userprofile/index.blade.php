@extends('frontend.layouts.app')
@section('title', __('User Profile'))
@section('content')
    <link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-profile.css')}}">
    <livewire:frontend.userprofile :userprofileId="$user->id"/>
@endsection