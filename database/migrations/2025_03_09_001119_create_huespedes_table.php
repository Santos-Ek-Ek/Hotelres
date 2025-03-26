<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHuespedesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('huespedes', function (Blueprint $table) {
            $table->id(); // Columna de ID autoincremental
            $table->string('nombre', 100); // Nombre del huésped
            $table->string('apellido', 100); // Apellido del huésped
            $table->string('direccion', 255); // Dirección del huésped
            $table->string('apartamento', 100)->nullable(); // Apartamento (opcional)
            $table->string('pais', 100); // País del huésped
            $table->string('estado', 100); // Estado del huésped
            $table->string('ciudad', 100); // Ciudad del huésped
            $table->string('codigo_postal', 20); // Código postal del huésped
            $table->string('correo', 100); // Correo electrónico (único)
            $table->string('telefono', 20); // Teléfono del huésped
            $table->boolean('activo');
            $table->timestamps(); // Columnas created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('huespedes');
    }
}