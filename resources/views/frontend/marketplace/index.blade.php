@extends('frontend.layouts.app')
@section('title', __('Marketplace'))
@section('content')
    <div class="container-xxl flex-grow-1">
        @livewire('frontend.marketplace')
    </div>
@endsection
