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
        background: url('/images/hero_real.png') no-repeat center center;
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
                    <h1 class="display-4 fw-bold mb-4">Start Your<br>Journey Today.</h1>
                    <p class="lead opacity-75">Join the world's most transparent logistics network and experience delivery updates in real-time.</p>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="login-wrapper">
                <div class="login-form-side w-100">
                    <div class="card card-login" data-aos="zoom-in">
                        <div class="mb-5 text-center">
                            <div class="bg-primary bg-opacity-10 d-inline-flex p-3 rounded-circle mb-4">
                                <i class="fas fa-user-plus text-primary fs-3"></i>
                            </div>
                            <h2 class="fw-bold mb-1">Create Account</h2>
                            <p class="text-muted">Register to start tracking your cargo</p>
                        </div>

                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="mb-4">
                                <label class="form-label small fw-bold text-uppercase tracking-wider">Full Name</label>
                                <input type="text" name="name" class="form-control form-control-lg border-0 bg-light py-3 px-4 rounded-3 @error('name') is-invalid @enderror" value="{{ old('name') }}" required autofocus placeholder="Yash Rao">
                                @error('name')
                                    <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label small fw-bold text-uppercase tracking-wider">Email Address</label>
                                <input type="email" name="email" class="form-control form-control-lg border-0 bg-light py-3 px-4 rounded-3 @error('email') is-invalid @enderror" value="{{ old('email') }}" required placeholder="name@example.com">
                                @error('email')
                                    <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label class="form-label small fw-bold text-uppercase tracking-wider">Password</label>
                                    <input type="password" name="password" class="form-control form-control-lg border-0 bg-light py-3 px-4 rounded-3 @error('password') is-invalid @enderror" required placeholder="••••••••">
                                    @error('password')
                                        <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label small fw-bold text-uppercase tracking-wider">Confirm</label>
                                    <input type="password" name="password_confirmation" class="form-control form-control-lg border-0 bg-light py-3 px-4 rounded-3" required placeholder="••••••••">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 py-3 mb-4 fw-bold shadow-lg">
                                INITIALIZE ACCOUNT
                            </button>

                            <p class="text-center text-muted small mb-0">
                                Already a partner? <a href="{{ route('login') }}" class="fw-bold text-decoration-none">Sign In</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
