@extends('layouts.app')
@section('title', __('Reviews'))
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        @livewire('reviews.show')
    </div>
@endsection
