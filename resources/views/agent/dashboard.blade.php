@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold mb-0">Field Manifests</h2>
    <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 fw-bold">{{ $orders->count() }} Active Tasks</span>
</div>

@if($orders->isEmpty())
    <div class="card border-0 shadow-sm text-center py-5">
        <div class="card-body">
            <i class="fas fa-check-circle text-success fs-1 mb-3"></i>
            <h5 class="fw-bold">All Tasks Completed</h5>
            <p class="text-muted">You have no active manifests at the moment.</p>
        </div>
    </div>
@else
    <div class="row g-4">
        @foreach($orders as $order)
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
                        <span class="fw-bold text-primary">#{{ $order->id }}</span>
                        <span class="badge bg-light text-dark border px-2 py-1 small">{{ $order->status }}</span>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="text-muted small fw-bold d-block">Consignee</label>
                            <span class="fw-bold">{{ $order->customer->name }}</span>
                        </div>
                        <div class="mb-4">
                            <label class="text-muted small fw-bold d-block">Destination</label>
                            <span class="small fw-bold">{{ $order->address }}</span>
                        </div>
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary btn-sm py-2" data-bs-toggle="modal" data-bs-target="#updateStatusModal{{ $order->id }}">
                                Update Status
                            </button>
                            <a href="{{ route('customer.tracking', $order) }}" class="btn btn-outline-secondary btn-sm py-2">
                                Preview Tracking
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Update Status Modal -->
            <div class="modal fade" id="updateStatusModal{{ $order->id }}" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 shadow">
                        <div class="modal-header border-bottom-0">
                            <h5 class="modal-title fw-bold">Update Manifest #{{ $order->id }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <form action="{{ route('agent.orders.update', $order) }}" method="POST">
                            @csrf
                            <div class="modal-body p-4">
                                <div class="mb-4">
                                    <label class="form-label small fw-bold mb-2">New Intelligence Status</label>
                                    <select name="status" class="form-select bg-light border-0 py-3" required>
                                        <option value="Packed" {{ $order->status == 'Packed' ? 'selected' : '' }}>Packed</option>
                                        <option value="Shipped" {{ $order->status == 'Shipped' ? 'selected' : '' }}>Shipped</option>
                                        <option value="Out for Delivery" {{ $order->status == 'Out for Delivery' ? 'selected' : '' }}>Out for Delivery</option>
                                        <option value="Delivered" {{ $order->status == 'Delivered' ? 'selected' : '' }}>Delivered</option>
                                    </select>
                                </div>
                                <div class="mb-0">
                                    <label class="form-label small fw-bold mb-2">Internal Note / Customer Message</label>
                                    <textarea name="message" class="form-control bg-light border-0 py-3" rows="3" placeholder="Describe the current update..."></textarea>
                                </div>
                            </div>
                            <div class="modal-footer border-top-0">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary px-4">Save Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
@endsection
