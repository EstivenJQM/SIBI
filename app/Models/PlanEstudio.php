<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanEstudio extends Model
{
    protected $table = 'plan_estudio';
    protected $primaryKey = 'id_plan_estudio';

    protected $fillable = ['id_programa_sede', 'codigo_plan'];

    public function programaSede()
    {
        return $this->belongsTo(ProgramaSede::class, 'id_programa_sede', 'id_programa_sede');
    }
}
