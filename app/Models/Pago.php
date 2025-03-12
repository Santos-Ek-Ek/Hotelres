<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pagos'; // Nombre de la tabla

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
        'numero_reserva',
        'huesped_id',
        'subtotal',
        'impuesto',
        'total',
        'fecha',
        'estado'
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
        'fecha' => 'date', // Convertir el campo fecha a tipo Carbon
    ];

    /**
     * Obtener la reserva asociada al pago.
     */
    public function reserva()
    {
        return $this->belongsTo(Reserva::class, 'numero_reserva', 'numero_reserva');
    }
    public function huesped()
    {
        return $this->belongsTo(Huesped::class, 'huesped_id');
    }
}