<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Seletech - Portal de Reclutamiento</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center text-white" href="{{ url('/') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Seletech Logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('login') ? 'active' : '' }}" href="{{ url('/login') }}">
                        <i class="bi bi-box-arrow-in-right me-1"></i> Login
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('conocenos') ? 'active' : '' }}" href="{{ url('/conocenos') }}">
                        <i class="bi bi-info-circle me-1"></i> Conócenos
                    </a>
                </li>
                @auth
                    @if(auth()->user()->rol === 'admin')
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('admin/solicitudes') ? 'active' : '' }}" href="{{ route('admin.solicitudes.index') }}">
                                <i class="bi bi-people-fill me-1"></i> Ver candidatos
                            </a>
                        </li>
                    @endif
                @endauth
            </ul>
        </div>
    </div>
</nav>
<!-- <nav class="navbar navbar-expand-lg fixed-top shadow-sm">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center fw-bold text-white" href="{{ url('/') }}">
            <img src="{{ asset('images/logo1.png') }}" alt="Seletech Logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('login') ? 'active' : '' }}" href="{{ url('/login') }}">Ingresar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('conocenos') ? 'active' : '' }}" href="{{ url('/conocenos') }}">Conócenos</a>
                </li>
                @auth
                    @if(auth()->user()->rol === 'admin')
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('admin/solicitudes') ? 'active' : '' }}" href="{{ route('admin.solicitudes.index') }}">
                                <i class="bi bi-people-fill me-1"></i> Ver candidatos
                            </a>
                        </li>
                    @endif
                @endauth
            </ul>
        </div>
    </div>
</nav> -->

<header class="hero">
    <div class="container">
        <h1>Busca tu futuro con Seletech</h1>
        <p class="mt-3">Explora las vacantes que se encuentran en disponibles y aplica en segundos</p>
    </div>
</header>

@php use Illuminate\Support\Str; @endphp

{{-- ============================================================
    SECCIÓN DINÁMICA DE FICHAS DE TRABAJO
============================================================ --}}
<section id="vacantes" class="py-5 bg-light">
    <div class="container text-center">

        <h2 class="fw-bold mb-4 text-primary">Vacantes</h2>

        @if(isset($fichas) && $fichas->count() > 0)
            <div class="row justify-content-center">

                @foreach ($fichas as $ficha)
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm h-100 border-0 rounded-4">

                            <div class="card-body">

                                <h5 class="card-title fw-bold text-dark">
                                    {{ $ficha->titulo }}
                                </h5>

                                <p class="card-text text-muted">
                                    {{ Str::limit($ficha->descripcion, 100) }}
                                </p>

                                <p class="small text-secondary mb-1">
                                    <i class="bi bi-building"></i> {{ $ficha->empresa }}
                                </p>

                                <p class="small text-secondary mb-2">
                                    <i class="bi bi-geo-alt"></i> {{ $ficha->ciudad }}
                                </p>

                                {{-- Estado --}}
                                @if($ficha->estado === 'Activa')
                                    <span class="badge bg-success mb-2">Activa</span>
                                @else
                                    <span class="badge bg-secondary mb-2">Cerrada</span>
                                @endif

                                {{-- BOTÓN POSTULARSE CORREGIDO --}}
                                <a href="{{ route('solicitud.create', $ficha->id) }}" 
                                   class="btn btn-primary btn-sm mt-2">
                                    <i class="bi bi-person-plus-fill me-1"></i> Postularse
                                </a>

                            </div>

                        </div>
                    </div>
                @endforeach

            </div>
        @else
            <p class="text-muted">No hay vacantes disponibles en este momento.</p>
        @endif

    </div>
</section>


<footer id="conocenos" class="py-5">
    <div class="container text-white">
        <div class="row align-items-center g-4">
            <div class="col-lg-5 text-center text-lg-start">
                <img src="{{ asset('images/logo.png') }}" alt="Seletech Logo">
                <h2 class="fw-bold mt-3">Conócenos</h2>
                <p class="mb-0">
                    En Seletech conectamos talento con oportunidades reales. Impulsamos equipos de alto desempeño
                    con procesos de reclutamiento claros, ágiles y con enfoque humano.
                </p>
            </div>
            <div class="col-lg-7">
                <div class="row g-4">
                    <div class="col-md-4">
                        <h6 class="text-uppercase text-acento">Lo que hacemos</h6>
                        <ul class="list-unstyled small mb-0">
                            <li><i class="bi bi-check-circle-fill text-primary me-2"></i>Reclutamiento IT</li>
                            <li><i class="bi bi-check-circle-fill text-primary me-2"></i>Perfiles especializados</li>
                            <li><i class="bi bi-check-circle-fill text-primary me-2"></i>Onboarding y seguimiento</li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h6 class="text-uppercase text-acento">Nuestros valores</h6>
                        <ul class="list-unstyled small mb-0">
                            <li><i class="bi bi-shield-check text-primary me-2"></i>Transparencia</li>
                            <li><i class="bi bi-people-fill text-primary me-2"></i>Empatía</li>
                            <li><i class="bi bi-speedometer2 text-primary me-2"></i>Agilidad</li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h6 class="text-uppercase text-acento">Contacto</h6>
                        <ul class="list-unstyled small mb-3">
                            <li>
                                <i class="bi bi-envelope-fill text-primary me-2"></i>
                                <a href="mailto:contacto@seletech.com" class="link-light text-decoration-none">
                                    SelecTech@gmail.com
                                </a>
                            </li>
                            <li><i class="bi bi-geo-alt-fill text-primary me-2"></i>CDMX, México</li>
                        </ul>
                        <div class="d-flex gap-2">
                            <a href="#" class="btn btn-outline-light btn-sm"><i class="bi bi-linkedin"></i></a>
                            <a href="#" class="btn btn-outline-light btn-sm"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="btn btn-outline-light btn-sm"><i class="bi bi-twitter-x"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
