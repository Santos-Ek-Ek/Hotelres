<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pago;
use App\Models\Reserva;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pagos = Pago::all();
        return view('administrador.pagos',compact('pagos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación de los datos de entrada
        $request->validate([
            'comprobante' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB máximo
            'numero_reserva' => 'required|exists:reservas,numero_reserva'
        ]);
    
        try {
            // Verificar que la reserva existe
            $reserva = Reserva::where('numero_reserva', $request->numero_reserva)->firstOrFail();
    
            // Verificar si ya existe un pago para esta reserva
            $pagoExistente = Pago::where('numero_reserva', $request->numero_reserva)->first();
            
            // Procesar la imagen
            if ($request->hasFile('comprobante')) {
                $file = $request->file('comprobante');
                
                // Crear directorio si no existe
                $directory = public_path('comprobantes');
                if (!file_exists($directory)) {
                    mkdir($directory, 0755, true);
                }
                
                // Generar nombre único para el archivo
                $fileName = 'comprobante-' . $request->numero_reserva . '.' . $file->getClientOriginalExtension();
                
                // Mover el archivo a public/comprobantes
                $file->move($directory, $fileName);
                
                // Ruta relativa para guardar en BD
                $relativePath = 'comprobantes/' . $fileName;
                
                // Actualizar o crear el registro de pago
                $pago = Pago::updateOrCreate(
                    ['numero_reserva' => $request->numero_reserva],
                    [
                        'anticipo' => $relativePath,
                        'anticipo_estado' => 'Pagado',
                    ]
                );
    
                return response()->json([
                    'success' => true,
                    'message' => 'Comprobante subido correctamente',
                    'pago' => $pago,
                    'comprobante_url' => asset($relativePath) // URL completa al archivo
                ]);
            }
    
            return response()->json([
                'success' => false,
                'message' => 'No se encontró el archivo del comprobante'
            ], 400);
    
        } catch (\Exception $e) {
            Log::error('Error en PagoController@store: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Error al procesar el comprobante',
                'error' => env('APP_DEBUG') ? $e->getMessage() : null
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
// En tu PagoController.php
public function show($numeroReserva)
{
    try {
        // Buscar el pago por número de reserva
        $pago = Pago::where('numero_reserva', $numeroReserva)->first();

        if (!$pago || empty($pago->anticipo)) {
            return response()->json([
                'success' => false,
                'message' => 'No se encontró comprobante para esta reserva'
            ], 404);
        }

        // Verificar que la ruta del comprobante es correcta
        $rutaComprobante = $pago->anticipo;
        
        // Construir ruta completa al archivo
        $rutaCompleta = public_path($rutaComprobante);
        
        // Verificar que el archivo existe físicamente
        if (!file_exists($rutaCompleta)) {
            return response()->json([
                'success' => false,
                'message' => 'El archivo del comprobante no existe en: '.$rutaComprobante
            ], 404);
        }

        return response()->json([
            'success' => true,
            'comprobante' => [
                'url' => asset($rutaComprobante), // URL pública completa
                'ruta' => $rutaComprobante, // Ruta relativa (comprobantes/comprobante-XXXXX.jpeg)
                'nombre_archivo' => basename($rutaComprobante),
                'estado' => $pago->anticipo_estado
            ]
        ]);

    } catch (\Exception $e) {
        Log::error('Error en PagoController@obtenerComprobante: '.$e->getMessage()."\n".$e->getTraceAsString());
        return response()->json([
            'success' => false,
            'message' => 'Error interno al obtener el comprobante',
            'error' => config('app.debug') ? $e->getMessage() : null
        ], 500);
    }
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         // Validar que el estado esté presente en la solicitud
         $request->validate([
            'estado' => 'required|in:Pendiente,Completado,Cancelado', // Asegúrate de que el estado sea válido
        ]);

        try {
            // Buscar el pago por su ID
            $pago = Pago::findOrFail($id);

            // Actualizar el estado del pago
            $pago->estado = $request->estado;
            $pago->save();

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


    // En tu PagoController.php
public function actualizar(Request $request, $numeroReserva)
{

    try {
        $pago = Pago::where('numero_reserva', $numeroReserva)->firstOrFail();
        
        // Eliminar el archivo anterior si existe
        if ($pago->anticipo && file_exists(public_path($pago->anticipo))) {
            unlink(public_path($pago->anticipo));
        }

        // Guardar el nuevo archivo
        $fileName = 'comprobante-' . $numeroReserva . '-' . $request->file('comprobante')->getClientOriginalExtension();
        $path = $request->file('comprobante')->move(public_path('comprobantes'), $fileName);
        $relativePath = 'comprobantes/' . $fileName;

        // Actualizar el registro
        $pago->update([
            'anticipo' => $relativePath,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Comprobante actualizado correctamente',
            'comprobante' => [
                'url' => asset($relativePath),
                'ruta' => $relativePath,
                'nombre_archivo' => $fileName,
                'estado' => $pago->anticipo_estado
            ]
        ]);

    } catch (\Exception $e) {
        Log::error('Error al actualizar comprobante: ' . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => 'Error al actualizar el comprobante'
        ], 500);
    }
}
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
