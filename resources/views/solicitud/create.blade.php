<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitud de Empleo - {{ $ficha->titulo }}</title>

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
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e9ecef 100%);
            min-height: 100vh;
            padding: 2rem 0;
        }

        .form-wrapper {
            max-width: 1100px;
            margin: 0 auto;
            padding: 0 15px;
        }

        /* Header */
        .form-header {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
            color: white;
            padding: 2.5rem;
            border-radius: 20px 20px 0 0;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .form-header i {
            font-size: 3.5rem;
            margin-bottom: 1rem;
        }

        .form-header h1 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .position-badge {
            display: inline-block;
            background: rgba(255, 255, 255, 0.2);
            padding: 0.75rem 2rem;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 600;
            margin-top: 1rem;
        }

        .form-subtitle {
            opacity: 0.9;
            margin-top: 0.5rem;
        }

        /* Form Body */
        .form-body {
            background: white;
            padding: 3rem;
            border-radius: 0 0 20px 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        /* Progress Steps */
        .progress-steps {
            display: flex;
            justify-content: space-between;
            margin-bottom: 3rem;
            position: relative;
        }

        .progress-steps::before {
            content: '';
            position: absolute;
            top: 20px;
            left: 0;
            right: 0;
            height: 2px;
            background: #e9ecef;
            z-index: 0;
        }

        .step {
            flex: 1;
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .step-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #e9ecef;
            color: #6c757d;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            margin-bottom: 0.5rem;
            transition: all 0.3s ease;
        }

        .step.active .step-circle {
            background: var(--accent-blue);
            color: white;
            box-shadow: 0 4px 12px rgba(0, 123, 255, 0.4);
        }

        .step.completed .step-circle {
            background: var(--success-green);
            color: white;
        }

        .step-label {
            font-size: 0.85rem;
            color: #6c757d;
            font-weight: 500;
        }

        .step.active .step-label {
            color: var(--accent-blue);
            font-weight: 600;
        }

        /* Sections */
        .form-section {
            margin-bottom: 3rem;
            animation: fadeIn 0.5s ease;
        }

        .section-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--primary-blue);
            margin-bottom: 1.5rem;
            padding-bottom: 0.75rem;
            border-bottom: 3px solid var(--accent-blue);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .section-title i {
            color: var(--accent-blue);
            font-size: 1.6rem;
        }

        /* Form Controls */
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
            font-size: 0.9rem;
        }

        .form-label .required {
            color: #dc3545;
            margin-left: 2px;
        }

        .form-control {
            border-radius: 10px;
            border: 2px solid #e9ecef;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }

        .form-control:focus {
            border-color: var(--accent-blue);
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.15);
            background: white;
        }

        .form-check-input {
            width: 1.25rem;
            height: 1.25rem;
            margin-top: 0.15rem;
        }

        .form-check-input:checked {
            background-color: var(--accent-blue);
            border-color: var(--accent-blue);
        }

        /* Photo Upload */
        .photo-upload-section {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 2rem;
            border-radius: 16px;
            text-align: center;
            border: 2px dashed #dee2e6;
        }

        .photo-preview {
            width: 200px;
            height: 250px;
            margin: 0 auto 1.5rem;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
            background: white;
        }

        .photo-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .file-input-wrapper {
            position: relative;
            display: inline-block;
        }

        .file-input-wrapper input[type="file"] {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        .file-input-label {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--accent-blue);
            color: white;
            padding: 0.75rem 2rem;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .file-input-label:hover {
            background: var(--secondary-blue);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 123, 255, 0.3);
        }

        /* Alerts */
        .alert {
            border-radius: 12px;
            border: none;
            padding: 1.25rem;
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 2rem;
        }

        .alert i {
            font-size: 1.5rem;
        }

        .alert-success {
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
            color: #155724;
        }

        .alert-danger {
            background: linear-gradient(135deg, #f8d7da, #f5c2c7);
            color: #842029;
        }

        /* Buttons */
        .btn-action {
            padding: 0.875rem 2.5rem;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            border: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .btn-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        .btn-submit {
            background: linear-gradient(135deg, var(--success-green), #20c997);
            color: white;
        }

        .btn-submit:hover {
            background: linear-gradient(135deg, #218838, #1ea87a);
            color: white;
        }

        .btn-cancel {
            background: #6c757d;
            color: white;
        }

        .btn-cancel:hover {
            background: #5a6268;
            color: white;
        }

        .form-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 3rem;
            padding-top: 2rem;
            border-top: 2px solid #e9ecef;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .form-header {
                padding: 2rem 1.5rem;
            }

            .form-header h1 {
                font-size: 1.5rem;
            }

            .form-body {
                padding: 2rem 1.5rem;
            }

            .progress-steps {
                flex-direction: column;
                gap: 1rem;
            }

            .progress-steps::before {
                display: none;
            }

            .step {
                display: flex;
                align-items: center;
                gap: 1rem;
                text-align: left;
            }

            .photo-preview {
                width: 150px;
                height: 187px;
            }

            .form-actions {
                flex-direction: column;
                gap: 1rem;
            }

            .btn-action {
                width: 100%;
                justify-content: center;
            }
        }

        /* Animation */
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
</head>
<body>

<div class="form-wrapper">
    
    <!-- HEADER -->
    <div class="form-header">
        <i class="bi bi-file-earmark-person-fill"></i>
        <h1>Solicitud de Empleo</h1>
        <div class="position-badge">
            {{ $ficha->titulo }}
        </div>
        <p class="form-subtitle mt-3">
            Completa el formulario con tus datos. La información será tratada de forma confidencial.
        </p>
    </div>

    <!-- FORM BODY -->
    <div class="form-body">

        <!-- ALERTS -->
        @if(session('success'))
            <div class="alert alert-success">
                <i class="bi bi-check-circle-fill"></i>
                <div>
                    <strong>¡Éxito!</strong><br>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <i class="bi bi-exclamation-triangle-fill"></i>
                <div>
                    <strong>Por favor corrige los siguientes errores:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <!-- FORM -->
        <form action="{{ route('solicitud.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id_ficha" value="{{ $ficha->id }}">

            <!-- SECCIÓN 1: DATOS PERSONALES -->
            <div class="form-section">
                <h3 class="section-title">
                    <i class="bi bi-person-circle"></i>
                    Datos Personales
                </h3>

                <div class="row">
                    <div class="col-md-9">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">
                                    Apellido Paterno <span class="required">*</span>
                                </label>
                                <input type="text" name="apellido_paterno" class="form-control" 
                                       value="{{ old('apellido_paterno') }}" required>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">
                                    Apellido Materno <span class="required">*</span>
                                </label>
                                <input type="text" name="apellido_materno" class="form-control" 
                                       value="{{ old('apellido_materno') }}" required>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">
                                    Nombre(s) <span class="required">*</span>
                                </label>
                                <input type="text" name="nombre" class="form-control" 
                                       value="{{ old('nombre') }}" required>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">
                                    <i class="bi bi-calendar"></i> Edad <span class="required">*</span>
                                </label>
                                <input type="number" name="edad" class="form-control" 
                                       min="18" max="99" value="{{ old('edad') }}" required>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">
                                    <i class="bi bi-gender-ambiguous"></i> Sexo <span class="required">*</span>
                                </label>
                                <div class="d-flex gap-4 mt-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="sexo" 
                                               id="sexoM" value="M" {{ old('sexo') == 'M' ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="sexoM">Masculino</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="sexo" 
                                               id="sexoF" value="F" {{ old('sexo') == 'F' ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="sexoF">Femenino</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="photo-upload-section">
                            <label class="form-label mb-3">Fotografía <span class="required">*</span></label>
                            <div class="photo-preview">
                                <img id="preview" src="{{ asset('images/default_photo.png') }}" alt="Vista previa">
                            </div>
                            <div class="file-input-wrapper">
                                <input type="file" name="foto" id="foto" accept="image/*" required>
                                <label for="foto" class="file-input-label">
                                    <i class="bi bi-camera-fill"></i>
                                    Select Foto
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SECCIÓN 2: CONTACTO Y DOMICILIO -->
            <div class="form-section">
                <h3 class="section-title">
                    <i class="bi bi-geo-alt-fill"></i>
                    Contacto y Domicilio
                </h3>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">
                            <i class="bi bi-house-door"></i> Domicilio <span class="required">*</span>
                        </label>
                        <input type="text" name="domicilio" class="form-control" 
                               placeholder="Calle y número" value="{{ old('domicilio') }}" required>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Colonia <span class="required">*</span></label>
                        <input type="text" name="colonia" class="form-control" 
                               value="{{ old('colonia') }}" required>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Municipio <span class="required">*</span></label>
                        <input type="text" name="municipio" class="form-control" 
                               value="{{ old('municipio') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">
                            <i class="bi bi-envelope"></i> Correo Electrónico <span class="required">*</span>
                        </label>
                        <input type="email" name="correo" class="form-control" 
                               placeholder="ejemplo@correo.com" value="{{ old('correo') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">
                            <i class="bi bi-telephone"></i> Teléfono
                        </label>
                        <input type="text" name="telefono" class="form-control" 
                               placeholder="10 dígitos" value="{{ old('telefono') }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">
                            <i class="bi bi-card-text"></i> CURP
                        </label>
                        <input type="text" name="curp" class="form-control" 
                               placeholder="18 caracteres" maxlength="18" value="{{ old('curp') }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">
                            <i class="bi bi-card-text"></i> RFC
                        </label>
                        <input type="text" name="rfc" class="form-control" 
                               placeholder="13 caracteres" maxlength="13" value="{{ old('rfc') }}">
                    </div>
                </div>
            </div>

            <!-- SECCIÓN 3: INFORMACIÓN ADICIONAL -->
            <div class="form-section">
                <h3 class="section-title">
                    <i class="bi bi-info-circle-fill"></i>
                    Información Adicional
                </h3>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">
                            <i class="bi bi-heart-pulse"></i> ¿Padece alguna enfermedad?
                        </label>
                        <input type="text" name="enfermedad" class="form-control" 
                               placeholder="Especifique o escriba 'No'" value="{{ old('enfermedad') }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">
                            <i class="bi bi-people"></i> ¿Pertenece a algún club?
                        </label>
                        <input type="text" name="club" class="form-control" 
                               placeholder="Nombre del club o 'No'" value="{{ old('club') }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">
                            <i class="bi bi-trophy"></i> ¿Practica algún deporte?
                        </label>
                        <input type="text" name="deporte" class="form-control" 
                               placeholder="Deporte que practica o 'No'" value="{{ old('deporte') }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">
                            <i class="bi bi-star"></i> Meta en la vida
                        </label>
                        <input type="text" name="meta" class="form-control" 
                               placeholder="Describa su meta profesional" value="{{ old('meta') }}">
                    </div>
                </div>
            </div>

            <!-- ACTIONS -->
            <div class="form-actions">
                <a href="{{ url('/') }}" class="btn-action btn-cancel">
                    <i class="bi bi-x-circle"></i>
                    Cancelar
                </a>

                <button type="submit" class="btn-action btn-submit">
                    <i class="bi bi-send-fill"></i>
                    Enviar Solicitud
                </button>
            </div>

        </form>

    </div>

    <!-- FOOTER -->
    <div class="text-center mt-4" style="color: #6c757d; font-size: 0.9rem;">
        © {{ date('Y') }} SeleTech — Tu información está protegida
    </div>

</div>

<script>
// Preview de foto
document.getElementById('foto').addEventListener('change', function(e) {
    if (e.target.files && e.target.files[0]) {
        const reader = new FileReader();
        reader.onload = function(event) {
            document.getElementById('preview').src = event.target.result;
        };
        reader.readAsDataURL(e.target.files[0]);
    }
});
</script>

</body>
</html>