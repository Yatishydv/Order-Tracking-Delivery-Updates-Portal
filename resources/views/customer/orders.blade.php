@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-5" data-aos="fade-down">
    <div>
        <h2 class="fw-bold mb-1">My Cargo Manifests</h2>
        <p class="text-muted mb-0">Manage and track your active deliveries.</p>
    </div>
    <div class="bg-primary bg-opacity-10 px-4 py-2 rounded-pill">
        <span class="text-primary fw-bold">{{ $orders->count() }} Total Shipments</span>
    </div>
</div>

@if($orders->isEmpty())
    <div class="card border-0 shadow-lg text-center py-5" data-aos="zoom-in">
        <div class="card-body">
            <div class="bg-light d-inline-flex p-4 rounded-circle mb-4">
                <i class="fas fa-box-open text-muted fs-1"></i>
            </div>
            <h4 class="fw-bold">No active orders found</h4>
            <p class="text-muted mb-4">You haven't placed any orders yet. Once you do, they will appear here for real-time tracking.</p>
            <a href="{{ route('services') }}" class="btn btn-primary px-4">Explore Our Services</a>
        </div>
    </div>
@else
    <div class="row g-4">
        @foreach($orders as $order)
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="card border-0 shadow-lg h-100 overflow-hidden">
                    <div class="card-header bg-white border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                        <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 fw-bold" style="font-size: 0.7rem;">#{{ $order->id }}</span>
                        @php
                            $statusClass = match($order->status) {
                                'Delivered' => 'bg-success',
                                'Packed', 'Shipped' => 'bg-info',
                                'Out for Delivery' => 'bg-warning text-dark',
                                default => 'bg-secondary'
                            };
                        @endphp
                        <span class="badge {{ $statusClass }} px-3 py-2 fw-bold" style="font-size: 0.65rem;">{{ strtoupper($order->status) }}</span>
                    </div>
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3">{{ $order->product_name }}</h5>
                        <div class="mb-4">
                            <label class="text-muted small fw-bold d-block mb-1">Destination Address</label>
                            <p class="small mb-0 text-dark">{{ Str::limit($order->address, 60) }}</p>
                        </div>
                        <div class="d-grid">
                            <a href="{{ route('customer.tracking', $order) }}" class="btn btn-primary fw-bold py-2">
                                <i class="fas fa-location-dot me-2"></i> TRACK CARGO
                            </a>
                        </div>
                    </div>
                    <div class="card-footer bg-light border-0 px-4 py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="small text-muted">ETA: {{ $order->estimated_delivery->format('M d, Y') }}</span>
                            <i class="fas fa-chevron-right text-muted smaller"></i>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
@endsection
