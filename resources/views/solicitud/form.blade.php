@extends('layouts.app')

@section('title', 'Postularse a la Vacante')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #002b5a 0%, #003a7a 50%, #0055c9 100%);
        font-family: 'Poppins', sans-serif;
    }

    .form-card {
        background: rgba(255, 255, 255, 0.12);
        backdrop-filter: blur(15px);
        border-radius: 20px;
        padding: 35px;
        color: white;
        box-shadow: 0 8px 25px rgba(0,0,0,0.25);
    }

    .input-custom {
        background: rgba(255,255,255,0.1);
        border: 1px solid rgba(255,255,255,0.3);
        color: #fff;
    }

    .input-custom::placeholder {
        color: #d8e4ff;
    }

    .input-custom:focus {
        background: rgba(255,255,255,0.15);
        border-color: #3db2ff;
        box-shadow: 0 0 5px rgba(0,140,255,0.7);
        color: #fff;
    }

    label {
        font-weight: bold;
        color: #d8e4ff;
    }

    .title-box {
        font-size: 28px;
        font-weight: 700;
        color: #ffffff;
    }

    .badge-vacante {
        background: #0d6efd;
        padding: 10px 20px;
        border-radius: 20px;
        font-size: 15px;
        margin-bottom: 10px;
        display: inline-block;
    }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7">

            {{-- Header --}}
            <div class="text-center mb-4">
                <span class="badge-vacante">
                    Vacante: <strong>{{ $ficha->titulo }}</strong>
                </span>
                <h2 class="title-box">Formulario de Postulación</h2>
                <p class="text-light">Completa la información para aplicar a esta oportunidad laboral</p>
            </div>

            {{-- Card --}}
            <div class="form-card">

                {{-- Errores --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>⚠️ {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('solicitud.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Ocultar el id de la vacante --}}
                    <input type="hidden" name="id_ficha" value="{{ $ficha->id }}">

                    <div class="mb-3">
                        <label>Nombre completo</label>
                        <input type="text" name="nombre" class="form-control input-custom" placeholder="Ej. Juan Pérez López" required>
                    </div>

                    <div class="mb-3">
                        <label>Correo electrónico</label>
                        <input type="email" name="correo" class="form-control input-custom" placeholder="ejemplo@correo.com" required>
                    </div>

                    <div class="mb-3">
                        <label>Teléfono</label>
                        <input type="text" name="telefono" class="form-control input-custom" placeholder="Ej. 7711234567">
                    </div>

                    <div class="mb-3">
                        <label>Edad</label>
                        <input type="number" name="edad" class="form-control input-custom" required>
                    </div>

                    <div class="mb-3">
                        <label>Domicilio</label>
                        <input type="text" name="domicilio" class="form-control input-custom" placeholder="Calle, número" required>
                    </div>

                    <div class="mb-3">
                        <label>Municipio</label>
                        <input type="text" name="municipio" class="form-control input-custom" required>
                    </div>

                    <div class="mb-3">
                        <label>Colonia</label>
                        <input type="text" name="colonia" class="form-control input-custom" required>
                    </div>

                    <div class="mb-3">
                        <label>CURP</label>
                        <input type="text" name="curp" class="form-control input-custom" required>
                    </div>

                    <div class="mb-3">
                        <label>RFC (opcional)</label>
                        <input type="text" name="rfc" class="form-control input-custom">
                    </div>

                    <div class="mb-3">
                        <label>Enfermedades (opcional)</label>
                        <input type="text" name="enfermedad" class="form-control input-custom">
                    </div>

                    <div class="mb-3">
                        <label>¿Practica algún deporte? (opcional)</label>
                        <input type="text" name="deporte" class="form-control input-custom">
                    </div>

                    <div class="mb-3">
                        <label>Meta personal (opcional)</label>
                        <textarea name="meta" class="form-control input-custom" rows="3"></textarea>
                    </div>

                    <div class="mb-3">
                        <label>Foto (opcional)</label>
                        <input type="file" name="foto" class="form-control input-custom" accept="image/*">
                    </div>

                    <div class="mb-3">
                        <label>Currículum (PDF opcional)</label>
                        <input type="file" name="cv" class="form-control input-custom" accept="application/pdf">
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-success px-5 py-2">
                            <i class="bi bi-send-check-fill"></i> Enviar Postulación
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
