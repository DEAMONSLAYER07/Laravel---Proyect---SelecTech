@extends('layouts.app')

@section('title', 'SeleTech RH - Detalle del Postulante')

@section('content')
<style>
/* Tu CSS original; no lo modifico */
</style>

<div class="container py-5">
    <div class="card-glass">

        {{-- HEADER --}}
        <div class="text-center mb-5">
            <i class="bi bi-person-badge-fill icon-title"></i>
            <h2 class="header-title">SeleTech RH — Perfil del Postulante</h2>
            <p class="text-light-50">Análisis detallado del candidato registrado</p>
        </div>

        {{-- FOTO + NOMBRE + FICHA --}}
        <div class="row align-items-center mb-5">
            <div class="col-md-4 text-center">

                <img src="{{ asset('storage/' . $solicitud->foto) }}" 
                     alt="Foto del postulante" 
                     class="foto-postulante">

                <h5 class="mt-3 fw-semibold text-light">
                    {{ $solicitud->nombre }} {{ $solicitud->apellido_paterno }} {{ $solicitud->apellido_materno }}
                </h5>

                <span class="badge bg-warning text-dark mt-2 px-3 py-2 shadow">
                    {{ $solicitud->ficha->titulo ?? 'Sin ficha asignada' }}
                </span>
            </div>

            {{-- INFO PERSONAL --}}
            <div class="col-md-8">
                <table class="table info-table table-borderless align-middle mb-0">
                    <tbody>
                        <tr><th>Edad</th><td>{{ $solicitud->edad }}</td></tr>
                        <tr><th>Sexo</th><td>{{ $solicitud->sexo }}</td></tr>
                        <tr>
                            <th>Correo</th>
                            <td><i class="bi bi-envelope-fill me-2 text-warning"></i>{{ $solicitud->correo }}</td>
                        </tr>
                        <tr>
                            <th>Teléfono</th>
                            <td><i class="bi bi-telephone-fill me-2 text-warning"></i>{{ $solicitud->telefono }}</td>
                        </tr>
                        <tr><th>Domicilio</th>
                            <td>{{ $solicitud->domicilio }}, {{ $solicitud->colonia }}, {{ $solicitud->municipio }}</td>
                        </tr>
                        <tr><th>CURP</th><td>{{ $solicitud->curp }}</td></tr>
                        <tr><th>RFC</th><td>{{ $solicitud->rfc }}</td></tr>
                        <tr><th>NSS</th><td>{{ $solicitud->nss ?? 'No especificado' }}</td></tr>
                        <tr><th>Enfermedad</th><td>{{ $solicitud->enfermedad ?? 'No especificado' }}</td></tr>
                        <tr><th>Club</th><td>{{ $solicitud->club ?? 'No especificado' }}</td></tr>
                        <tr><th>Deporte</th><td>{{ $solicitud->deporte ?? 'No especificado' }}</td></tr>
                        <tr><th>Meta personal</th><td>{{ $solicitud->meta ?? 'No especificado' }}</td></tr>
                    </tbody>
                </table>
            </div>
        </div>

        {{-- 🔥 INFORMACIÓN DE LA FICHA DE TRABAJO --}}
        <h4 class="text-warning fw-bold mt-4 mb-3">📄 Información de la Ficha de Trabajo</h4>

        @if(!$solicitud->ficha)

            <div class="alert alert-info">
                📌 Esta solicitud <strong>no tiene ficha asignada</strong>.
            </div>

            {{-- FORMULARIO PARA ASIGNAR FICHA --}}
            <form action="{{ route('rh.asignarFicha', $solicitud->id) }}" 
                  method="POST" 
                  class="bg-light p-3 rounded shadow-sm mb-4">
                @csrf

                <label class="fw-semibold">Asignar Ficha de Trabajo:</label>

                <select name="id_ficha" class="form-select mb-3" required>
                    <option value="">-- Selecciona una ficha --</option>
                    @foreach(\App\Models\FichaTrabajo::all() as $f)
                        <option value="{{ $f->id }}">
                            {{ $f->titulo }} — {{ $f->empresa }} ({{ $f->ciudad }})
                        </option>
                    @endforeach
                </select>

                <button class="btn btn-success fw-semibold px-4">✔ Asignar Ficha</button>
            </form>

        @else

            <table class="table info-table table-borderless mb-4">
                <tbody>
                    <tr><th>Puesto</th><td>{{ $solicitud->ficha->titulo }}</td></tr>
                    <tr><th>Empresa</th><td>{{ $solicitud->ficha->empresa }}</td></tr>
                    <tr><th>Ciudad</th><td>{{ $solicitud->ficha->ciudad }}</td></tr>
                    <tr><th>Modalidad</th><td>{{ $solicitud->ficha->modalidad }}</td></tr>
                    <tr><th>Experiencia requerida</th><td>{{ $solicitud->ficha->experiencia }}</td></tr>
                    <tr><th>Área</th><td>{{ $solicitud->ficha->area }}</td></tr>
                    <tr><th>Observaciones</th><td>{{ $solicitud->ficha->observaciones }}</td></tr>
                    <tr><th>Estado</th><td>{{ $solicitud->ficha->estado }}</td></tr>
                </tbody>
            </table>

        @endif

        {{-- BOTONES --}}
        <div class="text-center mt-4">

            <a href="{{ route('rh.dashboard') }}" class="btn btn-secondary px-4 me-3">
                ⬅️ Regresar
            </a>

            {{-- SOLO SI YA TIENE FICHA --}}
            @if ($solicitud->ficha)

                {{-- Botón contratar --}}
                <form action="{{ route('rh.actualizarEstadoFicha', [$solicitud->ficha->id, 'Contratado']) }}" 
                      method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-success px-5 me-3">✅ Contratar</button>
                </form>

                {{-- Botón rechazar --}}
                <form action="{{ route('rh.actualizarEstadoFicha', [$solicitud->ficha->id, 'Rechazado']) }}" 
                      method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-danger px-5">❌ No Contratar</button>
                </form>

            @else
                <div class="alert alert-warning mt-3">
                    ⚠️ No puedes contratar o rechazar porque esta solicitud <strong>NO tiene ficha asignada</strong>.
                </div>
            @endif

        </div>

    </div>

    <footer>
        © {{ date('Y') }} SeleTech RH — Sistema de Reclutamiento y Gestión de Talento
    </footer>
</div>
@endsection
