<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Solicitudes - Seletech</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">
    <h2 class="mb-4 fw-bold text-center text-primary">Solicitudes Recibidas</h2>

    @if($solicitudes->isEmpty())
        <div class="alert alert-info text-center">Aún no hay solicitudes registradas.</div>
    @else
        <table class="table table-striped table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Foto</th>
                    <th>Nombre</th>
                    <th>Vacante</th>
                    <th>Correo</th>
                    <th>Teléfono</th>
                    <th>Sexo</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                @foreach($solicitudes as $solicitud)
                <tr>
                    <td>
                        <img src="{{ asset('storage/'.$solicitud->foto) }}" alt="Foto" width="60" height="70" class="rounded">
                    </td>
                    <td>{{ $solicitud->nombre }} {{ $solicitud->apellido_paterno }}</td>
                    <td>{{ $solicitud->vacante_titulo }}</td>
                    <td>{{ $solicitud->correo }}</td>
                    <td>{{ $solicitud->telefono ?? 'N/A' }}</td>
                    <td>{{ $solicitud->sexo }}</td>
                    <td>{{ $solicitud->created_at->format('d/m/Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
</body>
</html>
