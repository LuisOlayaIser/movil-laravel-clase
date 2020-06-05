<?php

namespace App\Http\Controllers;

use App\estudiante;
use Illuminate\Http\Request;

class estudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estudiantes = estudiante::all();
        return $this->successResponse($estudiantes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'nombre' => 'required',
            'apellido' => 'required',
            'telefono' => 'required',
            'email' => 'required|email'
        ];
        $this->validate($request,$rules);
        $campos = $request->all();
        $estudiante = estudiante::create($campos);
        return $this->successResponse($estudiante);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function show(estudiante $estudiante)
    {
        return $this->successResponse($estudiante);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function edit(estudiante $estudiante)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, estudiante $estudiante)
    {
        $rules = [
            'email' => 'email'
        ];
        $this->validate($request,$rules);

        $estudiante->fill($request->all());

        if($estudiante->isClean()){
            return $this->errorResponse("No se hicieron cambios", 422);
        }


        $estudiante->save();
        
        
        return $this->successResponse($estudiante);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function destroy(estudiante $estudiante)
    {
        $estudiante->delete();
        return $this->successResponse($estudiante);
    }
}
