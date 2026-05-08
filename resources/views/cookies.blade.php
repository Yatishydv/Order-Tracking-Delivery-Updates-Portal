@extends('layouts.app')

@section('content')
<div class="py-5 bg-white">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <h6 class="text-primary fw-bold text-uppercase mb-3">Transparency Policy</h6>
                <h1 class="display-5 fw-bold mb-5">Cookie Intelligence Settings</h1>
                
                <div class="card p-5 border-0 shadow-lg mb-5">
                    <p class="lead text-muted mb-5">DeliKart uses cookies to optimize your logistics experience and maintain secure manifest sessions.</p>

                    <h4 class="fw-bold mb-4">1. Essential Cookies</h4>
                    <p class="text-muted mb-4">Required for authenticated access to the Admin, Agent, and Customer dashboards. These cannot be disabled as they ensure the security of your manifests.</p>

                    <h4 class="fw-bold mb-4">2. Intelligence Cookies</h4>
                    <p class="text-muted mb-4">Used to store your tracking preferences and dashboard layout settings, ensuring a personalized experience across the global network.</p>

                    <h4 class="fw-bold mb-4">3. Performance Cookies</h4>
                    <p class="text-muted mb-4">Analyze platform usage to optimize our real-time tracking feed and reduce data latency for our mobile operatives.</p>

                    <div class="mt-5 p-4 bg-light rounded-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h6 class="fw-bold mb-0">Accept All Intelligence Cookies</h6>
                                <p class="small text-muted mb-0">Recommended for the best tracking experience.</p>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" checked disabled>
                            </div>
                        </div>
                    </div>

                    <div class="mt-5 pt-4 border-top">
                        <p class="small text-muted mb-0">Updated: April 27, 2026</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
