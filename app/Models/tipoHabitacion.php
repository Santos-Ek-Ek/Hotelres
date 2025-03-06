<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipoHabitacion extends Model
{
    use HasFactory;
    protected $table = 'tipos_habitaciones'; // Nombre de la tabla en la BD

    protected $fillable = [
        'tipo_cuarto',
        'cantidad_maxima_personas',
        'numero_camas',
        'descripcion'
    ];

    // Relación con habitaciones (si aplica)
    public function habitaciones()
    {
        return $this->hasMany(Habitacion::class); // Si tienes un modelo Habitacion
    }
}
