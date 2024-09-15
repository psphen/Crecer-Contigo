@extends('frontend.layouts.app')
@section('title', __('Search results'))
@section('content')
    @include('frontend.layouts.breadcrumb')
    <div class="container">
        <livewire:frontend.search :resultQuery="$query"/>
    </div>
    @include('frontend.partials.variety')
@endsection
