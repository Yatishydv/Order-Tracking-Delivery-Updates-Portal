@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 px-xl-5 py-4 pb-5 mb-5">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold text-dark mb-1">All Shipments</h1>
            <p class="text-muted small mb-0">View and manage all shipments in the network.</p>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-dark btn-sm rounded-pill px-3 fw-bold">
            <i class="fas fa-arrow-left me-2"></i>Back to Dashboard
        </a>
    </div>

    <!-- Alerts -->
    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-3">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        </div>
    @endif
    
    <!-- Filters and Search -->
    <div class="d-flex justify-content-end mb-4">
        <form action="{{ route('admin.shipments') }}" method="GET" class="d-flex flex-column flex-sm-row gap-3 align-items-center mb-0">
            <!-- Search Bar -->
            <div class="position-relative shadow-sm rounded-pill bg-white border" style="width: 280px; transition: all 0.2s ease;">
                <i class="fas fa-search position-absolute text-muted" style="left: 16px; top: 50%; transform: translateY(-50%); font-size: 0.85rem;"></i>
                <input type="text" name="search" id="realtimeSearch" class="form-control border-0 bg-transparent rounded-pill" placeholder="Search product, customer, or ID..." value="{{ request('search') }}" style="padding: 10px 36px 10px 40px; font-size: 0.85rem; box-shadow: none;">
                @if(request('search') || request('status'))
                    <a href="{{ route('admin.shipments') }}" class="position-absolute text-muted" style="right: 16px; top: 50%; transform: translateY(-50%); text-decoration: none; font-size: 0.9rem;" title="Clear Filters"><i class="fas fa-times-circle hover-lift"></i></a>
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
    
    <!-- All Shipments Table -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-bottom-0 pb-0 pt-4 px-4 d-flex justify-content-between align-items-center">
            <h6 class="fw-bold mb-0 text-dark">Shipment Directory</h6>
        </div>
        <div class="card-body p-0 mt-3">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" style="font-size: 0.85rem;">
                    <thead class="bg-transparent">
                        <tr>
                            <th class="border-top-0 border-bottom-0 text-muted fw-bold" style="padding-left: 1.5rem;">ORDER ID</th>
                            <th class="border-top-0 border-bottom-0 text-muted fw-bold">CUSTOMER</th>
                            <th class="border-top-0 border-bottom-0 text-muted fw-bold">PRODUCT</th>
                            <th class="border-top-0 border-bottom-0 text-muted fw-bold">DESTINATION</th>
                            <th class="border-top-0 border-bottom-0 text-muted fw-bold">STATUS</th>
                            <th class="border-top-0 border-bottom-0 text-muted fw-bold">DRIVER</th>
                        </tr>
                    </thead>
                    <tbody class="border-top-0">
                        @forelse($orders as $order)
                        <tr>
                            <td class="fw-medium text-dark font-monospace" style="padding-left: 1.5rem;">#{{ substr($order->id, -8) }}</td>
                            <td class="text-dark fw-medium">{{ $order->customer->name }}</td>
                            <td class="text-muted">{{ Str::limit($order->product_name, 20) }}</td>
                            <td class="text-muted">{{ Str::limit($order->address, 30) }}</td>
                            <td>
                                @php
                                    $badgeClass = match($order->status) {
                                        'Delivered' => 'badge-delivered',
                                        'Packed' => 'badge-packed',
                                        'Shipped' => 'badge-shipped',
                                        'Out for Delivery' => 'badge-out',
                                        default => 'badge-packed'
                                    };
                                @endphp
                                <span class="badge {{ $badgeClass }} rounded-pill px-2 fw-medium">{{ $order->status }}</span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    @if($order->agent)
                                        <div class="d-flex align-items-center gap-2">
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($order->agent->name) }}&background=e5e7eb&color=374151" alt="Avatar" class="rounded-circle" width="28" height="28">
                                            <span class="text-dark">{{ explode(' ', $order->agent->name)[0] }}</span>
                                        </div>
                                    @else
                                        <button class="btn btn-light border btn-sm py-1 px-3 rounded-pill text-muted hover-lift fw-bold" data-bs-toggle="modal" data-bs-target="#assignModal{{ $order->id }}" style="font-size: 0.75rem;">
                                            Assign
                                        </button>
                                    @endif
                                    
                                    <form action="{{ route('admin.orders.destroy', $order) }}" method="POST" class="ms-auto">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link text-danger p-0 ms-2 hover-lift" onclick="return confirm('Are you sure you want to delete this shipment?');" title="Delete Shipment">
                                            <i class="fas fa-trash-alt" style="font-size: 0.9rem;"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                No shipments found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="p-4 border-top">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</div>

@foreach($orders as $order)
<!-- Assign Modal -->
<div class="modal fade" id="assignModal{{ $order->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="modal-header bg-light border-0 pb-0 pt-4 px-4">
                <h5 class="modal-title fw-bold text-dark">Assign Driver</h5>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.orders.assign', $order) }}" method="POST">
                @csrf
                <div class="modal-body px-4 pt-3 pb-4">
                    <p class="text-muted small mb-3">Assign a driver for order <strong>#{{ substr($order->id, -8) }}</strong>.</p>
                    <select name="agent_id" class="form-select border-0 bg-light py-2 px-3 shadow-sm" required style="border-radius: 0.5rem;">
                        <option value="">Select driver...</option>
                        @foreach($agents as $agent)
                            <option value="{{ $agent->id }}">{{ $agent->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer border-0 px-4 pb-4 pt-0">
                    <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-dark px-4">Assign</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('realtimeSearch');
        const rows = document.querySelectorAll('tbody.border-top-0 tr');
        
        if (searchInput) {
            searchInput.addEventListener('input', function(e) {
                const term = e.target.value.toLowerCase();
                
                rows.forEach(row => {
                    // Don't hide the "No shipments found" row if it's there
                    const cell = row.querySelector('td');
                    if(cell && cell.getAttribute('colspan') === '6') return;
                    
                    const text = row.innerText.toLowerCase();
                    if(text.includes(term)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        }
    });
</script>
@endsection
