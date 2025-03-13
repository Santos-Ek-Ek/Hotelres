<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->id(); // Columna de ID autoincremental
            $table->unsignedInteger('cantidad_cuartos'); // Cantidad de cuartos reservados
            $table->unsignedBigInteger('huesped_id'); // Cantidad de cuartos reservados
            $table->unsignedBigInteger('habitacion_id'); // Cantidad de cuartos reservados
            $table->string('tipo_cuarto'); // ID del tipo de cuarto (clave foránea)
            $table->unsignedInteger('cantidad_huespedes'); // Cantidad de huéspedes
            $table->string('numero_reserva', 50); // Número de reserva (único)
            $table->decimal('subtotal', 10, 2); // Subtotal de la reserva (10 dígitos, 2 decimales)
            $table->date('fecha_entrada'); // Fecha de entrada
            $table->date('fecha_salida'); // Fecha de salida
            $table->unsignedInteger('cantidad_noches'); // Cantidad de noches
            $table->string('estado');
            $table->string('numero_cuarto');
            $table->timestamps(); // Columnas created_at y updated_at
             // Clave foránea que hace referencia a la tabla tipos_habitaciones
             $table->foreign('habitacion_id')->references('id')->on('habitaciones')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservas');
    }
}