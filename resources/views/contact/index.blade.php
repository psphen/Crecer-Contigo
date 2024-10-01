@extends('layouts.app')
@section('title', __('Contactos'))
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        @livewire('contact.show');
    </div>
@endsection
