@extends('shared.layouts.login-register-layout')

@section('container-content')
    <div class="row">
        <div class="col-md-12 auth-form-container">
            <div class="auth-form-area">
                @include('shared.components.header-logo-section')
                <div class="form-title">
                    <h4>REGISTER ACCOUNT</h4>
                </div>
                @include('pages.account.components.register-form')

                <div class="external-link">
                    All ready have account?
                    <a href="{{ route('login') }}">Login.</a>
                </div>
            </div>
        </div>
    </div>
@endsection
