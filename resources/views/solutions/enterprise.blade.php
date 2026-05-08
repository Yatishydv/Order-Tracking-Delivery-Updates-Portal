@extends('layouts.app')

@section('content')
<div class="py-5 bg-white">
    <div class="container py-5">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <h6 class="text-primary fw-bold text-uppercase mb-3">Enterprise Grade</h6>
                <h1 class="display-4 fw-bold mb-4">Scalable Logistics for <span class="text-primary">Global Corporations</span></h1>
                <p class="lead text-muted mb-4">DeliKart Enterprise provides large-scale organizations with a dedicated logistics infrastructure, featuring custom fleet allocation and 24/7 priority support.</p>
                <a href="{{ route('contact') }}" class="btn btn-primary btn-lg px-5 py-3 fw-bold">REQUEST ENTERPRISE QUOTE</a>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <img src="{{ asset('images/enterprise.png') }}" class="img-fluid rounded-4 shadow-2xl" alt="Enterprise Logistics">
            </div>
        </div>
    </div>
</div>

<div class="container py-5">
    <div class="row g-4">
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
            <div class="card p-5 h-100 border-0 shadow-sm">
                <h4 class="fw-bold text-primary mb-3">Custom Fleet</h4>
                <p class="text-muted">Dedicated vehicles and personnel assigned exclusively to your supply chain manifests.</p>
            </div>
        </div>
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
            <div class="card p-5 h-100 border-0 shadow-sm">
                <h4 class="fw-bold text-primary mb-3">SLA Guarantee</h4>
                <p class="text-muted">Rigorous service level agreements ensuring 99.9% on-time delivery for high-volume cargo.</p>
            </div>
        </div>
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
            <div class="card p-5 h-100 border-0 shadow-sm">
                <h4 class="fw-bold text-primary mb-3">Global Hubs</h4>
                <p class="text-muted">Priority access to our international distribution centers and air freight networks.</p>
            </div>
        </div>
    </div>
</div>
@endsection
