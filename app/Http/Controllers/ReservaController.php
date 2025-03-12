<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Huesped;
use App\Models\Reserva;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;
use App\Models\Habitacion;
use App\Models\tipoHabitacion;
use App\Models\Pago;
use Illuminate\Support\Facades\DB;

class ReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservas = Reserva::all();
        return view('administrador.pedidos', compact('reservas'));
    }
    
    public function huesped(){
        $huespedes = Huesped::all();
        return view('administrador.usuarios',compact('huespedes'));
    }

    /**
     * Store a newly created resource in storage.
     */public function store(Request $request)
{
    DB::beginTransaction();

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
            'habitaciones' => 'required|array',
            'habitaciones.*.tipo' => 'required|string|max:255',
            'habitaciones.*.cantidad' => 'required|integer|min:1',
            'habitaciones.*.cantidad_cuartos' => 'required|integer|min:1',
            'habitaciones.*.cantidad_huespedes' => 'required|integer|min:1',
            'habitaciones.*.subtotal' => 'required|numeric|min:0',
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

        // Generar un número de reserva único (una sola vez)
        $numeroReserva = Str::upper(Str::random(8));

        // Formatear las fechas en el formato correcto (YYYY-MM-DD)
        $fechaEntrada = \Carbon\Carbon::parse($request->fecha_entrada)->toDateString();
        $fechaSalida = \Carbon\Carbon::parse($request->fecha_salida)->toDateString();

        // Crear una reserva por cada tipo de habitación
        foreach ($request->habitaciones as $habitacion) {
            // Obtener el tipo de habitación
            $tipoHabitacion = TipoHabitacion::where('tipo_cuarto', $habitacion['tipo'])->first();

            if (!$tipoHabitacion) {
                throw new \Exception("Tipo de habitación no encontrado: " . $habitacion['tipo']);
            }

            // Calcular el subtotal por habitación
            $subtotalPorHabitacion = $habitacion['subtotal'] / $habitacion['cantidad_cuartos'];

            // Buscar y asignar múltiples habitaciones disponibles del tipo seleccionado
            for ($i = 0; $i < $habitacion['cantidad_cuartos']; $i++) {
                // Buscar una habitación disponible del tipo seleccionado
                $habitacionDisponible = Habitacion::where('tipo_habitacion_id', $tipoHabitacion->id)
                    ->whereDoesntHave('reservas', function ($query) use ($fechaEntrada, $fechaSalida) {
                        // Excluir habitaciones con reservas que solapen con el rango solicitado
                        $query->where(function ($query) use ($fechaEntrada, $fechaSalida) {
                            $query->where('fecha_entrada', '<', $fechaSalida)
                                  ->where('fecha_salida', '>', $fechaEntrada);
                        });
                    })
                    ->lockForUpdate() // Bloquear la fila para evitar conflictos
                    ->first();

                if (!$habitacionDisponible) {
                    throw new \Exception("No hay suficientes habitaciones disponibles para el tipo: " . $habitacion['tipo']);
                }

                // Crear la reserva
                Reserva::create([
                    'huesped_id' => $huesped->id,
                    'tipo_cuarto' => $tipoHabitacion->tipo_cuarto,
                    'cantidad_cuartos' => 1,
                    'cantidad_huespedes' => $habitacion['cantidad_huespedes'],
                    'numero_reserva' => $numeroReserva,
                    'subtotal' => $subtotalPorHabitacion,
                    'fecha_entrada' => $fechaEntrada,
                    'fecha_salida' => $fechaSalida,
                    'cantidad_noches' => $request->cantidad_noches,
                    'estado' => 'pendiente',
                    'numero_cuarto' => $habitacionDisponible->numero_habitacion,
                    'habitacion_id' => $habitacionDisponible->id, // Asignar el ID de la habitación
                ]);

                // Log para depuración
                Log::info('Habitación asignada: ' . $habitacionDisponible->id . ' para la reserva: ' . $numeroReserva);
            }
        }

        // Registrar el pago
        $pago = Pago::create([
            'huesped_id' => $huesped->id,
            'numero_reserva' => $numeroReserva,
            'subtotal' => $request->subtotal,
            'impuesto' => $request->impuesto,
            'total' => $request->total,
            'fecha' => now(),
            'estado' => 'pendiente',
        ]);

        DB::commit();

        return response()->json([
            'success' => true,
            'message' => 'Reserva creada con éxito',
            'numero_reserva' => $numeroReserva,
            'huesped_id' => $huesped->id,
        ], 201);

    } catch (ValidationException $e) {
        DB::rollBack();
        return response()->json([
            'success' => false,
            'message' => 'Error de validación',
            'errors' => $e->errors(),
        ], 422);
    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('Error al crear la reserva: ' . $e->getMessage());

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
