<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Solicitud;
use App\Models\FichaTrabajo;   // 👈 USAMOS FICHA, no Vacante
use Illuminate\Support\Facades\Auth;

class SolicitudController extends Controller
{
    /**
     * 📄 Mostrar formulario para una ficha específica
     */
    public function create($id)
    {
        // 🔍 Buscamos la ficha por ID
        $ficha = FichaTrabajo::findOrFail($id);

        return view('solicitud.create', compact('ficha'));
    }

    /**
     * 💾 Guardar solicitud
     */
    public function store(Request $request)
    {
        // 🧪 Validamos los datos
        $validated = $request->validate([
            'nombre'             => 'required|string|max:100',
            'apellido_paterno'   => 'required|string|max:100',
            'apellido_materno'   => 'required|string|max:100',
            'edad'               => 'required|integer|min:18|max:99',
            'sexo'               => 'required|string|max:1',
            'domicilio'          => 'required|string|max:255',
            'colonia'            => 'required|string|max:100',
            'municipio'          => 'required|string|max:100',
            'correo'             => 'required|email|max:150',
            'telefono'           => 'nullable|string|max:20',
            'curp'               => 'nullable|string|max:18',
            'rfc'                => 'nullable|string|max:13',
            'nss'                => 'nullable|string|max:15',
            'enfermedad'         => 'nullable|string|max:255',
            'club'               => 'nullable|string|max:255',
            'deporte'            => 'nullable|string|max:255',
            'meta'               => 'nullable|string|max:255',
            'foto'               => 'required|image|mimes:jpg,jpeg,png|max:2048',

            // 👇 ESTA ES LA NUEVA VALIDACIÓN CORRECTA
            'id_ficha'           => 'required|exists:fichas_trabajo,id',
        ]);

        // 📸 Guardamos la foto
        $pathFoto = $request->file('foto')->store('fotos', 'public');
        $validated['foto'] = $pathFoto;

        // 🔎 Obtenemos la ficha asociada
        $ficha = FichaTrabajo::findOrFail($validated['id_ficha']);

        // 📝 Creamos la solicitud
        $solicitud = new Solicitud($validated);
        $solicitud->vacante_titulo = $ficha->titulo;  // 👈 Ahora viene de ficha
        $solicitud->id_usuario = Auth::check() ? Auth::id() : null;

        // 💾 Guardar en BD
        $solicitud->save();

        return back()->with('success', '✅ Tu solicitud ha sido enviada correctamente.');
    }
}
