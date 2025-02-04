@extends('layouts.app')
@section('title', __('Users'))
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        @livewire('users.create')
        @livewire('users.show')
    </div>
@endsection
