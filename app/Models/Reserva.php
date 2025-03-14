<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'reservas'; // Nombre de la tabla

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id'; // Clave primaria

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true; // ID autoincremental

    /**
     * The data type of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'int'; // Tipo de dato de la clave primaria

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true; // Usar timestamps (created_at y updated_at)

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cantidad_cuartos',
        'tipo_cuarto',
        'cantidad_huespedes',
        'numero_reserva',
        'subtotal',
        'fecha_entrada',
        'fecha_salida',
        'cantidad_noches',
        'estado',
        'huesped_id',
        'numero_cuarto',
        'habitacion_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        // Aquí puedes ocultar campos sensibles si es necesario
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'fecha_entrada' => 'date',
        'fecha_salida' => 'date',
    ];

    /**
     * Obtener el tipo de cuarto asociado a la reserva.
     */
    public function tipoCuarto()
    {
        return $this->belongsTo(tipoHabitacion::class, 'tipo_cuarto_id');
    }
    public function huesped()
    {
        return $this->belongsTo(Huesped::class);
    }
    public function habitacion()
{
    return $this->belongsTo(Habitacion::class);
}

public function habitacionbusqueda()
{
    return $this->belongsTo(Habitacion::class, 'numero_cuarto', 'numero_habitacion');
}

// app/Models/Reserva.php
public function huespedCancela()
{
    return $this->belongsTo(Huesped::class, 'huesped_id');
}
}