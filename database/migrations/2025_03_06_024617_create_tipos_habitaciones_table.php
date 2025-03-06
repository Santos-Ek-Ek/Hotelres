<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tipos_habitaciones', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_cuarto'); // Ej: Suite, Doble, Individual
            $table->integer('cantidad_maxima_personas'); // Ej: 2, 4, 6
            $table->integer('numero_camas'); // Número de camas en la habitación
            $table->text('descripcion')->nullable(); // Descripción opcional
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipos_habitaciones');
    }
};
