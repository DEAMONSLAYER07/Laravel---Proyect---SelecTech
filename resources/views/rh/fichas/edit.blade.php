@extends('layouts.app')

@section('title', 'Editar Ficha de Trabajo')

@section('content')
<div class="container mt-5">

    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header text-white text-center py-3"
                     style="background: linear-gradient(45deg, #0059ff, #00a6ff); border-radius: 10px 10px 0 0;">
                    <h3 class="mb-0">✏️ Editar Ficha de Trabajo</h3>
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

                    <form method="POST" action="{{ route('fichas.update', $ficha->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="fw-semibold">Puesto / Título</label>
                            <input type="text" name="titulo" 
                                   value="{{ $ficha->titulo }}" 
                                   class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="fw-semibold">Empresa</label>
                            <input type="text" name="empresa" 
                                   value="{{ $ficha->empresa }}" 
                                   class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="fw-semibold">Ciudad</label>
                            <input type="text" name="ciudad" 
                                   value="{{ $ficha->ciudad }}" 
                                   class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="fw-semibold">Modalidad</label>
                            <select name="modalidad" class="form-select" required>
                                <option value="Presencial" {{ $ficha->modalidad == 'Presencial' ? 'selected' : '' }}>Presencial</option>
                                <option value="Híbrido" {{ $ficha->modalidad == 'Híbrido' ? 'selected' : '' }}>Híbrido</option>
                                <option value="Remoto" {{ $ficha->modalidad == 'Remoto' ? 'selected' : '' }}>Remoto</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="fw-semibold">Descripción</label>
                            <textarea name="descripcion" rows="4" class="form-control" required>{{ $ficha->descripcion }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="fw-semibold">Experiencia requerida</label>
                            <input type="number" name="experiencia" 
                                   value="{{ $ficha->experiencia }}" 
                                   class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="fw-semibold">Salario (opcional)</label>
                            <input type="text" name="salario" 
                                   value="{{ $ficha->salario }}" 
                                   class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="fw-semibold">Estado</label>
                            <select name="estado" class="form-select" required>
                                <option value="Activa" {{ $ficha->estado == 'Activa' ? 'selected' : '' }}>Activa</option>
                                <option value="Cerrada" {{ $ficha->estado == 'Cerrada' ? 'selected' : '' }}>Cerrada</option>
                            </select>
                        </div>

                        <div class="text-end mt-4">
                            <a href="{{ route('fichas.index') }}" class="btn btn-secondary me-2">Cancelar</a>
                            <button type="submit" class="btn btn-warning px-4">Guardar cambios ✏️</button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

</div>
@endsection
