<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class habitacion_imagenes extends Model
{
    use HasFactory;
        // Define los campos que se pueden llenar
        protected $fillable = ['habitacion_id', 'imagen'];

        // Relación con la tabla habitaciones (es decir, la habitación a la que pertenece la imagen)
        public function habitacion()
        {
            return $this->belongsTo(Habitacion::class, 'habitacion_id');
        }
    
}
