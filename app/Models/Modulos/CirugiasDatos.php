<?php

namespace App\Models\Modulos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CirugiasDatos extends Model
{
    use HasFactory;
    protected $fillable = [
        'cirugia_id',
        'hora',
        'FC',
        'FR',
        'Tem',
        'MM',
        'TLLC',
        'sopo2',
        'observacion',
        'valoracion',
        'total'
    ];
}
