<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacante extends Model
{
    use HasFactory;

    protected $table = 'vacantes';

    protected $fillable = [
        'titulo',
        'descripcion',
        'empresa',
        'ubicacion',
        'salario',
        'id_reclutador',
    ];
    public function reclutador()
    {
        return $this->belongsTo(Usuario::class, 'id_reclutador');
    }

    public function postulaciones()
    {
        return $this->hasMany(Postulacion::class, 'id_vacante');
    }

    public function getNombreReclutadorAttribute()
    {
        return $this->reclutador ? $this->reclutador->nombre : 'Sin asignar';
    }

    public function getTotalPostulacionesAttribute()
    {
        return $this->postulaciones()->count();
    }
}
