<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\materia;

class materiaEstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $materia=materia::findOrFail($id);
        $estudiantes = $materia->rela_estudiante;
        return $this->successResponse($estudiantes);
    }

    
}
