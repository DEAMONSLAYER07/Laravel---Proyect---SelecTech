<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Usuario;

class FichaTrabajo extends Model
{
    use HasFactory;

    protected $table = 'fichas_trabajo';

    protected $fillable = [
        'id_postulante',
        'area',
        'experiencia',
        'carta_recomendacion',
        'archivo_carta',
        'observaciones',
        'estado',
        'titulo',
        'empresa',
        'ciudad',
        'modalidad',
        'descripcion',
        'salario'
    ];

    public function postulante()
    {
        return $this->belongsTo(Usuario::class, 'id_postulante');
    }
}
