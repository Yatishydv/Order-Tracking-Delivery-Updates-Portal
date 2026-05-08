@extends('layouts.app')

@section('styles')
<style>
    .login-wrapper {
        min-height: calc(100vh - 73px);
        display: flex;
        align-items: center;
        background: #fff;
    }
    .login-visual {
        background: url('/images/van_real.png') no-repeat center center;
        background-size: cover;
        height: 100%;
        min-height: 100vh;
        position: relative;
    }
    .login-visual::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(30, 58, 138, 0.8), rgba(15, 23, 42, 0.4));
    }
    .visual-content {
        position: relative;
        z-index: 10;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 4rem;
        color: white;
    }
    .login-form-side {
        padding: 4rem;
    }
    .card-login {
        max-width: 450px;
        margin: 0 auto;
        border: none;
    }
</style>
@endsection

@section('content')
<div class="container-fluid p-0">
    <div class="row g-0 align-items-stretch">
        <div class="col-lg-6 d-none d-lg-block">
            <div class="login-visual">
                <div class="visual-content" data-aos="fade-right">
                    <h1 class="display-4 fw-bold mb-4">Precision Logistics,<br>Human Touch.</h1>
                    <p class="lead opacity-75">Log in to your DeliKart node to manage real-time intelligence and ensure seamless delivery updates.</p>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="login-wrapper">
                <div class="login-form-side w-100">
                    <div class="card card-login" data-aos="zoom-in">
                        <div class="mb-5 text-center">
                            <div class="bg-primary bg-opacity-10 d-inline-flex p-3 rounded-circle mb-4">
                                <i class="fas fa-fingerprint text-primary fs-3"></i>
                            </div>
                            <h2 class="fw-bold mb-1">Intelligence Login</h2>
                            <p class="text-muted">Secure access to the DeliKart network</p>
                        </div>

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="mb-4">
                                <label class="form-label small fw-bold text-uppercase tracking-wider">Email Address</label>
                                <input type="email" name="email" class="form-control form-control-lg border-0 bg-light py-3 px-4 rounded-3 @error('email') is-invalid @enderror" value="{{ old('email') }}" required autofocus placeholder="name@company.com">
                                @error('email')
                                    <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label small fw-bold text-uppercase tracking-wider">Password</label>
                                    @if (Route::has('password.request'))
                                        <a class="small fw-bold text-decoration-none" href="{{ route('password.request') }}">Recover?</a>
                                    @endif
                                </div>
                                <input type="password" name="password" class="form-control form-control-lg border-0 bg-light py-3 px-4 rounded-3 @error('password') is-invalid @enderror" required placeholder="••••••••">
                                @error('password')
                                    <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label text-muted small" for="remember">Keep session active</label>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 py-3 mb-4 fw-bold shadow-lg">
                                SIGN IN TO NETWORK
                            </button>

                            <p class="text-center text-muted small mb-0">
                                New to DeliKart? <a href="{{ route('register') }}" class="fw-bold text-decoration-none">Create Partner Account</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
