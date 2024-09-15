@extends('layouts.app')
@section('title', __('Customers'))
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        @livewire('customers.show')
    </div>
@endsection
