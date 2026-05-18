@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<div class="bg-gradient-warm text-white py-5 position-relative overflow-hidden" style="min-height: 80vh; display: flex; align-items: center;">
    <div class="container position-relative" style="z-index: 2;">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <h6 class="text-accent fw-bold text-uppercase mb-3 tracking-widest">End-to-End Solutions</h6>
                <h1 class="display-3 fw-bold mb-4">Logistics Re-Imagined for the <span class="text-accent">Modern Era</span></h1>
                <p class="lead mb-5 opacity-75">DeliKart isn't just a shipping company. We are a technology-first logistics network designed to handle complex supply chains with absolute precision.</p>
                <div class="d-flex gap-3">
                    <a href="{{ route('register') }}" class="btn btn-primary btn-lg px-5 py-3 fw-bold border-0 shadow-lg" style="border-radius: 1rem;">GET STARTED</a>
                    <a href="#solutions" class="btn btn-outline-light btn-lg px-5 py-3 fw-bold" style="border-radius: 1rem;">EXPLORE STACK</a>
                </div>
            </div>
            <div class="col-lg-6" data-aos="zoom-in" data-aos-delay="200">
                <div class="position-relative">
                    <div class="bg-accent position-absolute top-50 start-50 translate-middle rounded-circle opacity-10" style="width: 120%; height: 120%; filter: blur(60px);"></div>
                    <img src="{{ asset('images/warehouse.png') }}" class="img-fluid rounded-5 shadow-2xl hover-lift position-relative" alt="Automated Warehouse">
                </div>
            </div>
        </div>
    </div>
</div>

<div id="solutions" class="py-5 bg-light">
    <div class="container py-5">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="display-5 fw-bold">Our Core Infrastructure</h2>
            <p class="text-muted mx-auto" style="max-width: 600px;">Every shipment in the DeliKart network passes through a rigorous, intelligence-driven handling process.</p>
        </div>

        <div class="row g-4">
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card h-100 border-0 shadow-sm p-5 hover-lift rounded-4">
                    <div class="bg-primary bg-opacity-10 text-primary p-4 rounded-circle d-inline-flex mb-4">
                        <i class="fas fa-warehouse fs-2"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Smart Storage</h4>
                    <p class="text-muted mb-0">Automated warehousing with AI-driven inventory management and real-time stock manifests.</p>
                </div>
            </div>
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card h-100 border-0 shadow-sm p-5 hover-lift rounded-4">
                    <div class="bg-primary bg-opacity-10 text-primary p-4 rounded-circle d-inline-flex mb-4">
                        <i class="fas fa-microchip fs-2"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Tech-First Handling</h4>
                    <p class="text-muted mb-0">Every consignment is tracked at a chip level, ensuring sub-meter accuracy across hubs.</p>
                </div>
            </div>
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
                <div class="card h-100 border-0 shadow-sm p-5 hover-lift rounded-4">
                    <div class="bg-primary bg-opacity-10 text-primary p-4 rounded-circle d-inline-flex mb-4">
                        <i class="fas fa-truck-fast fs-2"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Rapid Dispatch</h4>
                    <p class="text-muted mb-0">Optimized routing algorithms that cut delivery times by up to 40% compared to legacy carriers.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container py-5 my-5">
    <div class="row align-items-center g-5">
        <div class="col-lg-6" data-aos="fade-right">
            <img src="{{ asset('images/van_real.png') }}" class="img-fluid rounded-5 shadow-lg" alt="DeliKart Van">
        </div>
        <div class="col-lg-6" data-aos="fade-left">
            <h2 class="display-5 fw-bold mb-4">Precision Last-Mile Delivery</h2>
            <p class="text-muted lead mb-5">Our fleet is equipped with state-of-the-art telemetry systems that provide our central command with real-time health and position data for every ground unit.</p>
            <div class="row g-4">
                <div class="col-sm-6">
                    <div class="d-flex align-items-center mb-3">
                        <i class="fas fa-check-circle text-success fs-4 me-3"></i>
                        <span class="fw-bold">Bio-metric verification</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="fas fa-check-circle text-success fs-4 me-3"></i>
                        <span class="fw-bold">Real-time ETA polling</span>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="d-flex align-items-center mb-3">
                        <i class="fas fa-check-circle text-success fs-4 me-3"></i>
                        <span class="fw-bold">Secured manifest logs</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="fas fa-check-circle text-success fs-4 me-3"></i>
                        <span class="fw-bold">24/7 operative contact</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
