<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('habitaciones', function (Blueprint $table) {
            $table->id(); // ID de la habitación
            $table->string('numero_habitacion'); // Número de la habitación
            $table->longText('descripcion')->nullable(); // Número de la habitación
            $table->unsignedBigInteger('tipo_habitacion_id'); // ID del tipo de habitación (relación con tipos_habitaciones)
            $table->string('imagen_habitacion')->nullable(); // Imagen principal de la habitación (puede ser la primera imagen)
            $table->string('estado')->default('Disponible'); // Imagen principal de la habitación (puede ser la primera imagen)
            $table->timestamps(); // Fechas de creación y actualización

            // Clave foránea que hace referencia a la tabla tipos_habitaciones
            $table->foreign('tipo_habitacion_id')->references('id')->on('tipos_habitaciones')->onDelete('cascade');
        });

        // Tabla para almacenar las imágenes adicionales de las habitaciones
        Schema::create('habitacion_imagenes', function (Blueprint $table) {
            $table->id(); // ID de la imagen
            $table->unsignedBigInteger('habitacion_id'); // Relación con la habitación
            $table->string('imagen'); // Ruta de la imagen adicional
            $table->timestamps(); // Fechas de creación y actualización

            // Clave foránea que hace referencia a la tabla habitaciones
            $table->foreign('habitacion_id')->references('id')->on('habitaciones')->onDelete('cascade');
        });
    }

    public function down()
    {
        // Eliminamos las tablas en reversa
        Schema::dropIfExists('habitacion_imagenes');
        Schema::dropIfExists('habitaciones');
    }
};
