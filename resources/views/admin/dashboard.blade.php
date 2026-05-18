@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-5" data-aos="fade-down">
    <div>
        <h2 class="fw-bold mb-1">Operations Control</h2>
        <p class="text-muted mb-0">Manage global manifests and field personnel.</p>
    </div>
    <button class="btn btn-primary px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#createOrderModal">
        <i class="fas fa-plus me-2"></i> Create New Manifest
    </button>
</div>

<div class="row g-4 mb-5">
    <div class="col-md-3" data-aos="zoom-in" data-aos-delay="100">
        <div class="card p-4 border-0">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div class="bg-primary bg-opacity-10 p-3 rounded-4">
                    <i class="fas fa-boxes-stacked text-primary fs-4"></i>
                </div>
                <span class="badge bg-light text-dark fw-bold">TOTAL</span>
            </div>
            <h6 class="text-muted small fw-bold">Consignments</h6>
            <h3 class="fw-bold mb-0">{{ $stats['total'] }}</h3>
        </div>
    </div>
    <div class="col-md-3" data-aos="zoom-in" data-aos-delay="200">
        <div class="card p-4 border-0">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div class="bg-success bg-opacity-10 p-3 rounded-4">
                    <i class="fas fa-check-double text-success fs-4"></i>
                </div>
                <span class="badge bg-light text-dark fw-bold">DONE</span>
            </div>
            <h6 class="text-muted small fw-bold">Delivered</h6>
            <h3 class="fw-bold mb-0 text-success">{{ $stats['delivered'] }}</h3>
        </div>
    </div>
    <div class="col-md-3" data-aos="zoom-in" data-aos-delay="300">
        <div class="card p-4 border-0">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div class="bg-warning bg-opacity-10 p-3 rounded-4">
                    <i class="fas fa-clock text-warning fs-4"></i>
                </div>
                <span class="badge bg-light text-dark fw-bold">WAITING</span>
            </div>
            <h6 class="text-muted small fw-bold">In Pipeline</h6>
            <h3 class="fw-bold mb-0 text-warning">{{ $stats['pending'] }}</h3>
        </div>
    </div>
    <div class="col-md-3" data-aos="zoom-in" data-aos-delay="400">
        <div class="card p-4 border-0">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div class="bg-info bg-opacity-10 p-3 rounded-4">
                    <i class="fas fa-truck-fast text-info fs-4"></i>
                </div>
                <span class="badge bg-light text-dark fw-bold">LIVE</span>
            </div>
            <h6 class="text-muted small fw-bold">On Route</h6>
            <h3 class="fw-bold mb-0 text-info">{{ $stats['active'] }}</h3>
        </div>
    </div>
</div>

@if(isset($pendingAgents) && $pendingAgents->count() > 0)
<div class="card border-0 shadow-sm mb-5 border-start border-warning border-4" data-aos="fade-up">
    <div class="card-header bg-white py-3 border-0 d-flex justify-content-between align-items-center">
        <h5 class="fw-bold mb-0 text-warning"><i class="fas fa-users-cog me-2"></i> Pending Agent Requests ({{ $pendingAgents->count() }})</h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="bg-light text-dark small text-uppercase fw-bold">
                    <tr>
                        <th class="px-4 py-3">Applicant Name</th>
                        <th class="py-3">Email Address</th>
                        <th class="py-3">Requested On</th>
                        <th class="text-end px-4 py-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pendingAgents as $applicant)
                    <tr>
                        <td class="px-4 fw-bold">{{ $applicant->name }}</td>
                        <td>{{ $applicant->email }}</td>
                        <td>{{ $applicant->created_at->format('M d, Y') }}</td>
                        <td class="text-end px-4">
                            <form action="{{ route('admin.approve_agent', $applicant) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success fw-bold px-3 rounded-pill">Approve Agent</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif

<div class="card border-0 shadow-lg" data-aos="fade-up">
    <div class="card-header bg-white py-4 px-4 border-0">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h5 class="fw-bold mb-0">Active Manifests</h5>
            </div>
            <div class="col-md-6">
                <form action="{{ route('admin.dashboard') }}" method="GET" class="d-flex gap-2">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-0"><i class="fas fa-search text-muted"></i></span>
                        <input type="text" name="search" class="form-control border-0 bg-light text-dark" placeholder="Search ID or Product..." value="{{ request('search') }}">
                    </div>
                    <button type="submit" class="btn btn-dark px-4">Filter</button>
                </form>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light text-dark small text-uppercase fw-bold">
                <tr>
                    <th class="px-4 py-3">Reference</th>
                    <th class="py-3">Client</th>
                    <th class="py-3">Consignment</th>
                    <th class="py-3">Current Status</th>
                    <th class="py-3">Assigned Operative</th>
                    <th class="text-end px-4 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr class="border-bottom">
                    <td class="px-4 fw-bold text-primary">#{{ $order->id }}</td>
                    <td>
                        <div class="fw-bold">{{ $order->customer->name }}</div>
                        <div class="text-muted smaller" style="font-size: 0.75rem;">{{ $order->customer->email }}</div>
                    </td>
                    <td>
                        <div class="fw-bold small">{{ $order->product_name }}</div>
                        <div class="text-muted smaller" style="font-size: 0.75rem;">{{ Str::limit($order->address, 30) }}</div>
                    </td>
                    <td>
                        @php
                            $badgeClass = match($order->status) {
                                'Delivered' => 'bg-success',
                                'Packed', 'Shipped' => 'bg-info',
                                'Out for Delivery' => 'bg-warning text-dark',
                                default => 'bg-secondary'
                            };
                        @endphp
                        <span class="badge {{ $badgeClass }} px-3 py-2 fw-bold" style="font-size: 0.65rem;">
                            {{ strtoupper($order->status) }}
                        </span>
                    </td>
                    <td>
                        @if($order->agent)
                            <div class="d-flex align-items-center">
                                <div class="bg-primary bg-opacity-10 p-2 rounded-circle me-2"><i class="fas fa-id-badge text-primary"></i></div>
                                <span class="small fw-bold">{{ $order->agent->name }}</span>
                            </div>
                        @else
                            <button class="btn btn-outline-primary btn-sm px-3 rounded-pill fw-bold" data-bs-toggle="modal" data-bs-target="#assignModal{{ $order->id }}">
                                <i class="fas fa-user-plus me-1"></i> DISPATCH
                            </button>
                        @endif
                    </td>
                    <td class="text-end px-4">
                        <form action="{{ route('admin.orders.destroy', $order) }}" method="POST">
                            @csrf @method('DELETE')
                            <button class="btn btn-link text-danger p-0" onclick="return confirm('Archive manifest #{{ $order->id }}?')">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer bg-white py-4 px-4 border-0">
        {{ $orders->links() }}
    </div>
</div>

@foreach($orders as $order)
<!-- Dispatch Modal (Realistic) -->
<div class="modal fade" id="assignModal{{ $order->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg p-3">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold">Dispatch Operative</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.orders.assign', $order) }}" method="POST">
                @csrf
                <div class="modal-body p-4 pt-0">
                    <label class="form-label small fw-bold text-muted mb-2">Select Field Personnel</label>
                    <select name="agent_id" class="form-select border-0 bg-light text-dark py-3" required>
                        <option value="">-- SEARCH PERSONNEL --</option>
                        @foreach($agents as $agent)
                            <option value="{{ $agent->id }}">{{ $agent->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-link text-muted" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary px-4 fw-bold">Confirm Dispatch</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<!-- Create Manifest Modal (Realistic) -->
<div class="modal fade" id="createOrderModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg p-4">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold">Initialize New Manifest</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.orders.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted">Customer Account</label>
                            @php $customers = \App\Models\User::where('role', 'customer')->get(); @endphp
                            <select name="customer_id" class="form-select border-0 bg-light text-dark py-3" required>
                                <option value="">Select Client...</option>
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->name }} ({{ $customer->email }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted">Consignment Name</label>
                            <input type="text" name="product_name" class="form-control border-0 bg-light text-dark py-3" placeholder="e.g. MacBook Pro M3" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label small fw-bold text-muted">Delivery Address</label>
                            <textarea name="address" class="form-control border-0 bg-light text-dark py-3" rows="3" placeholder="Full destination address..." required></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted">Estimated Delivery</label>
                            <input type="datetime-local" name="estimated_delivery" class="form-control border-0 bg-light text-dark py-3" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-4">
                    <button type="button" class="btn btn-link text-muted" data-bs-dismiss="modal">Discard</button>
                    <button type="submit" class="btn btn-primary px-5 fw-bold">Create Manifest</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
