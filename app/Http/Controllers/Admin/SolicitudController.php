<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Solicitud;

class SolicitudController extends Controller
{
    public function index()
    {
        if (auth()->user()->rol !== 'rrhh') {
            abort(403, 'Acceso no autorizado.');
        }

        $solicitudes = Solicitud::with(['usuario', 'vacante'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.solicitudes.index', compact('solicitudes'));
    }

    public function show($id)
    {
        if (auth()->user()->rol !== 'rrhh') {
            abort(403, 'Acceso no autorizado.');
        }

        $solicitud = Solicitud::with(['usuario', 'vacante'])->findOrFail($id);

        return view('admin.solicitudes.show', compact('solicitud'));
    }


    public function destroy($id)
    {
        if (auth()->user()->rol !== 'rrhh') {
            abort(403, 'Acceso no autorizado.');
        }

        $solicitud = Solicitud::findOrFail($id);
        $solicitud->delete();

        return redirect()
            ->route('admin.solicitudes.index')
            ->with('success', 'La solicitud fue eliminada correctamente.');
    }
}
