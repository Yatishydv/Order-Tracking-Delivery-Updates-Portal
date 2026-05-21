@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 px-xl-5 py-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 mt-4">
            
            <div class="row g-5 align-items-center">
                <div class="col-md-6">
                    <h1 class="display-5 fw-bold text-dark mb-4" style="letter-spacing: -0.03em;">Let's talk logistics.</h1>
                    <p class="lead text-muted mb-5">Have a question about our API? Want to become a fleet partner? Or just need help tracking a package? We're here 24/7.</p>
                    
                    <div class="d-flex flex-column gap-4">
                        <div class="d-flex align-items-start gap-3">
                            <div class="bg-dark bg-opacity-10 text-dark rounded-circle d-flex align-items-center justify-content-center mt-1" style="width: 40px; height: 40px;">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-1">Email Us</h5>
                                <p class="text-muted mb-0">support@delikart.com</p>
                            </div>
                        </div>
                        
                        <div class="d-flex align-items-start gap-3">
                            <div class="bg-dark bg-opacity-10 text-dark rounded-circle d-flex align-items-center justify-content-center mt-1" style="width: 40px; height: 40px;">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-1">Call Us</h5>
                                <p class="text-muted mb-0">+1 (800) 123-4567</p>
                            </div>
                        </div>
                        
                        <div class="d-flex align-items-start gap-3">
                            <div class="bg-dark bg-opacity-10 text-dark rounded-circle d-flex align-items-center justify-content-center mt-1" style="width: 40px; height: 40px;">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-1">Headquarters</h5>
                                <p class="text-muted mb-0">123 Logistics Way<br>Suite 100<br>San Francisco, CA 94107</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5">
                        <h4 class="fw-bold mb-4">Send us a message</h4>
                        
                        @if(session('success'))
                            <div class="alert alert-success border-0 shadow-sm rounded-3 small">
                                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('contact.submit') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label small fw-bold text-muted">Your Name</label>
                                <input type="text" name="name" class="form-control bg-light border-0 py-2" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-bold text-muted">Email Address</label>
                                <input type="email" name="email" class="form-control bg-light border-0 py-2" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label small fw-bold text-muted">How can we help?</label>
                                <textarea name="message" class="form-control bg-light border-0 py-2" rows="4" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-dark w-100 py-2 rounded-3 fw-bold shadow-sm">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@include('partials.footer')
@endsection
