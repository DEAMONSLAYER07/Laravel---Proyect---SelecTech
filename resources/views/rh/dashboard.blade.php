@extends('layouts.app')

@section('title', 'Panel de Recursos Humanos')

@section('content')
<style>
    :root {
        --primary-blue: #0a1f44;
        --secondary-blue: #004a99;
        --accent-blue: #007bff;
        --light-blue: #e8ecff;
        --success-green: #28a745;
        --danger-red: #dc3545;
        --warning-yellow: #ffc107;
    }

    body {
        background: linear-gradient(135deg, #f5f7fa 0%, #e9ecef 100%);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: #333;
    }

    .dashboard-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 2rem 15px;
    }

    /* HEADER */
    .dashboard-header {
        background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 8px 24px rgba(10, 31, 68, 0.2);
        color: white;
    }

    .dashboard-header h2 {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        color: white;
    }

    .dashboard-header p {
        opacity: 0.9;
        margin: 0;
        font-size: 1.1rem;
    }

    .dashboard-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin-top: 1.5rem;
    }

    .stat-card {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        border-radius: 12px;
        padding: 1rem;
        text-align: center;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: 700;
        display: block;
        margin-bottom: 0.25rem;
    }

    .stat-label {
        font-size: 0.9rem;
        opacity: 0.9;
    }

    /* TABS */
    .nav-tabs {
        border: none;
        gap: 0.5rem;
        margin-bottom: 2rem;
    }

    .nav-tabs .nav-link {
        padding: 1rem 2rem;
        border-radius: 12px;
        font-weight: 600;
        background: white;
        color: #6c757d;
        border: 2px solid transparent;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .nav-tabs .nav-link:hover {
        color: var(--accent-blue);
        background: #f8f9fa;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .nav-tabs .nav-link.active {
        background: linear-gradient(135deg, var(--accent-blue), var(--secondary-blue));
        color: white !important;
        border-color: var(--accent-blue);
        box-shadow: 0 4px 16px rgba(0, 123, 255, 0.3);
    }

    .nav-tabs .nav-link i {
        margin-right: 8px;
        font-size: 1.2rem;
    }

    /* CARDS */
    .content-card {
        background: white;
        border-radius: 16px;
        padding: 2rem;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
        animation: fadeIn 0.5s ease;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .content-card h4 {
        font-weight: 700;
        color: var(--primary-blue);
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .content-card h4 i {
        color: var(--accent-blue);
    }

    /* TABLES */
    .table-wrapper {
        overflow-x: auto;
        border-radius: 12px;
    }

    .table {
        margin-bottom: 0;
    }

    .table thead {
        background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
        color: white;
    }

    .table thead th {
        border: none;
        padding: 1rem;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
    }

    .table tbody td {
        padding: 1rem;
        vertical-align: middle;
        border-bottom: 1px solid #e9ecef;
    }

    .table-hover tbody tr {
        transition: all 0.2s ease;
    }

    .table-hover tbody tr:hover {
        background: #f8f9fa;
        transform: scale(1.01);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    /* BADGES */
    .badge {
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.85rem;
    }

    .badge.bg-success {
        background: linear-gradient(135deg, var(--success-green), #20c997) !important;
    }

    .badge.bg-secondary {
        background: linear-gradient(135deg, #6c757d, #5a6268) !important;
    }

    /* BUTTONS */
    .btn {
        border-radius: 10px;
        padding: 0.6rem 1.5rem;
        font-weight: 600;
        transition: all 0.3s ease;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--accent-blue), var(--hover-blue, #0056b3));
    }

    .btn-success {
        background: linear-gradient(135deg, var(--success-green), #20c997);
    }

    .btn-warning {
        background: linear-gradient(135deg, var(--warning-yellow), #ffb037);
        color: #333;
    }

    .btn-warning:hover {
        color: white;
    }

    .btn-danger {
        background: linear-gradient(135deg, var(--danger-red), #c82333);
    }

    .btn-sm {
        padding: 0.4rem 1rem;
        font-size: 0.875rem;
    }

    .btn i {
        font-size: 1rem;
    }

    /* EMPTY STATE */
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: #6c757d;
    }

    .empty-state i {
        font-size: 5rem;
        color: #dee2e6;
        margin-bottom: 1rem;
        display: block;
    }

    .empty-state h5 {
        color: var(--primary-blue);
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    /* ALERTS */
    .alert {
        border-radius: 12px;
        border: none;
        padding: 1rem 1.5rem;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .alert i {
        font-size: 1.5rem;
    }

    .alert-success {
        background: linear-gradient(135deg, #d4edda, #c3e6cb);
        color: #155724;
    }

    .alert-info {
        background: linear-gradient(135deg, #d1ecf1, #bee5eb);
        color: #0c5460;
    }

    /* ACTION BUTTONS */
    .action-buttons {
        display: flex;
        gap: 0.5rem;
        justify-content: center;
        flex-wrap: wrap;
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {
        .dashboard-header {
            padding: 1.5rem;
        }

        .dashboard-header h2 {
            font-size: 1.5rem;
        }

        .dashboard-stats {
            grid-template-columns: repeat(2, 1fr);
        }

        .stat-number {
            font-size: 2rem;
        }

        .nav-tabs .nav-link {
            padding: 0.75rem 1.25rem;
            font-size: 0.9rem;
        }

        .content-card {
            padding: 1.5rem;
        }

        .table thead th,
        .table tbody td {
            padding: 0.75rem 0.5rem;
            font-size: 0.85rem;
        }

        .action-buttons {
            flex-direction: column;
        }

        .action-buttons .btn {
            width: 100%;
        }
    }

    /* LOADING ANIMATION */
    .fade-in {
        animation: fadeIn 0.5s ease;
    }
</style>

<div class="dashboard-container">
    
    <!-- HEADER CON ESTADÍSTICAS -->
    <div class="dashboard-header fade-in">
        <div class="text-center">
            <i class="bi bi-speedometer2" style="font-size: 3rem;"></i>
            <h2>Panel de Recursos Humanos</h2>
            <p>Gestiona solicitudes, fichas de trabajo y procesos de reclutamiento</p>
        </div>

        <div class="dashboard-stats">
            <div class="stat-card">
                <span class="stat-number">{{ $solicitudes->count() }}</span>
                <span class="stat-label">Solicitudes</span>
            </div>
            <div class="stat-card">
                <span class="stat-number">{{ $fichas->count() }}</span>
                <span class="stat-label">Total de Fichas</span>
            </div>
            <div class="stat-card">
                <span class="stat-number">{{ $fichas->where('estado', 'Activa')->count() }}</span>
                <span class="stat-label">Vacantes Abiertas</span>
            </div>
        </div>
    </div>

    <!-- TABS -->
    <ul class="nav nav-tabs justify-content-center" id="rhTabs" role="tablist">
        <li class="nav-item">
            <button class="nav-link active" id="solicitudes-tab" data-bs-toggle="tab" data-bs-target="#solicitudes" type="button">
                <i class="bi bi-inbox-fill"></i>
                Solicitudes Recibidas
            </button>
        </li>
        <li class="nav-item">
            <button class="nav-link" id="fichas-tab" data-bs-toggle="tab" data-bs-target="#fichas" type="button">
                <i class="bi bi-briefcase-fill"></i>
                Fichas de Trabajo
            </button>
        </li>
    </ul>

    <!-- TAB CONTENT -->
    <div class="tab-content" id="rhTabsContent">

        <!-- TAB 1: SOLICITUDES -->
        <div class="tab-pane fade show active" id="solicitudes" role="tabpanel">
            <div class="content-card">
                <h4>
                    <i class="bi bi-person-lines-fill"></i>
                    Solicitudes Recibidas
                </h4>

                @if($solicitudes->isEmpty())
                    <div class="empty-state">
                        <i class="bi bi-inbox"></i>
                        <h5>No hay solicitudes registradas</h5>
                        <p>Las solicitudes de los candidatos aparecerán aquí cuando se postulen a las vacantes.</p>
                    </div>
                @else
                    <div class="table-wrapper">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th><i class="bi bi-person me-1"></i> Nombre</th>
                                    <th><i class="bi bi-envelope me-1"></i> Correo</th>
                                    <th><i class="bi bi-briefcase me-1"></i> Ficha</th>
                                    <th><i class="bi bi-calendar me-1"></i> Fecha</th>
                                    <th class="text-center"><i class="bi bi-gear me-1"></i> Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($solicitudes as $solicitud)
                                    <tr>
                                        <td>
                                            <strong>{{ $solicitud->nombre }} {{ $solicitud->apellido_paterno }}</strong>
                                        </td>
                                        <td>
                                            <span class="text-muted">
                                                <i class="bi bi-envelope-fill text-primary me-1"></i>
                                                {{ $solicitud->correo }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($solicitud->ficha)
                                                <span class="badge bg-primary">
                                                    {{ $solicitud->ficha->titulo }}
                                                </span>
                                            @else
                                                <span class="badge bg-secondary">Sin asignar</span>
                                            @endif
                                        </td>
                                        <td>
                                            <small class="text-muted">
                                                <i class="bi bi-clock me-1"></i>
                                                {{ $solicitud->created_at ? $solicitud->created_at->format('d/m/Y H:i') : 'Sin fecha' }}
                                            </small>
                                        </td>
                                        <td>
                                            <div class="action-buttons">
                                                <a href="{{ route('rh.verSolicitud', $solicitud->id) }}" 
                                                   class="btn btn-sm btn-primary">
                                                    <i class="bi bi-eye-fill"></i> Ver Perfil
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

        <!-- TAB 2: FICHAS DE TRABAJO -->
        <div class="tab-pane fade" id="fichas" role="tabpanel">
            <div class="content-card">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="mb-0">
                        <i class="bi bi-clipboard-check-fill"></i>
                        Administrar Fichas de Trabajo
                    </h4>
                    <a href="{{ route('fichas.create') }}" class="btn btn-success">
                        <i class="bi bi-plus-circle-fill"></i> Crear Nueva Ficha
                    </a>
                </div>

                @if(session('success'))
                    <div class="alert alert-success">
                        <i class="bi bi-check-circle-fill"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @if($fichas->isEmpty())
                    <div class="empty-state">
                        <i class="bi bi-folder-x"></i>
                        <h5>No hay fichas registradas</h5>
                        <p>Crea tu primera ficha de trabajo para comenzar a recibir solicitudes.</p>
                        <a href="{{ route('fichas.create') }}" class="btn btn-success mt-3">
                            <i class="bi bi-plus-circle-fill"></i> Crear Primera Ficha
                        </a>
                    </div>
                @else
                    <div class="table-wrapper">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th><i class="bi bi-card-heading me-1"></i> Título</th>
                                    <th><i class="bi bi-building me-1"></i> Empresa</th>
                                    <th><i class="bi bi-geo-alt me-1"></i> Ciudad</th>
                                    <th><i class="bi bi-award me-1"></i> Experiencia</th>
                                    <th><i class="bi bi-toggle-on me-1"></i> Estado</th>
                                    <th class="text-center"><i class="bi bi-tools me-1"></i> Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($fichas as $f)
                                    <tr>
                                        <td><strong>{{ $f->titulo }}</strong></td>
                                        <td>{{ $f->empresa }}</td>
                                        <td>
                                            <i class="bi bi-pin-map-fill text-danger me-1"></i>
                                            {{ $f->ciudad }}
                                        </td>
                                        <td>
                                            <small class="text-muted">{{ $f->experiencia }}</small>
                                        </td>
                                        <td>
                                            <span class="badge bg-{{ $f->estado == 'Activa' ? 'success' : 'secondary' }}">
                                                <i class="bi bi-{{ $f->estado == 'Activa' ? 'check-circle' : 'x-circle' }} me-1"></i>
                                                {{ $f->estado }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="action-buttons">
                                                <a href="{{ route('fichas.edit', $f->id) }}" 
                                                   class="btn btn-sm btn-warning">
                                                    <i class="bi bi-pencil-fill"></i> Editar
                                                </a>

                                                <form action="{{ route('fichas.destroy', $f->id) }}" 
                                                      method="POST" 
                                                      style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="btn btn-sm btn-danger"
                                                            onclick="return confirm('¿Estás seguro de eliminar esta ficha?')">
                                                        <i class="bi bi-trash-fill"></i> Eliminar
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

    </div>

    <!-- FOOTER -->
    <div class="text-center mt-4" style="color: #6c757d; font-size: 0.9rem;">
        © {{ date('Y') }} SeleTech RH — Sistema de Reclutamiento y Gestión de Talento
    </div>

</div>
@endsection