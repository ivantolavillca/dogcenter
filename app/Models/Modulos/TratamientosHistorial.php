<?php

namespace App\Models\Modulos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TratamientosHistorial extends Model
{
    use HasFactory;

    protected $fillable = [
        'historial_id',
        'encargado',
        'fecha',
        'edad',
        'tratamiento',
        'observaciones',
        'user_id',
        'precio',

    ];
}
