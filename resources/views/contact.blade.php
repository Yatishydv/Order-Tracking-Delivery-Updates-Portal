@extends('layouts.app')

@section('content')
<div class="py-5 bg-white">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-5" data-aos="fade-right">
                <h6 class="text-primary fw-bold text-uppercase mb-3">Get In Touch</h6>
                <h1 class="display-5 fw-bold mb-4">How Can We <span class="text-primary">Help You?</span></h1>
                <p class="text-muted mb-5">Have a question about a shipment or interested in partnering with DeliKart? Our team is available 24/7 to assist you.</p>
                
                <div class="mb-4 d-flex align-items-center">
                    <div class="bg-primary bg-opacity-10 p-3 rounded-circle me-3">
                        <i class="fas fa-location-dot text-primary"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-0">Our Headquarters</h6>
                        <p class="text-muted small mb-0">123 Logistics Way, Suite 400, Global City</p>
                    </div>
                </div>
                
                <div class="mb-4 d-flex align-items-center">
                    <div class="bg-primary bg-opacity-10 p-3 rounded-circle me-3">
                        <i class="fas fa-envelope text-primary"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-0">Email Support</h6>
                        <p class="text-muted small mb-0">support@delikart.com</p>
                    </div>
                </div>
                
                <div class="d-flex align-items-center">
                    <div class="bg-primary bg-opacity-10 p-3 rounded-circle me-3">
                        <i class="fas fa-phone text-primary"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-0">24/7 Helpline</h6>
                        <p class="text-muted small mb-0">+1 (800) DELIKART</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7" data-aos="fade-left">
                <div class="card p-5 border-0 shadow-lg">
                    <h4 class="fw-bold mb-4">Send Us a Message</h4>
                    <form>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Full Name</label>
                                <input type="text" class="form-control py-3" placeholder="Yash Rao">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Email Address</label>
                                <input type="email" class="form-control py-3" placeholder="yashrao@example.com">
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-bold">Subject</label>
                                <select class="form-select py-3">
                                    <option>Tracking Issue</option>
                                    <option>Business Partnership</option>
                                    <option>Career Inquiry</option>
                                    <option>General Feedback</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-bold">Message</label>
                                <textarea class="form-control py-3" rows="5" placeholder="How can we help you today?"></textarea>
                            </div>
                            <div class="col-12 mt-4">
                                <button type="button" class="btn btn-primary w-100 py-3 fw-bold">SEND MESSAGE</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
