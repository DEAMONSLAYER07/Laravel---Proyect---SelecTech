<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gracias por postularte - Seletech</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #0a1f44, #0066cc);
            color: #fff;
            font-family: 'Segoe UI', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        .card {
            background: #fff;
            color: #333;
            border-radius: 18px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
            padding: 2.5rem;
            max-width: 450px;
            text-align: center;
            animation: fadeIn 0.6s ease-in-out;
        }
        .card h2 {
            color: #0a1f44;
            font-weight: 700;
        }
        .card p {
            color: #444;
        }
        .btn-primary {
            background-color: #0066cc;
            border: none;
            border-radius: 30px;
            padding: 0.7rem 2rem;
            transition: 0.3s;
        }
        .btn-primary:hover {
            background-color: #004999;
            transform: scale(1.05);
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

<div class="card">
    <img src="{{ asset('images/logo.png') }}" alt="Seletech Logo" height="70" class="mb-3">
    <h2>¡Gracias por preferir esta empresa!</h2>
    <p class="mt-3">
        Le haremos llegar más información sobre su solicitud a su correo electrónico.
        <br><br>
        Nuestro equipo de reclutamiento revisará su perfil lo antes posible.
    </p>

    <a href="{{ url('/') }}" class="btn btn-primary mt-3">
        <i class="bi bi-house-door-fill"></i> Regresar al inicio
    </a>
</div>

</body>
</html>
