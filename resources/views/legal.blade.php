@extends('layouts.app')

@section('content')
<div class="py-5 bg-white">
    <div class="container py-5">
        <h1 class="display-5 fw-bold mb-5">Legal & Compliance</h1>
        
        <div class="row g-5">
            <div class="col-lg-8">
                <div class="mb-5">
                    <h3 class="fw-bold text-primary mb-4">Terms of Service</h3>
                    <p class="text-muted">By using the DeliKart platform, you agree to our professional standards of shipping and data transparency. Our manifests are legally binding documents of consignment.</p>
                    <p class="text-muted">Users are responsible for ensuring the legality of all contents within their packages. DeliKart reserves the right to inspect cargo in compliance with international shipping regulations.</p>
                </div>

                <div class="mb-5">
                    <h3 class="fw-bold text-primary mb-4">Service Level Agreement (SLA)</h3>
                    <p class="text-muted">We guarantee a 99% uptime for our real-time tracking intelligence. Any delays in physical delivery will be communicated instantly through the tracking portal, fulfilling our promise of 100% transparency.</p>
                </div>

                <div class="mb-5">
                    <h3 class="fw-bold text-primary mb-4">Liability & Insurance</h3>
                    <p class="text-muted">All DeliKart shipments are insured up to a standard value. For high-value enterprise cargo, additional insurance manifests must be generated during the initialization phase.</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card p-4 border-0 shadow-lg bg-light">
                    <h5 class="fw-bold mb-4">Legal Documents</h5>
                    <ul class="list-unstyled">
                        <li class="mb-3"><a href="{{ route('privacy') }}" class="text-decoration-none fw-bold text-primary"><i class="fas fa-file-shield me-2"></i> Privacy Intelligence</a></li>
                        <li class="mb-3"><a href="#" class="text-decoration-none fw-bold text-muted"><i class="fas fa-file-contract me-2"></i> Shipping Agreement</a></li>
                        <li class="mb-3"><a href="#" class="text-decoration-none fw-bold text-muted"><i class="fas fa-file-lines me-2"></i> Cookie Policy</a></li>
                    </ul>
                    <hr>
                    <p class="small text-muted mb-0">Last Updated: April 27, 2026</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
