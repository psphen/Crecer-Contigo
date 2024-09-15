@extends('layouts.app')
@section('title', __('Posts'))
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        @livewire('posts.create')
        @livewire('posts.show')
    </div>
@endsection
