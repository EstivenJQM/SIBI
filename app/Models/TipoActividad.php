<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoActividad extends Model
{
    protected $table = 'tipo_actividad';
    protected $primaryKey = 'id_tipo_actividad';

    protected $fillable = ['nombre'];

    public function lineas()
    {
        return $this->belongsToMany(
            Linea::class,
            'linea_tipo_actividad',
            'id_tipo_actividad',
            'id_linea'
        );
    }
}
