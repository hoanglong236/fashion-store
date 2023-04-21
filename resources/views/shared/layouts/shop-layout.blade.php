@extends('shared.layouts.base-layout')

@section('body-content')
    @include('shared.components.loading-modal')
    <a class="scrollToTop" href="#"><i class="fa fa-chevron-up"></i></a>

    @include('shared.components.header')
    @include('shared.components.menu-section')

    @yield('body-main-content')

    @include('shared.components.support-section')
    {{-- @include('shared.components.testimonial-section') --}}
    {{-- @include('shared.components.latest-blog-section') --}}
    @include('shared.components.client-brand-section')
    @include('shared.components.subscribe-section')
    @include('shared.components.footer')
    {{-- @include('shared.components.login-modal') --}}
@endsection
