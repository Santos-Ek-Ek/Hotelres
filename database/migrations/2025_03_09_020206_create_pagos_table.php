<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->id(); // Columna de ID autoincremental
            $table->string('numero_reserva', 50); // Número de reserva (relación con la tabla reservas)
            $table->unsignedBigInteger('huesped_id'); // Clave foránea para el huésped
            $table->decimal('subtotal', 10, 2); // Subtotal del pago (10 dígitos, 2 decimales)
            $table->decimal('impuesto', 10, 2); // Impuesto del pago (10 dígitos, 2 decimales)
            $table->decimal('total', 10, 2); // Total del pago (10 dígitos, 2 decimales)
            $table->date('fecha'); // Fecha del pago
            $table->string('estado'); // Estado del pago
            $table->string('anticipo')->nullable();
            $table->string('anticipo_estado')->nullable();
            $table->timestamps(); // Columnas created_at y updated_at
    
            // Definir la clave foránea para numero_reserva
            $table->foreign('numero_reserva')
                  ->references('numero_reserva')
                  ->on('reservas')
                  ->onDelete('cascade'); // Eliminar pagos si se elimina la reserva
    
            // Definir la clave foránea para huesped_id
            $table->foreign('huesped_id')
                  ->references('id')
                  ->on('huespedes')
                  ->onDelete('cascade'); // Eliminar pagos si se elimina el huésped
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pagos');
    }
}