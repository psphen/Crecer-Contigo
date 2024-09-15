@extends('layouts.app')
@section('title', __('Testimonials'))
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        @livewire('testimonials.create')
        @livewire('testimonials.show')
    </div>
@endsection
