<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramaSede extends Model
{
    protected $table = 'programa_sede';
    protected $primaryKey = 'id_programa_sede';

    protected $fillable = ['id_programa', 'id_sede', 'codigo_snies'];

    public function programa()
    {
        return $this->belongsTo(Programa::class, 'id_programa', 'id_programa');
    }

    public function sede()
    {
        return $this->belongsTo(Sede::class, 'id_sede', 'id_sede');
    }

    public function planesEstudio()
    {
        return $this->hasMany(PlanEstudio::class, 'id_programa_sede', 'id_programa_sede');
    }
}
