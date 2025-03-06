<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Habitacion extends Model
{
    use HasFactory;
    protected $table = 'habitaciones';
    protected $fillable = ['numero_habitacion', 'tipo_habitacion_id', 'descripcion','imagen_habitacion', 'precio'];

    // Relación con la tabla tipos_habitaciones
    public function tipoHabitacion()
    {
        return $this->belongsTo(tipoHabitacion::class, 'tipo_habitacion_id');
    }

    // Relación con las imágenes adicionales de la habitación
    public function imagenes()
    {
        return $this->hasMany(habitacion_imagenes::class);
    }
}
