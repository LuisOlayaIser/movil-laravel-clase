<?php

namespace App\Http\Controllers;

use App\materia;
use Illuminate\Http\Request;

class materiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $materias = materia::all();
        return $this->successResponse($materias);
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
            'creditos' => 'required',
            'descripcion' => 'required',
            'horas' => 'required',
            'docente_id' => 'required',
        ];
        $this->validate($request,$rules);
        
        $campos = $request->all();
        //dd($campos);
        $materia = materia::create($campos);
        return $this->successResponse($materia);
    }

    /**
     * Display the specified resource.
     *
     * @param  App\materia  $materia
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $materia = materia::findOrFail($id);
        //dd($materia->id);
        return $this->successResponse($materia);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\materia  $materia
     * @return \Illuminate\Http\Response
     */
    public function edit(materia $materia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\materia  $materia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'creditos' => 'number',
        ];
        //dd($request);
        $this->validate($request,$rules);
        $materia = materia::findOrFail($id);
        $materia->fill($request->all());
        

        //dd($request);
        if($materia->isClean()){
            return response()->json("No se hicieron cambios",422);
        }

        $materia->save();
        
        return $this->successResponse($materia);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\materia  $materia
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $materia = materia::findOrFail($id);
        $materia->delete();
        return $this->successResponse($materia);
    }
}
