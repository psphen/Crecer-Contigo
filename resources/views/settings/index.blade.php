@extends('layouts.app')
@section('title', __('Settings'))
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        @livewire('settings.show')
    </div>
@endsection
