<?php

namespace App\Http\Controllers;

use App\Models\FichaTrabajo;
use Illuminate\Http\Request;

class FichaTrabajoController extends Controller
{
    /**
     * Mostrar lista de fichas
     */
    public function index()
    {
        $fichas = FichaTrabajo::orderBy('created_at', 'desc')->get();

        return view('rh.fichas.index', compact('fichas'));
    }


    /**
     * Formulario crear ficha
     */
    public function create()
    {
        return view('rh.fichas.create');
    }


    /**
     * Guardar ficha (VERSIÓN SIN ERRORES DE BD)
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

        // CAMPOS QUE LA BD EXIGE PERO TU FORM NO ENVÍA:
        $validated['id_postulante'] = auth()->id();
        $validated['area'] = $request->input('area', 'General');

        // EVITAR ERROR: ESTA COLUMNA ES INT, NO TEXTO
        $validated['carta_recomendacion'] = 0; // 0 = No

        $validated['archivo_carta'] = null;
        $validated['observaciones'] = $request->input('observaciones', '');

        FichaTrabajo::create($validated);

        return redirect()->route('fichas.index')
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

        // MISMA LÓGICA: ES UN ENTERO
        $validated['carta_recomendacion'] = $ficha->carta_recomendacion ?? 0;

        $validated['archivo_carta'] = $ficha->archivo_carta;
        $validated['observaciones'] = $request->input('observaciones', $ficha->observaciones ?? '');
        $validated['id_postulante'] = $ficha->id_postulante;

        $ficha->update($validated);

        return redirect()->route('fichas.index')
            ->with('success', 'Ficha actualizada correctamente.');
    }


    /**
     * Eliminar
     */
    public function destroy($id)
    {
        FichaTrabajo::destroy($id);

        return redirect()->route('fichas.index')
            ->with('success', 'Ficha eliminada correctamente.');
    }
}
