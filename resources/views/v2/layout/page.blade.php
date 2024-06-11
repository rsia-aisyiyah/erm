@extends('v2.main')

@stack('styles')
@section('page')
    <x-navbar />
    <x-menu-bar />
    <div class="page-wrapper">
        <!-- Page header -->
        <x-breadcumb />
        <!-- Page body -->
        <div class="container-fluid">
            @yield('content')
        </div>

        <x-footer />
    </div>
@endsection
