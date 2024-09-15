@extends('frontend.layouts.app')
@section('title', $category->name)
@section('content')
    @include('frontend.layouts.breadcrumb')
    <livewire:frontend.categories :categorySlug="$category->slug" />
@endsection
