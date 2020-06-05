<?php

namespace App;

use App\docente;
use App\estudiante;
use Illuminate\Database\Eloquent\Model;

class materia extends Model
{
    protected $fillable = ['id', 'nombre', 'creditos', 'descripcion', 'horas', 'docente_id'];

    public function rela_docente()
    {

        return $this->belongsTo(docente::class);
    }

    public function rela_estudiante()
    {

        return $this->belongsToMany(estudiante::class);
    }
}
