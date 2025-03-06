<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Habitacion;
use App\Models\habitacion_imagenes;
use App\Models\tipoHabitacion;

class HabitacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener los tipos de habitaciones desde la base de datos
        $tipos = tipoHabitacion::all();
        $habitaciones = Habitacion::all();
        // Pasar los tipos a la vista
        return view('administrador.productos', compact('tipos', 'habitaciones'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
                // Guardar la habitación
                $habitacion = new Habitacion();
                $habitacion->numero_habitacion = $request->input('nombre');
                $habitacion->tipo_habitacion_id = $request->input('categoria');
                // $habitacion->cantidad_habitaciones = $request->input('cantidad');
                $habitacion->precio = $request->input('precio');
                $habitacion->descripcion = $request->input('detalles');
                
                // Guardar la imagen principal
                if ($request->hasFile('file')) {
                    $imagenPrincipal = $request->file('file');
                    $nombreImagenPrincipal = $imagenPrincipal->getClientOriginalName(); // Obtener el nombre original del archivo
                    $rutaImagenPrincipal = public_path('habitaciones/' . $nombreImagenPrincipal); // Ruta completa en public_path
                    $imagenPrincipal->move(public_path('habitaciones'), $nombreImagenPrincipal); // Mover el archivo a public/habitaciones
                    $habitacion->imagen_habitacion = 'habitaciones/' . $nombreImagenPrincipal; // Guardar la ruta relativa en la base de datos
                }
                // Guardar la habitación en la base de datos
                $habitacion->save();
        
                // Guardar las imágenes adicionales, si existen
                if ($request->hasFile('imagenes')) {
                    foreach ($request->file('imagenes') as $imagen) {
                        $nombreImagen = $imagen->getClientOriginalName(); // Obtener el nombre original del archivo
                        $rutaImagen = public_path('habitaciones/otros/' . $nombreImagen); // Ruta completa en public_path
                        $imagen->move(public_path('habitaciones/otros'), $nombreImagen); // Mover el archivo a public/habitaciones/otros
            
                        // Guardar cada imagen en la base de datos
                        habitacion_imagenes::create([
                            'habitacion_id' => $habitacion->id,
                            'imagen' => 'habitaciones/otros/' . $nombreImagen, // Guardar la ruta relativa en la base de datos
                        ]);
                    }
                }
                // Redirigir al usuario con un mensaje de éxito
                return redirect()->back()->with('success', 'Habitación agregada correctamente.');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
