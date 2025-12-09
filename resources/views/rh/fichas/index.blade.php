@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <h2 class="text-light">Listado de Fichas de Trabajo</h2>

    @if(session('success'))
        <div class="alert alert-success mt-3">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('fichas.create') }}" class="btn btn-primary">+ Nueva Ficha</a>
    </div>

    <div class="card bg-dark text-light">
        <div class="card-body">

            <table class="table table-dark table-hover table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Empresa</th>
                        <th>Estado</th>
                        <th>Fecha</th>
                        <th style="width: 160px;">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($fichas as $ficha)
                    <tr>
                        <td>{{ $ficha->id }}</td>
                        <td>{{ $ficha->titulo ?? 'Sin título' }}</td>
                        <td>{{ $ficha->empresa ?? 'N/A' }}</td>
                        <td>{{ $ficha->estado }}</td>
                        <td>{{ $ficha->created_at->format('d/m/Y') }}</td>

                        <td>
                            <a href="{{ route('fichas.edit', $ficha->id) }}" class="btn btn-warning btn-sm">Editar</a>

                            <form action="{{ route('fichas.destroy', $ficha->id) }}" 
                                  method="POST" 
                                  class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar ficha?')">
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
