<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                        <i class="bi bi-box-arrow-in-right me-1"></i> Ingresar
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#conocenos">
                        <i class="bi bi-info-circle me-1"></i> Conócenos
                    </a>
                </li>
                @auth
                    @if(auth()->user()->rol === 'admin' || auth()->user()->rol === 'rrhh')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('rh.dashboard') }}">
                                <i class="bi bi-speedometer2 me-1"></i> Panel RH
                            </a>
                        </li>
                    @endif
                @endauth
            </ul>
        </div>
    </div>
</nav>

<!-- HERO SECTION -->
<header class="hero">
    <div class="container">
        <h1>Busca tu futuro con Seletech</h1>
        <p class="mt-3">Explora las vacantes disponibles y aplica en segundos</p>
    </div>
</header>

@php use Illuminate\Support\Str; @endphp

<!-- SECCIÓN VACANTES -->
<section id="vacantes" class="py-5">
    <div class="container">

        <div class="text-center mb-5">
            <h2 class="section-title">Vacantes Disponibles</h2>
            <p class="section-subtitle">Encuentra la oportunidad perfecta para impulsar tu carrera</p>
        </div>

        @if(isset($fichas) && $fichas->count() > 0)
            <div class="row g-4">

                @foreach ($fichas as $ficha)
                    @if($ficha->estado === 'Activa')
                        <div class="col-md-6 col-lg-4">
                            <div class="vacancy-card">
                                
                                <!-- Header de la tarjeta -->
                                <div class="vacancy-header">
                                    <div class="company-badge">
                                        <i class="bi bi-building-fill"></i>
                                    </div>
                                    <h5 class="vacancy-title">{{ $ficha->titulo }}</h5>
                                    <span class="company-name">{{ $ficha->empresa }}</span>
                                </div>

                                <!-- Descripción -->
                                <div class="vacancy-description">
                                    <p>{{ Str::limit($ficha->descripcion, 120) }}</p>
                                </div>

                                <!-- Información detallada -->
                                <div class="vacancy-info-grid">
                                    
                                    <div class="info-badge">
                                        <div class="info-icon location">
                                            <i class="bi bi-geo-alt-fill"></i>
                                        </div>
                                        <div class="info-content">
                                            <span class="info-label">Ubicación</span>
                                            <span class="info-value">{{ $ficha->ciudad }}</span>
                                        </div>
                                    </div>

                                    <div class="info-badge">
                                        <div class="info-icon modality">
                                            <i class="bi bi-laptop"></i>
                                        </div>
                                        <div class="info-content">
                                            <span class="info-label">Modalidad</span>
                                            <span class="info-value">{{ $ficha->modalidad ?? 'No especificado' }}</span>
                                        </div>
                                    </div>

                                    @if($ficha->salario)
                                    <div class="info-badge">
                                        <div class="info-icon salary">
                                            <i class="bi bi-cash-stack"></i>
                                        </div>
                                        <div class="info-content">
                                            <span class="info-label">Salario</span>
                                            <span class="info-value">{{ $ficha->salario }}</span>
                                        </div>
                                    </div>
                                    @endif

                                    <div class="info-badge">
                                        <div class="info-icon experience">
                                            <i class="bi bi-award-fill"></i>
                                        </div>
                                        <div class="info-content">
                                            <span class="info-label">Experiencia</span>
                                            <span class="info-value">{{ $ficha->experiencia }}</span>
                                        </div>
                                    </div>

                                </div>

                                <!-- Botón de postulación -->
                                <a href="{{ route('solicitud.create', $ficha->id) }}" class="btn-apply">
                                    <span>Postularse Ahora</span>
                                    <i class="bi bi-arrow-right-circle-fill"></i>
                                </a>

                            </div>
                        </div>
                    @endif
                @endforeach

            </div>
        @else
            <div class="empty-state py-5">
                <i class="bi bi-inbox"></i>
                <h4>No hay vacantes disponibles</h4>
                <p>En este momento no hay ofertas laborales publicadas. Vuelve pronto.</p>
            </div>
        @endif

    </div>
</section>

<!-- SECCIÓN CONÓCENOS (FOOTER) -->
<footer id="conocenos" class="py-5">
    <div class="container text-white">
        <div class="row align-items-center g-4">
            
            <!-- Columna Izquierda -->
            <div class="col-lg-5 text-center text-lg-start">
                <img src="{{ asset('images/logo.png') }}" alt="Seletech Logo" class="mb-3">
                <h2 class="fw-bold">Conócenos</h2>
                <p class="mb-0">
                    En Seletech conectamos talento con oportunidades reales. Impulsamos equipos de alto desempeño
                    con procesos de reclutamiento claros, ágiles y con enfoque humano.
                </p>
            </div>
            
            <!-- Columna Derecha -->
            <div class="col-lg-7">
                <div class="row g-4">
                    
                    <!-- Lo que hacemos -->
                    <div class="col-md-4">
                        <h6 class="text-uppercase text-acento fw-bold mb-3">Lo que hacemos</h6>
                        <ul class="list-unstyled small mb-0">
                            <li class="mb-2">
                                <i class="bi bi-check-circle-fill text-primary me-2"></i>
                                Reclutamiento IT
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-check-circle-fill text-primary me-2"></i>
                                Perfiles especializados
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-check-circle-fill text-primary me-2"></i>
                                Onboarding y seguimiento
                            </li>
                        </ul>
                    </div>
                    
                    <!-- Nuestros valores -->
                    <div class="col-md-4">
                        <h6 class="text-uppercase text-acento fw-bold mb-3">Nuestros valores</h6>
                        <ul class="list-unstyled small mb-0">
                            <li class="mb-2">
                                <i class="bi bi-shield-check text-primary me-2"></i>
                                Transparencia
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-people-fill text-primary me-2"></i>
                                Empatía
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-speedometer2 text-primary me-2"></i>
                                Agilidad
                            </li>
                        </ul>
                    </div>
                    
                    <!-- Contacto -->
                    <div class="col-md-4">
                        <h6 class="text-uppercase text-acento fw-bold mb-3">Contacto</h6>
                        <ul class="list-unstyled small mb-3">
                            <li class="mb-2">
                                <i class="bi bi-envelope-fill text-primary me-2"></i>
                                <a href="mailto:SelecTech@gmail.com" class="link-light text-decoration-none">
                                    SelecTech@gmail.com
                                </a>
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-geo-alt-fill text-primary me-2"></i>
                                CDMX, México
                            </li>
                        </ul>
                        <div class="d-flex gap-2">
                            <a href="#" class="btn btn-outline-light btn-sm" aria-label="LinkedIn">
                                <i class="bi bi-linkedin"></i>
                            </a>
                            <a href="#" class="btn btn-outline-light btn-sm" aria-label="Facebook">
                                <i class="bi bi-facebook"></i>
                            </a>
                            <a href="#" class="btn btn-outline-light btn-sm" aria-label="Twitter">
                                <i class="bi bi-twitter-x"></i>
                            </a>
                        </div>
                    </div>
                    
                </div>
            </div>
            
        </div>

        <!-- Copyright -->
        <div class="row mt-4 pt-4 border-top border-secondary">
            <div class="col-12 text-center">
                <p class="mb-0 small opacity-75">
                    © {{ date('Y') }} SeleTech - Todos los derechos reservados
                </p>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>