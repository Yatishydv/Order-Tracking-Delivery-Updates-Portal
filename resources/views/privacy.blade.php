@extends('layouts.app')

@section('content')
<div class="py-5 bg-white">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <h6 class="text-primary fw-bold text-uppercase mb-3">Your Security First</h6>
                <h1 class="display-5 fw-bold mb-5">Privacy Intelligence Policy</h1>
                
                <div class="card p-5 border-0 shadow-lg mb-5">
                    <p class="lead text-muted mb-5">At DeliKart, we treat your shipping data with the same precision we treat your cargo. Your privacy is paramount to the integrity of our logistics network.</p>

                    <h4 class="fw-bold mb-4">1. Data Collection</h4>
                    <p class="text-muted mb-4">We collect only the necessary data to facilitate real-time tracking: your name, email, delivery address, and consignment details. We never share your personal intelligence with third-party marketing entities.</p>

                    <h4 class="fw-bold mb-4">2. Real-Time Transparency</h4>
                    <p class="text-muted mb-4">By using our tracking portal, you agree to share your location data for the purpose of receiving accurate ETA calculations. This data is cryptographically secured and deleted after successful delivery.</p>

                    <h4 class="fw-bold mb-4">3. Data Security</h4>
                    <p class="text-muted mb-4">Our logistics nodes use state-of-the-art encryption to protect your manifest history. Your account access is restricted to verified partner nodes only.</p>

                    <div class="mt-5 pt-4 border-top">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary bg-opacity-10 p-3 rounded-circle me-3">
                                <i class="fas fa-user-shield text-primary"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-0">Privacy Officer</h6>
                                <p class="text-muted small mb-0">privacy@delikart.com</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
