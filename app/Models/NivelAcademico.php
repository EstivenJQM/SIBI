<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NivelAcademico extends Model
{
    protected $table = 'nivel_academico';
    protected $primaryKey = 'id_nivel';
    public $timestamps = false;

    protected $fillable = ['nombre'];

    public function tiposFormacion()
    {
        return $this->hasMany(TipoFormacion::class, 'id_nivel', 'id_nivel');
    }
}
