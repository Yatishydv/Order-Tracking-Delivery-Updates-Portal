@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 px-xl-5 py-4">
    
    @php
        // Fallback images
        $defaultImage = 'https://images.unsplash.com/photo-1606220838315-056192d5e927?w=500&q=80';
        $nameLower = strtolower($order->product_name);
        if(str_contains($nameLower, 'tv')) $defaultImage = 'https://images.unsplash.com/photo-1593359677879-a4bb92f829d1?w=500&q=80';
        if(str_contains($nameLower, 'macbook')) $defaultImage = 'https://images.unsplash.com/photo-1517336714731-489689fd1ca8?w=500&q=80';
        if(str_contains($nameLower, 'iphone')) $defaultImage = 'https://images.unsplash.com/photo-1592750475338-74b7b21085ab?w=500&q=80';
        if(str_contains($nameLower, 'airpods')) $defaultImage = 'https://images.unsplash.com/photo-1600294037681-c80b4cb5b434?w=500&q=80';
        
        $imgUrl = $order->image_url ?: $defaultImage;
        
        $steps = ['Order Placed', 'Packed', 'Shipped', 'Out for Delivery', 'Delivered'];
        $currentIndex = array_search($order->status, $steps);
        if($currentIndex === false) $currentIndex = 0;
    @endphp

    <div class="row g-4">
        <!-- Main Journey Section -->
        <div class="col-lg-8">
            <!-- Header Section -->
            <div class="d-flex justify-content-between align-items-start mb-5 flex-wrap gap-4">
                <div>
                    <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-1 mb-3" style="font-size: 0.7rem; font-weight: 700; letter-spacing: 1px;"><i class="fas fa-circle me-1" style="font-size: 6px;"></i> LIVE TRACKING</span>
                    <h1 class="display-6 fw-bold text-dark mb-1">{{ $order->product_name }}</h1>
                    <div class="text-muted small">Order ID: <span class="fw-bold font-monospace text-dark">#{{ substr($order->id, -8) }}</span></div>
                </div>
                
                <div class="card border-0 shadow-sm p-3 d-flex flex-row align-items-center gap-4" style="min-width: 350px;">
                    <div>
                        <div class="text-muted small mb-1">Expected Delivery</div>
                        <div class="h5 fw-bold text-dark mb-0">{{ $order->estimated_delivery->format('M d, Y') }}</div>
                        <div class="text-muted small">By {{ $order->estimated_delivery->format('g:i A') }}</div>
                    </div>
                    <div class="bg-light rounded d-flex align-items-center justify-content-center border" style="width: 48px; height: 48px;">
                        <i class="far fa-calendar-alt text-muted fs-5"></i>
                    </div>
                    <div class="ms-auto rounded border" style="width: 80px; height: 60px; overflow: hidden;">
                        <img src="{{ $imgUrl }}" alt="Product" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                </div>
            </div>

            <!-- Stepper Map Card -->
            <div class="card border-0 shadow-sm p-5 mb-4">
                <h6 class="fw-bold text-dark mb-5">Package Journey</h6>
                
                <!-- Horizontal Stepper -->
                <div class="position-relative d-flex justify-content-between align-items-center w-100 mb-5 px-3">
                    <!-- Track line -->
                    <div class="position-absolute" style="top: 24px; left: 40px; right: 40px; height: 2px; background: #e5e7eb; z-index: 1;"></div>
                    
                    <!-- Active Track line -->
                    @php $percent = ($currentIndex / 4) * 100; @endphp
                    <div class="position-absolute" style="top: 24px; left: 40px; width: calc({{ $percent }}% - 40px); height: 2px; background: #111827; z-index: 2;"></div>
                    
                    <!-- Steps -->
                    @foreach($steps as $index => $step)
                        @php
                            $icon = match($step) {
                                'Order Placed' => 'fa-clipboard-check',
                                'Packed' => 'fa-box',
                                'Shipped' => 'fa-truck-loading',
                                'Out for Delivery' => 'fa-truck-fast',
                                'Delivered' => 'fa-home',
                            };
                            $isActive = $index <= $currentIndex;
                        @endphp
                        <div class="position-relative z-3 d-flex flex-column align-items-center text-center" style="width: 80px;">
                            <div class="rounded-circle d-flex align-items-center justify-content-center {{ $isActive ? 'bg-dark text-white' : 'bg-white border text-muted' }}" style="width: 48px; height: 48px; font-size: 1.1rem; border-color: #e5e7eb !important;">
                                <i class="fas {{ $icon }}"></i>
                            </div>
                            <div class="mt-3 text-dark fw-bold" style="font-size: 0.75rem;">{{ $step }}</div>
                            @if($isActive)
                                <div class="text-muted mt-1" style="font-size: 0.65rem;">
                                    @php
                                        // Try to find exact update time, otherwise mock it based on created_at
                                        $update = $order->updates->where('status', $step)->first();
                                        $time = $update ? $update->created_at : $order->created_at->addHours($index * 2);
                                    @endphp
                                    <div>{{ $time->format('M d') }}</div>
                                    <div>{{ $time->format('h:i A') }}</div>
                                </div>
                            @else
                                <div class="text-muted mt-1" style="font-size: 0.65rem;">Pending</div>
                            @endif
                        </div>
                    @endforeach
                </div>
                
                <!-- Interactive Map Graphic -->
                <div class="rounded-4 overflow-hidden position-relative mt-4 bg-light border" style="height: 350px; z-index: 1;">
                    <div id="tracking-map" style="width: 100%; height: 100%;"></div>
                </div>
            </div>
        </div>
        
        <!-- Sidebar -->
        <div class="col-lg-4">
            <h6 class="fw-bold text-dark mb-4">Driver Details</h6>
            <div class="card border-0 shadow-sm p-4 mb-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-3">
                        @php $driverName = $order->agent ? $order->agent->name : 'Unassigned'; @endphp
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($driverName) }}&background=f3f4f6&color=374151" alt="Driver" class="rounded-circle" width="50" height="50">
                        <div>
                            <div class="fw-bold text-dark">{{ $driverName }}</div>
                            <div class="text-warning small fw-bold"><i class="fas fa-star me-1"></i>4.8 <span class="text-muted fw-normal">(120 deliveries)</span></div>
                        </div>
                    </div>
                    @if($order->agent)
                        <div class="d-flex gap-2">
                            <button class="btn btn-light rounded-circle p-0 border d-flex align-items-center justify-content-center hover-lift" style="width: 35px; height: 35px;">
                                <i class="fas fa-phone-alt text-dark" style="font-size: 0.8rem;"></i>
                            </button>
                            <button class="btn btn-dark rounded-circle p-0 d-flex align-items-center justify-content-center hover-lift" style="width: 35px; height: 35px;">
                                <i class="fas fa-comment text-white" style="font-size: 0.8rem;"></i>
                            </button>
                        </div>
                    @endif
                </div>
            </div>
            
            <h6 class="fw-bold text-dark mb-4 mt-5">Delivery Details</h6>
            <div class="card border-0 shadow-sm p-4">
                <div class="d-flex align-items-start gap-3 mb-4">
                    <div class="bg-light rounded-circle d-flex align-items-center justify-content-center border flex-shrink-0" style="width: 32px; height: 32px;">
                        <i class="fas fa-map-pin text-dark" style="font-size: 0.8rem;"></i>
                    </div>
                    <div>
                        <div class="text-muted small fw-medium mb-1">Destination</div>
                        <div class="text-dark fw-bold" style="font-size: 0.85rem;">{{ $order->address }}</div>
                    </div>
                </div>
                
                <div class="d-flex align-items-start gap-3">
                    <div class="bg-light rounded-circle d-flex align-items-center justify-content-center border flex-shrink-0" style="width: 32px; height: 32px;">
                        <i class="fas fa-file-alt text-dark" style="font-size: 0.8rem;"></i>
                    </div>
                    <div>
                        <div class="text-muted small fw-medium mb-1">Delivery Instructions</div>
                        <div class="text-dark" style="font-size: 0.85rem;">Please handle with care.<br>Ring the doorbell.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<script>
    document.addEventListener('DOMContentLoaded', async function() {
        // Order details from Laravel
        const orderAddress = @json($order->address);
        const orderStatus = @json($order->status);
        
        // Setup Map
        var map = L.map('tracking-map', {
            zoomControl: true,
            scrollWheelZoom: false
        }).setView([0, 0], 2); // Default view until geocoded
        
        L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
            attribution: '&copy; OpenStreetMap &copy; CARTO',
            subdomains: 'abcd',
            maxZoom: 20
        }).addTo(map);
        
        var truckIcon = L.divIcon({
            html: '<div class="bg-dark text-white rounded-circle d-flex align-items-center justify-content-center shadow-lg" style="width: 40px; height: 40px; border: 2px solid white;"><i class="fas fa-truck-fast"></i></div>',
            className: '', iconSize: [40, 40], iconAnchor: [20, 20]
        });
        
        var homeIcon = L.divIcon({
            html: '<div class="bg-white text-dark rounded-circle d-flex align-items-center justify-content-center shadow" style="width: 40px; height: 40px; border: 2px solid #111827;"><i class="fas fa-home"></i></div>',
            className: '', iconSize: [40, 40], iconAnchor: [20, 20]
        });

        try {
            // 1. Geocode the destination address using Nominatim (OpenStreetMap)
            let response = await fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(orderAddress)}`);
            let data = await response.json();
            
            // If the exact street address isn't found (e.g. fake test data), try geocoding just the city/state part
            if (!data || data.length === 0) {
                const parts = orderAddress.split(',');
                if (parts.length > 1) {
                    const cityState = parts.slice(-2).join(','); // Take last two parts (e.g. "Silicon Valley, CA 94025")
                    response = await fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(cityState)}`);
                    data = await response.json();
                }
            }
            
            let destLat, destLng;
            
            if (data && data.length > 0) {
                destLat = parseFloat(data[0].lat);
                destLng = parseFloat(data[0].lon);
            } else {
                // If it's completely fake gibberish, generate a consistent pseudo-random coordinate in India based on the string
                let hash = 0;
                for (let i = 0; i < orderAddress.length; i++) hash = orderAddress.charCodeAt(i) + ((hash << 5) - hash);
                destLat = 15 + (Math.abs(hash) % 15) + ((Math.abs(hash * 3) % 100) / 100);
                destLng = 72 + (Math.abs(hash * 2) % 15) + ((Math.abs(hash * 5) % 100) / 100);
                console.warn("Address not found, using hashed fallback coordinates.");
            }
            
            // 2. Define the "Warehouse" (starting point) - simulated as ~5km away for visual purposes
            const startLat = destLat - 0.05;
            const startLng = destLng - 0.05;
            
            // 3. Calculate accurate Truck Position based on actual Order Status
            let progress = 0;
            if (orderStatus === 'Packed' || orderStatus === 'Order Placed') progress = 0.05;
            else if (orderStatus === 'Shipped') progress = 0.5;
            else if (orderStatus === 'Out for Delivery') progress = 0.85;
            else if (orderStatus === 'Delivered') progress = 1.0;
            
            const currentLat = startLat + (destLat - startLat) * progress;
            const currentLng = startLng + (destLng - startLng) * progress;
            
            // 4. Draw markers
            var homeMarker = L.marker([destLat, destLng], {icon: homeIcon}).addTo(map);
            var truckMarker = L.marker([currentLat, currentLng], {icon: truckIcon}).addTo(map);
            
            // 5. Fit bounds to show both markers
            var bounds = L.latLngBounds([startLat, startLng], [destLat, destLng]);
            map.fitBounds(bounds, {padding: [50, 50]});

        } catch (error) {
            console.error("Geocoding failed:", error);
            // Optionally, we could show a toast or alert, but the map will just remain blank or use fallbacks
        }
    });
</script>

@endsection
