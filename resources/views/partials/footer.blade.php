<footer>
    <div class="container-fluid px-4 px-xl-5 mt-5">
        <div class="row justify-content-between g-4 mb-5">
            <div class="col-lg-4">
                <a class="brand-logo d-flex align-items-center mb-3" href="#" style="font-size: 1.5rem; text-decoration: none;">
                    <i class="fas fa-cube me-2 text-dark"></i> <span class="fw-bold text-dark">DeliKart</span>
                </a>
                <p class="text-muted small pe-lg-5">Delivering what matters, every time. The most reliable and transparent logistics network for modern businesses.</p>
            </div>
            <div class="col-lg-2 col-6">
                <h6 class="fw-bold mb-3">Product</h6>
                <ul class="list-unstyled text-muted small d-flex flex-column gap-2">
                    <li><a href="{{ route('about') }}" class="text-muted text-decoration-none hover-lift">Features</a></li>
                    <li><a href="{{ route('register') }}" class="text-muted text-decoration-none hover-lift">Tracking API</a></li>
                </ul>
            </div>
            <div class="col-lg-2 col-6">
                <h6 class="fw-bold mb-3">Company</h6>
                <ul class="list-unstyled text-muted small d-flex flex-column gap-2">
                    <li><a href="{{ route('about') }}" class="text-muted text-decoration-none hover-lift">Our Story</a></li>
                    <li><a href="{{ route('contact') }}" class="text-muted text-decoration-none hover-lift">Contact</a></li>
                </ul>
            </div>
            <div class="col-lg-2 col-6">
                <h6 class="fw-bold mb-3">Legal</h6>
                <ul class="list-unstyled text-muted small d-flex flex-column gap-2">
                    <li><a href="{{ route('privacy') }}" class="text-muted text-decoration-none hover-lift">Privacy Policy</a></li>
                    <li><a href="{{ route('privacy') }}" class="text-muted text-decoration-none hover-lift">Terms of Service</a></li>
                </ul>
            </div>
        </div>
        <div class="text-center border-top pt-4 text-muted small pb-4">
            &copy; {{ date('Y') }} DeliKart Logistics. All rights reserved.
        </div>
    </div>
</footer>
