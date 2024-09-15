@extends('layouts.app')
@section('title', __('Services'))
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
       @livewire('services.create')
        @livewire('services.show')
    </div>
@endsection
