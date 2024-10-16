@extends('frontend.layouts.app')
@section('title', __('Detalles del servicios'))
@section('content')
    <div class="container-xxl flex-grow-1">
        @livewire('frontend.service.details', ['service' => $service])
    </div>
@endsection
