@extends('shared.layouts.shop-layout')

@section('body-main-content')
    <section id="checkout">
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-8">
                    @include('pages.order.components.order-items-table', [
                        'customOrderItems' => $data['customOrderItems'],
                    ])
                </div>
                <div class="col-md-4">
                    @include('pages.order.components.order-info-table', [
                        'customOrder' => $data['customOrder'],
                    ])
                </div>
            </div>
        </div>
    </section>
@endsection
