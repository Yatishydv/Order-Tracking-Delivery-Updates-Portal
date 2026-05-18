@extends('layouts.app')

@section('content')
<div class="card border-0 shadow-lg mb-5 rounded-4 overflow-hidden" data-aos="fade-down">
    <div class="card-body p-0">
        <div class="row g-0">
            <div class="col-lg-8 p-5 bg-gradient-warm text-white position-relative">
                <i class="fas fa-satellite-dish position-absolute text-white opacity-10" style="font-size: 8rem; right: 2rem; top: 1rem;"></i>
                <h2 class="fw-bold mb-2 position-relative z-1">My Cargo Manifests</h2>
                <p class="mb-0 opacity-75 position-relative z-1">Global precision tracking. Monitor your active logistics operations in real-time.</p>
            </div>
            <div class="col-lg-4 d-flex align-items-center justify-content-center bg-primary text-white p-4">
                <div class="text-center">
                    <h1 class="fw-bold mb-0 display-4">{{ $orders->count() }}</h1>
                    <div class="text-uppercase tracking-widest small fw-bold opacity-75">Active Shipments</div>
                </div>
            </div>
        </div>
    </div>
</div>

@if(auth()->user()->role === 'customer' && auth()->user()->requested_role !== 'agent')
<div class="card border-0 shadow-sm mb-5 bg-primary bg-opacity-10" data-aos="fade-in">
    <div class="card-body p-4 d-flex justify-content-between align-items-center">
        <div>
            <h5 class="fw-bold text-dark mb-1"><i class="fas fa-truck-fast text-primary me-2"></i> Join Our Fleet</h5>
            <p class="text-dark opacity-75 mb-0 small">Want to earn by delivering packages? Apply to become a Delivery Agent today.</p>
        </div>
        <form action="{{ route('customer.request_agent') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary fw-bold px-4 rounded-pill shadow-sm">
                Apply Now
            </button>
        </form>
    </div>
</div>
@elseif(auth()->user()->role === 'customer' && auth()->user()->requested_role === 'agent')
<div class="card border-0 shadow-sm mb-5 bg-warning bg-opacity-10" data-aos="fade-in">
    <div class="card-body p-4 d-flex justify-content-between align-items-center">
        <div>
            <h5 class="fw-bold text-warning mb-1"><i class="fas fa-clock me-2"></i> Application Pending</h5>
            <p class="text-dark opacity-75 mb-0 small">Your application to become a Delivery Agent is currently under review by our administrators.</p>
        </div>
        <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">PENDING APPROVAL</span>
    </div>
</div>
@endif

@if($orders->isEmpty())
    <div class="card border-0 shadow-lg text-center py-5 rounded-4" data-aos="zoom-in">
        <div class="card-body py-5">
            <div class="bg-primary bg-opacity-10 d-inline-flex p-4 rounded-circle mb-4">
                <i class="fas fa-box-open text-primary fs-1"></i>
            </div>
            <h4 class="fw-bold">No Active Operations Found</h4>
            <p class="text-muted mb-5 col-md-6 mx-auto">Your logistics board is currently clear. Initiate a new shipping request to begin live tracking.</p>
            <a href="{{ route('services') }}" class="btn btn-dark px-5 py-3 rounded-pill fw-bold hover-lift">
                DEPLOY NEW CARGO <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
@else
    <div class="row g-4">
        @foreach($orders as $order)
            <div class="col-md-6 col-xl-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="card border-0 shadow-sm h-100 overflow-hidden position-relative">
                    <div class="position-absolute bg-primary opacity-10" style="width: 150px; height: 150px; border-radius: 50%; top: -50px; right: -50px;"></div>
                    
                    <div class="card-header bg-transparent border-0 pt-4 px-4 pb-0 d-flex justify-content-between align-items-center position-relative z-1">
                        <span class="text-muted small fw-bold text-uppercase tracking-widest">ID: {{ substr($order->id, -8) }}</span>
                        @php
                            $statusClass = match($order->status) {
                                'Delivered' => 'bg-success',
                                'Packed', 'Shipped' => 'bg-info',
                                'Out for Delivery' => 'bg-warning text-dark',
                                default => 'bg-secondary'
                            };
                        @endphp
                        <span class="badge {{ $statusClass }} px-3 py-2 fw-bold shadow-sm" style="font-size: 0.65rem; border-radius: 0.5rem;">
                            <i class="fas fa-circle ms-1 me-2 small" style="font-size: 0.4rem;"></i> {{ strtoupper($order->status) }}
                        </span>
                    </div>
                    
                    <div class="card-body p-4 position-relative z-1">
                        <h4 class="fw-bold mb-4">{{ $order->product_name }}</h4>
                        
                        <div class="d-flex mb-4">
                            <div class="me-3 mt-1 text-primary">
                                <i class="fas fa-map-marker-alt fs-5"></i>
                            </div>
                            <div>
                                <label class="text-muted small fw-bold text-uppercase tracking-widest d-block mb-1" style="font-size: 0.65rem;">Destination</label>
                                <p class="small mb-0 text-dark fw-medium">{{ Str::limit($order->address, 60) }}</p>
                            </div>
                        </div>
                        
                        <div class="d-flex align-items-center p-3 bg-light rounded-4 mb-4 border">
                            <div class="bg-white p-2 rounded-3 shadow-sm me-3 text-primary">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                            <div>
                                <label class="text-muted small fw-bold d-block mb-0" style="font-size: 0.65rem;">ESTIMATED ARRIVAL</label>
                                <span class="fw-bold text-dark">{{ $order->estimated_delivery->format('M d, Y - H:i') }}</span>
                            </div>
                        </div>

                        <div class="d-grid">
                            <a href="{{ route('customer.tracking', $order) }}" class="btn btn-dark fw-bold py-3 rounded-4 hover-lift">
                                ACCESS LIVE TRACKING <i class="fas fa-satellite ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
@endsection
