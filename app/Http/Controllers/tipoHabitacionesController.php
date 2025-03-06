<?php

namespace App\Http\Controllers;

use App\Models\tipoHabitacion;
use Illuminate\Http\Request;

class tipoHabitacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tipos = tipoHabitacion::all();
        return view('administrador.categorias', compact('tipos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $tipo = new tipoHabitacion();
       $tipo->tipo_cuarto = $request->input('tipo_cuarto');
       $tipo->cantidad_maxima_personas = $request->input('cantidad_maxima_personas');
       $tipo->numero_camas = $request->input('numero_camas');
       $tipo->descripcion = $request->input('descripcion');

       $tipo->save();
       return redirect()->back()->with('success', 'Tipo de habitación agregado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $tipo = tipoHabitacion::findOrFail($id);
        $tipo->tipo_cuarto = $request->input('tipo_cuarto');
        $tipo->cantidad_maxima_personas = $request->input('cantidad_maxima_personas');
        $tipo->numero_camas = $request->input('numero_camas');
        $tipo->descripcion = $request->input('descripcion');
    
        $tipo->save();
    
        return redirect()->back()->with('success', 'Tipo de habitación actualizado correctamente.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
