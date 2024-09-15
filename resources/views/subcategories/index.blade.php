@extends('layouts.app')
@section('title', __('Subcategories'))
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        @livewire('subcategories.create')
        @livewire('subcategories.show')
    </div>
@endsection
