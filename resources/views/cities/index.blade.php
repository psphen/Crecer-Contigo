@extends('layouts.app')
@section('title', __('Cities'))
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        @livewire('cities.create')
        @livewire('cities.show')
    </div>
@endsection
