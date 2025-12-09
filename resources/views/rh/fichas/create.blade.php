@extends('layouts.app')

@section('content')
<div class="container mt-5">

    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header text-white text-center py-3"
                    style="background: linear-gradient(45deg, #0059ff, #00a6ff); border-radius: 10px 10px 0 0;">
                    <h3 class="mb-0"> Crear Nueva Vacante</h3>
                </div>

                <div class="card-body p-4">

                    {{-- ERRORES --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>⚠️ {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('fichas.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="fw-semibold">Puesto / Título</label>
                            <input type="text" name="titulo" class="form-control" placeholder="Ejemplo: Desarrollador PHP" required>
                        </div>

                        <div class="mb-3">
                            <label class="fw-semibold">Empresa</label>
                            <input type="text" name="empresa" class="form-control" placeholder="Ejemplo: SeleTech RH" required>
                        </div>

                        <div class="mb-3">
                            <label class="fw-semibold">Ciudad</label>
                            <input type="text" name="ciudad" class="form-control" placeholder="Ejemplo: Guadalajara" required>
                        </div>

                        <div class="mb-3">
                            <label class="fw-semibold">Modalidad</label>
                            <select name="modalidad" class="form-select" required>
                                <option value="Presencial">Presencial</option>
                                <option value="Híbrido">Híbrido</option>
                                <option value="Remoto">Remoto</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="fw-semibold">Descripción breve</label>
                            <textarea name="descripcion" rows="4" class="form-control"
                                placeholder="Describe brevemente el puesto..." required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="fw-semibold">Experiencia requerida</label>
                            <input type="text" name="experiencia" class="form-control"
                                placeholder="Ejemplo: 1-2 años en Laravel" required>
                        </div>

                        <div class="mb-3">
                            <label class="fw-semibold">Salario (opcional)</label>
                            <input type="text" name="salario" class="form-control" placeholder="Ejemplo: $15,000 - $22,000">
                        </div>

                        <div class="mb-3">
                            <label class="fw-semibold">Estado</label>
                            <select name="estado" class="form-select">
                                <option value="Activa">Activa</option>
                                <option value="Cerrada">Cerrada</option>
                            </select>
                        </div>

                        <div class="text-end mt-4">
                            <a href="{{ route('fichas.index') }}" class="btn btn-secondary me-2">
                                Cancelar
                            </a>

                            <button type="submit" class="btn btn-primary px-4">
                                Publicar Vacante 🚀
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

</div>
@endsection
