@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<div class="py-5 bg-light overflow-hidden">
    <div class="container py-5">
        <div class="row align-items-center g-5 min-vh-75">
            <div class="col-lg-6" data-aos="fade-right">
                <h6 class="text-primary fw-bold text-uppercase mb-3 tracking-widest">Our Legacy</h6>
                <h1 class="display-3 fw-bold mb-4">The Future of <span class="text-primary">Global Movement.</span></h1>
                <p class="lead text-muted mb-5">Founded in 2024, DeliKart was built on a single premise: that logistics should be a source of intelligence, not a source of stress. Today, we manage the most transparent shipping network on the planet.</p>
                <div class="row g-4 mb-5">
                    <div class="col-6">
                        <h4 class="fw-bold mb-1">Global HQ</h4>
                        <p class="small text-muted mb-0">Tech-Forward Architecture</p>
                    </div>
                    <div class="col-6">
                        <h4 class="fw-bold mb-1">1,200+</h4>
                        <p class="small text-muted mb-0">System Operatives</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" data-aos="zoom-in" data-aos-delay="200">
                <img src="{{ asset('images/about.png') }}" class="img-fluid rounded-5 shadow-2xl hover-lift" alt="DeliKart Headquarters">
            </div>
        </div>
    </div>
</div>

<div class="container py-5 my-5">
    <div class="row g-5 align-items-center">
        <div class="col-lg-6" data-aos="fade-right">
            <h2 class="display-5 fw-bold mb-4">Engineering Certainty</h2>
            <p class="text-muted lead mb-4">Our mission is to eliminate the 'black box' of shipping. By providing customers, agents, and admins with a unified intelligence feed, we ensure that every node in the supply chain is synchronized.</p>
            <div class="d-flex align-items-center mb-3">
                <div class="bg-primary bg-opacity-10 p-3 rounded-circle me-3">
                    <i class="fas fa-eye text-primary"></i>
                </div>
                <div>
                    <h5 class="fw-bold mb-0">Radical Transparency</h5>
                    <p class="small text-muted mb-0">Real-time polling for every single manifest.</p>
                </div>
            </div>
            <div class="d-flex align-items-center">
                <div class="bg-primary bg-opacity-10 p-3 rounded-circle me-3">
                    <i class="fas fa-shield-heart text-primary"></i>
                </div>
                <div>
                    <h5 class="fw-bold mb-0">Absolute Integrity</h5>
                    <p class="small text-muted mb-0">Secure handling protocols for every gram of cargo.</p>
                </div>
            </div>
        </div>
        <div class="col-lg-6" data-aos="fade-left">
            <div class="p-5 bg-gradient-warm text-white rounded-5 shadow-lg">
                <h3 class="fw-bold mb-4">The DeliKart Promise</h3>
                <p class="opacity-75 mb-5">"We don't just deliver packages. We deliver peace of mind through data and precision handling. Every shipment is a commitment to excellence."</p>
                <div class="d-flex align-items-center">
                    <div class="bg-white p-2 rounded-circle me-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-cube text-primary"></i>
                    </div>
                    <div>
                        <div class="fw-bold">Executive Board</div>
                        <div class="small text-white-50">DeliKart Logistics Intelligence</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
