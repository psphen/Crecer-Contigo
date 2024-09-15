@extends('frontend.layouts.app')
@section('title', $city->name)
@section('content')
    <livewire:frontend.cities :citySlug="$city->slug" />
@endsection
