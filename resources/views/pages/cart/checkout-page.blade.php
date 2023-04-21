@extends('shared.layouts.shop-layout')

@section('body-main-content')
    <section id="checkout">
        <div class="container my-4">
            <div class="row">
                <div class="col-md-8">
                    @include('pages.cart.components.checkout-items-table', [
                        'customCartItems' => $data['customCartItems'],
                    ])
                </div>
                <div class="col-md-4">
                    @include('pages.cart.components.checkout-form', [
                        'customerAddresses' => $data['customerAddresses'],
                        'paymentMethods' => $data['paymentMethods'],
                        'customCartItems' => $data['customCartItems'],
                    ])
                </div>
            </div>
        </div>
    </section>
@endsection
