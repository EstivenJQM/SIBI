<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuario';
    protected $primaryKey = 'id_usuario';

    protected $fillable = [
        'documento',
        'primer_nombre',
        'segundo_nombre',
        'primer_apellido',
        'segundo_apellido',
        'correo',
    ];

    /** "APELLIDO1 [APELLIDO2], NOMBRE1 [NOMBRE2]" */
    public function getNombreCompletoAttribute(): string
    {
        $apellidos = collect([$this->primer_apellido, $this->segundo_apellido])->filter()->implode(' ');
        $nombres   = collect([$this->primer_nombre,   $this->segundo_nombre])->filter()->implode(' ');

        return "{$apellidos}, {$nombres}";
    }

    public function rolesEnSedes()
    {
        return $this->hasMany(UsuarioRolSede::class, 'id_usuario', 'id_usuario');
    }
}
