@extends('layouts.app')

@section('styles')
<style>
    .tracking-hero {
        background: var(--primary);
        color: white;
        padding: 60px 0 100px;
        margin-bottom: -60px;
        position: relative;
    }
    .tracking-card-wrap {
        position: relative;
        z-index: 10;
    }
    .live-pulse {
        width: 12px;
        height: 12px;
        background: #10b981;
        border-radius: 50%;
        display: inline-block;
        margin-right: 8px;
        box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.4);
        animation: pulse-green 2s infinite;
    }
    @keyframes pulse-green {
        0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7); }
        70% { transform: scale(1); box-shadow: 0 0 0 10px rgba(16, 185, 129, 0); }
        100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
    }
    .intel-card {
        border-left: 4px solid var(--primary);
    }
</style>
@endsection

@section('content')
<div class="tracking-hero">
    <div class="container text-center" data-aos="fade-down">
        <h6 class="text-uppercase tracking-widest fw-bold opacity-75 mb-3">Live Intelligence Manifest</h6>
        <h1 class="display-4 fw-bold">Cargo ID #{{ $order->id }}</h1>
        <p class="lead opacity-75">Providing 100% transparency through real-time delivery updates.</p>
    </div>
</div>

<div class="container tracking-card-wrap">
    <div class="row g-4 justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-2xl p-4 p-md-5 mb-4" data-aos="zoom-in">
                <div class="row align-items-center mb-5">
                    <div class="col-md-7">
                        <div class="d-flex align-items-center mb-2">
                            <div class="live-pulse"></div>
                            <span class="text-success fw-bold small">LIVE TRACKING ACTIVE</span>
                        </div>
                        <h2 class="fw-bold mb-1">{{ $order->product_name }}</h2>
                        <p class="text-muted mb-0">Current status: <span class="badge bg-primary px-3 py-2 fw-bold ms-2">{{ strtoupper($order->status) }}</span></p>
                    </div>
                    <div class="col-md-5 text-md-end mt-3 mt-md-0">
                        <div class="p-3 bg-light rounded-4 d-inline-block">
                            <span class="text-muted small d-block">Expected Arrival</span>
                            <span class="fw-bold h5 text-primary mb-0">{{ $order->estimated_delivery->format('M d, Y') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Progress Bar -->
                <div class="track-bar-horizontal d-none d-md-flex mb-5">
                    @php
                        $steps = [
                            'Order Placed' => 'fa-file-invoice',
                            'Packed' => 'fa-cubes',
                            'Shipped' => 'fa-plane-up',
                            'Out for Delivery' => 'fa-truck-ramp-box',
                            'Delivered' => 'fa-box-circle-check'
                        ];
                        $keys = array_keys($steps);
                        $currentIndex = array_search($order->status, $keys);
                        $progressWidth = ($currentIndex / (count($keys) - 1)) * 80;
                    @endphp
                    <div class="track-progress-line" style="width: {{ $progressWidth }}%"></div>
                    @foreach($steps as $status => $icon)
                        @php
                            $idx = array_search($status, $keys);
                            $state = '';
                            if ($idx < $currentIndex) $state = 'completed';
                            elseif ($idx == $currentIndex) $state = 'active';
                        @endphp
                        <div class="text-center" style="width: 20%; position: relative; z-index: 5;">
                            <div class="track-node mx-auto {{ $state }}">
                                <i class="fas {{ $icon }}"></i>
                            </div>
                            <div class="small fw-bold mt-2 {{ $state ? 'text-primary' : 'text-muted' }}" style="font-size: 0.65rem;">{{ strtoupper($status) }}</div>
                        </div>
                    @endforeach
                </div>

                <div class="row g-5">
                    <div class="col-md-6">
                        <h5 class="fw-bold mb-4">Tracking Intelligence</h5>
                        <div class="timeline-real">
                            @foreach($order->updates->sortByDesc('created_at') as $update)
                            <div class="timeline-item-real mb-4 {{ $loop->first ? 'active' : 'completed' }}">
                                <div class="timeline-dot-real"></div>
                                <div class="ms-2">
                                    <h6 class="fw-bold mb-1">{{ $update->status }}</h6>
                                    <p class="text-muted small mb-1">{{ $update->message }}</p>
                                    <span class="smaller text-muted" style="font-size: 0.7rem;">{{ $update->created_at->format('M d, H:i:s') }}</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card intel-card border-0 bg-light p-4 h-100">
                            <h6 class="fw-bold text-uppercase mb-4" style="font-size: 0.7rem;">Shipment Transparency Details</h6>
                            
                            <div class="mb-4">
                                <label class="text-muted small d-block mb-1">Destination Hub</label>
                                <span class="fw-bold">{{ $order->address }}</span>
                            </div>

                            <div class="mb-4">
                                <label class="text-muted small d-block mb-1">Handling Operative</label>
                                <span class="fw-bold"><i class="fas fa-id-card me-2 text-primary"></i> {{ $order->agent ? $order->agent->name : 'Pending Dispatch' }}</span>
                            </div>

                            <div class="mt-auto p-3 bg-white rounded-3 border">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-shield-halved text-success me-2"></i>
                                    <span class="small fw-bold">Verified Shipment Intelligence</span>
                                </div>
                                <p class="smaller text-muted mb-0">Every update is cryptographically signed and verified by our logistics node network.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="alert bg-white border shadow-sm p-4 rounded-4" data-aos="fade-up">
                <div class="d-flex align-items-center">
                    <div class="bg-warning bg-opacity-10 p-3 rounded-circle me-3">
                        <i class="fas fa-circle-question text-warning fs-4"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1">Need Immediate Assistance?</h6>
                        <p class="text-muted small mb-0">Our 24/7 intelligence support team is here to help. <a href="{{ route('contact') }}" class="fw-bold">Contact Support</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function pollTracking() {
        $.ajax({
            url: '/api/tracking/{{ $order->id }}',
            method: 'GET',
            success: function(data) {
                if (data.status !== '{{ $order->status }}') {
                    location.reload();
                }
            }
        });
    }
    setInterval(pollTracking, 5000);
</script>
@endsection
