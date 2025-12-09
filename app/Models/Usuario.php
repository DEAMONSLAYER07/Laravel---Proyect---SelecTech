<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuarios';

    protected $fillable = [
        'nombre',
        'email',
        'password',
        'rol',
    ];

    protected $hidden = ['password'];

    public function vacantes()
    {
        return $this->hasMany(Vacante::class, 'id_reclutador');
    }

    public function solicitudes()
    {
        return $this->hasMany(Solicitud::class, 'id_usuario');
    }
}
