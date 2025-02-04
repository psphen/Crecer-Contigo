@extends('layouts.app')
@section('title', __('Dashboard'))
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
{{--{{__('Name')}}--}}

    </div>
    @push('scripts')
        <!-- Page JS -->
        <script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
    @endpush
@endsection

