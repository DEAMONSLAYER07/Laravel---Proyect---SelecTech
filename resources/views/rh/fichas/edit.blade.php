@extends('layouts.app')

@section('title', 'Editar Ficha de Trabajo')

@section('content')
<style>
    :root {
        --primary-blue: #0a1f44;
        --secondary-blue: #004a99;
        --accent-blue: #007bff;
        --warning-yellow: #ffc107;
    }

    body {
        background: linear-gradient(135deg, #f5f7fa 0%, #e9ecef 100%);
    }

    .form-container {
        max-width: 900px;
        margin: 2rem auto;
        padding: 0 15px;
    }

    .form-header {
        background: linear-gradient(135deg, #ff9800 0%, #ff6f00 100%);
        color: white;
        padding: 2rem;
        border-radius: 16px 16px 0 0;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .form-header i {
        font-size: 3rem;
        margin-bottom: 0.5rem;
    }

    .form-header h2 {
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        color: white;
    }

    .form-header p {
        opacity: 0.9;
        margin: 0;
    }

    .form-body {
        background: white;
        padding: 2.5rem;
        border-radius: 0 0 16px 16px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    .form-section {
        margin-bottom: 2rem;
        padding-bottom: 2rem;
        border-bottom: 2px solid #f0f0f0;
    }

    .form-section:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }

    .section-title {
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--primary-blue);
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .section-title i {
        color: #ff9800;
        font-size: 1.5rem;
    }

    .form-label {
        font-weight: 600;
        color: #495057;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .form-label i {
        color: var(--accent-blue);
        font-size: 1rem;
    }

    .form-label .required {
        color: #dc3545;
        font-weight: 700;
    }

    .form-control,
    .form-select {
        border-radius: 10px;
        border: 2px solid #e9ecef;
        padding: 0.75rem 1rem;
        transition: all 0.3s ease;
        font-size: 0.95rem;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #ff9800;
        box-shadow: 0 0 0 0.2rem rgba(255, 152, 0, 0.15);
    }

    textarea.form-control {
        resize: vertical;
        min-height: 120px;
    }

    /* ALERTS */
    .alert {
        border-radius: 12px;
        border: none;
        padding: 1rem 1.5rem;
    }

    .alert-danger {
        background: linear-gradient(135deg, #f8d7da, #f5c2c7);
        color: #842029;
    }

    .alert-danger ul {
        margin-bottom: 0;
        padding-left: 1.5rem;
    }

    .alert-danger li {
        margin: 0.25rem 0;
    }

    /* INFO BADGE */
    .info-badge {
        background: linear-gradient(135deg, #e3f2fd, #bbdefb);
        border: 2px solid #2196f3;
        border-radius: 12px;
        padding: 1rem 1.5rem;
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .info-badge i {
        font-size: 2rem;
        color: #1976d2;
    }

    .info-badge .info-content {
        flex: 1;
    }

    .info-badge .info-title {
        font-weight: 700;
        color: #1565c0;
        margin-bottom: 0.25rem;
    }

    .info-badge .info-text {
        color: #1976d2;
        margin: 0;
        font-size: 0.9rem;
    }

    /* BUTTONS */
    .btn-action {
        padding: 0.75rem 2rem;
        border-radius: 10px;
        font-weight: 600;
        font-size: 1rem;
        border: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
    }

    .btn-warning-custom {
        background: linear-gradient(135deg, #ff9800, #f57c00);
        color: white;
    }

    .btn-warning-custom:hover {
        background: linear-gradient(135deg, #f57c00, #e65100);
        color: white;
    }

    .btn-secondary-custom {
        background: #6c757d;
        color: white;
    }

    .btn-secondary-custom:hover {
        background: #5a6268;
        color: white;
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
        margin-top: 2rem;
        padding-top: 2rem;
        border-top: 2px solid #f0f0f0;
    }

    /* HELPER TEXT */
    .form-text {
        font-size: 0.875rem;
        color: #6c757d;
        margin-top: 0.25rem;
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {
        .form-header {
            padding: 1.5rem;
        }

        .form-header h2 {
            font-size: 1.5rem;
        }

        .form-body {
            padding: 1.5rem;
        }

        .form-actions {
            flex-direction: column;
        }

        .btn-action {
            width: 100%;
            justify-content: center;
        }
    }

    /* ANIMATION */
    .fade-in {
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
</style>

<div class="form-container fade-in">
    
    <!-- HEADER -->
    <div class="form-header">
        <i class="bi bi-pencil-square"></i>
        <h2>Editar Vacante</h2>
        <p>Modifica la información de la oferta laboral</p>
    </div>

    <!-- BODY -->
    <div class="form-body">

        <!-- INFO BADGE -->
        <div class="info-badge">
            <i class="bi bi-info-circle-fill"></i>
            <div class="info-content">
                <div class="info-title">Editando: {{ $ficha->titulo }}</div>
                <p class="info-text">Los cambios se aplicarán inmediatamente y serán visibles para los candidatos</p>
            </div>
        </div>

        <!-- ERRORES -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <div class="d-flex align-items-center mb-2">
                    <i class="bi bi-exclamation-triangle-fill me-2" style="font-size: 1.5rem;"></i>
                    <strong>Por favor corrige los siguientes errores:</strong>
                </div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('fichas.update', $ficha->id) }}">
            @csrf
            @method('PUT')

            <!-- SECCIÓN 1: INFORMACIÓN BÁSICA -->
            <div class="form-section">
                <h4 class="section-title">
                    <i class="bi bi-info-circle-fill"></i>
                    Información Básica
                </h4>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="bi bi-briefcase"></i>
                            Puesto / Título <span class="required">*</span>
                        </label>
                        <input type="text" 
                               name="titulo" 
                               class="form-control" 
                               value="{{ old('titulo', $ficha->titulo) }}"
                               required>
                        <div class="form-text">El nombre del puesto</div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="bi bi-building"></i>
                            Empresa <span class="required">*</span>
                        </label>
                        <input type="text" 
                               name="empresa" 
                               class="form-control" 
                               value="{{ old('empresa', $ficha->empresa) }}"
                               required>
                        <div class="form-text">Nombre de la empresa</div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="bi bi-geo-alt"></i>
                            Ciudad <span class="required">*</span>
                        </label>
                        <input type="text" 
                               name="ciudad" 
                               class="form-control" 
                               value="{{ old('ciudad', $ficha->ciudad) }}"
                               required>
                        <div class="form-text">Ubicación del puesto</div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="bi bi-laptop"></i>
                            Modalidad <span class="required">*</span>
                        </label>
                        <select name="modalidad" class="form-select" required>
                            <option value="">-- Selecciona una modalidad --</option>
                            <option value="Presencial" {{ old('modalidad', $ficha->modalidad) == 'Presencial' ? 'selected' : '' }}>
                                🏢 Presencial
                            </option>
                            <option value="Híbrido" {{ old('modalidad', $ficha->modalidad) == 'Híbrido' ? 'selected' : '' }}>
                                🔄 Híbrido
                            </option>
                            <option value="Remoto" {{ old('modalidad', $ficha->modalidad) == 'Remoto' ? 'selected' : '' }}>
                                🌍 Remoto
                            </option>
                        </select>
                        <div class="form-text">Tipo de trabajo</div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        <i class="bi bi-file-text"></i>
                        Descripción del Puesto <span class="required">*</span>
                    </label>
                    <textarea name="descripcion" 
                              class="form-control"
                              required>{{ old('descripcion', $ficha->descripcion) }}</textarea>
                    <div class="form-text">Descripción detallada de la vacante</div>
                </div>
            </div>

            <!-- SECCIÓN 2: REQUISITOS -->
            <div class="form-section">
                <h4 class="section-title">
                    <i class="bi bi-award-fill"></i>
                    Requisitos y Compensación
                </h4>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="bi bi-graph-up"></i>
                            Experiencia Requerida <span class="required">*</span>
                        </label>
                        <input type="text" 
                               name="experiencia" 
                               class="form-control"
                               value="{{ old('experiencia', $ficha->experiencia) }}"
                               required>
                        <div class="form-text">Años de experiencia o nivel requerido</div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="bi bi-cash-stack"></i>
                            Salario (opcional)
                        </label>
                        <input type="text" 
                               name="salario" 
                               class="form-control" 
                               value="{{ old('salario', $ficha->salario) }}">
                        <div class="form-text">Rango salarial ofrecido</div>
                    </div>
                </div>
            </div>

            <!-- SECCIÓN 3: ESTADO DE LA VACANTE -->
            <div class="form-section">
                <h4 class="section-title">
                    <i class="bi bi-toggle-on"></i>
                    Estado de la Vacante
                </h4>

                <div class="mb-3">
                    <label class="form-label">
                        <i class="bi bi-check-circle"></i>
                        Estado <span class="required">*</span>
                    </label>
                    <select name="estado" class="form-select" required>
                        <option value="Activa" {{ old('estado', $ficha->estado) == 'Activa' ? 'selected' : '' }}>
                            ✅ Activa (los candidatos pueden postularse)
                        </option>
                        <option value="Cerrada" {{ old('estado', $ficha->estado) == 'Cerrada' ? 'selected' : '' }}>
                            🚫 Cerrada (no se aceptan postulaciones)
                        </option>
                    </select>
                    <div class="form-text">
                        @if($ficha->estado == 'Activa')
                            <span class="text-success fw-semibold">Esta vacante está actualmente activa</span>
                        @else
                            <span class="text-secondary fw-semibold">Esta vacante está actualmente cerrada</span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- BOTONES DE ACCIÓN -->
            <div class="form-actions">
                <a href="{{ route('rh.dashboard') }}" class="btn-action btn-secondary-custom">
                    <i class="bi bi-x-circle"></i>
                    Cancelar
                </a>

                <button type="submit" class="btn-action btn-warning-custom">
                    <i class="bi bi-check-circle-fill"></i>
                    Guardar Cambios
                </button>
            </div>

        </form>

    </div>

    <!-- FOOTER -->
    <div class="text-center mt-4" style="color: #6c757d; font-size: 0.9rem;">
        © {{ date('Y') }} SeleTech RH — Sistema de Reclutamiento
    </div>

</div>
@endsection