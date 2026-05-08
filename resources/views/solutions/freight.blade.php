@extends('layouts.app')

@section('content')
<div class="py-5 bg-white">
    <div class="container py-5">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="p-2 border rounded-4 shadow-2xl overflow-hidden">
                    <img src="{{ asset('images/freight.png') }}" class="img-fluid rounded-4" alt="Air Freight">
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <h6 class="text-primary fw-bold text-uppercase mb-3">Global Velocity</h6>
                <h1 class="display-4 fw-bold mb-4">International <span class="text-primary">Air Freight</span> Manifests</h1>
                <p class="lead text-muted mb-4">When speed is non-negotiable. DeliKart Air connects your business to over 500 international airports with rapid customs clearance and priority tarmac handling.</p>
                <ul class="list-unstyled mb-5">
                    <li class="mb-3 d-flex align-items-center"><i class="fas fa-plane-up text-primary me-3"></i> Next-Flight-Out (NFO) service</li>
                    <li class="mb-3 d-flex align-items-center"><i class="fas fa-globe text-primary me-3"></i> Door-to-Door international courier</li>
                    <li class="mb-3 d-flex align-items-center"><i class="fas fa-file-contract text-primary me-3"></i> Automated customs documentation</li>
                </ul>
                <a href="{{ route('contact') }}" class="btn btn-primary btn-lg px-5 py-3 fw-bold">INITIATE AIR MANIFEST</a>
            </div>
        </div>
    </div>
</div>
@endsection
