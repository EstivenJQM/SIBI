<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstudianteEgresado extends Model
{
    protected $table = 'estudiante_egresado';
    protected $primaryKey = 'id_usuario_rol_sede';
    public $timestamps = false;

    protected $fillable = ['id_usuario_rol_sede', 'id_plan_estudio'];

    public function planEstudio()
    {
        return $this->belongsTo(PlanEstudio::class, 'id_plan_estudio', 'id_plan_estudio');
    }

    public function usuarioRolSede()
    {
        return $this->belongsTo(UsuarioRolSede::class, 'id_usuario_rol_sede', 'id_usuario_rol_sede');
    }
}
