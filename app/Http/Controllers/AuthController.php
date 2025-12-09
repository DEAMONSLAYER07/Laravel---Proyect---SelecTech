<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Mostrar la vista de inicio de sesión.
     */
    public function mostrarLogin()
    {
        return view('auth.login');
    }

    /**
     * Procesar el inicio de sesión.
     */
    public function login(Request $request)
    {
        // Validar datos del formulario
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Buscar usuario por correo
        $user = Usuario::where('email', $credentials['email'])->first();

        // Verificar credenciales
        if ($user && Hash::check($credentials['password'], $user->password)) {
            Auth::login($user);

            // Redirecciones según el rol
            switch (strtolower($user->rol)) {
                case 'rrhh':
                case 'rh':
                case 'admin': // si admin también debe ver el mismo panel
                    return redirect()->route('rh.dashboard');
                default:
                    return redirect()->route('home');
            }
        }

        // Credenciales incorrectas
        return back()
            ->withErrors(['email' => 'Correo o contraseña incorrectos.'])
            ->withInput();
    }

    /**
     * Cerrar sesión.
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
