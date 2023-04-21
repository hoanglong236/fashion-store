@extends('shared.layouts.shop-layout')

@section('body-main-content')
    <section id="checkout">
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-12">
                    @include('shared.components.action-results-area')
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @include('pages.order.components.orders-table', [
                        'customOrders' => $data['customOrders'],
                    ])
                </div>
            </div>
        </div>
    </section>
@endsection
