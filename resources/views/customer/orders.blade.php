@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 px-xl-5 py-4">
    <!-- Hero Banner -->
    <div class="card border-0 mb-5 rounded-4" style="background-color: #f8f9fa;">
        <div class="card-body p-5 d-flex align-items-center justify-content-between position-relative overflow-hidden">
            <div class="position-relative z-1">
                <h1 class="display-6 fw-bold text-dark mb-2">Welcome back, {{ explode(' ', auth()->user()->name)[0] }}! 👋</h1>
                <p class="text-muted mb-0 fs-6">Track your orders and view your delivery history.</p>
            </div>
            <div class="d-none d-md-block position-relative z-1 me-4">
                <img src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?w=300&q=80" alt="Box" class="rounded-3 shadow-sm" style="width: 120px; height: 120px; object-fit: cover; opacity: 0.8; filter: grayscale(50%);">
            </div>
            <!-- Decorative circle -->
            <div class="position-absolute rounded-circle bg-white" style="width: 300px; height: 300px; right: -50px; top: -100px; opacity: 0.5;"></div>
        </div>
    </div>

    <!-- Orders Section -->
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <h4 class="fw-bold text-dark mb-0">Your Orders</h4>
        
        <form action="{{ route('customer.orders') }}" method="GET" class="d-flex flex-column flex-sm-row gap-3 align-items-center mb-0">
            <!-- Search Bar -->
            <div class="position-relative shadow-sm rounded-pill bg-white border" style="width: 280px; transition: all 0.2s ease;">
                <i class="fas fa-search position-absolute text-muted" style="left: 16px; top: 50%; transform: translateY(-50%); font-size: 0.85rem;"></i>
                <input type="text" name="search" id="customerRealtimeSearch" class="form-control border-0 bg-transparent rounded-pill" placeholder="Search product or ID..." value="{{ request('search') }}" style="padding: 10px 36px 10px 40px; font-size: 0.85rem; box-shadow: none;">
                @if(request('search') || request('status'))
                    <a href="{{ route('customer.orders') }}" class="position-absolute text-muted" style="right: 16px; top: 50%; transform: translateY(-50%); text-decoration: none; font-size: 0.9rem;" title="Clear Filters"><i class="fas fa-times-circle hover-lift"></i></a>
                @endif
                <button type="submit" class="d-none"></button>
            </div>
            
            <!-- Status Filter -->
            <div class="position-relative shadow-sm rounded-pill bg-white border" style="width: 180px;">
                <select name="status" class="form-select border-0 bg-transparent rounded-pill fw-medium text-dark" style="padding: 10px 36px 10px 16px; font-size: 0.85rem; box-shadow: none; cursor: pointer;" onchange="this.form.submit()">
                    <option value="">All Statuses</option>
                    <option value="Packed" {{ request('status') == 'Packed' ? 'selected' : '' }}>📦 Packed</option>
                    <option value="Shipped" {{ request('status') == 'Shipped' ? 'selected' : '' }}>🚢 Shipped</option>
                    <option value="Out for Delivery" {{ request('status') == 'Out for Delivery' ? 'selected' : '' }}>🚚 Out for Delivery</option>
                    <option value="Delivered" {{ request('status') == 'Delivered' ? 'selected' : '' }}>✅ Delivered</option>
                </select>
            </div>
        </form>
    </div>

    @if($orders->isEmpty())
        <div class="card p-5 text-center border-0 shadow-sm">
            <h5 class="fw-bold">No active orders</h5>
            <p class="text-muted small">When you place an order, its tracking details will appear here.</p>
        </div>
    @else
        <div class="row g-4">
            @foreach($orders as $order)
                @php
                    $badgeClass = match($order->status) {
                        'Delivered' => 'badge-delivered',
                        'Packed' => 'badge-packed',
                        'Shipped' => 'badge-shipped',
                        'Out for Delivery' => 'badge-out',
                        default => 'badge-packed'
                    };
                    
                    // Fallback images
                    $defaultImage = 'https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?w=500&q=80';
                    $nameLower = strtolower($order->product_name);
                    if(str_contains($nameLower, 'tv')) $defaultImage = 'https://images.unsplash.com/photo-1593359677879-a4bb92f829d1?w=500&q=80';
                    if(str_contains($nameLower, 'macbook')) $defaultImage = 'https://images.unsplash.com/photo-1517336714731-489689fd1ca8?w=500&q=80';
                    if(str_contains($nameLower, 'iphone')) $defaultImage = 'https://images.unsplash.com/photo-1592750475338-74b7b21085ab?w=500&q=80';
                    if(str_contains($nameLower, 'airpods')) $defaultImage = 'https://images.unsplash.com/photo-1600294037681-c80b4cb5b434?w=500&q=80';
                    
                    $imgUrl = $order->image_url ?: $defaultImage;
                    
                    // Progress tracker mapping
                    $steps = ['Order Placed', 'Packed', 'Shipped', 'Out for Delivery', 'Delivered'];
                    $currentIndex = array_search($order->status, $steps);
                    if($currentIndex === false) $currentIndex = 0;
                @endphp
                
                <div class="col-md-6 col-lg-3 order-card-wrapper">
                    <a href="{{ route('customer.tracking', $order) }}" class="text-decoration-none">
                        <div class="card h-100 border-0 shadow-sm p-4 position-relative">
                            <!-- Status Badge Float -->
                            <div class="position-absolute" style="top: 1rem; right: 1rem; z-index: 2;">
                                <span class="badge {{ $badgeClass }} rounded-pill px-2 py-1">{{ $order->status }}</span>
                            </div>
                            
                            <!-- Image Area -->
                            <div class="mb-4 d-flex justify-content-center align-items-center" style="height: 120px;">
                                <img src="{{ $imgUrl }}" alt="Product" class="img-fluid" style="max-height: 100%; object-fit: contain;">
                            </div>
                            
                            <!-- Content -->
                            <h5 class="fw-bold text-dark mb-4">{{ $order->product_name }}</h5>
                            
                            <div class="d-flex justify-content-between mb-4">
                                <div>
                                    <div class="text-muted" style="font-size: 0.65rem;">Order ID</div>
                                    <div class="text-dark fw-bold font-monospace" style="font-size: 0.8rem;">#{{ substr($order->id, -8) }}</div>
                                </div>
                                <div>
                                    <div class="text-muted" style="font-size: 0.65rem;">Est. Arrival</div>
                                    <div class="text-dark fw-bold" style="font-size: 0.8rem;">{{ $order->estimated_delivery->format('M d, Y') }}</div>
                                </div>
                            </div>
                            
                            <!-- Horizontal Tracker -->
                            <div class="mt-auto">
                                <div class="position-relative d-flex justify-content-between align-items-center w-100">
                                    <!-- Track line -->
                                    <div class="position-absolute" style="top: 50%; left: 10px; right: 10px; height: 2px; background: #e5e7eb; z-index: 1; transform: translateY(-50%);"></div>
                                    
                                    <!-- Active Track line -->
                                    @php $percent = ($currentIndex / 4) * 100; @endphp
                                    <div class="position-absolute" style="top: 50%; left: 10px; width: calc({{ $percent }}% - 10px); height: 2px; background: #111827; z-index: 2; transform: translateY(-50%); transition: width 0.5s;"></div>
                                    
                                    <!-- Dots -->
                                    @foreach($steps as $index => $step)
                                        <div class="position-relative z-3 d-flex flex-column align-items-center" style="width: 20px;">
                                            <div class="rounded-circle {{ $index <= $currentIndex ? 'bg-dark' : 'bg-white border' }}" style="width: 12px; height: 12px; border-color: #e5e7eb !important;"></div>
                                            <div class="position-absolute text-center mt-2" style="font-size: 0.5rem; width: 50px; left: -15px; color: {{ $index <= $currentIndex ? '#111827' : '#9ca3af' }}; fw-bold">{{ explode(' ', $step)[0] }}</div>
                                        </div>
                                    @endforeach
                                </div>
                                <div style="height: 15px;"></div> <!-- Spacer for labels -->
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    @endif

    <!-- Become a Driver Section -->
    @if(auth()->user()->role === 'agent')
        <!-- User is already an active driver, show nothing here or a subtle link to their tasks -->
    @elseif(auth()->user()->requested_role === 'agent')
        <div class="alert alert-success border-0 shadow-sm mt-5 rounded-4 d-flex align-items-center gap-3 p-4">
            <div class="bg-white rounded-circle d-flex align-items-center justify-content-center text-success flex-shrink-0" style="width: 40px; height: 40px;">
                <i class="fas fa-check"></i>
            </div>
            <div>
                <h6 class="fw-bold mb-1">Application Submitted</h6>
                <p class="mb-0 small opacity-75">Your request to become a driver is currently under review by our admin team.</p>
            </div>
        </div>
    @else
        <div class="card border-0 shadow-sm mt-5 overflow-hidden" style="border-radius: 1rem; background-color: #111827; color: #ffffff;">
            <div class="card-body p-4 p-md-5 d-flex flex-column flex-md-row align-items-center justify-content-between gap-4">
                <div>
                    <h4 class="fw-bold mb-2">Want to drive for us?</h4>
                    <p class="text-white-50 mb-0">Join our network of delivery professionals and earn on your own schedule.</p>
                </div>
                <form action="{{ route('customer.request_agent') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-light px-4 py-3 fw-bold rounded-pill text-dark hover-lift shadow-sm text-nowrap">
                        Apply Now <i class="fas fa-arrow-right ms-1"></i>
                    </button>
                </form>
            </div>
        </div>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('customerRealtimeSearch');
        const cards = document.querySelectorAll('.order-card-wrapper');
        
        if (searchInput) {
            searchInput.addEventListener('input', function(e) {
                const term = e.target.value.toLowerCase();
                
                cards.forEach(card => {
                    const text = card.innerText.toLowerCase();
                    if(text.includes(term)) {
                        card.style.display = '';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        }
    });
</script>
@endsection
