<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Huesped;
use App\Models\Reserva;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
class ReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validar los datos del formulario
            $validatedData = $request->validate([
                'nombre' => 'required|string|max:255',
                'apellido' => 'required|string|max:255',
                'direccion' => 'nullable|string|max:255',
                'apartamento' => 'nullable|string|max:255',
                'pais' => 'required|string|max:255',
                'estado' => 'nullable|string|max:255',
                'ciudad' => 'nullable|string|max:255',
                'codigo_postal' => 'nullable|string|max:20',
                'correo' => 'required|email|max:255',
                'telefono' => 'required|string|max:20',
                'cantidad_cuartos' => 'required|integer|min:1',
                'tipo_cuarto' => 'required|string|max:255', // Cambia a tipo_cuarto
                'cantidad_huespedes' => 'required|integer|min:1',
                'subtotal' => 'required|numeric|min:0',
                'fecha_entrada' => 'required|date',
                'fecha_salida' => 'required|date|after:fecha_entrada',
                'cantidad_noches' => 'required|integer|min:1',
            ]);
    
            // Crear el huésped
            $huesped = Huesped::create([
                'nombre' => $request->nombre,
                'apellido' => $request->apellido,
                'direccion' => $request->direccion,
                'apartamento' => $request->apartamento,
                'pais' => $request->pais,
                'estado' => $request->estado,
                'ciudad' => $request->ciudad,
                'codigo_postal' => $request->codigo_postal,
                'correo' => $request->correo,
                'telefono' => $request->telefono,
                'estado' => 'pendiente',
            ]);
    
            // Generar un número de reserva único
            $numeroReserva = Str::upper(Str::random(8));
    
            // Crear la reserva
            $reserva = Reserva::create([
                'cantidad_cuartos' => $request->cantidad_cuartos,
                'tipo_cuarto' => $request->tipo_cuarto, // Usa tipo_cuarto
                'cantidad_huespedes' => $request->cantidad_huespedes,
                'numero_reserva' => $numeroReserva,
                'subtotal' => $request->subtotal,
                'fecha_entrada' => $request->fecha_entrada,
                'fecha_salida' => $request->fecha_salida,
                'cantidad_noches' => $request->cantidad_noches,
                'estado' => 'pendiente',
                'huesped_id' => $huesped->id,
            ]);
    
            // Retornar una respuesta
            return response()->json([
                'success' => true,
                'message' => 'Reserva creada con éxito',
                'numero_reserva' => $numeroReserva,
            ], 201);
    
        } catch (ValidationException $e) {
            // Devolver errores de validación en formato JSON
            return response()->json([
                'success' => false,
                'message' => 'Error de validación',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            // Devolver otros errores en formato JSON
            return response()->json([
                'success' => false,
                'message' => 'Hubo un error al procesar la reserva',
                'error' => $e->getMessage(),
            ], 500);
        }
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
