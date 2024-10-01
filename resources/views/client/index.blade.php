@extends('layouts.app')
@section('title', __('Clientes'))
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        @livewire('client.show');
    </div>
@endsection
