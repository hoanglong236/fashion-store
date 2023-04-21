@extends('shared.layouts.shop-layout')

@section('body-main-content')
    @include('pages.product.components.head-banner')

    <section id="aa-product-category">
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-3">
                    @include('pages.product.components.product-filter-nav', [
                        'brands' => $data['brands'],
                        'sorterOptions' => $data['sorterOptions'],
                        'bestSellerProducts' => $data['bestSellerProducts'],
                    ])
                </div>
                <div class="col-md-9">
                    @include('shared.components.products-list', [
                        'products' => $data['products'],
                    ])
                    @include('shared.components.paginator', [
                        'paginator' => $data['products'],
                    ])
                </div>
            </div>
        </div>
    </section>

    @include('shared.components.action-results-alert')
@endsection
