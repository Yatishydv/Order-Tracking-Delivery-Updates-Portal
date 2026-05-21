<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>DeliKart - {{ Auth::check() ? ucfirst(Auth::user()->role) . ' Portal' : 'Logistics Management' }}</title>

    <!-- Professional Inter Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Libraries -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --brand-primary: #000000;
            --brand-secondary: #f4f5f7;
            --border-color: #e5e7eb;
            --text-main: #111827;
            --text-muted: #6b7280;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background-color: #f4f5f7;
            color: var(--text-main);
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* Utilitarian Overrides */
        .btn {
            border-radius: 0.5rem;
            font-weight: 500;
            letter-spacing: -0.01em;
            padding: 0.5rem 1rem;
            box-shadow: none !important;
            transition: all 0.15s ease-in-out;
        }
        
        .btn-primary {
            background-color: #000000;
            border-color: #000000;
            color: #ffffff;
        }
        
        .btn-primary:hover {
            background-color: #1f2937;
            border-color: #1f2937;
        }

        .btn-outline-primary {
            color: #000000;
            border-color: var(--border-color);
        }
        .btn-outline-primary:hover {
            background-color: #f9fafb;
            color: #000000;
            border-color: var(--border-color);
        }

        .card {
            border-radius: 1rem;
            border: 1px solid var(--border-color);
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.05);
            background-color: #ffffff;
            overflow: hidden;
        }

        .card-header {
            background-color: #ffffff;
            border-bottom: 1px solid var(--border-color);
            padding: 1.25rem 1.5rem;
        }

        .form-control, .form-select {
            border-radius: 0.5rem;
            border: 1px solid var(--border-color);
            font-size: 0.875rem;
            padding: 0.6rem 0.75rem;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.02);
        }
        
        .form-control:focus, .form-select:focus {
            border-color: #000000;
            box-shadow: 0 0 0 1px #000000;
        }

        .badge {
            border-radius: 0.375rem;
            font-weight: 600;
            padding: 0.35em 0.65em;
            font-size: 0.7rem;
            letter-spacing: 0.02em;
        }

        .table {
            color: var(--text-main);
            font-size: 0.875rem;
        }
        
        .table th {
            color: var(--text-muted);
            font-weight: 500;
            border-bottom-width: 1px;
            border-color: var(--border-color);
            padding: 1rem 1.5rem;
            background-color: #ffffff;
            text-transform: uppercase;
            font-size: 0.65rem;
            letter-spacing: 0.05em;
        }
        
        .table td {
            border-color: var(--border-color);
            padding: 1rem 1.5rem;
            vertical-align: middle;
        }

        /* Professional Navbar */
        .navbar-main {
            background-color: #ffffff;
            border-bottom: 1px solid var(--border-color);
            padding: 0.75rem 0;
        }

        .nav-link {
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--text-muted);
            padding: 0.5rem 0.75rem !important;
        }
        .nav-link:hover {
            color: var(--text-main);
        }

        .brand-logo {
            font-weight: 700;
            color: #000000;
            font-size: 1.125rem;
            letter-spacing: -0.02em;
            text-decoration: none;
        }

        .dropdown-menu {
            border-radius: 0.5rem;
            border: 1px solid var(--border-color);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            padding: 0.5rem 0;
            font-size: 0.875rem;
        }

        .dropdown-item {
            padding: 0.5rem 1rem;
            font-weight: 400;
        }
        .dropdown-item:hover {
            background-color: #f9fafb;
        }

        /* Mockup Specific Badges */
        .badge-delivered { background-color: #dcfce7; color: #166534; }
        .badge-shipped { background-color: #e0e7ff; color: #4338ca; }
        .badge-packed { background-color: #f3e8ff; color: #7e22ce; }
        .badge-out { background-color: #ffedd5; color: #c2410c; }
        .badge-pending { background-color: #fee2e2; color: #b91c1c; }
    </style>
    @yield('styles')
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-main sticky-top">
        <div class="container-fluid px-4 px-xl-5">
            <a class="brand-logo d-flex align-items-center me-4" href="{{ url('/') }}">
                <i class="fas fa-cube me-2 text-dark"></i> DeliKart
            </a>
            
            <button class="navbar-toggler border-0 shadow-none p-0" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                <i class="fas fa-bars text-muted"></i>
            </button>

            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav me-auto">
                    @if(Auth::check())
                        @if(Auth::user()->isAdmin())
                            <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        @elseif(Auth::user()->isAgent())
                            <li class="nav-item"><a class="nav-link" href="{{ route('agent.dashboard') }}">Tasks</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('customer.orders') }}">My Orders</a></li>
                        @else
                            <li class="nav-item"><a class="nav-link" href="{{ route('customer.orders') }}">Orders</a></li>
                        @endif
                    @endif
                </ul>
                
                <div class="d-flex align-items-center gap-3">
                    @auth
                        <div class="dropdown">
                            <button class="btn btn-outline-primary border-0 bg-light px-3 py-1 d-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown" style="font-size: 0.875rem;">
                                <div class="bg-dark text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 20px; height: 20px; font-size: 10px;">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                {{ explode(' ', Auth::user()->name)[0] }}
                                <i class="fas fa-chevron-down ms-1" style="font-size: 0.7rem;"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end mt-2">
                                <li class="px-3 py-2 text-muted" style="font-size: 0.75rem;">Signed in as <strong>{{ Auth::user()->email }}</strong></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Sign out
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    @else
                        <a class="nav-link" href="{{ route('login') }}">Log in</a>
                        <a class="btn btn-primary btn-sm" href="{{ route('register') }}">Sign up</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @yield('scripts')
</body>
</html>
