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
        // Verificar si hay datos de habitaciones
        if ($request->has('nombre') && is_array($request->input('nombre'))) {
            // Iterar sobre cada habitación
            foreach ($request->input('nombre') as $index => $nombre) {
                // Crear una nueva habitación
                $habitacion = new Habitacion();
                $habitacion->numero_habitacion = $nombre;
                $habitacion->tipo_habitacion_id = $request->input('categoria')[$index];
                $habitacion->precio = $request->input('precio')[$index];
                $habitacion->descripcion = $request->input('detalles')[$index];

                // Guardar la imagen principal
                if ($request->hasFile('file') && isset($request->file('file')[$index])) {
                    $imagenPrincipal = $request->file('file')[$index];
                    $nombreImagenPrincipal = $imagenPrincipal->getClientOriginalName(); // Obtener el nombre original del archivo
                    $rutaImagenPrincipal = public_path('habitaciones/' . $nombreImagenPrincipal); // Ruta completa en public_path
                    $imagenPrincipal->move(public_path('habitaciones'), $nombreImagenPrincipal); // Mover el archivo a public/habitaciones
                    $habitacion->imagen_habitacion = 'habitaciones/' . $nombreImagenPrincipal; // Guardar la ruta relativa en la base de datos
                }

                // Guardar la habitación en la base de datos
                $habitacion->save();

                if ($request->hasFile("imagenes-{$index}")) {
                    foreach ($request->file("imagenes-{$index}") as $imagen) {
                        if ($imagen->isValid()) { // Verifica si el archivo es válido
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
                }
            }
        }

        // Redirigir al usuario con un mensaje de éxito
        return redirect()->back()->with('success', 'Habitaciones agregadas correctamente.');
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
