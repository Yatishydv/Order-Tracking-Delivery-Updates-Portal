<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>DeliKart - {{ Auth::check() ? ucfirst(Auth::user()->role) . ' Panel' : 'Global Logistics Intelligence' }}</title>

    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Libraries -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        :root {
            --primary: #2d2422;
            --sidebar-bg: #382c2a;
            --accent: #e56b55; /* Warm, humanized coral/terracotta instead of tech blue */
            --bg-dashboard: #fdfbfb; /* Warmer off-white */
            --glass: rgba(255, 255, 255, 0.9);
            
            /* Bootstrap Primary Overrides */
            --bs-primary: #e56b55;
            --bs-primary-rgb: 229, 107, 85;
        }

        .btn-primary {
            --bs-btn-bg: var(--accent);
            --bs-btn-border-color: var(--accent);
            --bs-btn-hover-bg: #cf5e49;
            --bs-btn-hover-border-color: #cf5e49;
            --bs-btn-active-bg: #cf5e49;
            --bs-btn-active-border-color: #cf5e49;
        }

        .text-primary { color: var(--accent) !important; }
        .bg-primary { background-color: var(--accent) !important; }
        .border-primary { border-color: var(--accent) !important; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: {{ request()->is('admin*', 'agent*', 'customer*') ? 'var(--bg-dashboard)' : '#ffffff' }};
            color: #1e293b;
            overflow-x: hidden;
        }

        /* PUBLIC NAVBAR */
        .navbar-public {
            background: var(--glass) !important;
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border-bottom: 1px solid rgba(0,0,0,0.05);
            padding: 1.25rem 0;
            z-index: 1000;
            transition: all 0.3s;
        }
        .navbar-public.scrolled { padding: 0.8rem 0; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }

        .nav-link {
            font-weight: 600;
            color: #1e293b !important;
            padding: 0.5rem 1.25rem !important;
            transition: 0.3s;
        }
        .nav-link:hover { color: var(--accent) !important; }

        .dropdown-menu {
            border: none;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            border-radius: 1.25rem;
            padding: 1.5rem;
            margin-top: 1rem;
            min-width: 280px;
        }
        .dropdown-item {
            border-radius: 0.75rem;
            padding: 0.75rem 1rem;
            font-weight: 600;
            transition: 0.2s;
        }
        .dropdown-item:hover { background: #f8fafc; color: var(--accent); transform: translateX(5px); }

        /* PREMIUM FOOTER */
        .footer-premium { background: var(--primary); color: white; padding: 120px 0 60px; margin-top: 0; position: relative; }
        .footer-title { font-family: 'Space Grotesk', sans-serif; font-weight: 700; color: white; margin-bottom: 2.5rem; font-size: 1rem; letter-spacing: 2px; text-transform: uppercase; opacity: 0.8; }
        .footer-link { color: rgba(255, 255, 255, 0.5); text-decoration: none; display: block; margin-bottom: 1.25rem; transition: 0.3s; font-weight: 500; font-size: 0.95rem; }
        .footer-link:hover { color: var(--accent); transform: translateX(10px); }

        /* DASHBOARD SPECIFIC */
        @if(request()->is('admin*', 'agent*', 'customer*'))
        .dashboard-nav { background: white; border-bottom: 1px solid #e2e8f0; height: 75px; display: flex; align-items: center; padding: 0 2.5rem; position: sticky; top: 0; z-index: 100; }
        .sidebar { background: var(--sidebar-bg); color: white; min-height: 100vh; width: 280px; position: fixed; left: 0; top: 0; padding: 2.5rem 1.5rem; }
        .main-content { margin-left: 280px; padding: 3rem 4rem; min-height: 100vh; }
        .nav-link-db { color: rgba(255, 255, 255, 0.6); padding: 1rem 1.25rem; border-radius: 0.85rem; margin-bottom: 0.75rem; text-decoration: none; display: flex; align-items: center; font-weight: 600; transition: 0.3s; }
        .nav-link-db:hover, .nav-link-db.active { color: white; background: rgba(255, 255, 255, 0.1); }
        .nav-link-db.active { background: var(--accent); box-shadow: 0 8px 20px rgba(59, 130, 246, 0.3); }
        .nav-link-db i { width: 24px; margin-right: 15px; font-size: 1.1rem; }
        @endif

        .brand-text { font-family: 'Space Grotesk', sans-serif; font-weight: 800; letter-spacing: -1px; }
        
        /* Animations */
        .hover-lift { transition: 0.3s; }
        .hover-lift:hover { transform: translateY(-10px); }
        
        .bg-gradient-warm { background: linear-gradient(135deg, var(--sidebar-bg) 0%, var(--primary) 100%); }
    </style>
    @yield('styles')
</head>
<body>

    @if(request()->is('admin*', 'agent*', 'customer*'))
        <!-- DASHBOARD MODE -->
        <div class="sidebar">
            <div class="px-3 mb-5">
                <a href="{{ url('/') }}" class="text-white text-decoration-none d-flex align-items-center">
                    <i class="fas fa-cube fs-2 text-accent me-3"></i>
                    <span class="brand-text fs-3">DeliKart</span>
                </a>
                <div class="mt-3 small text-muted text-uppercase tracking-widest fw-bold" style="font-size: 0.65rem; opacity: 0.6;">{{ Auth::user()->role }} Intelligence Center</div>
            </div>

            <nav class="nav flex-column">
                @if(Auth::user()->isAdmin())
                    <a class="nav-link-db {{ request()->is('admin*') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}"><i class="fas fa-chart-line"></i> Operations Hub</a>
                @elseif(Auth::user()->isAgent())
                    <a class="nav-link-db {{ request()->is('agent*') ? 'active' : '' }}" href="{{ route('agent.dashboard') }}"><i class="fas fa-map-location-dot"></i> Live Routes</a>
                @else
                    <a class="nav-link-db {{ request()->is('customer*') ? 'active' : '' }}" href="{{ route('customer.orders') }}"><i class="fas fa-box-archive"></i> My Cargo</a>
                @endif
                
                <div class="px-3 mt-5 mb-3 small text-muted text-uppercase fw-bold" style="font-size: 0.65rem; opacity: 0.5;">Platform View</div>
                <a class="nav-link-db" href="{{ url('/') }}"><i class="fas fa-house-chimney"></i> Brand Home</a>
                <a class="nav-link-db" href="{{ route('fleet') }}"><i class="fas fa-satellite"></i> Network Status</a>
                <a class="nav-link-db" href="{{ route('contact') }}"><i class="fas fa-headset"></i> Support Desk</a>
                
                <div class="mt-auto pt-5">
                    <a class="nav-link-db text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-arrow-right-from-bracket"></i> Terminate Session
                    </a>
                </div>
            </nav>
        </div>

        <div class="main-content">
            <header class="dashboard-nav mb-5 rounded-4 shadow-sm border">
                <div class="d-flex align-items-center w-100">
                    <div class="d-flex align-items-center">
                        <div class="pulse-active me-3" style="width: 12px; height: 12px; background: #10b981; border-radius: 50%;"></div>
                        <h5 class="fw-bold mb-0">System: <span class="text-success">NOMINAL</span></h5>
                    </div>
                    <div class="ms-auto d-flex align-items-center">
                        <div class="me-4 text-end d-none d-lg-block">
                            <div class="fw-bold small">{{ Auth::user()->name }}</div>
                            <div class="text-muted smaller" style="font-size: 0.75rem;">{{ strtoupper(Auth::user()->role) }} NODE</div>
                        </div>
                        <div class="bg-primary text-white p-2 rounded-3">
                            <i class="fas fa-user-gear fs-5"></i>
                        </div>
                    </div>
                </div>
            </header>

            @yield('content')
        </div>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>

    @else
        <!-- PUBLIC WEBSITE MODE -->
        <nav class="navbar navbar-expand-lg navbar-public sticky-top">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                    <i class="fas fa-cube me-3 text-primary fs-3"></i>
                    <span class="brand-text fs-3">DeliKart</span>
                </a>
                
                <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                    <i class="fas fa-bars-staggered text-primary fs-4"></i>
                </button>

                <div class="collapse navbar-collapse" id="mainNav">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Home</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Solutions</a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('enterprise') }}">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-building text-primary me-3"></i>
                                        <div>
                                            <div class="fw-bold">Enterprise</div>
                                            <div class="smaller text-muted fw-normal" style="font-size: 0.7rem;">Corporate logistics network</div>
                                        </div>
                                    </div>
                                </a>
                                <a class="dropdown-item" href="{{ route('api') }}">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-code text-primary me-3"></i>
                                        <div>
                                            <div class="fw-bold">E-commerce API</div>
                                            <div class="smaller text-muted fw-normal" style="font-size: 0.7rem;">Developer-first integration</div>
                                        </div>
                                    </div>
                                </a>
                                <a class="dropdown-item" href="{{ route('sme') }}">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-rocket text-primary me-3"></i>
                                        <div>
                                            <div class="fw-bold">SME Shipping</div>
                                            <div class="smaller text-muted fw-normal" style="font-size: 0.7rem;">Growth-ready shipping</div>
                                        </div>
                                    </div>
                                </a>
                                <div class="dropdown-divider my-2"></div>
                                <a class="dropdown-item" href="{{ route('secure') }}">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-shield-halved text-primary me-3"></i>
                                        <div class="fw-bold">Secure Cargo</div>
                                    </div>
                                </a>
                                <a class="dropdown-item" href="{{ route('freight') }}">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-plane-up text-primary me-3"></i>
                                        <div class="fw-bold">Air Freight</div>
                                    </div>
                                </a>
                            </div>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('fleet') }}">Network</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">About</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Contact</a></li>
                    </ul>
                    
                    <div class="d-flex align-items-center gap-3">
                        @auth
                            <a class="btn btn-dark px-4 py-2 border-0" href="{{ route('home') }}" style="border-radius: 0.85rem; font-weight: 700; background: var(--primary);">
                                <i class="fas fa-gauge-high me-2"></i> DASHBOARD
                            </a>
                        @else
                            <a class="nav-link fw-bold px-3 d-none d-xl-block" href="{{ route('login') }}">Sign In</a>
                            <a class="btn btn-primary px-4 py-2" href="{{ route('register') }}" style="background: var(--accent); border: none; border-radius: 0.85rem; font-weight: 700; box-shadow: 0 10px 20px rgba(229, 107, 85, 0.2);">Join Network</a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <main>
            @yield('content')
        </main>

        <footer class="footer-premium">
            <div class="container">
                <div class="row g-5">
                    <div class="col-lg-4">
                        <div class="d-flex align-items-center mb-4">
                            <i class="fas fa-cube me-3 text-accent fs-2"></i>
                            <span class="brand-text fs-3 text-white">DeliKart</span>
                        </div>
                        <p class="text-white-50 mb-5 pe-lg-5">Redefining global logistics through transparency, precision, and state-of-the-art tracking intelligence.</p>
                        <div class="d-flex gap-3">
                            <a href="#" class="footer-social"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="footer-social"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#" class="footer-social"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-2">
                        <h6 class="footer-title">Platform</h6>
                        <a href="{{ route('about') }}" class="footer-link">Our Mission</a>
                        <a href="{{ route('fleet') }}" class="footer-link">Global Fleet</a>
                        <a href="{{ route('fleet') }}" class="footer-link">Network Status</a>
                        <a href="{{ route('contact') }}" class="footer-link">Support Hub</a>
                    </div>
                    <div class="col-sm-6 col-lg-2">
                        <h6 class="footer-title">Solutions</h6>
                        <a href="{{ route('enterprise') }}" class="footer-link">Enterprise</a>
                        <a href="{{ route('api') }}" class="footer-link">E-commerce API</a>
                        <a href="{{ route('sme') }}" class="footer-link">SME Shipping</a>
                        <a href="{{ route('secure') }}" class="footer-link">Secure Cargo</a>
                        <a href="{{ route('freight') }}" class="footer-link">Air Freight</a>
                    </div>
                    <div class="col-lg-4">
                        <h6 class="footer-title">Stay Intelligent</h6>
                        <p class="text-white-50 mb-4">Get weekly insights into the future of global logistics and supply chain tech.</p>
                        <form class="d-flex gap-2 mb-4" onsubmit="event.preventDefault(); alert('Intelligence feed active!');">
                            <input type="email" class="form-control bg-white bg-opacity-10 border-0 text-white px-4 py-3" placeholder="email@address.com" required style="border-radius: 0.85rem;">
                            <button type="submit" class="btn btn-primary px-4 fw-bold" style="background: var(--accent); border: none; border-radius: 0.85rem;">JOIN</button>
                        </form>
                        <div class="text-white-50 small">
                            <i class="fas fa-shield-check text-accent me-2"></i> GDPR Compliant Intelligence
                        </div>
                    </div>
                </div>
                <hr class="my-5 border-white border-opacity-10">
                <div class="row align-items-center">
                    <div class="col-md-6 text-white-50 small">
                        &copy; 2026 DeliKart Logistics Network. Engineered for Excellence.
                    </div>
                    <div class="col-md-6 text-md-end text-white-50 small">
                        <a href="{{ route('privacy') }}" class="text-white-50 text-decoration-none me-4">Privacy Intelligence</a>
                        <a href="{{ route('terms') }}" class="text-white-50 text-decoration-none me-4">Terms of Manifest</a>
                        <a href="{{ route('cookies') }}" class="text-white-50 text-decoration-none">Cookies</a>
                    </div>
                </div>
            </div>
        </footer>
    @endif

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 1000, once: true, easing: 'ease-out-quad' });
        $(window).scroll(function() {
            if ($(this).scrollTop() > 50) {
                $('.navbar-public').addClass('scrolled');
            } else {
                $('.navbar-public').removeClass('scrolled');
            }
        });
    </script>
    @yield('scripts')
</body>
</html>
