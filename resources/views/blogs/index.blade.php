@extends('layouts.app')
@section('title', __('Blogs'))
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        @livewire('blogs.create')
        @livewire('blogs.show')
    </div>
@endsection
