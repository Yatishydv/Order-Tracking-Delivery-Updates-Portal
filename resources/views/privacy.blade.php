@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 px-xl-5 py-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 mt-4">
            
            <div class="mb-5 pb-4 border-bottom">
                <h1 class="display-5 fw-bold text-dark mb-3" style="letter-spacing: -0.02em;">Privacy & Terms</h1>
                <p class="lead text-muted mb-0">Last updated: {{ date('F j, Y') }}</p>
            </div>

            <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white">
                <div class="prose max-w-none text-muted">
                    <h3 class="fw-bold text-dark mb-4">1. Information We Collect</h3>
                    <p class="mb-4">When you use DeliKart, we collect information you provide directly to us, such as when you create an account, update your profile, use our interactive maps, request customer support, or communicate with us. The types of information we may collect include your name, email address, postal address, phone number, and any other information you choose to provide.</p>
                    
                    <h3 class="fw-bold text-dark mb-4">2. How We Use Your Information</h3>
                    <p class="mb-4">We use the information we collect to provide, maintain, and improve our services, such as to facilitate deliveries, process transactions, and send you related information including confirmations and invoices. We also use your information to send you technical notices, updates, security alerts, and support messages.</p>

                    <h3 class="fw-bold text-dark mb-4">3. Data Security</h3>
                    <p class="mb-4">We take reasonable measures to help protect information about you from loss, theft, misuse and unauthorized access, disclosure, alteration and destruction. Our payment processing is fully encrypted and we do not store your raw credit card information on our servers.</p>

                    <h3 class="fw-bold text-dark mb-4">4. Location Tracking</h3>
                    <p class="mb-4">When you are an active driver for DeliKart, we collect precise location data from your device to provide real-time tracking to our customers. You can stop this at any time by going off-duty in the driver app.</p>
                </div>
            </div>

        </div>
    </div>
</div>
@include('partials.footer')
@endsection
