<?php

namespace App;

use App\materia;

use Illuminate\Database\Eloquent\Model;

class docente extends Model
{
    protected $fillable = [
        'id',
        'nombre',
        'cargo',
        'email',
        'telefono',
        'apellido',
        'imagen'
    ];


    public function rela_materia()
    {
        return $this->hasMany(materia::class);
    }
}
