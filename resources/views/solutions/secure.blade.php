@extends('layouts.app')

@section('styles')
<style>
    body { background-color: #1a1514 !important; color: #f8fafc !important; }
    .main-content-wrapper { background: #1a1514; }
    .secure-card { background: rgba(56, 44, 42, 0.5); border: 1px solid rgba(229, 107, 85, 0.2); backdrop-filter: blur(10px); }
    .text-accent-glow { color: #e56b55; text-shadow: 0 0 20px rgba(229, 107, 85, 0.5); }
</style>
@endsection

@section('content')
<div class="py-5" style="background: radial-gradient(circle at top right, #382c2a, #1a1514);">
    <div class="container py-5">
        <div class="text-center mb-5" data-aos="zoom-in">
            <h6 class="text-accent-glow fw-bold text-uppercase tracking-widest mb-3">Priority Classification: Level 5</h6>
            <h1 class="display-2 fw-bold mb-4">Secure Cargo <span class="text-accent-glow">Vaults</span></h1>
            <p class="lead opacity-75 mx-auto" style="max-width: 700px;">When the manifest contains high-value assets, security is non-negotiable. DeliKart Secure utilizes bio-metric chain-of-custody protocols to ensure 100% integrity from origin to extraction.</p>
        </div>

        <div class="row g-0 rounded-5 overflow-hidden shadow-2xl border border-white border-opacity-10 mb-5" data-aos="fade-up">
            <div class="col-lg-7 p-0">
                <img src="{{ asset('images/secure.png') }}" class="w-100 h-100" style="object-fit: cover; min-height: 500px;" alt="Secure Vault">
            </div>
            <div class="col-lg-5 p-5 d-flex align-items-center" style="background: #2d2422;">
                <div>
                    <h3 class="fw-bold mb-4"><i class="fas fa-lock text-accent me-2"></i> Bio-metric Protocols</h3>
                    <p class="opacity-75 mb-4">Every hand-off in the Secure network requires a dual-factor biometric verification. No consignment is ever moved without verified operative identification.</p>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-3 d-flex align-items-center"><i class="fas fa-fingerprint text-accent me-3"></i> Fingerprint extraction logic</li>
                        <li class="mb-3 d-flex align-items-center"><i class="fas fa-eye text-accent me-3"></i> Retinal scan hand-overs</li>
                        <li class="mb-3 d-flex align-items-center"><i class="fas fa-shield-halved text-accent me-3"></i> Encrypted manifest nodes</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row g-4 mt-5">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="secure-card p-5 rounded-4 h-100 text-center">
                    <div class="bg-primary bg-opacity-20 text-accent p-4 rounded-circle d-inline-flex mb-4">
                        <i class="fas fa-video fs-2"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Visual Intelligence</h4>
                    <p class="small opacity-75 mb-0">Direct 24/7 video feed for enterprise clients. Monitor your cargo in every hub across the global network.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="secure-card p-5 rounded-4 h-100 text-center">
                    <div class="bg-primary bg-opacity-20 text-accent p-4 rounded-circle d-inline-flex mb-4">
                        <i class="fas fa-vault fs-2"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Hardened Storage</h4>
                    <p class="small opacity-75 mb-0">Reinforced steel distribution units with active vibration and temperature monitoring.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="secure-card p-5 rounded-4 h-100 text-center">
                    <div class="bg-primary bg-opacity-20 text-accent p-4 rounded-circle d-inline-flex mb-4">
                        <i class="fas fa-file-contract fs-2"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Insured Manifest</h4>
                    <p class="small opacity-75 mb-0">Immediate insurance coverage up to $10M for all assets under Secure classification.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
