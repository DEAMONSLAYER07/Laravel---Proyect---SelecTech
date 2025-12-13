<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel RH - SeleTech')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --primary-blue: #0a1f44;
            --secondary-blue: #004a99;
            --accent-blue: #007bff;
            --success-green: #28a745;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #e9ecef 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* NAVBAR */
        .navbar {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(10, 31, 68, 0.3);
            padding: 0.75rem 0;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            transition: transform 0.3s ease;
            display: flex;
            align-items: center;
            gap: 12px;
            color: white !important;
        }

        .navbar-brand:hover {
            transform: scale(1.05);
            color: white !important;
        }

        .navbar-brand img {
            height: 45px;
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.2));
        }

        .navbar-brand .brand-text {
            display: flex;
            flex-direction: column;
            line-height: 1.2;
        }

        .navbar-brand .brand-title {
            font-size: 1.3rem;
            font-weight: 700;
        }

        .navbar-brand .brand-subtitle {
            font-size: 0.75rem;
            opacity: 0.9;
            font-weight: 400;
        }

        /* NAVIGATION LINKS */
        .navbar-nav {
            gap: 0.5rem;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.85) !important;
            font-weight: 500;
            padding: 0.5rem 1rem !important;
            border-radius: 8px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.15);
            color: white !important;
        }

        .nav-link.active {
            background: rgba(255, 255, 255, 0.2);
            color: white !important;
        }

        .nav-link i {
            font-size: 1.1rem;
        }

        /* LOGOUT BUTTON */
        .btn-logout {
            background: rgba(255, 255, 255, 0.2);
            border: 2px solid rgba(255, 255, 255, 0.3);
            color: white;
            font-weight: 600;
            padding: 0.5rem 1.5rem;
            border-radius: 10px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-logout:hover {
            background: white;
            color: var(--primary-blue);
            border-color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .btn-logout i {
            font-size: 1rem;
        }

        /* MAIN CONTENT */
        main {
            flex: 1;
            padding: 2rem 0;
        }

        /* FOOTER */
        .app-footer {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
            color: white;
            padding: 1.5rem 0;
            margin-top: auto;
            box-shadow: 0 -2px 20px rgba(10, 31, 68, 0.2);
        }

        .app-footer p {
            margin: 0;
            opacity: 0.9;
            font-size: 0.9rem;
        }

        .app-footer a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .app-footer a:hover {
            opacity: 0.8;
            text-decoration: underline;
        }

        /* USER INFO */
        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0.5rem 1rem;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            color: white;
            margin-right: 1rem;
        }

        .user-info i {
            font-size: 1.5rem;
        }

        .user-info .user-details {
            display: flex;
            flex-direction: column;
            line-height: 1.2;
        }

        .user-info .user-name {
            font-weight: 600;
            font-size: 0.9rem;
        }

        .user-info .user-role {
            font-size: 0.75rem;
            opacity: 0.9;
        }

        /* ALERTS */
        .alert {
            border-radius: 12px;
            border: none;
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
        }

        .alert i {
            font-size: 1.2rem;
            margin-right: 8px;
        }

        .alert-success {
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
            color: #155724;
        }

        .alert-info {
            background: linear-gradient(135deg, #d1ecf1, #bee5eb);
            color: #0c5460;
        }

        .alert-warning {
            background: linear-gradient(135deg, #fff3cd, #ffeaa7);
            color: #856404;
        }

        .alert-danger {
            background: linear-gradient(135deg, #f8d7da, #f5c2c7);
            color: #842029;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .navbar-brand .brand-text {
                display: none;
            }

            .user-info .user-details {
                display: none;
            }

            .navbar-nav {
                padding: 1rem 0;
            }

            .nav-link {
                margin: 0.25rem 0;
            }

            main {
                padding: 1rem 0;
            }
        }
    </style>

    @yield('styles')
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            
            <!-- LOGO Y BRAND -->
            <a class="navbar-brand" href="{{ route('rh.dashboard') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Seletech Logo">
            </a>

            <!-- TOGGLE BUTTON (Mobile) -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- NAVIGATION -->
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('rh/dashboard*') ? 'active' : '' }}" 
                           href="{{ route('rh.dashboard') }}">
                            <i class="bi bi-speedometer2"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('rh/fichas*') ? 'active' : '' }}" 
                           href="{{ route('fichas.create') }}">
                            <i class="bi bi-plus-circle"></i>
                            Nueva Vacante
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}" target="_blank">
                            <i class="bi bi-eye"></i>
                            Ver Portal
                        </a>
                    </li>
                </ul>

                <!-- USER INFO & LOGOUT -->
                <div class="d-flex align-items-center">
                    @auth
                        <div class="user-info">
                            <i class="bi bi-person-circle"></i>
                            <div class="user-details">
                                <span class="user-name">{{ auth()->user()->nombre }}</span>
                                <span class="user-role">{{ ucfirst(auth()->user()->rol) }}</span>
                            </div>
                        </div>
                    @endauth

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-logout">
                            <i class="bi bi-box-arrow-right"></i>
                            Cerrar sesión
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </nav>

    <!-- FLASH MESSAGES -->
    @if(session('success'))
        <div class="container mt-3">
            <div class="alert alert-success">
                <i class="bi bi-check-circle-fill"></i>
                <strong>¡Éxito!</strong> {{ session('success') }}
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="container mt-3">
            <div class="alert alert-danger">
                <i class="bi bi-exclamation-triangle-fill"></i>
                <strong>Error:</strong> {{ session('error') }}
            </div>
        </div>
    @endif

    @if(session('info'))
        <div class="container mt-3">
            <div class="alert alert-info">
                <i class="bi bi-info-circle-fill"></i>
                {{ session('info') }}
            </div>
        </div>
    @endif

    @if(session('warning'))
        <div class="container mt-3">
            <div class="alert alert-warning">
                <i class="bi bi-exclamation-circle-fill"></i>
                {{ session('warning') }}
            </div>
        </div>
    @endif

    <!-- MAIN CONTENT -->
    <main>
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="app-footer">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start">
                    <p>© {{ date('Y') }} SeleTech — Sistema de Reclutamiento y Gestión de Talento</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p>
                        <a href="{{ url('/conocenos') }}">Conócenos</a> | 
                        <a href="mailto:SelecTech@gmail.com">Contacto</a> | 
                        <a href="#">Ayuda</a>
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- SCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    @yield('scripts')
</body>
</html>