@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 px-xl-5 py-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold text-dark mb-1">My Active Tasks</h1>
            <p class="text-muted small mb-0">You have {{ $orders->count() }} deliveries assigned to you today.</p>
        </div>
        <div>
            <div class="btn btn-white border px-3 py-2 bg-white text-dark shadow-sm d-flex align-items-center gap-2" style="border-radius: 0.5rem; font-size: 0.875rem;">
                <span class="text-muted">Sort by:</span> <span class="fw-bold">Nearest</span>
                <i class="fas fa-chevron-down text-muted ms-1" style="font-size: 0.7rem;"></i>
            </div>
        </div>
    </div>

    @if($orders->isEmpty())
        <div class="card p-5 text-center border-0 shadow-sm mt-5">
            <h5 class="fw-bold">No active tasks</h5>
            <p class="text-muted small">You're all caught up for now.</p>
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
                    
                    // Fallback images if no DB image
                    $defaultImage = 'https://images.unsplash.com/photo-1606220838315-056192d5e927?w=500&q=80'; // generic box
                    $nameLower = strtolower($order->product_name);
                    if(str_contains($nameLower, 'tv')) $defaultImage = 'https://images.unsplash.com/photo-1593359677879-a4bb92f829d1?w=500&q=80';
                    if(str_contains($nameLower, 'macbook')) $defaultImage = 'https://images.unsplash.com/photo-1517336714731-489689fd1ca8?w=500&q=80';
                    if(str_contains($nameLower, 'iphone')) $defaultImage = 'https://images.unsplash.com/photo-1592750475338-74b7b21085ab?w=500&q=80';
                    if(str_contains($nameLower, 'airpods')) $defaultImage = 'https://images.unsplash.com/photo-1600294037681-c80b4cb5b434?w=500&q=80';
                    
                    $imgUrl = $order->image_url ?: $defaultImage;
                @endphp
                
                <div class="col-md-6">
                    <div class="card p-4 h-100 border-0 shadow-sm">
                        <!-- Top Row -->
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div>
                                <div class="text-muted small" style="font-size: 0.7rem;">Order ID</div>
                                <div class="fw-bold text-dark font-monospace" style="font-size: 0.85rem;">#{{ substr($order->id, -8) }}</div>
                            </div>
                            <span class="badge {{ $badgeClass }} rounded-pill px-3 py-1">{{ $order->status }}</span>
                        </div>
                        
                        <!-- Product Info & Image -->
                        <div class="d-flex justify-content-between align-items-start mb-4">
                            <h3 class="fw-bold text-dark mb-0">{{ Str::limit($order->product_name, 25) }}</h3>
                            <div class="rounded-3 overflow-hidden bg-light border ms-3 flex-shrink-0" style="width: 80px; height: 60px;">
                                <img src="{{ $imgUrl }}" alt="Product" style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                        </div>
                        
                        <!-- Customer & Dest -->
                        <div class="mb-3">
                            <div class="text-muted small" style="font-size: 0.7rem;">Customer</div>
                            <div class="text-dark fw-medium" style="font-size: 0.85rem;">{{ $order->customer->name }}</div>
                        </div>
                        <div class="mb-4">
                            <div class="text-muted small" style="font-size: 0.7rem;">Destination</div>
                            <div class="text-dark fw-medium" style="font-size: 0.85rem;">{{ $order->address }}</div>
                        </div>
                        
                        <!-- Action Button -->
                        <div class="mt-auto pt-2">
                            <div class="d-flex gap-2">
                                <button class="btn btn-dark w-100 fw-bold py-2" data-bs-toggle="modal" data-bs-target="#updateStatusModal{{ $order->id }}" style="border-radius: 0.5rem;">
                                    Update Status
                                </button>
                                <a href="{{ route('customer.tracking', $order) }}" class="btn btn-outline-light border text-dark px-3 py-2" style="border-radius: 0.5rem;" title="View Map">
                                    <i class="fas fa-chevron-down"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Update Status Modal -->
                <div class="modal fade" id="updateStatusModal{{ $order->id }}" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
                            <div class="modal-header bg-light border-0 pb-0 pt-4 px-4">
                                <h5 class="modal-title fw-bold text-dark">Update Status</h5>
                                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"></button>
                            </div>
                            <form action="{{ route('agent.orders.update', $order) }}" method="POST">
                                @csrf
                                <div class="modal-body px-4 pt-3 pb-4">
                                    <div class="mb-3">
                                        <label class="form-label small fw-bold text-dark mb-1">Status</label>
                                        <select name="status" class="form-select border-0 bg-light py-2 shadow-sm" style="border-radius: 0.5rem;" required>
                                            <option value="Packed" {{ $order->status == 'Packed' ? 'selected' : '' }}>Packed</option>
                                            <option value="Shipped" {{ $order->status == 'Shipped' ? 'selected' : '' }}>Shipped</option>
                                            <option value="Out for Delivery" {{ $order->status == 'Out for Delivery' ? 'selected' : '' }}>Out for Delivery</option>
                                            <option value="Delivered" {{ $order->status == 'Delivered' ? 'selected' : '' }}>Delivered</option>
                                        </select>
                                    </div>
                                    <div class="mb-0">
                                        <label class="form-label small fw-bold text-dark mb-1">Log Note (Optional)</label>
                                        <textarea name="message" class="form-control border-0 bg-light py-2 shadow-sm" rows="2" style="border-radius: 0.5rem;"></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer border-0 px-4 pb-4 pt-0">
                                    <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-dark px-4">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
