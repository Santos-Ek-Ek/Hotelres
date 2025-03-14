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
                $habitacion->descripcion = $request->input('detalles')[$index];
                $estado = $request->input('estado');
                $habitacion->estado = is_array($estado) && isset($estado[$index]) ? $estado[$index] : 'Disponible';
                

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

     public function edit(string $id)
{
    $habitacion = Habitacion::with('imagenes')->findOrFail($id);
    return response()->json([
        'habitacion' => $habitacion,
        'imagenes' => $habitacion->imagenes,
    ]);
}
public function eliminarImagen(string $id)
{
    $imagen = habitacion_imagenes::findOrFail($id);
    $imagen->delete();

    return response()->json(['success' => true]);
}
public function update(Request $request, string $id)
{
    // Buscar la habitación por su ID
    $habitacion = Habitacion::findOrFail($id);

    // Actualizar los campos de la habitación
    $habitacion->numero_habitacion = $request->input('nombre');
    $habitacion->tipo_habitacion_id = $request->input('categoria');
    $habitacion->descripcion = $request->input('detalles');
    $habitacion->estado = $request->input('estado');

    // Actualizar la imagen principal si se proporciona una nueva
    if ($request->hasFile('file')) {
        $imagenPrincipal = $request->file('file');
        $nombreImagenPrincipal = $imagenPrincipal->getClientOriginalName(); // Obtener el nombre original del archivo
        $rutaImagenPrincipal = public_path('habitaciones/' . $nombreImagenPrincipal); // Ruta completa en public_path
        $imagenPrincipal->move(public_path('habitaciones'), $nombreImagenPrincipal); // Mover el archivo a public/habitaciones
        $habitacion->imagen_habitacion = 'habitaciones/' . $nombreImagenPrincipal; // Guardar la ruta relativa en la base de datos
    }

    // Guardar los cambios en la base de datos
    $habitacion->save();

    // Guardar las nuevas imágenes adicionales, si existen
    if ($request->hasFile('nuevas_imagenes')) {
        foreach ($request->file('nuevas_imagenes') as $imagen) {
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

    // Redirigir al usuario con un mensaje de éxito
    return redirect()->back()->with('success', 'Habitación actualizada correctamente.');
}
public function buscarHabitaciones(Request $request)
{
    $checkin = $request->query('checkin');
    $checkout = $request->query('checkout');

    // Validar las fechas
    if (!$checkin || !$checkout) {
        return response()->json(['success' => false, 'message' => 'Fechas no válidas.']);
    }

    // Convertir las fechas a formato de base de datos
    $checkin = \Carbon\Carbon::createFromFormat('d-m-Y', $checkin)->format('Y-m-d');
    $checkout = \Carbon\Carbon::createFromFormat('d-m-Y', $checkout)->format('Y-m-d');

    // Obtener las habitaciones disponibles
    $habitacionesDisponibles = Habitacion::with('tipoHabitacion')
        ->whereDoesntHave('reservas', function ($query) use ($checkin, $checkout) {
            // Excluir habitaciones con reservas que solapen con el rango solicitado
            $query->where(function ($query) use ($checkin, $checkout) {
                $query->whereBetween('fecha_entrada', [$checkin, $checkout])
                      ->orWhereBetween('fecha_salida', [$checkin, $checkout])
                      ->orWhere(function ($query) use ($checkin, $checkout) {
                          $query->where('fecha_entrada', '<=', $checkin)
                                ->where('fecha_salida', '>=', $checkout);
                      });
            });
        })
        ->get();

    // Agrupar habitaciones por tipo_habitacion_id y contar cuántas hay disponibles
    $habitacionesPorTipo = [];
    foreach ($habitacionesDisponibles as $habitacion) {
        $tipoId = $habitacion->tipo_habitacion_id;
        if (!isset($habitacionesPorTipo[$tipoId])) {
            $habitacionesPorTipo[$tipoId] = [
                'tipo_habitacion' => $habitacion->tipoHabitacion,
                'cantidad_disponible' => 0,
                'habitaciones' => [],
            ];
        }
        $habitacionesPorTipo[$tipoId]['cantidad_disponible']++;
        $habitacionesPorTipo[$tipoId]['habitaciones'][] = $habitacion;
    }

    return response()->json([
        'success' => true,
        'habitacionesPorTipo' => array_values($habitacionesPorTipo), // Convertir a array indexado
    ]);
}
    /**
     * Remove the specified resource from storage.
     */
public function destroy(string $id)
{
    try {
        // Buscar la habitación por su ID
        $habitacion = Habitacion::findOrFail($id);

        // Eliminar las imágenes adicionales asociadas a la habitación
        $habitacion->imagenes()->delete();

        // Eliminar la habitación
        $habitacion->delete();

        // Devolver una respuesta JSON de éxito
        return response()->json([
            'success' => true,
            'message' => 'Habitación eliminada correctamente.',
        ]);
    } catch (\Exception $e) {
        // Devolver una respuesta JSON de error en caso de fallo
        return response()->json([
            'success' => false,
            'message' => 'Error al eliminar la habitación: ' . $e->getMessage(),
        ], 500);
    }
}
}
