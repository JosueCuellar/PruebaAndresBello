<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    //

    protected $fillable = [
        'carnet',
        'nombre_completo',
        'fecha_nacimiento',
    ];
}
