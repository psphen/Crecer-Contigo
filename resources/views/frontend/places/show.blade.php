@extends('frontend.layouts.app')
@section('title', $place->name)
@section('content')
    <livewire:frontend.places :placeSlug="$place->slug" />
@endsection
