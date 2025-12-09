<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Postulacion extends Model
{
    protected $table = 'postulaciones';

    protected $fillable = [
        'id_usuario',
        'id_vacante',
        'cv',
        'estado',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }

    public function vacante()
    {
        return $this->belongsTo(Vacante::class, 'id_vacante');
    }
}
