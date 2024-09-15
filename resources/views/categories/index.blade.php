@extends('layouts.app')
@section('title', __('Categories'))
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        @livewire('categories.create')
        @livewire('categories.show')
    </div>
@endsection
