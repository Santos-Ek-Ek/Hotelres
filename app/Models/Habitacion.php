<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Habitacion extends Model
{
    use HasFactory;

    protected $table = 'habitaciones';
    protected $fillable = ['numero_habitacion', 'tipo_habitacion_id', 'estado', 'descripcion', 'imagen_habitacion'];

    // Relación con la tabla tipos_habitaciones
    public function tipoHabitacion()
    {
        return $this->belongsTo(TipoHabitacion::class, 'tipo_habitacion_id');
    }

    // Relación con las imágenes adicionales de la habitación
    public function imagenes()
    {
        return $this->hasMany(habitacion_imagenes::class);
    }

    // Relación con las reservas (usando habitacion_id)
    public function reservas()
    {
        return $this->hasMany(Reserva::class, 'habitacion_id');
    }
}
