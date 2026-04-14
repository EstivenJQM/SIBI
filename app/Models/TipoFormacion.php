<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoFormacion extends Model
{
    protected $table = 'tipo_formacion';
    protected $primaryKey = 'id_tipo_formacion';
    public $timestamps = false;

    protected $fillable = ['id_nivel', 'nombre'];

    public function nivel()
    {
        return $this->belongsTo(NivelAcademico::class, 'id_nivel', 'id_nivel');
    }
}
