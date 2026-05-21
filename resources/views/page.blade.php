@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 px-xl-5 py-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 text-center mt-5 mb-5">
            <h1 class="display-4 fw-bold text-dark mb-4">{{ $title }}</h1>
            <p class="lead text-muted mb-5">{{ $content }}</p>
            
            <div class="card border-0 shadow-sm p-5 text-center mt-4">
                <div class="mb-4 text-muted">
                    <i class="fas fa-hammer fa-3x" style="opacity: 0.2;"></i>
                </div>
                <h3 class="fw-bold text-dark mb-3">Under Construction</h3>
                <p class="text-muted mx-auto mb-0" style="max-width: 500px;">
                    This section of the platform is currently being updated. We are bringing you new features and updated content very soon!
                </p>
            </div>
            
            <a href="{{ url('/') }}" class="btn btn-dark rounded-pill px-4 py-2 mt-5 fw-bold shadow-sm">
                <i class="fas fa-arrow-left me-2"></i>Return Home
            </a>
        </div>
    </div>
</div>
@endsection
