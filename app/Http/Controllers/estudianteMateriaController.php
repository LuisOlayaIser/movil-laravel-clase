<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\estudiante;

class estudianteMateriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(estudiante $estudiante)
    {
        $materias = $estudiante->rela_materia;
        return $this->successResponse($materias);
    }

    
}
