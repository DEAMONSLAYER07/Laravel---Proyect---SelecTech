<?php

namespace App\Http\Controllers\Clases;

use App\Models\Vacante;
use Illuminate\Support\Facades\Log;

class VacanteManager
{
    
    public function listarVacantes()
    {
        try {
            return Vacante::with('reclutador')
                ->orderBy('created_at', 'desc')
                ->get();
        } catch (\Exception $e) {
            Log::error("Error al listar vacantes: " . $e->getMessage());
            return collect(); 
        }
    }

    public function buscarVacantes($termino)
    {
        try {
            if (!$termino) {

                return $this->listarVacantes();
            }

            return Vacante::with('reclutador')
                ->where('titulo', 'like', "%$termino%")
                ->orWhere('descripcion', 'like', "%$termino%")
                ->orWhere('ubicacion', 'like', "%$termino%")
                ->orderBy('created_at', 'desc')
                ->get();
        } catch (\Exception $e) {
            Log::error("Error al buscar vacantes: " . $e->getMessage());
            return collect();
        }
    }

    public function crearVacante(array $data)
    {
        try {
            $vacante = new Vacante();
            $vacante->titulo = $data['titulo'];
            $vacante->descripcion = $data['descripcion'];
            $vacante->ubicacion = $data['ubicacion'];
            $vacante->empresa = $data['empresa'] ?? 'No especificada';
            $vacante->salario = $data['salario'] ?? 0;
            $vacante->reclutador_id = $data['reclutador_id'] ?? null;
            $vacante->save();

            return $vacante;
        } catch (\Exception $e) {
            Log::error("Error al crear vacante: " . $e->getMessage());
            return null;
        }
    }


    public function actualizarVacante($id, array $data)
    {
        try {
            $vacante = Vacante::findOrFail($id);
            $vacante->update($data);
            return $vacante;
        } catch (\Exception $e) {
            Log::error("Error al actualizar vacante #$id: " . $e->getMessage());
            return null;
        }
    }

    public function eliminarVacante($id)
    {
        try {
            $vacante = Vacante::findOrFail($id);
            return $vacante->delete();
        } catch (\Exception $e) {
            Log::error("Error al eliminar vacante #$id: " . $e->getMessage());
            return false;
        }
    }
}