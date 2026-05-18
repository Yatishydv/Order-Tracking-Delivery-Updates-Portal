@extends('layouts.app')

@section('styles')
<style>
    .network-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
    }
    .status-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 1.25rem;
        padding: 2rem;
        transition: 0.3s;
    }
    .status-card:hover { border-color: var(--accent); transform: translateY(-5px); }
    .map-container {
        height: 600px;
        background: #2d2422;
        border-radius: 2rem;
        position: relative;
        overflow: hidden;
        border: 8px solid white;
        box-shadow: 0 30px 60px rgba(0,0,0,0.1);
    }
    .map-overlay-img {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        object-fit: cover;
        opacity: 0.4;
    }
    .map-data-box {
        position: absolute;
        bottom: 30px; left: 30px;
        background: rgba(45, 36, 34, 0.8);
        backdrop-filter: blur(10px);
        padding: 2rem;
        border-radius: 1.5rem;
        color: white;
        width: 350px;
        z-index: 10;
        border: 1px solid rgba(255,255,255,0.1);
    }
</style>
@endsection

@section('content')
<div class="py-5 bg-white">
    <div class="container py-5">
        <div class="row align-items-end mb-5">
            <div class="col-lg-6" data-aos="fade-right">
                <h6 class="text-primary fw-bold text-uppercase tracking-widest mb-3">Live Fleet Intelligence</h6>
                <h1 class="display-4 fw-bold">Network <span class="text-primary">Ops Center</span></h1>
            </div>
            <div class="col-lg-6 text-lg-end" data-aos="fade-left">
                <p class="text-muted mb-0 mx-lg-auto" style="max-width: 450px;">Real-time diagnostics for the DeliKart global logistics engine. Monitoring over 12,000 active units across 142 hubs.</p>
            </div>
        </div>

        <div class="map-container mb-5" data-aos="zoom-in">
            <img src="{{ asset('images/fleet.png') }}" class="map-overlay-img" alt="Global Network">
            <div class="map-data-box">
                <div class="d-flex align-items-center mb-4">
                    <div class="pulse-active me-3" style="width: 15px; height: 15px; background: #10b981; border-radius: 50%;"></div>
                    <h5 class="fw-bold mb-0">System Nominal</h5>
                </div>
                <div class="mb-4">
                    <div class="small text-white-50 mb-1">Global Delivery Velocity</div>
                    <div class="progress bg-white bg-opacity-10" style="height: 6px;">
                        <div class="progress-bar bg-accent" style="width: 94%;"></div>
                    </div>
                    <div class="d-flex justify-content-between mt-1 smaller">
                        <span>Current Load: 94%</span>
                        <span>4.2k Manifests/hr</span>
                    </div>
                </div>
                <div class="d-grid">
                    <button class="btn btn-primary fw-bold rounded-pill">VIEW SATELLITE FEED</button>
                </div>
            </div>
            <div class="position-absolute top-0 end-0 p-4 d-flex flex-column gap-2" style="z-index: 10;">
                <div class="bg-white p-3 rounded-4 shadow-sm border small fw-bold"><i class="fas fa-plane text-primary me-2"></i> AIR: ACTIVE</div>
                <div class="bg-white p-3 rounded-4 shadow-sm border small fw-bold"><i class="fas fa-ship text-primary me-2"></i> SEA: NOMINAL</div>
                <div class="bg-white p-3 rounded-4 shadow-sm border small fw-bold"><i class="fas fa-truck text-primary me-2"></i> GROUND: HEAVY</div>
            </div>
        </div>

        <div class="network-grid mt-5">
            <div class="status-card text-center" data-aos="fade-up" data-aos-delay="100">
                <div class="display-5 fw-bold text-primary mb-1">142</div>
                <div class="small text-muted fw-bold">ACTIVE HUBS</div>
            </div>
            <div class="status-card text-center" data-aos="fade-up" data-aos-delay="200">
                <div class="display-5 fw-bold text-primary mb-1">98.9%</div>
                <div class="small text-muted fw-bold">SLA ACCURACY</div>
            </div>
            <div class="status-card text-center" data-aos="fade-up" data-aos-delay="300">
                <div class="display-5 fw-bold text-primary mb-1">4.2s</div>
                <div class="small text-muted fw-bold">SYNC LATENCY</div>
            </div>
            <div class="status-card text-center" data-aos="fade-up" data-aos-delay="400">
                <div class="display-5 fw-bold text-primary mb-1">24/7</div>
                <div class="small text-muted fw-bold">LIVE SUPPORT</div>
            </div>
        </div>
    </div>
</div>
@endsection
