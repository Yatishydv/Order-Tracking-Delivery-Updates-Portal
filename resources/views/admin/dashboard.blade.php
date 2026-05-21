@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 px-xl-5 py-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold text-dark mb-1">Welcome back, Admin 👋</h1>
            <p class="text-muted small mb-0">Here's what's happening with your logistics network today.</p>
        </div>
        <div>
            <div class="btn btn-white border px-3 py-2 bg-white text-dark shadow-sm d-flex align-items-center gap-2" style="border-radius: 0.5rem; font-size: 0.875rem;">
                <span class="fw-medium">{{ date('M d, Y') }}</span>
                <i class="far fa-calendar text-muted"></i>
            </div>
        </div>
    </div>

    <!-- Alerts -->
    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-3">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        </div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger border-0 shadow-sm rounded-3">
            <div class="d-flex align-items-center mb-2">
                <i class="fas fa-exclamation-circle me-2"></i><strong>Failed to create shipment:</strong>
            </div>
            <ul class="mb-0 small">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Stats Row -->
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card p-4 h-100 border-0 shadow-sm">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="text-muted small fw-medium">Total Shipments</div>
                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                        <i class="fas fa-box" style="font-size: 0.8rem;"></i>
                    </div>
                </div>
                <div class="h2 fw-bold text-dark mb-2">{{ number_format($stats['total']) }}</div>
                <div class="small fw-medium {{ $stats['total_growth'] >= 0 ? 'text-success' : 'text-danger' }}">
                    <i class="fas {{ $stats['total_growth'] >= 0 ? 'fa-arrow-up' : 'fa-arrow-down' }} me-1"></i>{{ abs($stats['total_growth']) }}% <span class="text-muted fw-normal">from last week</span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-4 h-100 border-0 shadow-sm">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="text-muted small fw-medium">Delivered</div>
                    <div class="bg-success bg-opacity-10 text-success rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                        <i class="fas fa-check-circle" style="font-size: 0.8rem;"></i>
                    </div>
                </div>
                <div class="h2 fw-bold text-dark mb-2">{{ number_format($stats['delivered']) }}</div>
                <div class="small fw-medium {{ $stats['delivered_growth'] >= 0 ? 'text-success' : 'text-danger' }}">
                    <i class="fas {{ $stats['delivered_growth'] >= 0 ? 'fa-arrow-up' : 'fa-arrow-down' }} me-1"></i>{{ abs($stats['delivered_growth']) }}% <span class="text-muted fw-normal">from last week</span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-4 h-100 border-0 shadow-sm">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="text-muted small fw-medium">Pending</div>
                    <div class="bg-warning bg-opacity-10 text-warning rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                        <i class="far fa-clock" style="font-size: 0.8rem;"></i>
                    </div>
                </div>
                <div class="h2 fw-bold text-dark mb-2">{{ number_format($stats['pending']) }}</div>
                <div class="small fw-medium {{ $stats['pending_growth'] >= 0 ? 'text-success' : 'text-danger' }}">
                    <i class="fas {{ $stats['pending_growth'] >= 0 ? 'fa-arrow-up' : 'fa-arrow-down' }} me-1"></i>{{ abs($stats['pending_growth']) }}% <span class="text-muted fw-normal">from last week</span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-4 h-100 border-0 shadow-sm">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="text-muted small fw-medium">Active Routes</div>
                    <div class="bg-purple bg-opacity-10 text-purple rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; color: #7e22ce; background: #f3e8ff;">
                        <i class="fas fa-route" style="font-size: 0.8rem;"></i>
                    </div>
                </div>
                <div class="h2 fw-bold text-dark mb-2">{{ number_format($stats['active']) }}</div>
                <div class="small fw-medium {{ $stats['active_growth'] >= 0 ? 'text-success' : 'text-danger' }}">
                    <i class="fas {{ $stats['active_growth'] >= 0 ? 'fa-arrow-up' : 'fa-arrow-down' }} me-1"></i>{{ abs($stats['active_growth']) }}% <span class="text-muted fw-normal">from last week</span>
                </div>
            </div>
        </div>
    </div>

    <!-- ROW 1: Pending Approvals & Active Shipments -->
    <div class="row g-4 mb-4">
        
        <!-- Pending Approvals -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm h-100 d-flex flex-column">
                <div class="card-header bg-white border-bottom-0 pb-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                    <h6 class="fw-bold mb-0 text-dark">Pending Driver Approvals</h6>
                    @if(isset($pendingAgents) && $pendingAgents->count() > 0)
                        <span class="badge badge-pending rounded-pill px-2 py-1" style="font-size: 0.65rem;">{{ $pendingAgents->count() }} Pending</span>
                    @endif
                </div>
                <div class="card-body p-4 pt-3 flex-grow-1" style="max-height: 350px; overflow-y: auto;">
                    @if(isset($pendingAgents) && $pendingAgents->count() > 0)
                        <div class="d-flex flex-column gap-4">
                            @foreach($pendingAgents as $applicant)
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center gap-3">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($applicant->name) }}&background=f3f4f6&color=374151" alt="Avatar" class="rounded-circle" width="40" height="40">
                                    <div>
                                        <div class="fw-bold text-dark" style="font-size: 0.85rem;">{{ $applicant->name }}</div>
                                        <div class="text-muted" style="font-size: 0.75rem;">{{ $applicant->email }}</div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="text-muted d-none d-sm-block" style="font-size: 0.75rem;"><i class="fas fa-phone-alt me-1 text-light"></i>(555) 123-4567</div>
                                    <form action="{{ route('admin.approve_agent', $applicant) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-dark btn-sm rounded-pill px-3" style="font-size: 0.75rem;">Approve</button>
                                    </form>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted small">No pending approvals.</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Active Shipments -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm h-100 d-flex flex-column">
                <div class="card-header bg-white border-bottom-0 pb-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                    <h6 class="fw-bold mb-0 text-dark">Active Shipments</h6>
                    <div class="d-flex align-items-center gap-3">
                        <a href="#" class="text-muted text-decoration-none small fw-medium" data-bs-toggle="modal" data-bs-target="#createOrderModal">Create shipment <i class="fas fa-plus ms-1" style="font-size: 0.7rem;"></i></a>
                        <a href="{{ route('admin.shipments') }}" class="text-muted text-decoration-none small fw-medium">View all shipments <i class="fas fa-arrow-right ms-1" style="font-size: 0.7rem;"></i></a>
                    </div>
                </div>
                <div class="card-body p-0 mt-3 flex-grow-1" style="max-height: 350px; overflow-y: auto;">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0" style="font-size: 0.8rem;">
                            <thead class="bg-transparent" style="position: sticky; top: 0; background: white; z-index: 10;">
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
                                @foreach($orders as $order)
                                <tr>
                                    <td class="fw-medium text-dark font-monospace" style="padding-left: 1.5rem;">#{{ substr($order->id, -8) }}</td>
                                    <td class="text-dark">{{ $order->customer->name }}</td>
                                    <td class="text-muted">{{ Str::limit($order->product_name, 15) }}</td>
                                    <td class="text-muted">{{ Str::limit($order->address, 25) }}</td>
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
                                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($order->agent->name) }}&background=e5e7eb&color=374151" alt="Avatar" class="rounded-circle" width="24" height="24">
                                                    <span class="text-dark">{{ explode(' ', $order->agent->name)[0] }}</span>
                                                </div>
                                            @else
                                                <button class="btn btn-light border btn-sm py-0 px-2 rounded-pill text-muted hover-lift" data-bs-toggle="modal" data-bs-target="#assignModal{{ $order->id }}" style="font-size: 0.7rem;">
                                                    Assign
                                                </button>
                                            @endif
                                            
                                            <!-- Delete Button -->
                                            <form action="{{ route('admin.orders.destroy', $order) }}" method="POST" class="ms-auto">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link text-danger p-0 ms-2 hover-lift" onclick="return confirm('Are you sure you want to delete this shipment?');" title="Delete Shipment">
                                                    <i class="fas fa-trash-alt" style="font-size: 0.85rem;"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ROW 2: Active Drivers & Support Messages -->
    <div class="row g-4 mb-5 pb-4">
        
        <!-- Active Drivers (History) -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm h-100 d-flex flex-column" id="drivers">
                <div class="card-header bg-white border-bottom-0 pb-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                    <h6 class="fw-bold mb-0 text-dark">Active Drivers</h6>
                    <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-2 py-1" style="font-size: 0.65rem;">{{ $agents->count() }} Active</span>
                </div>
                <div class="card-body p-4 pt-3 flex-grow-1" style="max-height: 300px; overflow-y: auto;">
                    @if(isset($agents) && $agents->count() > 0)
                        <div class="d-flex flex-column gap-4">
                            @foreach($agents as $agent)
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center gap-3">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($agent->name) }}&background=e5e7eb&color=374151" alt="Avatar" class="rounded-circle" width="40" height="40">
                                    <div>
                                        <div class="fw-bold text-dark" style="font-size: 0.85rem;">{{ $agent->name }}</div>
                                        <div class="text-muted" style="font-size: 0.75rem;"><i class="fas fa-check-circle text-success me-1"></i>Approved</div>
                                    </div>
                                </div>
                                <div>
                                    <form action="{{ route('admin.revoke_agent', $agent) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3 py-1 fw-bold" style="font-size: 0.7rem;" onclick="return confirm('Are you sure you want to revoke this driver?');">Revoke</button>
                                    </form>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted small">No active drivers yet.</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Support Messages -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm h-100 d-flex flex-column">
                <div class="card-header bg-white border-bottom-0 pb-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                    <h6 class="fw-bold mb-0 text-dark">Recent Support Messages</h6>
                </div>
                <div class="card-body p-4 pt-3 flex-grow-1" style="max-height: 300px; overflow-y: auto;">
                    @forelse($contactMessages as $msg)
                        <div class="d-flex align-items-start gap-3 mb-3 {{ !$loop->last ? 'pb-3 border-bottom' : '' }}">
                            <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center flex-shrink-0 mt-1" style="width: 35px; height: 35px;">
                                <i class="fas fa-envelope" style="font-size: 0.85rem;"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <div class="fw-bold text-dark small">{{ $msg->name }}</div>
                                    <div class="text-muted" style="font-size: 0.7rem;">{{ $msg->created_at->diffForHumans() }}</div>
                                </div>
                                <div class="text-muted small mb-1">{{ $msg->email }}</div>
                                <p class="text-muted small mb-0" style="line-height: 1.4;">{{ Str::limit($msg->message, 80) }}</p>
                            </div>
                            <div class="ms-auto flex-shrink-0 align-self-center ps-2">
                                <form action="{{ route('admin.messages.resolve', $msg) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-success btn-sm rounded-pill px-2 py-1" style="font-size: 0.75rem;" title="Mark as resolved" onclick="return confirm('Mark this message as resolved?');">
                                        <i class="fas fa-check"></i> Resolve
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-4">
                            <div class="text-muted small">No recent messages.</div>
                        </div>
                    @endforelse
                </div>
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

<!-- Create Modal -->
<div class="modal fade" id="createOrderModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="modal-header bg-light border-0 pb-0 pt-4 px-4">
                <h5 class="modal-title fw-bold text-dark">Create Shipment</h5>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.orders.store') }}" method="POST">
                @csrf
                <div class="modal-body px-4 pt-3 pb-4">
                    @if ($errors->any())
                        <div class="alert alert-danger small py-2">
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark mb-1">Customer</label>
                        @php $customers = \App\Models\User::where('role', 'customer')->get(); @endphp
                        <select name="customer_id" class="form-select border-0 bg-light py-2 shadow-sm" required style="border-radius: 0.5rem;">
                            <option value="">Select Customer...</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark mb-1">Product Name</label>
                        <input type="text" name="product_name" class="form-control border-0 bg-light py-2 shadow-sm" style="border-radius: 0.5rem;" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark mb-1">Image URL (Optional)</label>
                        <input type="text" name="image_url" class="form-control border-0 bg-light py-2 shadow-sm" placeholder="https://..." style="border-radius: 0.5rem;">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark mb-1">Destination Address</label>
                        <textarea name="address" class="form-control border-0 bg-light py-2 shadow-sm" rows="2" style="border-radius: 0.5rem;" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark mb-1">Estimated Delivery</label>
                        <input type="datetime-local" name="estimated_delivery" class="form-control border-0 bg-light py-2 shadow-sm" style="border-radius: 0.5rem;" required>
                    </div>
                </div>
                <div class="modal-footer border-0 px-4 pb-4 pt-0">
                    <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-dark px-4">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        @if($errors->any())
            // Automatically re-open the create modal if validation fails
            var createModal = new bootstrap.Modal(document.getElementById('createOrderModal'));
            createModal.show();
        @endif
    });
</script>
@endsection
