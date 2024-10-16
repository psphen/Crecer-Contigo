@extends('layouts.app')
@section('title', __('Psicologas'))
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        @livewire('psychologist.create')
        @livewire('psychologist.show')
    </div>
@endsection
