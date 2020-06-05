<?php

namespace App;
use App\materia;
use Illuminate\Database\Eloquent\Model;

class estudiante extends Model
{
    protected $fillable = [

        'id',
        'nombre',
        'apellido',
        'telefono',
        'email',
        'idmat'
    ];

    public function setNombreAttribute($valor){
        $this->attributes['nombre'] = strtolower($valor);
    }

    public function getNombreAttribute($valor){
        return ucfirst($valor);
    }

    public function rela_materia(){

        return $this->belongsToMany(materia::class);

    }
}
