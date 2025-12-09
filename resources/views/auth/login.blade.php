<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión — SeleTech RRHH</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #001C3D 0%, #003A77 50%, #0056B3 100%);
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.97);
            color: #333;
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.25);
            width: 380px;
            padding: 2rem;
            animation: fadeIn 0.8s ease-in-out;
        }

        .login-card img {
            width: 100px;
            display: block;
            margin: 0 auto 1rem auto;
        }

        .login-card h3 {
            color: #800020;
            font-weight: 700;
            text-align: center;
            margin-bottom: 1rem;
        }

        .form-control {
            border-radius: 10px;
            border: 1px solid #ccc;
            padding: 0.75rem;
            transition: all 0.2s;
        }

        .form-control:focus {
            border-color: #800020;
            box-shadow: 0 0 5px #D4AF37;
        }

        .btn-login {
            background-color: #800020;
            border: none;
            color: #fff;
            font-weight: 600;
            border-radius: 10px;
            width: 100%;
            padding: 0.75rem;
            transition: all 0.3s;
        }

        .btn-login:hover {
            background-color: #D4AF37;
            color: #4B0013;
            transform: scale(1.03);
        }

        .footer-text {
            margin-top: 1rem;
            text-align: center;
            color: #800020;
            font-size: 0.9rem;
        }

        @keyframes fadeIn {
            from {opacity: 0; transform: translateY(-10px);}
            to {opacity: 1; transform: translateY(0);}
        }
    </style>
</head>

<body>
    <div class="login-card">
        <img src="{{ asset('images/logo.png') }}" alt="SeleTech Logo" onerror="this.style.display='none'">
        <h3>Recursos Humanos — SeleTech</h3>

        @if ($errors->any())
            <div class="alert alert-danger text-center py-2">
                <i class="bi bi-exclamation-triangle"></i> {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.post') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label fw-semibold">Correo institucional</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="tucorreo@seletech.com" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label fw-semibold">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="********" required>
            </div>

            <button type="submit" class="btn btn-login">
                <i class="bi bi-box-arrow-in-right"></i> Ingresar
            </button>
        </form>

        <p class="footer-text mt-3">
            © {{ date('Y') }} SeleTech | Departamento de Recursos Humanos
        </p>
    </div>
</body>
</html>
