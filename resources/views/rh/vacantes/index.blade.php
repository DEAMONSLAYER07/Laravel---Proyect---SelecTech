@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between mb-3">
        <h2 class="text-light">Administrar Vacantes</h2>
        <a href="{{ route('rh.vacantes.create') }}" class="btn btn-primary">+ Nueva Vacante</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card bg-dark text-white shadow">
        <div class="card-body">
            <table class="table table-dark table-hover">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Empresa</th>
                        <th>Ubicación</th>
                        <th style="width: 180px;">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($vacantes as $vacante)
                    <tr>
                        <td>{{ $vacante->titulo }}</td>
                        <td>{{ $vacante->empresa }}</td>
                        <td>{{ $vacante->ubicacion }}</td>

                        <td>
                            <a href="{{ route('rh.vacantes.edit', $vacante->id) }}" class="btn btn-warning btn-sm">
                                Editar
                            </a>

                            <form action="{{ route('rh.vacantes.destroy', $vacante->id) }}" 
                                  method="POST"
                                  class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar vacante?')">
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>

</div>
@endsection
