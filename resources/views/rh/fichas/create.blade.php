@extends('layouts.app')

@section('content')
<style>
    :root {
        --primary-blue: #0a1f44;
        --secondary-blue: #004a99;
        --accent-blue: #007bff;
        --success-green: #28a745;
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
        background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
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
        color: var(--accent-blue);
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
        border-color: var(--accent-blue);
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.15);
    }

    .form-control::placeholder {
        color: #adb5bd;
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

    .btn-primary-custom {
        background: linear-gradient(135deg, var(--accent-blue), var(--secondary-blue));
        color: white;
    }

    .btn-primary-custom:hover {
        background: linear-gradient(135deg, var(--secondary-blue), var(--primary-blue));
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

    /* INPUT GROUPS */
    .input-group-text {
        background: #e9ecef;
        border: 2px solid #e9ecef;
        border-radius: 10px 0 0 10px;
        color: #495057;
        font-weight: 500;
    }

    .input-group .form-control {
        border-radius: 0 10px 10px 0;
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
        <i class="bi bi-plus-circle-fill"></i>
        <h2>Crear Nueva Vacante</h2>
        <p>Completa el formulario para publicar una nueva oferta laboral</p>
    </div>

    <!-- BODY -->
    <div class="form-body">

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

        <form method="POST" action="{{ route('fichas.store') }}">
            @csrf

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
                               placeholder="Ej: Desarrollador Full Stack"
                               value="{{ old('titulo') }}"
                               required>
                        <div class="form-text">El nombre del puesto que se publicará</div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="bi bi-building"></i>
                            Empresa <span class="required">*</span>
                        </label>
                        <input type="text" 
                               name="empresa" 
                               class="form-control" 
                               placeholder="Ej: SeleTech RH"
                               value="{{ old('empresa') }}"
                               required>
                        <div class="form-text">Nombre de la empresa contratante</div>
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
                               placeholder="Ej: Ciudad de México"
                               value="{{ old('ciudad') }}"
                               required>
                        <div class="form-text">Ubicación del puesto de trabajo</div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="bi bi-laptop"></i>
                            Modalidad <span class="required">*</span>
                        </label>
                        <select name="modalidad" class="form-select" required>
                            <option value="">-- Selecciona una modalidad --</option>
                            <option value="Presencial" {{ old('modalidad') == 'Presencial' ? 'selected' : '' }}>
                                🏢 Presencial
                            </option>
                            <option value="Híbrido" {{ old('modalidad') == 'Híbrido' ? 'selected' : '' }}>
                                🔄 Híbrido
                            </option>
                            <option value="Remoto" {{ old('modalidad') == 'Remoto' ? 'selected' : '' }}>
                                🌍 Remoto
                            </option>
                        </select>
                        <div class="form-text">Tipo de trabajo (presencial, híbrido o remoto)</div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        <i class="bi bi-file-text"></i>
                        Descripción del Puesto <span class="required">*</span>
                    </label>
                    <textarea name="descripcion" 
                              class="form-control"
                              placeholder="Describe las responsabilidades, requisitos y beneficios del puesto..."
                              required>{{ old('descripcion') }}</textarea>
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
                               placeholder="Ej: 2-3 años en Laravel"
                               value="{{ old('experiencia') }}"
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
                               placeholder="Ej: $15,000 - $22,000 MXN"
                               value="{{ old('salario') }}">
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
                        <option value="Activa" {{ old('estado', 'Activa') == 'Activa' ? 'selected' : '' }}>
                            ✅ Activa (los candidatos pueden postularse)
                        </option>
                        <option value="Cerrada" {{ old('estado') == 'Cerrada' ? 'selected' : '' }}>
                            🚫 Cerrada (no se aceptan postulaciones)
                        </option>
                    </select>
                    <div class="form-text">Define si la vacante está abierta o cerrada</div>
                </div>
            </div>

            <!-- BOTONES DE ACCIÓN -->
            <div class="form-actions">
                <a href="{{ route('rh.dashboard') }}" class="btn-action btn-secondary-custom">
                    <i class="bi bi-x-circle"></i>
                    Cancelar
                </a>

                <button type="submit" class="btn-action btn-primary-custom">
                    <i class="bi bi-check-circle-fill"></i>
                    Publicar Vacante
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