@extends('shared.layouts.shop-layout')

@section('body-main-content')
    {{-- @include('pages.home.components.slider-section') --}}
    @include('pages.home.components.promo-section')
    @include('pages.home.components.products-section')
    @include('pages.home.components.banner-section')
    @include('pages.home.components.popular-section')

    @include('shared.components.action-results-alert')
@endsection
