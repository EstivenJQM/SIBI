<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facultad extends Model
{
    protected $table = 'facultad';
    protected $primaryKey = 'id_facultad';

    protected $fillable = ['nombre'];

    public function sedes()
    {
        return $this->belongsToMany(
            Sede::class,
            'facultad_sede',
            'id_facultad',
            'id_sede'
        );
    }
}
