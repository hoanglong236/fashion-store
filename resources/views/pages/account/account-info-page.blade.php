@extends('shared.layouts.shop-layout')

@section('body-main-content')
    <section id="customer-info">
        <div class="container mt-2">
            <div class="row">
                <div class="col-md-8">
                    @include('pages.account.components.customer-address-table', [
                        'customerAddresses' => $data['customerAddresses'],
                    ])
                    @include('shared.components.action-results-alert')
                    @include('pages.account.components.add-address-form')
                </div>
                <div class="col-md-4">
                    @include('pages.account.components.customer-info-table', [
                        'customer' => Auth::guard('customer')->user(),
                    ])
                </div>
            </div>
        </div>
    </section>
@endsection
