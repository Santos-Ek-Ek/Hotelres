<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Huesped extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'huespedes'; // Nombre de la tabla

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
        'nombre',
        'apellido',
        'direccion',
        'apartamento',
        'pais',
        'estado',
        'ciudad',
        'codigo_postal',
        'correo',
        'telefono',
        'activo'
    ];

    // app/Models/Huesped.php
public function reservasCancela()
{
    return $this->hasMany(Reserva::class, 'huesped_id');
}
}