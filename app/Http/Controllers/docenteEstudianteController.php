<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\docente;

class docenteEstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $docente=docente::findOrFail($id);
        $estudiantes = $docente->rela_materia()
        ->with('rela_estudiante')
        ->get()
        ->pluck("rela_estudiante")
        ->collapse()
        ->unique()
        ->values();
        return $this->successResponse($estudiantes);
    }
}
