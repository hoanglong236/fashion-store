@extends('shared.layouts.shop-layout')

@section('body-main-content')
    <section id="checkout">
        <div class="container my-4">
            <div class="row">
                <div class="col-md-12">
                    @include('shared.components.action-results-area')
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    @include('pages.cart.components.cart-items-table', [
                        'customCartItems' => $data['customCartItems'],
                    ])
                    <div class="cart-action-wrapper">
                        <a href="{{ route('cart.checkout') }}" class="btn action-btn checkout-btn">Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
