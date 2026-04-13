<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sede extends Model
{
    protected $table = 'sede';
    protected $primaryKey = 'id_sede';

    protected $fillable = ['codigo', 'nombre'];

    public function facultades()
    {
        return $this->belongsToMany(
            Facultad::class,
            'facultad_sede',
            'id_sede',
            'id_facultad'
        );
    }
}
