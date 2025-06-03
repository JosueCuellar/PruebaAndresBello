<?php

namespace App\Livewire;

use App\Models\Estudiante;
use App\Models\Materia;
use App\Models\Matricula;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

use function PHPUnit\Framework\isNull;

class Matriculas extends Component
{

    public $estudiantes, $materias, $carnet, $codigo, $materias_matriculadas = [], $id_estudiante, $id_materia, $mensaje;

    public function render()
    {
        return view('livewire.matriculas');
    }

    public function matricular()
    {

        $this->validate([
            "carnet" => "required",
            "codigo" => "required"
        ]);

        $var = DB::statement('EXEC sp_matricular_estudiante ?, ?', [$this->codigo, $this->carnet]);

        $this->id_estudiante = DB::table('estudiantes')->where('carnet', '=', $this->carnet)->get("id");
        $this->id_materia = DB::table('materias')->where('codigo', '=', $this->codigo)->get("id");

        if ($this->carnet == "") {
            $this->mensaje = "No existe registro";
        } else {
            if (sizeof($this->id_estudiante) > 0) {
                $this->materias_matriculadas = DB::table("materias")->join('matriculas', 'materias.id', '=', 'matriculas.id_materia')->where('matriculas.id_estudiante', "=",  $this->id_estudiante[0]->id)->get();
            } else {
                $this->reset(["materias_matriculadas"]);
            }
        }

        return view('livewire.matriculas');
    }

    public function eliminar($id){
        Matricula::destroy($id);
         if ($this->carnet == "") {
            $this->mensaje = "No existe registro";
        } else {
            if (sizeof($this->id_estudiante) > 0) {
                $this->materias_matriculadas = DB::table("materias")->join('matriculas', 'materias.id', '=', 'matriculas.id_materia')->where('matriculas.id_estudiante', "=",  $this->id_estudiante[0]->id)->get();
            } else {
                $this->reset(["materias_matriculadas"]);
            }
        }
    }

}
