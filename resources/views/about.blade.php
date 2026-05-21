@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 px-xl-5 py-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 mt-4">
            
            <div class="text-center mb-5">
                <div class="badge bg-dark bg-opacity-10 text-dark rounded-pill px-3 py-2 mb-3 fw-bold border border-dark border-opacity-10">Our Story</div>
                <h1 class="display-4 fw-bold text-dark mb-4" style="letter-spacing: -0.03em;">Revolutionizing the final mile.</h1>
                <p class="lead text-muted mx-auto" style="max-width: 600px;">We built DeliKart to fix a broken system. Shipping shouldn't be a black box of stress and uncertainty.</p>
            </div>

            <img src="https://images.unsplash.com/photo-1553413077-190dd305871c?w=1200&q=80" alt="Warehouse Operations" class="img-fluid rounded-4 shadow-sm mb-5 w-100" style="height: 400px; object-fit: cover;">

            <div class="row g-5 mb-5">
                <div class="col-md-6">
                    <h3 class="fw-bold mb-3">The Problem</h3>
                    <p class="text-muted" style="line-height: 1.8;">Traditional courier services rely on outdated technology and hub-and-spoke models that delay your packages. When you hand over a package, it enters a void of vague updates and missed delivery windows.</p>
                </div>
                <div class="col-md-6">
                    <h3 class="fw-bold mb-3">Our Solution</h3>
                    <p class="text-muted" style="line-height: 1.8;">We leverage an active crowd-sourced network of local delivery professionals powered by our cutting-edge routing algorithm. This means direct, point-to-point delivery with live GPS tracking from start to finish.</p>
                </div>
            </div>

            <div class="card bg-light border-0 rounded-4 p-5 text-center mt-5">
                <h2 class="fw-bold mb-4">Join our mission</h2>
                <p class="text-muted mb-4 mx-auto" style="max-width: 500px;">Whether you're a business looking to scale your local delivery, or a driver wanting to earn on your own schedule, there's a place for you at DeliKart.</p>
                <div class="d-flex justify-content-center gap-3">
                    <a href="{{ route('register') }}" class="btn btn-dark px-4 py-2 rounded-pill fw-bold shadow-sm">Sign Up Now</a>
                    <a href="{{ route('contact') }}" class="btn btn-outline-dark px-4 py-2 rounded-pill fw-bold">Contact Us</a>
                </div>
            </div>

        </div>
    </div>
</div>
@include('partials.footer')
@endsection
