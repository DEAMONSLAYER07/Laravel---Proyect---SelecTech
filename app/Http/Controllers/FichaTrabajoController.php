<?php

namespace App\Http\Controllers;

use App\Models\FichaTrabajo;
use Illuminate\Http\Request;

class FichaTrabajoController extends Controller
{
    /**
     * Redirigir al dashboard (la vista index ya no existe)
     */
    public function index()
    {
        return redirect()->route('rh.dashboard')
            ->with('info', 'Gestiona las fichas desde el panel de control.');
    }


    /**
     * Formulario crear ficha
     */
    public function create()
    {
        return view('rh.fichas.create');
    }


    /**
     * Guardar ficha
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'empresa' => 'required|string|max:255',
            'ciudad' => 'required|string|max:255',
            'modalidad' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'experiencia' => 'required|string|max:255',
            'salario' => 'nullable|string|max:255',
            'estado' => 'required|in:Activa,Cerrada',
        ]);

        // Campos que la BD exige
        $validated['id_postulante'] = auth()->id();
        $validated['area'] = $request->input('area', 'General');
        $validated['carta_recomendacion'] = 0;
        $validated['archivo_carta'] = null;
        $validated['observaciones'] = $request->input('observaciones', '');

        FichaTrabajo::create($validated);

        return redirect()->route('rh.dashboard')
            ->with('success', 'Ficha de trabajo creada correctamente.');
    }


    /**
     * Formulario editar
     */
    public function edit($id)
    {
        $ficha = FichaTrabajo::findOrFail($id);

        return view('rh.fichas.edit', compact('ficha'));
    }


    /**
     * Actualizar ficha
     */
    public function update(Request $request, $id)
    {
        $ficha = FichaTrabajo::findOrFail($id);

        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'empresa' => 'required|string|max:255',
            'ciudad' => 'required|string|max:255',
            'modalidad' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'experiencia' => 'required|string|max:255',
            'salario' => 'nullable|string|max:255',
            'estado' => 'required|in:Activa,Cerrada',
        ]);

        $validated['area'] = $request->input('area', $ficha->area ?? 'General');
        $validated['carta_recomendacion'] = $ficha->carta_recomendacion ?? 0;
        $validated['archivo_carta'] = $ficha->archivo_carta;
        $validated['observaciones'] = $request->input('observaciones', $ficha->observaciones ?? '');
        $validated['id_postulante'] = $ficha->id_postulante;

        $ficha->update($validated);

        return redirect()->route('rh.dashboard')
            ->with('success', 'Ficha actualizada correctamente.');
    }


    /**
     * Eliminar
     */
    public function destroy($id)
    {
        FichaTrabajo::destroy($id);

        return redirect()->route('rh.dashboard')
            ->with('success', 'Ficha eliminada correctamente.');
    }
}