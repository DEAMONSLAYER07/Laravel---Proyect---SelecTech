<?php

namespace App\Http\Controllers;

use App\Models\Vacante;
use App\Models\FichaTrabajo;
use Illuminate\Http\Request;
use App\Http\Controllers\Clases\VacanteManager;

class VacanteController extends Controller
{
    protected $vacanteManager;

    public function __construct()
    {
        $this->vacanteManager = new VacanteManager();
    }

    /**
     * Página principal (muestra fichas creadas por RH)
     */
    public function index()
    {
        // Ahora cargamos fichas activas, no vacantes estáticas
        $fichas = FichaTrabajo::where('estado', 'Activa')->get();

        return view('index', compact('fichas'));
    }


    /**
     * Búsqueda de vacantes (esto lo dejamos igual)
     */
    public function buscar(Request $request)
    {
        $termino = $request->input('query');
        $vacantes = $this->vacanteManager->buscarVacantes($termino);

        return view('vacantes.index', compact('vacantes', 'termino'));
    }


    /**
     * Crear vacante desde formulario público (lo dejamos)
     */
    public function crear(Request $request)
    {
        $data = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'ubicacion' => 'required|string|max:100',
            'empresa' => 'nullable|string|max:255',
        ]);

        $this->vacanteManager->crearVacante($data);

        return redirect()->back()->with('success', 'Vacante creada correctamente');
    }


    /* ============================================================
     *  CRUD PARA RRHH  (ADMINISTRACIÓN)
     * ============================================================ */

    public function indexRh()
    {
        $vacantes = Vacante::all();
        return view('rh.vacantes.index', compact('vacantes'));
    }

    public function createForm()
    {
        return view('rh.vacantes.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'ubicacion' => 'required|string|max:100',
            'empresa' => 'required|string|max:255',
        ]);

        Vacante::create($data);

        return redirect()->route('rh.vacantes')
                         ->with('success', 'Vacante creada correctamente');
    }

    public function edit($id)
    {
        $vacante = Vacante::findOrFail($id);
        return view('rh.vacantes.edit', compact('vacante'));
    }

    public function update(Request $request, $id)
    {
        $vacante = Vacante::findOrFail($id);

        $data = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'ubicacion' => 'required|string|max:100',
            'empresa' => 'required|string|max:255',
        ]);

        $vacante->update($data);

        return redirect()->route('rh.vacantes')
                         ->with('success', 'Vacante actualizada correctamente');
    }

    public function destroy($id)
    {
        Vacante::destroy($id);

        return redirect()->route('rh.vacantes')
                         ->with('success', 'Vacante eliminada correctamente');
    }

}
