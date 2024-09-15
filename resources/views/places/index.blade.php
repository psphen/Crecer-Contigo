@extends('layouts.app')
@section('title', __('Places'))
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        @livewire('places.create')
        @livewire('places.show')
    </div>
@endsection

