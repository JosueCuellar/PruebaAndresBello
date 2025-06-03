<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    //
        protected $fillable = [
        'id_estudiante',
        'id_materia',
        'fecha'
    ];

    public function estudiantes()
    {
        return $this->hasMany(Estudiante::class);
    }

    public function materias()
    {
        return $this->hasMany(Materia::class);
    }
}
