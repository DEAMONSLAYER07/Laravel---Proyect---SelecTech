<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    use HasFactory;

    protected $table = 'solicitudes';

    protected $fillable = [
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'edad',
        'sexo',
        'domicilio',
        'colonia',
        'municipio',
        'correo',
        'telefono',
        'curp',
        'rfc',
        'nss',
        'foto',
        'enfermedad',
        'club',
        'deporte',
        'meta',
        'vacante_titulo',   // <-- mantén esto, aunque venga de la ficha
        'id_ficha',         // <-- NUEVA COLUMNA CORRECTA
        'id_usuario',
    ];

    /**
     * Relación para obtener el usuario que envió la solicitud
     */
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }

    /**
     * Relación con la ficha de trabajo asociada
     */
    public function ficha()
    {
        return $this->belongsTo(FichaTrabajo::class, 'id_ficha');
    }
}
