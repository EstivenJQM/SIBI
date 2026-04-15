<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Programa extends Model
{
    protected $table = 'programa';
    protected $primaryKey = 'id_programa';

    protected $fillable = ['id_facultad', 'id_tipo_formacion', 'nombre'];

    public function programaSedes()
    {
        return $this->hasMany(ProgramaSede::class, 'id_programa', 'id_programa');
    }

    public function facultad()
    {
        return $this->belongsTo(Facultad::class, 'id_facultad', 'id_facultad');
    }

    public function tipoFormacion()
    {
        return $this->belongsTo(TipoFormacion::class, 'id_tipo_formacion', 'id_tipo_formacion');
    }

    public function sedes()
    {
        return $this->belongsToMany(
            Sede::class,
            'programa_sede',
            'id_programa',
            'id_sede'
        )->withPivot('codigo_snies')->withTimestamps();
    }
}
