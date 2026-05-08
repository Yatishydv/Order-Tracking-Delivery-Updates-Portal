@extends('layouts.app')

@section('styles')
<style>
    .api-hero {
        background: linear-gradient(rgba(15, 23, 42, 0.9), rgba(15, 23, 42, 0.9)), url("{{ asset('images/api.png') }}");
        background-size: cover;
        background-position: center;
        min-height: 60vh;
        display: flex;
        align-items: center;
        color: white;
    }
    .code-window-premium {
        background: #0f172a;
        border-radius: 1.5rem;
        box-shadow: 0 50px 100px rgba(0,0,0,0.5);
        border: 1px solid rgba(255,255,255,0.1);
        transform: translateY(-100px);
    }
    .feature-icon-box {
        width: 60px; height: 60px;
        background: #f1f5f9;
        border-radius: 1rem;
        display: flex; align-items: center; justify-content: center;
        margin-bottom: 1.5rem;
    }
</style>
@endsection

@section('content')
<div class="api-hero">
    <div class="container text-center" data-aos="fade-down">
        <h6 class="text-accent fw-bold text-uppercase tracking-widest mb-3">Intelligence for Developers</h6>
        <h1 class="display-3 fw-bold mb-4">Integrate the <span class="text-accent">Future</span> of Shipping</h1>
        <p class="lead opacity-75 mx-auto mb-5" style="max-width: 650px;">A robust, RESTful infrastructure that allows your e-commerce platform to communicate directly with our global logistics network.</p>
        <div class="d-flex justify-content-center gap-3">
            <a href="#" class="btn btn-primary px-5 py-3 fw-bold rounded-pill">GET API KEYS</a>
            <a href="#" class="btn btn-outline-light px-5 py-3 fw-bold rounded-pill">FULL DOCS</a>
        </div>
    </div>
</div>

<div class="container pb-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="code-window-premium overflow-hidden" data-aos="fade-up">
                <div class="bg-dark p-3 d-flex align-items-center border-bottom border-white border-opacity-10">
                    <div class="d-flex gap-2 me-4">
                        <div class="rounded-circle" style="width: 12px; height: 12px; background: #ff5f56;"></div>
                        <div class="rounded-circle" style="width: 12px; height: 12px; background: #ffbd2e;"></div>
                        <div class="rounded-circle" style="width: 12px; height: 12px; background: #27c93f;"></div>
                    </div>
                    <span class="small text-white-50 font-monospace">POST /api/v1/shipments/create</span>
                </div>
                <div class="p-5 font-monospace" style="background: #020617; color: #38bdf8; font-size: 0.95rem;">
                    <div class="mb-2"><span class="text-pink">{</span></div>
                    <div class="ms-4 mb-2"><span class="text-white">"origin":</span> <span class="text-success">"Global Hub 01"</span>,</div>
                    <div class="ms-4 mb-2"><span class="text-white">"destination":</span> <span class="text-success">"Retailer Node 42"</span>,</div>
                    <div class="ms-4 mb-2"><span class="text-white">"manifest_type":</span> <span class="text-success">"Priority Air"</span>,</div>
                    <div class="ms-4 mb-2"><span class="text-white">"options":</span> {</div>
                    <div class="ms-5 mb-2"><span class="text-white">"real_time_polling":</span> <span class="text-warning">true</span>,</div>
                    <div class="ms-5 mb-2"><span class="text-white">"biometric_verification":</span> <span class="text-warning">true</span></div>
                    <div class="ms-4 mb-2">}</div>
                    <div><span class="text-pink">}</span></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-5 py-5">
        <div class="col-md-4" data-aos="fade-right" data-aos-delay="100">
            <div class="feature-icon-box text-primary fs-3"><i class="fas fa-bolt"></i></div>
            <h5 class="fw-bold">High Velocity</h5>
            <p class="text-muted small">Sub-second response times across all endpoints, optimized for high-volume retailers.</p>
        </div>
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
            <div class="feature-icon-box text-primary fs-3"><i class="fas fa-link"></i></div>
            <h5 class="fw-bold">Webhooks</h5>
            <p class="text-muted small">Instant server-to-server notifications when cargo status changes within our network.</p>
        </div>
        <div class="col-md-4" data-aos="fade-left" data-aos-delay="300">
            <div class="feature-icon-box text-primary fs-3"><i class="fas fa-shield-cat"></i></div>
            <h5 class="fw-bold">Signed Payloads</h5>
            <p class="text-muted small">Cryptographically signed manifest data to ensure 100% data integrity for your logs.</p>
        </div>
    </div>
</div>
@endsection
