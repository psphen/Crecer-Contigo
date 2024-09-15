@extends('layouts.app')
@section('title', __('Vendors'))
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        @livewire('vendors.create')
        @livewire('vendors.show')
    </div>
@endsection
