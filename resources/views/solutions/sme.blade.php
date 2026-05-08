@extends('layouts.app')

@section('content')
<div class="py-5 bg-white">
    <div class="container py-5">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <img src="{{ asset('images/sme.png') }}" class="img-fluid rounded-4 shadow-2xl" alt="SME Logistics">
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <h6 class="text-primary fw-bold text-uppercase mb-3">Growth Engine</h6>
                <h1 class="display-4 fw-bold mb-4">SME Shipping <span class="text-primary">Simplified.</span></h1>
                <p class="lead text-muted mb-4">Small and medium businesses need speed and reliability without the overhead. DeliKart SME offers pay-as-you-go logistics with premium tracking features included.</p>
                <div class="row g-4 mb-5">
                    <div class="col-6">
                        <h2 class="fw-bold text-primary mb-0">No</h2>
                        <p class="text-muted small">MINIMUM ORDER</p>
                    </div>
                    <div class="col-6">
                        <h2 class="fw-bold text-primary mb-0">Flat</h2>
                        <p class="text-muted small">CITY-WIDE RATES</p>
                    </div>
                </div>
                <a href="{{ route('register') }}" class="btn btn-primary btn-lg px-5 py-3 fw-bold">START SHIPPING NOW</a>
            </div>
        </div>
    </div>
</div>
@endsection
