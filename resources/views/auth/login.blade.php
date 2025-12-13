<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión — SeleTech RRHH</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        body {
            background: #0A1A2F;
            background: linear-gradient(135deg,#0A1A2F,#134074,#1E5A9C);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
        }

        .login-wrapper {
            width: 100%;
            max-width: 380px;
            padding: 2rem;
        }

        .login-card {
            background: #ffffff;
            border-radius: 18px;
            padding: 2rem 2rem 2.5rem;
            box-shadow: 0 10px 35px rgba(0,0,0,0.15);
            animation: fadeIn 0.7s ease;
        }

        .logo {
            width: 85px;
            display: block;
            margin: 0 auto 1rem;
        }

        .title {
            text-align: center;
            font-size: 1.4rem;
            font-weight: 600;
            color: #1A1A1A;
            margin-bottom: 1.4rem;
            line-height: 1.3;
        }

        .form-label {
            font-weight: 500;
            color: #333;
        }

        .form-control {
            border: 1px solid #d1d1d1;
            border-radius: 12px;
            padding: 0.75rem;
            font-size: 0.95rem;
        }

        .form-control:focus {
            border-color: #1257A5;
            box-shadow: 0 0 0 3px rgba(18, 87, 165, 0.25);
        }

        .btn-login {
            background: #1257A5;
            border: none;
            border-radius: 12px;
            width: 100%;
            padding: 0.8rem;
            font-weight: 600;
            color: white;
            font-size: 1rem;
            transition: 0.25s;
        }

        .btn-login:hover {
            background: #0D447E;
            transform: translateY(-2px);
        }

        .footer-text {
            text-align: center;
            font-size: 0.85rem;
            margin-top: 1.3rem;
            color: #e8e8e8;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>

<body>

<div class="login-wrapper">
    
    <div class="login-card">

        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo" onerror="this.style.display='none'">

        <h3 class="title">Iniciar Sesión<br><span style="font-size: 0.9rem; font-weight:400; color:#666;">SeleTech — Recursos Humanos</span></h3>

        @if ($errors->any())
            <div class="alert alert-danger text-center py-2">
                <i class="bi bi-exclamation-triangle"></i> {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.post') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Correo institucional</label>
                <input 
                    type="email" 
                    class="form-control" 
                    name="email"
                    placeholder="tucorreo@seletech.com"
                    required>
            </div>

            <div class="mb-4">
                <label class="form-label">Contraseña</label>
                <input 
                    type="password" 
                    class="form-control" 
                    name="password"
                    placeholder="********"
                    required>
            </div>

            <button class="btn btn-login">
                <i class="bi bi-box-arrow-in-right"></i> Ingresar
            </button>

        </form>
    </div>

    <p class="footer-text">© {{ date('Y') }} SeleTech — Departamento de RRHH</p>

</div>

</body>
</html>
