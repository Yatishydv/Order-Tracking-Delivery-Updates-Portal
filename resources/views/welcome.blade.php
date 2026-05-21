@extends('layouts.app')

@section('styles')
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@1,600&display=swap" rel="stylesheet">
<style>
    body {
        background-color: #ffffff;
    }
    
    .hero-section {
        min-height: 80vh;
        position: relative;
        overflow: hidden;
        background-color: #ffffff;
    }
    
    .hero-bg-image {
        position: absolute;
        top: 0;
        right: 0;
        width: 60%;
        height: 100%;
        background-image: url('https://images.unsplash.com/photo-1580674285054-bed31e145f59?q=80&w=2000&auto=format&fit=crop');
        background-size: cover;
        background-position: center right;
        z-index: 1;
    }
    
    .hero-gradient-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, rgba(255,255,255,1) 0%, rgba(255,255,255,1) 40%, rgba(255,255,255,0) 65%);
        z-index: 2;
    }
    
    .hero-content {
        position: relative;
        z-index: 3;
        padding-top: 10vh;
    }
    
    .badge-pill-outline {
        border: 1px solid #e5e7eb;
        color: #b45309; 
        background-color: #fffbeb;
        border-radius: 50rem;
        padding: 0.35rem 0.8rem;
        font-size: 0.75rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        letter-spacing: 0.02em;
    }
    
    .hero-title {
        font-size: 4.5rem;
        font-weight: 600;
        line-height: 1.1;
        color: #111827;
        letter-spacing: -0.03em;
        margin-top: 2rem;
        margin-bottom: 1.5rem;
    }
    
    .hero-title-italic {
        font-family: 'Playfair Display', serif;
        font-style: italic;
        font-weight: 600;
        color: #111827;
    }
    
    .hero-subtitle {
        font-size: 1.1rem;
        color: #4b5563;
        line-height: 1.6;
        max-width: 450px;
        margin-bottom: 2.5rem;
    }
    
    .features-section {
        border-top: 1px solid #f3f4f6;
        border-bottom: 1px solid #f3f4f6;
        background-color: #ffffff;
        padding-top: 5rem;
        padding-bottom: 5rem;
    }
    
    .feature-icon-wrapper {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background-color: #f9fafb;
        border: 1px solid #f3f4f6;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #374151;
        font-size: 1.25rem;
        flex-shrink: 0;
    }
    
    .feature-title {
        font-weight: 600;
        color: #111827;
        font-size: 0.95rem;
        margin-bottom: 0.2rem;
    }
    
    .feature-desc {
        color: #6b7280;
        font-size: 0.85rem;
        line-height: 1.4;
    }
    
    .logos-section {
        background-color: #ffffff;
        padding: 5rem 0;
    }

    /* Modern Bento Box Section */
    .bento-section {
        padding: 6rem 0;
        background-color: #f4f5f7;
    }

    .bento-card {
        background: #ffffff;
        border-radius: 1.5rem;
        border: 1px solid #e5e7eb;
        overflow: hidden;
        height: 100%;
        position: relative;
        padding: 2.5rem;
        transition: transform 0.3s ease;
    }
    
    .bento-card:hover {
        transform: translateY(-5px);
    }
    
    .bento-card-dark {
        background: #111827;
        color: #ffffff;
        border: none;
    }
    
    .bento-card-image {
        position: absolute;
        bottom: 0;
        right: 0;
        width: 60%;
        height: 60%;
        object-fit: cover;
        border-top-left-radius: 1.5rem;
        opacity: 0.9;
    }

    footer {
        background-color: #ffffff;
        border-top: 1px solid #e5e7eb;
        padding: 5rem 0 2rem 0;
    }
    
    @media (max-width: 991px) {
        .hero-bg-image { width: 100%; }
        .hero-gradient-overlay { background: linear-gradient(90deg, rgba(255,255,255,0.95) 0%, rgba(255,255,255,0.85) 100%); }
        .hero-title { font-size: 3.5rem; }
    }
</style>
@endsection

@section('content')

<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-bg-image"></div>
    <div class="hero-gradient-overlay"></div>
    
    <div class="container-fluid px-4 px-xl-5 hero-content h-100">
        <div class="row h-100">
            <div class="col-lg-6 col-xl-5">
                <div class="badge-pill-outline">
                    <i class="fas fa-box-open"></i> Smart Delivery, Simplified
                </div>
                
                <h1 class="hero-title">
                    Delivering<br>
                    what matters,<br>
                    <span class="hero-title-italic">every time.</span>
                </h1>
                
                <p class="hero-subtitle">
                    DeliKart connects you with the people and businesses that matter most. Fast, reliable and transparent delivery you can always count on.
                </p>
                
                <div class="d-flex align-items-center gap-4">
                    <a href="{{ route('register') }}" class="btn btn-dark px-4 py-3 rounded-3 shadow-sm d-flex align-items-center gap-2" style="font-weight: 500;">
                        Get Started <i class="fas fa-arrow-right ms-1" style="font-size: 0.8rem;"></i>
                    </a>
                    <a href="{{ route('login') }}" class="text-dark text-decoration-none fw-medium d-flex align-items-center gap-1 hover-lift">
                        Track Package <i class="fas fa-chevron-right ms-1" style="font-size: 0.7rem;"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section (Restored underline with plenty of spacing) -->
<section class="features-section">
    <div class="container-fluid px-4 px-xl-5">
        <div class="row g-4 justify-content-between">
            <div class="col-sm-6 col-lg-3">
                <div class="d-flex align-items-start gap-3">
                    <div class="feature-icon-wrapper"><i class="fas fa-shield-alt"></i></div>
                    <div>
                        <div class="feature-title">Safe & Secure</div>
                        <div class="feature-desc">Your packages are<br>in safe hands.</div>
                    </div>
                </div>
            </div>
            
            <div class="col-sm-6 col-lg-3">
                <div class="d-flex align-items-start gap-3">
                    <div class="feature-icon-wrapper"><i class="fas fa-map-marker-alt"></i></div>
                    <div>
                        <div class="feature-title">Real-time Tracking</div>
                        <div class="feature-desc">Follow your shipment<br>every step of the way.</div>
                    </div>
                </div>
            </div>
            
            <div class="col-sm-6 col-lg-3">
                <div class="d-flex align-items-start gap-3">
                    <div class="feature-icon-wrapper"><i class="far fa-clock"></i></div>
                    <div>
                        <div class="feature-title">On-time Delivery</div>
                        <div class="feature-desc">Punctual delivery,<br>every time.</div>
                    </div>
                </div>
            </div>
            
            <div class="col-sm-6 col-lg-3">
                <div class="d-flex align-items-start gap-3">
                    <div class="feature-icon-wrapper"><i class="fas fa-headset"></i></div>
                    <div>
                        <div class="feature-title">24/7 Support</div>
                        <div class="feature-desc">We're here to help,<br>whenever you need.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Trusted By Section -->
<section class="logos-section">
    <div class="container-fluid px-4 px-xl-5 text-center text-lg-start">
        <p class="text-muted small fw-medium mb-4 text-center">Trusted by businesses and individuals globally</p>
        
        <div class="d-flex flex-wrap align-items-center justify-content-center gap-4 gap-md-5 mx-auto" style="max-width: 900px;">
            <div class="fw-bold text-muted fs-4" style="font-family: Arial, sans-serif; opacity: 0.5; letter-spacing: -1px;">Google</div>
            <div class="fw-bold text-muted fs-4" style="font-family: 'Amazon Ember', Arial, sans-serif; opacity: 0.5; letter-spacing: -1px;"><i class="fab fa-amazon me-1 fs-5"></i>amazon</div>
            <div class="fw-bold text-muted fs-4" style="font-family: italic, sans-serif; opacity: 0.5; font-style: italic;">Flipkart</div>
            <div class="fw-bold text-muted fs-4" style="font-family: Arial, sans-serif; opacity: 0.5; color: #fc8019;">SWIGGY</div>
            <div class="fw-bold text-muted fs-4" style="font-family: Arial, sans-serif; opacity: 0.5; font-style: italic;">zepto</div>
            <div class="fw-bold text-muted fs-4" style="font-family: Arial, sans-serif; opacity: 0.5; letter-spacing: 2px;">NYKAA</div>
        </div>
    </div>
</section>

<!-- Humanized Bento Grid Section -->
<section class="bento-section">
    <div class="container-fluid px-4 px-xl-5">
        
        <div class="mb-5 pb-2" style="max-width: 600px;">
            <h2 class="display-5 fw-bold text-dark mb-3" style="letter-spacing: -0.02em;">We don't just move boxes. We deliver peace of mind.</h2>
            <p class="text-muted fs-5">Forget the robotic tracking updates and lost packages. We built DeliKart because we believe sending a package should be as easy as sending a text message.</p>
        </div>
        
        <div class="row g-4">
            <!-- Large Map Feature -->
            <div class="col-lg-8">
                <div class="bento-card p-0 d-flex flex-column flex-md-row">
                    <div class="p-5 d-flex flex-column justify-content-center" style="flex: 1;">
                        <div class="bg-primary bg-opacity-10 text-dark rounded-circle d-flex align-items-center justify-content-center mb-4" style="width: 48px; height: 48px;">
                            <i class="fas fa-route fs-5"></i>
                        </div>
                        <h3 class="fw-bold mb-3">See exactly where it is.</h3>
                        <p class="text-muted mb-0">Our beautiful live map doesn't just show you a vague city. It shows you the actual truck moving down the street towards your front door. No more guessing.</p>
                    </div>
                    <div style="flex: 1; min-height: 250px; background: url('https://images.unsplash.com/photo-1524661135-423995f22d0b?w=800&q=80') center/cover; opacity: 0.8; filter: grayscale(50%);"></div>
                </div>
            </div>
            
            <!-- Dark Callout -->
            <div class="col-lg-4">
                <div class="bento-card bento-card-dark d-flex flex-column justify-content-center text-center p-5">
                    <h1 class="display-3 fw-bold mb-0">99%</h1>
                    <h4 class="fw-medium text-white-50 mt-2 mb-4">of packages arrive early.</h4>
                    <p class="small text-white-50 mb-0">Our drivers are real people from your neighborhood who actually care about getting your stuff to you safely.</p>
                </div>
            </div>
            
            <!-- Image Card -->
            <div class="col-lg-4">
                <div class="bento-card p-0 position-relative" style="min-height: 350px;">
                    <img src="https://images.unsplash.com/photo-1586864387967-d02ef85d93e8?w=800&q=80" alt="Courier" style="width: 100%; height: 100%; object-fit: cover;">
                    <div class="position-absolute bottom-0 start-0 w-100 p-4" style="background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);">
                        <h4 class="fw-bold text-white mb-1">Meet your couriers</h4>
                        <p class="text-white-50 small mb-0">Chat with them directly in the app.</p>
                    </div>
                </div>
            </div>
            
            <!-- CTA Card -->
            <div class="col-lg-8">
                <div class="bento-card d-flex flex-column justify-content-center align-items-center text-center p-5" style="background-color: #ffffff;">
                    <h2 class="fw-bold mb-3">Ready to ship with us?</h2>
                    <p class="text-muted mb-4" style="max-width: 400px;">Sign up today and get your first local delivery completely on the house. No credit card required.</p>
                    <a href="{{ route('register') }}" class="btn btn-dark btn-lg px-5 py-3 rounded-pill shadow-sm fw-bold">Create Free Account</a>
                </div>
            </div>
        </div>
        
    </div>
</section>

<!-- Footer -->
@include('partials.footer')

@endsection
