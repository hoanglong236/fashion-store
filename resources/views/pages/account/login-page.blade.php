@extends('shared.layouts.login-register-layout')

@section('container-content')
    <div class="row">
        <div class="col-md-12 auth-form-container">
            <div class="auth-form-area">
                @include('shared.components.header-logo-section')
                <div class="form-title">
                    <h4>LOGIN</h4>
                </div>

                @include('pages.account.components.login-form')
                @include('shared.components.action-results-area')

                <div class="external-link">
                    New to <strong>fashion<span>Store</span></strong>?
                    <a href="{{ route('register') }}">Create an account.</a>
                </div>
            </div>
        </div>
    </div>
@endsection
