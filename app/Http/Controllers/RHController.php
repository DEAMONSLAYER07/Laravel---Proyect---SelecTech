<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use App\Models\FichaTrabajo;
use App\Models\Usuario;
use Illuminate\Http\Request;

class RHController extends Controller
{
    /**
     * Dashboard principal de Recursos Humanos
     */
    public function dashboard()
    {
        // Solicitues ligadas a fichas
        $solicitudes = Solicitud::with('ficha')
            ->latest()
            ->get();

        // Fichas creadas por RH
        $fichas = FichaTrabajo::with('postulante')
            ->latest()
            ->get();

        // Usuarios tipo postulante
        $postulantes = Usuario::where('rol', 'postulante')->get();

        return view('rh.dashboard', compact('solicitudes', 'fichas', 'postulantes'));
    }

    /**
     * Crear ficha de trabajo (RH)
     */
    public function guardarFicha(Request $request)
    {
        $validated = $request->validate([
            'id_postulante' => 'required|exists:usuarios,id',
            'area' => 'required|string|max:255',
            'experiencia' => 'required|integer|min:0',
            'carta_recomendacion' => 'nullable|boolean',
            'archivo_carta' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
            'observaciones' => 'nullable|string',
        ]);

        if ($request->hasFile('archivo_carta')) {
            $path = $request->file('archivo_carta')->store('cartas', 'public');
            $validated['archivo_carta'] = $path;
        }

        FichaTrabajo::create($validated);

        return redirect()->route('rh.dashboard')
            ->with('success', 'Ficha de trabajo creada correctamente.');
    }

    /**
     * Cambiar estado de una ficha
     */
    public function actualizarEstadoFicha($id, $estado)
    {
        $ficha = FichaTrabajo::findOrFail($id);
        $ficha->update(['estado' => $estado]);

        return back()->with('success', "Ficha actualizada a estado: $estado");
    }

    /**
     * Eliminar solicitud
     */
    public function eliminarSolicitud($id)
    {
        $solicitud = Solicitud::findOrFail($id);
        $solicitud->delete();

        return back()->with('success', 'La solicitud fue eliminada correctamente.');
    }

    /**
     * Ver solicitud detallada
     */
    public function verSolicitud($id)
    {
        $solicitud = Solicitud::with('ficha')->findOrFail($id);
        return view('rh.ver-solicitud', compact('solicitud'));
    }

    /**
     * Asignar una ficha de trabajo a una solicitud (nuevo)
     */
    public function asignarFicha(Request $request, $id)
    {
        $request->validate([
            'id_ficha' => 'required|exists:fichas_trabajo,id',
        ]);

        $solicitud = Solicitud::findOrFail($id);

        // Guardar relación
        $solicitud->id_ficha = $request->id_ficha;
        $solicitud->save();

        return back()->with('success', 'Ficha asignada correctamente al postulante.');
    }
}
