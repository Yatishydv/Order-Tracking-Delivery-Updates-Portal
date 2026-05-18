@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<div class="bg-white py-5 overflow-hidden">
    <div class="container py-5">
        <div class="row align-items-center g-5 min-vh-75">
            <div class="col-lg-6" data-aos="fade-right">
                <h6 class="text-primary fw-bold text-uppercase mb-3 tracking-widest">Global Logistics Intelligence</h6>
                <h1 class="display-2 fw-bold mb-4">Precision Shipping for a <span class="text-primary">Connected World.</span></h1>
                <p class="lead text-muted mb-5">DeliKart is the world's most transparent logistics network. We combine state-of-the-art tracking intelligence with a global fleet to ensure your manifest reaches its destination with absolute certainty.</p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('register') }}" class="btn btn-primary btn-lg px-5 py-3 fw-bold rounded-4 shadow-lg border-0">START SHIPPING</a>
                    <a href="{{ route('fleet') }}" class="btn btn-outline-dark btn-lg px-5 py-3 fw-bold rounded-4">VIEW NETWORK</a>
                </div>
            </div>
            <div class="col-lg-6" data-aos="zoom-in" data-aos-delay="200">
                <div class="position-relative">
                    <div class="bg-primary position-absolute top-50 start-50 translate-middle rounded-circle opacity-10" style="width: 120%; height: 120%; filter: blur(60px);"></div>
                    <img src="{{ asset('images/hero_real.png') }}" class="img-fluid rounded-5 shadow-2xl hover-lift position-relative" alt="Professional Logistics">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Features Section -->
<div class="bg-light py-5">
    <div class="container py-5">
        <div class="row g-4">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card p-5 h-100 border-0 shadow-sm rounded-4 hover-lift">
                    <i class="fas fa-microchip text-primary fs-1 mb-4"></i>
                    <h4 class="fw-bold">AI Routing</h4>
                    <p class="text-muted mb-0">Our algorithms predict delays before they happen, re-routing cargo in real-time to avoid congestion.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card p-5 h-100 border-0 shadow-sm rounded-4 hover-lift">
                    <i class="fas fa-earth-americas text-primary fs-1 mb-4"></i>
                    <h4 class="fw-bold">Global Reach</h4>
                    <p class="text-muted mb-0">With 142 hubs across 6 continents, DeliKart provides a truly borderless shipping experience.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="card p-5 h-100 border-0 shadow-sm rounded-4 hover-lift">
                    <i class="fas fa-shield-halved text-primary fs-1 mb-4"></i>
                    <h4 class="fw-bold">Vault Security</h4>
                    <p class="text-muted mb-0">High-value assets are protected by biometric chain-of-custody protocols throughout transit.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Social Proof / Stats -->
<div class="py-5 bg-gradient-warm text-white">
    <div class="container py-5 text-center">
        <div class="row g-4">
            <div class="col-md-3">
                <h2 class="display-4 fw-bold mb-0">99.9%</h2>
                <p class="small text-white-50 fw-bold">ON-TIME DELIVERY</p>
            </div>
            <div class="col-md-3">
                <h2 class="display-4 fw-bold mb-0">1.2M+</h2>
                <p class="small text-white-50 fw-bold">CARGO MANIFESTS</p>
            </div>
            <div class="col-md-3">
                <h2 class="display-4 fw-bold mb-0">24/7</h2>
                <p class="small text-white-50 fw-bold">INTEL FEED</p>
            </div>
            <div class="col-md-3">
                <h2 class="display-4 fw-bold mb-0">142</h2>
                <p class="small text-white-50 fw-bold">GLOBAL HUBS</p>
            </div>
        </div>
    </div>
</div>
@endsection
