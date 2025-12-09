@extends('layouts.app')

@section('title', 'Panel de Recursos Humanos')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #004080 0%, #007bff 50%, #00bfff 100%);
        font-family: 'Poppins', sans-serif;
        color: #333;
    }

    .card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 6px 18px rgba(0,0,0,0.15);
        background: #fff;
        transition: all 0.3s ease;
    }

    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 22px rgba(0,0,0,0.18);
    }

    .tab-pane {
        animation: fadeIn 0.4s ease;
    }

    @keyframes fadeIn {
        from {opacity: 0; transform: translateY(5px);}
        to {opacity: 1; transform: translateY(0);}
    }

    .nav-tabs .nav-link.active {
        background-color: #007bff !important;
        color: white !important;
        font-weight: 600;
        border: none;
        border-radius: 8px;
    }

    .nav-tabs .nav-link {
        color: #004080;
        font-weight: 500;
        transition: all 0.2s;
    }

    .table thead {
        background-color: #007bff;
        color: #fff;
    }

    .btn-primary {
        background: linear-gradient(90deg, #007bff, #0056b3);
        border: none;
    }

    .btn-warning {
        background: linear-gradient(90deg, #ffbb33, #ff8800);
        border: none;
        color: #fff;
    }

    .btn-danger {
        background: linear-gradient(90deg, #ff4444, #cc0000);
        border: none;
    }

    .btn-success {
        background: linear-gradient(90deg, #00c851, #007e33);
        border: none;
    }

    h2, h4 {
        color: #003366;
    }
</style>

<div class="container py-5">
    <h2 class="text-center fw-bold mb-4">
        Recursos Humanos 
    </h2>

    <ul class="nav nav-tabs justify-content-center mb-4 border-0" id="rhTabs" role="tablist">
        <li class="nav-item">
            <button class="nav-link active" id="solicitudes-tab" data-bs-toggle="tab" data-bs-target="#solicitudes" type="button">
                Solicitudes Recibidas
            </button>
        </li>
        <li class="nav-item">
            <button class="nav-link" id="fichas-tab" data-bs-toggle="tab" data-bs-target="#fichas" type="button">
                 Fichas de Trabajo
            </button>
        </li>
    </ul>

    <div class="tab-content" id="rhTabsContent">

        {{-- ============================================================
            🔵 TAB 1 — SOLICITUDES RECIBIDAS
        ============================================================ --}}
        <div class="tab-pane fade show active" id="solicitudes" role="tabpanel">
            <div class="card p-4">
                <h4 class="fw-bold mb-3">Solicitudes Recibidas</h4>

                @if($solicitudes->isEmpty())
                    <div class="alert alert-info text-center">Aún no hay solicitudes registradas.</div>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Correo</th>
                                    <th>Ficha</th>
                                    <th>Fecha de Solicitud</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($solicitudes as $solicitud)
                                    <tr>
                                        <td>{{ $solicitud->nombre }}</td>
                                        <td>{{ $solicitud->correo }}</td>

                                        <td>
                                            {{ $solicitud->ficha->titulo ?? 'Sin ficha asignada' }}
                                        </td>

                                        {{-- SOLO UNA FECHA --}}
                                        <td>
                                            {{ $solicitud->created_at ? $solicitud->created_at->format('d/m/Y') : 'Sin fecha' }}
                                        </td>

                                        <td>
                                            <a href="{{ route('rh.verSolicitud', $solicitud->id) }}" class="btn btn-sm btn-primary">
                                                👁️ Ver
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

        {{-- ============================================================
            🔵 TAB 2 — FICHAS DE TRABAJO
        ============================================================ --}}
        <div class="tab-pane fade" id="fichas" role="tabpanel">
            <div class="card p-4">
                <h4 class="fw-bold mb-3 text-primary">Administrar Fichas de Trabajo</h4>

                @if(session('success'))
                    <div class="alert alert-success text-center">{{ session('success') }}</div>
                @endif

                <a href="{{ route('fichas.create') }}" class="btn btn-success mb-3 fw-semibold">
                     Crear Nueva Ficha
                </a>

                @if($fichas->isEmpty())
                    <div class="alert alert-info text-center">Aún no hay fichas registradas.</div>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>Título</th>
                                    <th>Empresa</th>
                                    <th>Ciudad</th>
                                    <th>Experiencia</th>
                                    <th>Estado</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($fichas as $f)
                                    <tr>
                                        <td>{{ $f->titulo }}</td>
                                        <td>{{ $f->empresa }}</td>
                                        <td>{{ $f->ciudad }}</td>
                                        <td>{{ $f->experiencia }}</td>
                                        <td>
                                            <span class="badge bg-{{ $f->estado == 'Activa' ? 'success' : 'secondary' }}">
                                                {{ $f->estado }}
                                            </span>
                                        </td>

                                        <td class="text-center">
                                            <a href="{{ route('fichas.edit', $f->id) }}" class="btn btn-warning btn-sm me-2">
                                                ✏️ Editar
                                            </a>

                                            <form action="{{ route('fichas.destroy', $f->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('¿Deseas eliminar esta ficha?')">
                                                    🗑️ Eliminar
                                                </button>
                                            </form>
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
</div>
@endsection
