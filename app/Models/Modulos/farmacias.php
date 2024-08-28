<?php

namespace App\Models\Modulos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class farmacias extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'descripcion',
        'estado',
    ];
     //  envia su id primaria a Compras (modelo padre)
     public function productos_famaciaven()
     {
        return $this->hasMany(farmaciasVentas::class , 'id');
     }
}
