<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\estudiante;

class estudianteDocenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*public function index($id)
    {
        $estudiante=estudiante::findOrFail($id);
        $docentes = $estudiante->rela_materia
        //->with('rela_docente')
        /* ->pluck("rela_docente")
        ->collapse()
        ->unique()
        ->values() *//*;
        return $this->successResponse($docentes);
    }*/

    public function index($id)
    {
        $estudiante=estudiante::findOrFail($id);
        $docentes = $estudiante->rela_materia()->each(function ($data){
            $data->id = 25;
        });
        return $this->successResponse($docentes);
    }
}
