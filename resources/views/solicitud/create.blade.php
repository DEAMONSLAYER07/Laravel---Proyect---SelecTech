<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Solicitud de Empleo - {{ $ficha->titulo }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, sans-serif;
            background: linear-gradient(180deg, #0a1f44 0%, #003b99 50%, #00286b 100%);
            color: #fff;
            min-height: 100vh;
            margin: 0;
            padding-top: 40px;
        }

        .solicitud-container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(6px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 15px;
            color: #fff;
            max-width: 1100px;
            margin: auto;
            box-shadow: 0 0 20px rgba(0,0,0,0.4);
        }

        .solicitud-header h2 {
            color: #4da3ff;
            font-weight: 800;
        }

        .form-control, .form-check-input {
            border-radius: 8px;
            border: 1px solid rgba(255,255,255,0.3);
            background-color: rgba(255,255,255,0.1);
            color: #fff;
        }

        .photo-box {
            border: 2px dashed rgba(255,255,255,0.3);
            border-radius: 12px;
            padding: 5px;
        }
    </style>
</head>
<body>

<div class="container my-5 solicitud-container p-4">

    <div class="solicitud-header text-center mb-4">
        <h2 class="fw-bold text-uppercase border-bottom pb-2">Solicitud de Empleo</h2>

        <p class="mb-0">Cargo solicitado: <strong>{{ $ficha->titulo }}</strong></p>
        <p class="small">Favor de llenar esta solicitud. La información será confidencial.</p>
    </div>

    {{-- Mensaje de éxito --}}
    @if(session('success'))
        <div class="alert alert-success text-center fw-bold">
            {{ session('success') }}
        </div>
    @endif

    {{-- Errores --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Hubo errores:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form action="{{ route('solicitud.store') }}" method="POST" enctype="multipart/form-data" class="p-4">
        @csrf

        {{-- ID de la ficha --}}
        <input type="hidden" name="id_ficha" value="{{ $ficha->id }}">

        <div class="row mb-3 align-items-start">
            <div class="col-md-9">

                <h5 class="fw-bold text-light bg-primary bg-opacity-50 p-2 rounded">Datos Personales</h5>

                <div class="row g-2">
                    <div class="col-md-4">
                        <label>Apellido Paterno</label>
                        <input type="text" name="apellido_paterno" class="form-control" required>
                    </div>

                    <div class="col-md-4">
                        <label>Apellido Materno</label>
                        <input type="text" name="apellido_materno" class="form-control" required>
                    </div>

                    <div class="col-md-4">
                        <label>Nombre(s)</label>
                        <input type="text" name="nombre" class="form-control" required>
                    </div>
                </div>

                <div class="row g-2 mt-2">
                    <div class="col-md-2">
                        <label>Edad</label>
                        <input type="number" name="edad" class="form-control" min="18" max="99" required>
                    </div>

                    <div class="col-md-3">
                        <label>Sexo</label><br>

                        <label class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="sexo" value="M" required>
                            M
                        </label>

                        <label class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="sexo" value="F" required>
                            F
                        </label>
                    </div>
                </div>

                <div class="row g-2 mt-2">
                    <div class="col-md-6">
                        <label>Domicilio</label>
                        <input type="text" name="domicilio" class="form-control" required>
                    </div>

                    <div class="col-md-3">
                        <label>Colonia</label>
                        <input type="text" name="colonia" class="form-control" required>
                    </div>

                    <div class="col-md-3">
                        <label>Municipio</label>
                        <input type="text" name="municipio" class="form-control" required>
                    </div>
                </div>

                <div class="row g-2 mt-2">
                    <div class="col-md-3">
                        <label>Correo electrónico</label>
                        <input type="email" name="correo" class="form-control" required>
                    </div>

                    <div class="col-md-3">
                        <label>Teléfono</label>
                        <input type="text" name="telefono" class="form-control">
                    </div>

                    <div class="col-md-3">
                        <label>CURP</label>
                        <input type="text" name="curp" class="form-control">
                    </div>

                    <div class="col-md-3">
                        <label>RFC</label>
                        <input type="text" name="rfc" class="form-control">
                    </div>
                </div>
            </div>

            <div class="col-md-3 text-center">
                <label class="fw-semibold">Fotografía</label>

                <div class="photo-box mb-2">
                    <img id="preview" src="{{ asset('images/default_photo.png') }}" class="img-thumbnail">
                </div>

                <input type="file" name="foto" id="foto" class="form-control" accept="image/*" required>
            </div>
        </div>

        <h5 class="fw-bold text-light bg-primary bg-opacity-50 p-2 rounded mt-4">Estado de Salud y Hábitos</h5>

        <div class="row g-2">
            <div class="col-md-6">
                <label>¿Padece alguna enfermedad?</label>
                <input type="text" name="enfermedad" class="form-control">
            </div>

            <div class="col-md-6">
                <label>¿Pertenece a algún club?</label>
                <input type="text" name="club" class="form-control">
            </div>

            <div class="col-md-6">
                <label>¿Practica algún deporte?</label>
                <input type="text" name="deporte" class="form-control">
            </div>

            <div class="col-md-6">
                <label>Meta en la vida</label>
                <input type="text" name="meta" class="form-control">
            </div>
        </div>

        <div class="d-flex justify-content-between mt-5">
            <button type="submit" class="btn btn-primary px-4">
                Enviar Solicitud
            </button>

            <a href="{{ url('/') }}" class="btn btn-danger px-4">Salir</a>
        </div>
    </form>
</div>

<script>
document.getElementById('foto').addEventListener('change', function(e) {
    const reader = new FileReader();
    reader.onload = function() {
        document.getElementById('preview').src = reader.result;
    };
    reader.readAsDataURL(e.target.files[0]);
});
</script>

</body>
</html>
