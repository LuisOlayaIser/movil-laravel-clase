<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\docente;

class docenteMateriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(docente $docente)
    {
        $materias = $docente->rela_materia;
        return $this->successResponse($materias);
    }

    
}
