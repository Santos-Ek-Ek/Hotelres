<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pago;
use Illuminate\Support\Facades\Log;

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
        //
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
