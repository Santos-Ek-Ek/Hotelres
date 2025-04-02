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
use Illuminate\Support\Facades\Mail;
use App\Mail\ReservaConfirmada;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use App\Mail\CodigoCancelacionMail;
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
        $huespedes = Huesped::where('activo', 1)->get();
        return view('administrador.usuarios',compact('huespedes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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
            'estado' => 'Pendiente',
            'activo' =>'1',
        ]);

        // Generar un número de reserva único (una sola vez)
        $numeroReserva = Str::upper(Str::random(8));

        // Formatear las fechas en el formato correcto (YYYY-MM-DD)
        $fechaEntrada = \Carbon\Carbon::parse($request->fecha_entrada)->toDateString();
        $fechaSalida = \Carbon\Carbon::parse($request->fecha_salida)->toDateString();
        $habitacionesAsignadas = [];
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
                    'estado' => 'Pendiente',
                    'numero_cuarto' => $habitacionDisponible->numero_habitacion,
                    'habitacion_id' => $habitacionDisponible->id, // Asignar el ID de la habitación
                ]);

                $habitacionesAsignadas[] = [
                    'numero_cuarto' => $habitacionDisponible->numero_habitacion,
                    'tipo' => $tipoHabitacion->tipo_cuarto,
                    'cantidad_huespedes' => $habitacion['cantidad_huespedes'],
                    'subtotal' => $subtotalPorHabitacion,
                ];
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
            'estado' => 'Pendiente',
            'anticipo_estado' => 'Pendiente'
        ]);

        DB::commit();
        
                // Generar el PDF
                $pdf = PDF::loadView('emails.reserva_pdf', [
                    'huesped' => $huesped,
                    'reserva' => $numeroReserva,
                    'fecha_entrada' => $fechaEntrada,
                    'fecha_salida' => $fechaSalida,
                    'cantidad_noches' => $request->cantidad_noches, // Pasar la cantidad de noches
                    'habitaciones' => $habitacionesAsignadas, // Pasar las habitaciones con números
                    'subtotal' => $request->subtotal,
                    'impuesto' => $request->impuesto,
                    'total' => $request->total,
                    'correo' => $huesped->correo, // Pasar el correo del huésped
                    'fecha' => now()->format('Y-m-d'), // Pasar la fecha de la reserva
                ]);
        
                // Enviar el correo con el PDF adjunto
                Mail::to($huesped->correo)->send(new ReservaConfirmada($pdf));

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


    public function buscarReserva($numeroReserva)
    {
        // Buscar todas las reservas con el número de reserva
        $reservas = Reserva::where('numero_reserva', $numeroReserva)->get();
    
        if ($reservas->isEmpty()) {
            return response()->json(['mensaje' => 'Reservas no encontradas'], 404);
        }
    
        // Formatear las fechas de cada reserva
        $reservasFormateadas = $reservas->map(function ($reserva) {
            return [
                'id' => $reserva->id,
                'numero_reserva' => $reserva->numero_reserva,
                'tipo_cuarto' => $reserva->tipo_cuarto,
                'cantidad_cuartos' => $reserva->cantidad_cuartos,
                'cantidad_huespedes' => $reserva->cantidad_huespedes,
                'fecha_entrada' => Carbon::parse($reserva->fecha_entrada)->format('d-m-Y'), // Formato día/mes/año
                'fecha_salida' => Carbon::parse($reserva->fecha_salida)->format('d-m-Y'),   // Formato día/mes/año
                'cantidad_noches' => $reserva->cantidad_noches,
                'subtotal' => $reserva->subtotal,
                'estado' => $reserva->estado,
                'numero_cuarto' => $reserva->numero_cuarto,
            ];
        });
    
        // Devolver las reservas con las fechas formateadas
        return response()->json($reservasFormateadas);
    }
    public function cancelarReserva($reservaId)
    {
        // Buscar la reserva por su ID
        $reserva = Reserva::find($reservaId);
    
        if (!$reserva) {
            return response()->json(['mensaje' => 'Reserva no encontrada'], 404);
        }
    
        // Cambiar el estado de la reserva a "cancelada"
        $reserva->estado = 'Cancelado';
        $reserva->save();
    
        return response()->json(['mensaje' => 'Reserva cancelada correctamente']);
    }

    public function enviarCodigoCancelacion(Request $request)
    {
        // Validar el número de reserva
        $request->validate([
            'numero_reserva' => 'required|string|exists:reservas,numero_reserva',
        ]);
    
        // Obtener todas las reservas asociadas al número de reserva
        $reservas = Reserva::where('numero_reserva', $request->numero_reserva)->get();
    
        if ($reservas->isEmpty()) {
            return response()->json(['mensaje' => 'Reserva no encontrada.'], 404);
        }
    
        // Obtener el huésped asociado a la primera reserva
        $huesped = $reservas->first()->huespedCancela;
    
        if (!$huesped) {
            return response()->json(['mensaje' => 'Huésped no encontrado.'], 404);
        }
    
        // Generar un código de cancelación único
        $codigoCancelacion = Str::random(6); // Código de 6 caracteres
    
        // Guardar el código en la sesión (o en la base de datos si lo prefieres)
        session(['codigo_cancelacion' => $codigoCancelacion]);
    
        // Enviar el correo con el código de cancelación
        try {
            Mail::to($huesped->correo)->send(new CodigoCancelacionMail($codigoCancelacion));
        } catch (\Exception $e) {
            return response()->json([
                'mensaje' => 'Error al enviar el correo.',
                'error' => $e->getMessage(),
            ], 500);
        }
    
        return response()->json([
            'mensaje' => 'Se ha enviado un código de cancelación a tu correo.',
        ]);
    }
    
    public function validarCodigoYCancelar(Request $request)
    {
        // Validar el código de cancelación y el número de reserva
        $request->validate([
            'codigo' => 'required|string|size:6',
            'numero_reserva' => 'required|string|exists:reservas,numero_reserva',
        ]);
    
        // Obtener el código de la sesión
        $codigoSession = session('codigo_cancelacion');
    
        // Verificar si el código coincide
        if ($request->codigo === $codigoSession) {
            // Obtener todas las reservas asociadas al número de reserva
            $reservas = Reserva::where('numero_reserva', $request->numero_reserva)->get();
    
            // Cambiar el estado de las reservas a "cancelada"
            foreach ($reservas as $reserva) {
                $reserva->estado = 'Cancelado';
                $reserva->save();
            }
    
            // Limpiar el código de la sesión
            session()->forget('codigo_cancelacion');
    
            return response()->json([
                'mensaje' => 'Todas las reservas han sido canceladas correctamente.',
            ]);
        } else {
            return response()->json([
                'mensaje' => 'El código de cancelación es incorrecto.',
            ], 400);
        }
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
                 // Validar que el estado esté presente en la solicitud
                 $request->validate([
                    'estado' => 'required|in:Pendiente,Ocupado,Cancelado', // Asegúrate de que el estado sea válido
                ]);
        
                try {
                    // Buscar el pago por su ID
                    $reserva = Reserva::findOrFail($id);
        
                    // Actualizar el estado del pago
                    $reserva->estado = $request->estado;
                    $reserva->save();
        
                    // Devolver una respuesta JSON de éxito
                    return response()->json([
                        'success' => true,
                        'message' => 'Estado actualizado correctamente.',
                    ]);
                } catch (\Exception $e) {
                    // Log del error (opcional)
                    Log::error('Error al actualizar el estado del pago: ' . $e->getMessage());
        
                    // Devolver una respuesta JSON de error
                    return response()->json([
                        'success' => false,
                        'message' => 'Error al actualizar el estado.',
                    ], 500);
                }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $huesped = Huesped::findOrFail($id);
        $huesped->activo = 0;
        $huesped->save();
        return redirect()->back()->with('success', 'Huésped eliminado correctamente');
    }
}
