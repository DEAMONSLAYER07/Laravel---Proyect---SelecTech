@extends('layouts.app')

@section('title', 'SeleTech RH - Detalle del Postulante')

@section('content')
<style>
    :root {
        --primary-blue: #0a1f44;
        --secondary-blue: #004a99;
        --accent-blue: #007bff;
        --success-green: #28a745;
        --danger-red: #dc3545;
        --warning-yellow: #ffc107;
    }

    body {
        background: linear-gradient(135deg, #f5f7fa 0%, #e9ecef 100%);
    }

    .profile-container {
        max-width: 1200px;
        margin: 2rem auto;
        padding: 0 15px;
    }

    .profile-header {
        background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
        color: white;
        padding: 2rem;
        border-radius: 16px 16px 0 0;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .profile-header h2 {
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .profile-header p {
        opacity: 0.9;
        margin: 0;
    }

    .profile-body {
        background: white;
        padding: 2.5rem;
        border-radius: 0 0 16px 16px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    /* FOTO DEL POSTULANTE */
    .candidate-photo-wrapper {
        text-align: center;
        margin-bottom: 2rem;
    }

    .foto-postulante {
        width: 200px;
        height: 250px;
        object-fit: cover;
        border-radius: 16px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
        border: 4px solid white;
        transition: transform 0.3s ease;
    }

    .foto-postulante:hover {
        transform: scale(1.05);
    }

    .candidate-name {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--primary-blue);
        margin-top: 1rem;
        margin-bottom: 0.5rem;
    }

    .position-badge {
        display: inline-block;
        background: linear-gradient(135deg, var(--accent-blue), var(--secondary-blue));
        color: white;
        padding: 0.5rem 1.5rem;
        border-radius: 25px;
        font-weight: 600;
        font-size: 0.95rem;
        box-shadow: 0 4px 12px rgba(0, 123, 255, 0.3);
    }

    /* SECCIÓN DE INFORMACIÓN */
    .info-section {
        margin-bottom: 2rem;
    }

    .section-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--primary-blue);
        margin-bottom: 1.5rem;
        padding-bottom: 0.5rem;
        border-bottom: 3px solid var(--accent-blue);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .section-title i {
        font-size: 1.5rem;
        color: var(--accent-blue);
    }

    /* CARDS DE INFORMACIÓN */
    .info-card {
        background: #f8f9fa;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        border-left: 4px solid var(--accent-blue);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }

    .info-card:hover {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        transform: translateY(-2px);
    }

    .info-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1rem;
        margin-bottom: 1rem;
    }

    .info-item {
        display: flex;
        flex-direction: column;
        padding: 0.75rem;
        background: white;
        border-radius: 8px;
        transition: all 0.2s ease;
    }

    .info-item:hover {
        background: #f0f7ff;
    }

    .info-label {
        font-size: 0.85rem;
        font-weight: 600;
        color: #6c757d;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.3rem;
    }

    .info-value {
        font-size: 1rem;
        color: #333;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .info-value i {
        color: var(--accent-blue);
        font-size: 1.1rem;
    }

    /* FICHA DE TRABAJO */
    .ficha-card {
        background: linear-gradient(135deg, #fff9e6 0%, #fff4d4 100%);
        border: 2px solid var(--warning-yellow);
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .ficha-card .info-item {
        background: white;
    }

    /* ASIGNAR FICHA */
    .assign-ficha-form {
        background: #e7f3ff;
        border: 2px dashed var(--accent-blue);
        border-radius: 12px;
        padding: 2rem;
        text-align: center;
    }

    .assign-ficha-form select {
        max-width: 500px;
        margin: 1rem auto;
    }

    /* BOTONES DE ACCIÓN */
    .action-buttons {
        display: flex;
        justify-content: center;
        gap: 1rem;
        margin-top: 2rem;
        flex-wrap: wrap;
    }

    .btn-action {
        padding: 0.75rem 2.5rem;
        border-radius: 10px;
        font-weight: 600;
        font-size: 1rem;
        border: none;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
    }

    .btn-back {
        background: #6c757d;
        color: white;
    }

    .btn-back:hover {
        background: #5a6268;
    }

    .btn-hire {
        background: linear-gradient(135deg, var(--success-green), #20c997);
        color: white;
    }

    .btn-hire:hover {
        background: linear-gradient(135deg, #218838, #1ea87a);
    }

    .btn-reject {
        background: linear-gradient(135deg, var(--danger-red), #c82333);
        color: white;
    }

    .btn-reject:hover {
        background: linear-gradient(135deg, #c82333, #bd2130);
    }

    /* ALERTAS */
    .custom-alert {
        border-radius: 12px;
        padding: 1.5rem;
        border: none;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    .custom-alert i {
        font-size: 1.5rem;
        margin-right: 10px;
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {
        .foto-postulante {
            width: 150px;
            height: 187px;
        }

        .candidate-name {
            font-size: 1.2rem;
        }

        .profile-header {
            padding: 1.5rem;
        }

        .profile-body {
            padding: 1.5rem;
        }

        .info-row {
            grid-template-columns: 1fr;
        }

        .action-buttons {
            flex-direction: column;
        }

        .btn-action {
            width: 100%;
            justify-content: center;
        }
    }

    /* ANIMACIÓN DE ENTRADA */
    .fade-in {
        animation: fadeIn 0.5s ease-in;
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
</style>

<div class="profile-container fade-in">
    
    <!-- HEADER -->
    <div class="profile-header">
        <div class="text-center">
            <!-- <i class="bi bi-person-badge-fill" style="font-size: 3rem;"></i> -->
            <h2>Perfil del Postulante</h2>
            <!-- <p>Análisis detallado del candidato registrado</p> -->
        </div>
    </div>

    <!-- BODY -->
    <div class="profile-body">

        <!-- FOTO Y NOMBRE -->
        <div class="candidate-photo-wrapper">
            <img src="{{ asset('storage/' . $solicitud->foto) }}" 
                 alt="Foto del postulante" 
                 class="foto-postulante">

            <h3 class="candidate-name">
                {{ $solicitud->nombre }} {{ $solicitud->apellido_paterno }} {{ $solicitud->apellido_materno }}
            </h3>

            <span class="position-badge">
                {{ $solicitud->ficha->titulo ?? 'Sin ficha asignada' }}
            </span>
        </div>

        <!-- INFORMACIÓN PERSONAL -->
        <div class="info-section">
            <h4 class="section-title">
                <i class="bi bi-person-circle"></i>
                Información Personal
            </h4>

            <div class="info-card">
                <div class="info-row">
                    <div class="info-item">
                        <span class="info-label">Edad</span>
                        <span class="info-value">{{ $solicitud->edad }} años</span>
                    </div>

                    <div class="info-item">
                        <span class="info-label">Sexo</span>
                        <span class="info-value">{{ $solicitud->sexo == 'M' ? 'Masculino' : 'Femenino' }}</span>
                    </div>

                    <div class="info-item">
                        <span class="info-label">Correo Electrónico</span>
                        <span class="info-value">
                            <i class="bi bi-envelope-fill"></i>
                            {{ $solicitud->correo }}
                        </span>
                    </div>

                    <div class="info-item">
                        <span class="info-label">Teléfono</span>
                        <span class="info-value">
                            <i class="bi bi-telephone-fill"></i>
                            {{ $solicitud->telefono }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- INFORMACIÓN DE DOMICILIO -->
        <div class="info-section">
            <h4 class="section-title">
                <i class="bi bi-geo-alt-fill"></i>
                Domicilio
            </h4>

            <div class="info-card">
                <div class="info-row">
                    <div class="info-item">
                        <span class="info-label">Calle y Número</span>
                        <span class="info-value">{{ $solicitud->domicilio }}</span>
                    </div>

                    <div class="info-item">
                        <span class="info-label">Colonia</span>
                        <span class="info-value">{{ $solicitud->colonia }}</span>
                    </div>

                    <div class="info-item">
                        <span class="info-label">Municipio</span>
                        <span class="info-value">{{ $solicitud->municipio }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- DOCUMENTOS OFICIALES -->
        <div class="info-section">
            <h4 class="section-title">
                <i class="bi bi-file-earmark-text-fill"></i>
                Documentos Oficiales
            </h4>

            <div class="info-card">
                <div class="info-row">
                    <div class="info-item">
                        <span class="info-label">CURP</span>
                        <span class="info-value">{{ $solicitud->curp }}</span>
                    </div>

                    <div class="info-item">
                        <span class="info-label">RFC</span>
                        <span class="info-value">{{ $solicitud->rfc }}</span>
                    </div>

                    <div class="info-item">
                        <span class="info-label">NSS</span>
                        <span class="info-value">{{ $solicitud->nss ?? 'No especificado' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- INFORMACIÓN ADICIONAL -->
        <div class="info-section">
            <h4 class="section-title">
                <i class="bi bi-heart-pulse-fill"></i>
                Estado de Salud y Hábitos
            </h4>

            <div class="info-card">
                <div class="info-row">
                    <div class="info-item">
                        <span class="info-label">¿Padece alguna enfermedad?</span>
                        <span class="info-value">{{ $solicitud->enfermedad ?? 'No' }}</span>
                    </div>

                    <div class="info-item">
                        <span class="info-label">¿Pertenece a algún club?</span>
                        <span class="info-value">{{ $solicitud->club ?? 'No' }}</span>
                    </div>

                    <div class="info-item">
                        <span class="info-label">¿Practica algún deporte?</span>
                        <span class="info-value">{{ $solicitud->deporte ?? 'No' }}</span>
                    </div>

                    <div class="info-item" style="grid-column: 1 / -1;">
                        <span class="info-label">Meta Personal</span>
                        <span class="info-value">{{ $solicitud->meta ?? 'No especificado' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- FICHA DE TRABAJO -->
        <div class="info-section">
            <h4 class="section-title">
                <i class="bi bi-briefcase-fill"></i>
                Información de la Ficha de Trabajo
            </h4>

            @if(!$solicitud->ficha)
                <!-- ASIGNAR FICHA -->
                <div class="assign-ficha-form">
                    <i class="bi bi-exclamation-circle" style="font-size: 3rem; color: var(--accent-blue);"></i>
                    <h5 class="mt-3 mb-3">Esta solicitud no tiene ficha asignada</h5>
                    
                    <form action="{{ route('rh.asignarFicha', $solicitud->id) }}" method="POST">
                        @csrf
                        <select name="id_ficha" class="form-select" required>
                            <option value="">-- Selecciona una ficha de trabajo --</option>
                            @foreach(\App\Models\FichaTrabajo::all() as $f)
                                <option value="{{ $f->id }}">
                                    {{ $f->titulo }} — {{ $f->empresa }} ({{ $f->ciudad }})
                                </option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-primary btn-action mt-3">
                            <i class="bi bi-check-circle-fill"></i> Asignar Ficha
                        </button>
                    </form>
                </div>
            @else
                <!-- INFORMACIÓN DE LA FICHA -->
                <div class="ficha-card">
                    <div class="info-row">
                        <div class="info-item">
                            <span class="info-label">Puesto</span>
                            <span class="info-value">{{ $solicitud->ficha->titulo }}</span>
                        </div>

                        <div class="info-item">
                            <span class="info-label">Empresa</span>
                            <span class="info-value">{{ $solicitud->ficha->empresa }}</span>
                        </div>

                        <div class="info-item">
                            <span class="info-label">Ciudad</span>
                            <span class="info-value">{{ $solicitud->ficha->ciudad }}</span>
                        </div>

                        <div class="info-item">
                            <span class="info-label">Modalidad</span>
                            <span class="info-value">{{ $solicitud->ficha->modalidad }}</span>
                        </div>

                        <div class="info-item">
                            <span class="info-label">Experiencia Requerida</span>
                            <span class="info-value">{{ $solicitud->ficha->experiencia }}</span>
                        </div>

                        <div class="info-item">
                            <span class="info-label">Área</span>
                            <span class="info-value">{{ $solicitud->ficha->area }}</span>
                        </div>

                        <div class="info-item">
                            <span class="info-label">Estado</span>
                            <span class="info-value">
                                <span class="badge bg-{{ $solicitud->ficha->estado == 'Activa' ? 'success' : 'secondary' }}">
                                    {{ $solicitud->ficha->estado }}
                                </span>
                            </span>
                        </div>

                        @if($solicitud->ficha->observaciones)
                        <div class="info-item" style="grid-column: 1 / -1;">
                            <span class="info-label">Observaciones</span>
                            <span class="info-value">{{ $solicitud->ficha->observaciones }}</span>
                        </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>

        <!-- BOTONES DE ACCIÓN -->
        <div class="action-buttons">
            <a href="{{ route('rh.dashboard') }}" class="btn-action btn-back">
                <i class="bi bi-arrow-left-circle-fill"></i>
                Regresar al Dashboard
            </a>

            @if ($solicitud->ficha)
                <form action="{{ route('rh.actualizarEstadoFicha', [$solicitud->ficha->id, 'Contratado']) }}" 
                      method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn-action btn-hire">
                        <i class="bi bi-check-circle-fill"></i>
                        Contratar
                    </button>
                </form>

                <form action="{{ route('rh.actualizarEstadoFicha', [$solicitud->ficha->id, 'Rechazado']) }}" 
                      method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn-action btn-reject" 
                            onclick="return confirm('¿Estás seguro de rechazar este candidato?')">
                        <i class="bi bi-x-circle-fill"></i>
                        Rechazar
                    </button>
                </form>
            @else
                <div class="custom-alert alert-warning" style="margin-top: 1rem;">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                    <strong>Atención:</strong> No puedes contratar o rechazar porque esta solicitud no tiene ficha asignada.
                </div>
            @endif
        </div>

    </div>

    <!-- FOOTER -->
    <div class="text-center mt-4" style="color: #6c757d; font-size: 0.9rem;">
        © {{ date('Y') }} SeleTech RH — Sistema de Reclutamiento y Gestión de Talento
    </div>

</div>
@endsection